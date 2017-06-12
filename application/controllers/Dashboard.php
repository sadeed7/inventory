<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $user = $this->session->userdata('user');
        if(!isset($user)){
        	redirect('Login');
        }
        $this->load->model('Notifications_model');
        date_default_timezone_set('Asia/Karachi');
        
    }


	public function index(){			
        $data['notifications'] = $this->getNotifications();
		$this->load->view('dashboard',$data);
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
