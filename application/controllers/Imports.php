<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Imports extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $user = $this->session->userdata('user');
        if(!isset($user)){
        	redirect('Login');
        }
        $this->load->model('Exports_model');
        $this->load->model('Services_model');
        $this->load->model('Vehicles_model');
        $this->load->model('Expenses_model');
        $this->load->model('Stations_model');
        $this->load->model('Notifications_model');
        $this->load->model('Containers_model');
        $this->load->model('Account_model');
        date_default_timezone_set('Asia/Karachi');
        

    }


	public function index(){
        $data = $this->getImport();	
        $data['notifications'] = $this->getNotifications();		
		$this->load->view('imports',$data);
	}

    public function get(){
        $id = $this->input->post('id');

        if(isset($id)){
            $vehicle = $this->Exports_model->getexport($id);
            
            if($vehicle){
                $vehicle = $vehicle[0];
                $folder = './assets/uploads/'.$vehicle->vid;
                if (!is_dir($folder)) {
                    $vehicle->images = false;
                }else{
                    $this->load->helper('directory');
                    $files = directory_map($folder);
                    $vehicle->images = $files;
                }
            }

            //Days Passed
            $today = date('Y-m-d');
            $date = $vehicle->date;
            $datetime1 = date_create($date);
            $datetime2 = date_create($today);
            $interval = date_diff($datetime1, $datetime2);

            $vehicle->dayspassed = $interval->format('%a');

            
            $vehicle->services = $this->Services_model->getservices($id);
            echo json_encode(array('status' => 'success', 'vehicle' => $vehicle));

        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Information Not Found'));
        }
    }


    //Vehicle Received At Station
    public function received(){
        $id = $this->input->post('id');
        $tax = $this->input->post('tax');
        $transport = $this->input->post('transport');
        $user = $this->session->userdata('user');

        if(isset($id) && isset($tax) && isset($transport)){

            $data = array(
                'receive_date' => date('m/d/Y'),
                'tax_paid' => $tax,
                'transport_charges' => $transport,
                'status' => 'received'
            );

            $update = $this-> Exports_model ->update($id, $data);

            if($update){
                $vehicle = $this->Exports_model->getexport($id);
                $id = $vehicle[0]->vid;
                

                $locationchange = array(
                    'current_location' => $station = $user['location']
                );
                $update = $this->Vehicles_model->update($id, $locationchange);
                $update = true;
                if($update){

                    //Updating Contaier Status
                        $container = $vehicle[0]->container;
                        $this->containerStatus($container);
                    //End Updating Container Status


                    //Adding Notification
                    $this->addnotification('purchaser', 'received', "Vehicle Received At ".$user['station']." Successfull");

                    //TO DO NOTIFICATION WORK HERE FOR Successfull Import
                    //TO DO NOTIFICATION WORK HERE FOR Successfull Import
                    //TO DO NOTIFICATION WORK HERE FOR Successfull Import
                    //TO DO NOTIFICATION WORK HERE FOR Successfull Import
                    //TO DO NOTIFICATION WORK HERE FOR Successfull Import
                    //TO DO NOTIFICATION WORK HERE FOR Successfull Import
                    //TO DO NOTIFICATION WORK HERE FOR Successfull Import
                    $this->updateCost($id);

                    //Making Transaction
                    $this->maketransaction('debit',$tax,"Vehicle Duty");
                    $this->maketransaction('debit',$transport,"Vehicle Transport Charges");

                    //Add Expense
                    $this->addExpense('Tax', $tax, $id);
                    $this->addExpense('Transport Expense', $transport, $id);



                    echo json_encode(array('status' => 'success', 'msg' => 'Vehicle Successfully Received'));
                }else{
                    //Current Location Not Changed
                    echo json_encode(array('status' => 'error', 'msg' => 'Current Location Changing Failed'));
                }
            }else{
                //Export Data Not Changed
                echo json_encode(array('status' => 'error', 'msg' => 'Updating Failed'));
            }
            
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Incomplete Data'));
        }
    }

    //Updating Container Status
    private function containerStatus($container_id){
        
        $container = $this->Containers_model->getcontainer($container_id);
        //Looking for vehicle images
        if($container){
            $container = $container[0];
            $vehicle = explode(',',$container->vehicles);
            $vehicles = array();

            $status = '';
            foreach ($vehicle as $v) {
                    
                $v = $this->Exports_model->getexportcontainer($v)[0];
                if($v->status === 'received'){
                    $status = 'received';   
                }else{
                    $status = 'enroute';
                    break;
                }
                
            }
            $status = array(
                'status' => $status
            );
            $this->Containers_model->update($container_id, $status);

        }

    }


    //Getting Index Data
    private function getImport(){
        $user = $this->session->userdata('user');
        $station = $station = $user['location'];
        return array(
            'imports' => $this->Exports_model->getimports($station)
        ); 
    }
	
    //Updating Vehicle Cost
    public function updateCost($vehicle = ''){
        //$vehicle = 11;

        $this->db->trans_start();
        $success = $this->db->query("call  UpdateCost($vehicle, @outputparam)");
        $query = $this->db->query('select @outputparam as cost');
        $this->db->trans_complete();

        return $query->row()->cost;
       
    }


    private function addExpense($type, $amount, $refrence){
        $user = $this->session->userdata('user');
        $expense = array(
            'station_id' => $user['location'],
            'refrence' =>$refrence,
            'type' => $type,
            'amount' => $amount,
            'expensedate' => date('m/d/Y'),
            'addeddate' => date('m/d/Y'),
            'addeddate' => date('h:i A')
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
