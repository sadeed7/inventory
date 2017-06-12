<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $user = $this->session->userdata('user');
        if(!isset($user)){
        	redirect('Login');
        }
        $this->load->model('Stations_model');
        $this->load->model('Users_model');
        $this->load->model('Notifications_model');
        date_default_timezone_set('Asia/Karachi');
        
    }


	public function index(){
        $data = $this->userviewdata();
        $data['notifications'] = $this->getNotifications();
		$this->load->view('user',$data);
	}

	public function adduser(){
        
        //Verifying Data
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('stations', 'Station', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('role', 'Role', 'required');

        $this->form_validation->set_message('is_unique', 'The %s is already taken');
        if ($this->form_validation->run() == FALSE){
            $data = $this->userviewdata();
            $data['notifications'] = $this->getNotifications();
            //Validation False
            $this->load->view('user',$data);

        }else{
            
            $user = array(
                'fullname' => $this->input->post('fullname'),
                'station' => $this->input->post('stations'),
                'username' => $this->input->post('username'),
                'password' => hash('md5',$this->input->post('password')),
                'role' => $this->input->post('role'),
                'date' => date('m/d/Y'),
                'time' => date('h:i A')
            );

            $inserteduser = $this->Users_model->adddata($user);
            $data = $this->userviewdata();
            $data['status'] = 'success';
            $data['msg'] = 'User Successfully Added';
            $data['notifications'] = $this->getNotifications();
            $this->load->view('user', $data);

        }


    }

    //Get User
    public function get(){
        $id = base64_decode($this->uri->segment(3));
        $user = $this->Users_model->getuser($id);
        $data = $this->userviewdata();    
        if($user){
            $data['user'] = $user[0];
        }else{
            $data['status'] = 'error';
            $data['msg'] = "User Data Not Found";
        }
        $data['notifications'] = $this->getNotifications();
        $this->load->view('user', $data);
    }

    //Edit
    public function edit(){
           
        //Verifying Data
        $this->form_validation->set_rules('user_id', 'User', 'required');
        $this->form_validation->set_rules('fullname', 'Full Name', 'required');
        $this->form_validation->set_rules('stations', 'Station', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required'); 
        $this->form_validation->set_rules('role', 'Role', 'required');

        $this->form_validation->set_message('is_unique', 'The %s is already taken'); 
        $id = $this->input->post('user_id');
        if ($this->form_validation->run() == FALSE){
            $data = $this->userviewdata();
            //User Data
            $user = $this->Users_model->getuser($id);
            $data['user'] = $user[0];
            //Validation False
            $data['notifications'] = $this->getNotifications();
            $this->load->view('user',$data);
            
        }else{
            
            $user = array(
                'fullname' => $this->input->post('fullname'),
                'station' => $this->input->post('stations'),
                'username' => $this->input->post('username'),
                'role' => $this->input->post('role'),
            );
            
            $update = $this->Users_model->update($id, $user);
            //User View Data
            $data = $this->userviewdata();
            if($update){
                //User Data
                $data['status'] = "success";
                $data['msg'] = "User Data Successfully Updated";
            }else{
                $user = $this->Users_model->getuser($id);
                $data['user'] = $user[0];
                $data['status'] = "error";
                $data['msg'] = "Updating User Data Failed";   
            }
            $data['notifications'] = $this->getNotifications();
            $this->load->view('user', $data);
        }     
    }

    //Deleting User
    public function delete(){
        $id = base64_decode($this->uri->segment(3));
        $delete = $this->Users_model->delete($id);
        $data = $this->userviewdata();
        if($delete){
            $data['status'] = "success";
            $data['msg'] = "User Successfully Deleted";
        }else{
            $data['status'] = "error";
            $data['msg'] = "Deleting User Failed";   
        }
        $data['notifications'] = $this->getNotifications();
        $this->load->view('user', $data);
    }

    //Returning Required For User View
    private function userviewdata(){
        $data = array();
        $stations = $this->Stations_model->getall();
        if($stations){
            $data['stations'] = $stations;
        }
        $users = $this->Users_model->getall();
        if($users){
            $data['users'] = $users;
        }
        return $data;    
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
