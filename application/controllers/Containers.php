<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Containers extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $user = $this->session->userdata('user');
        if(!isset($user)){
        	redirect('Login');
        }
        $this->load->model('Vehicles_model');
        $this->load->model('Containers_model');
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
        $data = $this->getContainers();
        /*print_r($data['containers']);
        exit();*/
        $data['notifications'] = $this->getNotifications();
		$this->load->view('containers',$data);
	}

	public function add(){
        $user = $this->session->userdata('user');
        
        //Validation Rules
        $this->form_validation->set_rules('refrence', 'Container Refrence', 'required|is_unique[containers.refrence]');
        $this->form_validation->set_rules('vehicles[]', 'Vehicles To Export', 'required');
        $this->form_validation->set_rules('destination', 'Destination', 'required');
        $this->form_validation->set_rules('deliverydate', 'Delivery Date', 'required');
        $this->form_validation->set_rules('shippingprice', 'Shipping Price', 'required|numeric');

        $this->form_validation->set_message('is_unique', '%s already exist');
        if ($this->form_validation->run() == FALSE){ 
            //Validation False
            echo json_encode(array('status' => 'error', 'msg' => validation_errors()));

        }else{
            $vehicles = explode(',',$this->input->post('vehicles[]')[0]);
            $destination = $this->input->post('destination');
            $shipping = $this->input->post('shippingprice');
            $delivery = $this->input->post('deliverydate');
            $container = array(
                'refrence' => $this->input->post('refrence'),
                'vehicles' => implode(',', $vehicles),
                'destination' => $destination,
                'deliverydate' => $delivery,
                'shippingprice' => $shipping,
                'status' => 'enroute',
                'date' => date('Y-m-d'),
                'time' => date('h:i A')
            );

            //Add Container To Database
            $container_id = $this->Containers_model->add($container);


            //Total of All Vehicle Cost
            $totalcost = $this->Vehicles_model->vehiclesCost($vehicles)->cost;
            
            foreach ($vehicles as $vehicle) {
                
                //Calculate Shipment 
                $v = $this->Vehicles_model->getvehicle($vehicle)[0];
                $cost = $v->cost;
                $percentagecost = round(((int)$cost/(int)$totalcost)*100);
                $vehicleShipping = ((int)$percentagecost/100)*(int)$shipping;


                //Export Vehicle
                $this->exportVehicle($vehicle, $destination, $vehicleShipping, $delivery);

                //Update Vehicle Container
                $vehicleUpdate = array(
                    'container' => $container_id
                );

                $this->Vehicles_model->update($vehicle, $vehicleUpdate);
            }
            
            $this->addnotification($destination, 'export', 'Container '.$this->input->post('refrence').' Shipped To Your Location');

            echo json_encode(array('status' => 'success', 'container' => $container));
        }
    }

    //Vehicle Export Function
    private function exportVehicle($vehicle, $destination, $shipping, $delivery){
        $user = $this->session->userdata('user');
        $exported = $this->Exports_model->getvehicle($vehicle);
        if(!$exported){
            //Vehicle Not Exported
            $export = array(
                'vehicle_id' => $vehicle,
                'destination' => $destination,
                'shipment_price' => $shipping,
                'status' => 'enroute',
                'export_date' => date('m/d/Y'),
                'delivery_date' => $delivery,
                'exported_by' => $user['user']
            );

            $export_id = $this->Exports_model->add($export);


            //Updating Vehicle Cost
            $this->updateCost($vehicle);

            //Making Transaction
            $this->maketransaction('debit',(Int)$shipping,"Shipping of Vehicle");

            //To Add Expense And Subtract From Account
            $this->addExpense('Shipping Expense' , (Int)$shipping, $vehicle);
        }    
    }

    //Get Vehicle Data
    public function get(){
        $id = $this->input->post('id');
        if(isset($id)){
            $container = $this->Containers_model->getcontainer($id);
            //Looking for vehicle images
            if($container){
                $container = $container[0];
                $vehicle = explode(',',$container->vehicles);
                $vehicles = array();

                $i = 0;
                foreach ($vehicle as $v) {
                    
                    $v = $this->Exports_model->getexportcontainer($v)[0];
                   
                    $vehicles[$i] = array(
                        'id' => $v->id,
                        'chassis' => $v->chassis,
                        'name' => $v->name,
                        'year' => $v->year,
                        'status' => $v->status 
                    );
                    $i++; 
                }
                $container->vehicles = $vehicles; 
            }
            echo json_encode(array('status' => 'success', 'container' => $container));
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Container Not Found' ));
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


    //Get Inventory
    private function getContainers(){
        $user = $this->session->userdata('user');
        $role = $user['role'];

        if($role === 'admin' || $role === 'purchaser'){
            //Get Vehicles Not Assigned Any Container

            $stations = $this->Stations_model->getall();
            return array('vehicles'=>$this->Vehicles_model->getnotexported(),'containers' => $this->Containers_model->getall(), 'stations' => $stations);
        }else if($role === 'seller'){
            $station = $user['location'];
            //Get Vehicles Not Assigned Any Container
            return array('containers'=>$this->Containers_model->getstationcontainer($station));
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
