<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){

        parent::__construct();

        //Loading Models
        $this->load->model('Users_model');
    }


	public function index(){

		$user = $this->session->userdata('user');
        if(isset($user)){
        	redirect('Dashboard');
        }else{
        	$this->load->view('login');
        }

		
	}

	public function loginuser(){	

		//Verifying Data
		$this->form_validation->set_rules('username', 'Username', 'required');
       	$this->form_validation->set_rules('password', 'Password', 'required|min_length[2]');

       	if ($this->form_validation->run() == FALSE){
       		
       		//Validation False
            $this->load->view('login');

        }else{

        	//Validation Successfull
            $username = $this->input->post('username');
			$password = $this->input->post('password');

			//Logging In
			$user = $this->Users_model->login($username, $password);

			if($user){
				//User Login In Successfully
           		$this->session->set_userdata('user', $user);
           		redirect('Dashboard');
		
			}else{
				//Invalid User

				$data = array('msg' => "Invalid Username or Password");
				$this->load->view('login',$data);
			}
			
			
        }

		
	}


	public function logout(){
		
		$this->session->unset_userdata('user');
        session_destroy();
        redirect('Login');

	}


}
