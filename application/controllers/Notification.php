<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

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
		//$this->load->view('zakat');
	}

	//Notification Seen 
    public function seen(){
        $notification = $this->input->post('notification');
        if(isset($notification)){
            //Update Notification
            $this->Notifications_model->update($notification, array('status' => 'seen'));
            echo json_encode(array('status' => 'success', 'msg' => 'Notification Seen Successfully'));
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Data Incomplete'));
        }
    }


}
