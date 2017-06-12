<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $user = $this->session->userdata('user');
        if(!isset($user)){
        	redirect('Login');
        }
        $this->load->model('Vehicles_model');
        $this->load->model('Services_model');
        $this->load->model('Stations_model');
        $this->load->model('Exports_model');
        $this->load->model('Sales_model');
        $this->load->model('Expenses_model');
        $this->load->model('Notifications_model');
        $this->load->model('Account_model');
        date_default_timezone_set('Asia/Karachi');
        
    }


	public function index(){	
        $data = $this->getInventory();
        if($data['vehicles']){
            $vehicles = $data['vehicles'];
            $i = 0;
            foreach ($vehicles as $vehicle) {
                if($vehicle->status === 'Sold'){
                    $today = $vehicle->saledate;
                    $date = $vehicle->date;
                    $datetime1 = date_create($date);
                    $datetime2 = date_create($today);
                    $interval = date_diff($datetime1, $datetime2);

                    $vehicles[$i]->days = $interval->format('%a');
                }else{
                    $today = date('Y-m-d');
                    $date = $vehicle->date;
                    $datetime1 = date_create($date);
                    $datetime2 = date_create($today);
                    $interval = date_diff($datetime1, $datetime2);

                    $vehicles[$i]->days = $interval->format('%a');
                }
                
                $i++;
            }
            
            $data['vehicles'] = $vehicles;
        }
        $data['notifications'] = $this->getNotifications();
		$this->load->view('inventory',$data);
	}

	public function add(){
        $user = $this->session->userdata('user');
        
        //Validation Rules
        $this->form_validation->set_rules('name', 'Vehicle Name', 'required');
        $this->form_validation->set_rules('chassis', 'Chassis Number', 'required|is_unique[vehicles.chassis]');
        $this->form_validation->set_rules('make', 'Make', 'required');
        $this->form_validation->set_rules('model', 'Model', 'required');
        $this->form_validation->set_rules('year', 'Year', 'required');
        $this->form_validation->set_rules('stars', 'Year', 'required|numeric');
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');

        $this->form_validation->set_message('is_unique', 'Vehicle with %s is already entered');

        if ($this->form_validation->run() == FALSE){ 
            //Validation False
            echo json_encode(array('status' => 'error', 'msg' => validation_errors()));

        }else{
            
            $vehicle = array(
                'name' => $this->input->post('name'),
                'chassis' => $this->input->post('chassis'),
                'make' => $this->input->post('make'),
                'model' => $this->input->post('model'),
                'year' => $this->input->post('year'),
                'stars' => $this->input->post('stars'),
                'purchase_price' => $this->input->post('price'),
                'status' => "InStock",
                'date' => date('m/d/Y'),
                'time' => date('h:i A'),
                'added_by' => $user['user'],
                'current_location' => $user['location']
            );

            $vehicle_id = $this->Vehicles_model->add($vehicle);

            //Making Transaction
            $this->maketransaction('debit',$vehicle['purchase_price'],"Purchase of Vehicle, Chassis: ".$vehicle['chassis']);


            $servicecharges = 0;
            $servicename = $this->input->post('servicename[]');
            $serviceprice = $this->input->post('serviceprice[]');
            if(isset($servicename) && isset($servicename)){
                for($i = 0; $i < Count($servicename); $i++){

                    $service = array(
                        'vehicle_id' => $vehicle_id,
                        'service_name' => $servicename[$i],
                        'service_price' => $serviceprice[$i],
                        'date' => date('m/d/Y')
                    );
                    $this->Services_model->add($service);
                    //Making Transaction
                    $this->maketransaction('debit',(Int)$serviceprice[$i],"Service of Vehicle, Chassis: ".$vehicle['chassis']);

                    $servicecharges += (Int)$serviceprice[$i];
                }
            }

            //Making vehicle array for response
            $vehicle['id'] = $vehicle_id;
            $vehicle['location'] = $user['station'];
            $vehicle['date'] = date('d M, Y');

            //Updating Vehicle Cost
            $this->updateCost($vehicle_id);



            //To Add Expense
            $this->addExpense('Inventory Expense', (Int)$this->input->post('purchase_price'), $vehicle['id']);
            $this->addExpense('Services Expense', (Int)$servicecharges, $vehicle['id']);
           
            

            echo json_encode(array('status' => 'success', 'vehicle' => $vehicle));
        }
    }


    //Get Vehicle Data
    public function get(){
        $id = $this->input->post('id');
        if(isset($id)){
            $vehicle = $this->Vehicles_model->getvehicle($id);
            //Looking for vehicle images
            if($vehicle){
                $vehicle = $vehicle[0];
                $folder = './assets/uploads/'.$id;
                if (!is_dir($folder)) {
                    $vehicle->images = false;
                }else{
                    $this->load->helper('directory');
                    $files = directory_map($folder);
                    $vehicle->images = $files;
                }
            }
            //Getting Services
            $vehicle->services = $this->Services_model->getservices($id);    
            $vehicle->exported = $this->Exports_model->getvehicle($id);
            echo json_encode(array('status' => 'success', 'vehicle' => $vehicle));
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Vehicle Not Found' ));
        }
    }


    //Updating Vehicle Data
    public function edit(){
        
        $id = $this->input->post('id');
        if(isset($id)){
            //Validation Rules
            $this->form_validation->set_rules('name', 'Vehicle Name', 'required');
            $this->form_validation->set_rules('chassis', 'Chassis Number', 'required');
            $this->form_validation->set_rules('make', 'Make', 'required');
            $this->form_validation->set_rules('model', 'Model', 'required');
            $this->form_validation->set_rules('year', 'Year', 'required');
            $this->form_validation->set_rules('stars', 'Year', 'required|numeric');
            $this->form_validation->set_rules('price', 'Price', 'required|numeric');

            $this->form_validation->set_message('is_unique', 'Vehicle with %s is already entered');

            if ($this->form_validation->run() == FALSE){ 
                //Validation False
                echo json_encode(array('status' => 'error', 'msg' => validation_errors()));

            }else{
                $servicecharges = 0;
                //Checking IF Price Changed
                $purchasePrice = $this->Vehicles_model->getvehicle($id)[0]->price;
                $pricechange = (Int)$purchasePrice - (Int)$this->input->post('price');
                $pricechange = -1 * (Int)$pricechange;
                
                
                $vehicle = array(
                    'name' => $this->input->post('name'),
                    'chassis' => $this->input->post('chassis'),
                    'make' => $this->input->post('make'),
                    'model' => $this->input->post('model'),
                    'year' => $this->input->post('year'),
                    'stars' => $this->input->post('stars'),
                    'purchase_price' => $this->input->post('price')
                );
                $update = $this->Vehicles_model->update($id, $vehicle);
                
                    //Updating Other Services
                    $serviceid = $this->input->post('serviceid[]');
                    $servicename = $this->input->post('servicename[]');
                    $serviceprice = $this->input->post('serviceprice[]');
                    //If Services Exist
                    if(isset($servicename) && isset($servicename)){
                        for($i = 0; $i < Count($servicename); $i++){
                            if(isset($serviceid[$i])){

                                //Checking If Services Price Changed
                                $service = $this->Services_model->getservice($serviceid[$i])[0];
                                $servicechange = (Int)$service->service_price - (Int)$serviceprice[$i];
                                $servicechange = -1 * (Int)$servicechange;
                                
                                $servicecharges += (int)$servicechange;


                                //Update Service
                                
                                $service = array(
                                    'service_name' => $servicename[$i],
                                    'service_price' => $serviceprice[$i]
                                );
                                $update = $this->Services_model->update($serviceid[$i],$service);



                            }else{
                                //Insert Service
                                
                                $service = array(
                                    'vehicle_id' => $id,
                                    'service_name' => $servicename[$i],
                                    'service_price' => $serviceprice[$i],
                                    'date' => date('m/d/Y')
                                );
                                $this->Services_model->add($service); 

                                //Making Transaction
                                $this->maketransaction('debit',(Int)$serviceprice[$i],"Service of Vehicle, Chassis: ".$vehicle['chassis']);

                                $servicecharges += (Int)$serviceprice[$i];
                            }
                            
                        }
                    }
                    $vehicle['id'] = $id;

                    //Updating Vehicle Cost
                    $this->updateCost($id);

                    //Updating Expenses/Cash
                    $this->addExpense('Inventory Expense', (Int)$pricechange, $vehicle['id']);
                    $this->addExpense('Services Expense', (Int)$servicecharges, $vehicle['id']);


                    echo json_encode(array('status' => 'success', 'vehicle' => $vehicle));
                

            }

        }else{
            //ID Not Given
            echo json_encode(array('status' => 'error', 'msg' => "Updating Vehicle Information Failed"));
        }

    }

    //Uploading Vehicle Images
    public function upload(){

        $folder = './assets/uploads/'.$this->input->post('id');

        if (!is_dir($folder)) {
          mkdir($folder, 0777, TRUE);
        }

        $config['upload_path']          = $folder;
        $config['allowed_types']        = 'gif|jpg|png|jpeg';
        $this->load->library('upload', $config);
         if ( ! $this->upload->do_upload('qqfile')){
            
            $error = array('error' => $this->upload->display_errors());

            echo json_encode(array('success' => false ));
        }else{  

            
            $vid = $this->input->post('id');

            echo json_encode(array('success' => true ,'id' => $vid));           
        } 

    }

    //Delete Service
    public function deleteservice(){
        $id = $this->input->post('id');
        if(isset($id)){
            //Getting Vehicle ID
            $service = $this->Services_model->getservice($id)[0];
            $vehicle_id = $service->vehicle_id;
            $amount = -1 * (Int)$service->service_price;

            $delete = $this->Services_model->delete($id);
            if($delete){

                //Updating Vehicle Cost
                $this->updateCost($vehicle_id);

                //Making Transaction
                $this->maketransaction('credit',(Int)$amount,"Service Correction");

                //Managing Expenses
                $this->addExpense('Services Expense', (Int)$amount, $vehicle_id);

                

                echo json_encode(array('status' => 'success' ,'msg' => 'Service Successfully Deleted'));  
            }else{
                echo json_encode(array('status' => 'error' ,'msg' => 'Error While Deleting Service'));
            }
        }else{
           echo json_encode(array('status' => 'error' ,'msg' => 'Error While Deleting Service')); 
        }
        
    }


    //Export Vehicle
    public function export(){
        $id = $this->input->post('vehicle_id');
        if(isset($id)){
            $user = $this->session->userdata('user');

            $this->form_validation->set_rules('shippingprice', 'Shipping Price', 'required|numeric');
            $this->form_validation->set_rules('deliverydate', 'Delivery Date', 'required');
            $this->form_validation->set_rules('destination', 'Destination', 'required');

            if ($this->form_validation->run() == FALSE){ 
                //Validation False
                echo json_encode(array('status' => 'error', 'msg' => validation_errors()));

            }else{
                //Check If Vehicle Already Exported
                $exported = $this->Exports_model->getvehicle($id);
                if(!$exported){
                    //Vehicle Not Exported
                    $export = array(
                        'vehicle_id' => $this->input->post('vehicle_id'),
                        'destination' => $this->input->post('destination'),
                        'shipment_price' => $this->input->post('shippingprice'),
                        'status' => 'enroute',
                        'export_date' => date('m/d/Y'),
                        'delivery_date' => $this->input->post('deliverydate'),
                        'exported_by' => $user['user']
                    );

                    $export_id = $this->Exports_model->add($export);


                    //Adding Notification
                    $this->addnotification($this->input->post('destination'), 'export', 'Vehicle Exported To Your Station');

                    //TO DO NOTIFICATION WORK HERE FOR EXPORT
                    //TO DO NOTIFICATION WORK HERE FOR EXPORT
                    //TO DO NOTIFICATION WORK HERE FOR EXPORT
                    //TO DO NOTIFICATION WORK HERE FOR EXPORT
                    //TO DO NOTIFICATION WORK HERE FOR EXPORT
                    //TO DO NOTIFICATION WORK HERE FOR EXPORT
                    //TO DO NOTIFICATION WORK HERE FOR EXPORT

                    //Updating Vehicle Cost
                    $this->updateCost($this->input->post('vehicle_id'));

                    //Making Transaction
                    $this->maketransaction('debit',(Int)$this->input->post('shippingprice'),"Shipping of Vehicle");

                    //To Add Expense And Subtract From Account
                    $this->addExpense('Shipping Expense' , (Int)$this->input->post('shippingprice'), $id);
                    

                    echo json_encode(array('status' => 'success' ,'msg' => 'Vehicle Successfully Exported'));
                }else{
                    echo json_encode(array('status' => 'error' ,'msg' => 'Vehicle Already Exported'));
                }

                
            }

        }else{
            echo json_encode(array('status' => 'error' ,'msg' => 'Error Exporting Vehicle')); 
        }
    }


    //Delete Image
    public function deleteimage(){
        $vehicle = $this->input->post('vehicle');
        $image = $this->input->post('image');
        if(isset($vehicle) && isset($image)){
            $file = './assets/uploads/'.$vehicle.'/'.$image;
            if(unlink($file)) {
                echo json_encode(array('status' => 'success' ,'msg' => 'Image Deleted Successfully'));
            }else {
                echo json_encode(array('status' => 'error' ,'msg' => 'Error Deleting Image'));
            }
        }else{
            echo json_encode(array('status' => 'error' ,'msg' => 'Error Deleting Image')); 
        }
    }


    //Sell Vehicle
    public function sell(){
         $id = $this->input->post('vehicle_id');
        if(isset($id)){
            $user = $this->session->userdata('user');

            $this->form_validation->set_rules('sellingprice', 'Selling Price', 'required|numeric');

            if ($this->form_validation->run() == FALSE){ 
                //Validation False
                echo json_encode(array('status' => 'error', 'msg' => validation_errors()));

            }else{
                //Check If Vehicle Already Exported
                $sold = $this->Sales_model->getsale($id);
                if(!$sold){
                    //Vehicle Not Exported
                    $sale = array(
                        'vehicle_id' => $this->input->post('vehicle_id'),
                        'sold_at' => $user['location'],
                        'price' => $this->input->post('sellingprice'),
                        'sold_by' => $user['user'],
                        'date' => date('m/d/Y')
                    );

                    $sell_id = $this->Sales_model->add($sale);

                    $statusupdate = array(
                        'status' => 'Sold'
                    );

                    $update = $this->Vehicles_model->update($id,$statusupdate);

                    //Adding Notification
                    $this->addnotification('purchaser', 'sold', "Vehicle Sold On Station ".$user['station']);

                    //TO DO NOTIFICATION WORK HERE FOR Sold
                    //TO DO NOTIFICATION WORK HERE FOR Sold
                    //TO DO NOTIFICATION WORK HERE FOR Sold
                    //TO DO NOTIFICATION WORK HERE FOR Sold
                    //TO DO NOTIFICATION WORK HERE FOR Sold
                    //TO DO NOTIFICATION WORK HERE FOR Sold
                    //TO DO NOTIFICATION WORK HERE FOR Sold


                    //Making Transaction
                    $this->maketransaction('credit',(Int)$this->input->post('sellingprice'),"Vehicle Sold");

                    //Add To Cash Account
                    $cash = (Int)$this->Stations_model->getstation($user['location'])[0]->cash + (Int)$this->input->post('sellingprice');

                    $this->Stations_model->update($user['location'], array('cash' => $cash));

                    


                    echo json_encode(array('status' => 'success' ,'msg' => 'Vehicle Successfully Sold'));
                }else{
                    echo json_encode(array('status' => 'error' ,'msg' => 'Vehicle Already Sold'));
                }
        }
    }else{
            echo json_encode(array('status' => 'error' ,'msg' => 'Error Selling Vehicle'));
        }    
    }

    //Get Inventory
    private function getInventory(){
        $user = $this->session->userdata('user');
        $role = $user['role'];

        if($role === 'admin' || $role === 'purchaser'){
            $stations = $this->Stations_model->getall();
            $inventory = array();
            if($stations){
                $i = 0;
                foreach ($stations as $station) {
                    $inventory[$i] = array(
                        'station' => $station->name,
                        'vehicles' => $this->Vehicles_model->getstationinventory($station->id)
                        );
                    $i++;
                } 
            }else{
                $inventory = false;
            }
            return array('vehicles'=>$this->Vehicles_model->getall(), 'stations' => $stations, 'inventory' => $inventory);
        }else if($role === 'seller'){
            $station = $user['location'];
            $inventory[0] = array(
                'station' => $user['station'],
                'vehicles' => $this->Vehicles_model->getstationinventory($station)
                );
            return array('vehicles'=>$this->Vehicles_model->getstationinventory($station), 'inventory' => $inventory);
        }

    }

    //Update Vehicle Cost
    private function updateCost($vehicle = ''){
        //$vehicle = 11;

        $this->db->trans_start();
        $success = $this->db->query("call  UpdateCost($vehicle, @outputparam)");
        $query = $this->db->query('select @outputparam as cost');
        $this->db->trans_complete();

        return $query->row()->cost;
       
    }


    //Adding Expense
    private function addExpense($type, $amount, $refrence){
        $user = $this->session->userdata('user');
        $expense = array(
            'station_id' => $user['location'],
            'refrence' => $refrence,
            'type' => $type,
            'amount' => $amount,
            'expensedate' => date('m/d/Y'),
            'addeddate' => date('m/d/Y'),
            'addedtime' => date('h:i A')
        );

        $expenseid = $this->Expenses_model->add($expense);

        //Subtracting From Cash Account
        $cash = (Int)$this->Stations_model->getstation($user['location'])[0]->cash - (Int)$amount;
        $this->Stations_model->update($user['location'], array('cash' => $cash));

    }

    //Making Transaction
    private function maketransaction($type, $amount, $refrence){
        $user = $this->session->userdata('user');
        $cash = $this->Stations_model->getstation($user['location'])[0]->cash;
        if($type === 'credit'){
            $cash = (Int)$cash + (Int)$amount;
        }else if($type === 'debit'){
            $cash = (Int)$cash - (Int)$amount;
        }

        $transaction = array(
            'station' => $user['location'],
            'type' => $type,
            'amount' => $amount, 
            'refrence' => $refrence,
            'date' => date('m/d/Y'),
            'time' => date('h:i A'),
            'balance' => $cash
        );

        $this->Account_model->add($transaction);
    }

    //Adding Notification
    private function addnotification($receiver, $type, $msg){
        $notification = array(
            'receiver' => $receiver,
            'type' => $type,
            'message' => $msg,
            'status' => 'new',
            'date' => date('m/d/Y'),
            'time' => date('h:i A')
        );

        $this->Notifications_model->add($notification);
    }



    //Get Notifications
    private function getNotifications(){
        $user = $this->session->userdata('user');
        if($user['role'] === 'purchaser'){

            $notifications = $this->Notifications_model->purchaserNotification();
            return $notifications;

        }else if($user['role'] === 'seller'){
            $station = $user['location'];
            $notifications = $this->Notifications_model->sellerNotification($station);
            return $notifications;
        }
    }

}
