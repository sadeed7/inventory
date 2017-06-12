<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Station extends CI_Controller {

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
        $data = $this->stationviewdata();
        $data['notifications'] = $this->getNotifications();
		$this->load->view('stations',$data);
	}

	public function addstation(){
        
        //Verifying Data
        
        $this->form_validation->set_rules('name', 'Station Name', 'required');
        $this->form_validation->set_rules('location', 'Station Location', 'required');
        $this->form_validation->set_rules('cash', 'Station Cash', 'required|numeric');


        if ($this->form_validation->run() == FALSE){
            $data = $this->stationviewdata();
            $data['notifications'] = $this->getNotifications();
            //Validation False
            $this->load->view('stations',$data);

        }else{
            
            $station = array(
                'name' => $this->input->post('name'),
                'location' => $this->input->post('location'),
                'cash' => $this->input->post('cash'),
                'date' => date('m/d/Y')
            );

            $insertedstation = $this->Stations_model->adddata($station);
            $data = $this->stationviewdata();
            $data['status'] = 'success';
            $data['msg'] = 'Station Successfully Added';
            $data['notifications'] = $this->getNotifications();
            $this->load->view('stations', $data);

        }


    }

    //Get Station
    public function get(){
        $id = base64_decode($this->uri->segment(3));
        $station = $this->Stations_model->getstation($id);
        $data = $this->stationviewdata();    
        if($station){
            $data['station'] = $station[0];
        }else{
            $data['status'] = 'error';
            $data['msg'] = "Station Data Not Found";
        }
        $data['notifications'] = $this->getNotifications();
        $this->load->view('stations', $data);
    }

    //Edit
    public function edit(){
           
        //Verifying Data
        $this->form_validation->set_rules('id', 'Station', 'required');
        $this->form_validation->set_rules('name', 'Station Name', 'required');
        $this->form_validation->set_rules('location', 'Station Location', 'required');
        $this->form_validation->set_rules('cash', 'Station Cash', 'required|numeric');


        $id = $this->input->post('id');
        if ($this->form_validation->run() == FALSE){
            $data = $this->stationviewdata();
            //Station Data
            $station = $this->Stations_model->getstation($id);
            $data['station'] = $station[0];
            //Validation False
            $data['notifications'] = $this->getNotifications();
            $this->load->view('stations',$data);
            
        }else{
            
            $station = array(
                'name' => $this->input->post('name'),
                'location' => $this->input->post('location'),
                'cash' => $this->input->post('cash')
            );
            
            $update = $this->Stations_model->update($id, $station);
            //Station View Data
            $data = $this->stationviewdata();
            if($update){
                //Station Data
                $data['status'] = "success";
                $data['msg'] = "Station Data Successfully Updated";
            }else{
                $station = $this->Stations_model->getstation($id);
                $data['station'] = $station[0];
                $data['status'] = "error";
                $data['msg'] = "Updating Station Data Failed";   
            }
            $data['notifications'] = $this->getNotifications();
            $this->load->view('stations', $data);
        }     
    }

    //Deleting Station
    public function delete(){
        $id = base64_decode($this->uri->segment(3));
        $delete = $this->Stations_model->delete($id);
        $data = $this->stationviewdata();
        if($delete){
            $data['status'] = "success";
            $data['msg'] = "Station Successfully Deleted";
        }else{
            $data['status'] = "error";
            $data['msg'] = "Deleting Station Failed";   
        }
        $data['notifications'] = $this->getNotifications();
        $this->load->view('stations', $data);
    }

    //Returning Required For Station View
    private function stationviewdata(){
        $data = array();
        $stations = $this->Stations_model->getall();

        if($stations){
            $data['stations'] = $stations;
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
