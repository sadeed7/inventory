<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Exports extends CI_Controller {

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
        $this->load->model('Notifications_model');
        date_default_timezone_set('Asia/Karachi');
        
    }


	public function index(){	
        $data = $this->getExports();
        $data['notifications'] = $this->getNotifications();		
		$this->load->view('exports',$data);
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
	
    private function getExports(){
        
        return array('exports'=>$this->Exports_model->getall());
        
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
