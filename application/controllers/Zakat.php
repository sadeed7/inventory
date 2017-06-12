<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Zakat extends CI_Controller {

	public function __construct(){
        parent::__construct();
        $user = $this->session->userdata('user');
        if(!isset($user)){
        	redirect('Login');
        }
        $this->load->model('Notifications_model');
        $this->load->model('Stations_model');
        $this->load->model('Vehicles_model');
        date_default_timezone_set('Asia/Karachi');
        
    }


	public function index(){	
        $data['notifications'] = $this->getNotifications();	
        $data['stations'] = $this->Stations_model->getall();
        $data['zakat'] = $this->overall();
		$this->load->view('zakat',$data);
	}


    public function stationzakat(){
        $id = $this->input->post('id');
        if(isset($id)){
            $data = $this->perstationzakat($id);
            echo json_encode(array('status'=>'success', 'zakat'=>$data));

        }else{
            echo json_encode(array('status'=>'error', 'msg'=>'Something Went Wrong!'));
        }
    }

    //Overall Zakat
    public function overall(){
        $stations = $this->Stations_model->getall();

        if($stations){
            $cash = 0;
            $stock = 0;
            $total = 0;
            $zakat = 0;
            $stationzakat = array();
            $i = 0;
            foreach ($stations as $station) {
                $stationstock = 0;
                $cash += (Int)$station->cash;
                $vehicles = $this->Vehicles_model->getTotalInventory($station->id);
                if($vehicles){
                    $stationstock += (Int)$vehicles[0]->cost;
                    $stock += (Int)$vehicles[0]->cost;
                }

                $stationzakat[$i] = array('name'=>$station->name, 'cash' => $station->cash, 'stock' => $stationstock);
                $i++;
               
            }
            
            //Sum Both
            $total = $cash + $stock;

            //Calculate Zakat
            $zakat = ceil((2.5/100)*(Int)$total);
            $data = array(
                'stationszakat' => $stationzakat,
                'cash' => $cash,
                'stock' => $stock,
                'total' => $total,
                'zakat' => $zakat

                );
            return $data;
            //echo json_encode(array('status'=>'success', 'zakat'=>$data));
        }else{
            return false;
            //echo json_encode(array('status'=>'error', 'msg'=>'No Station Found!'));
        }
    }


    //Perstation Zakat
    private function perstationzakat($id = ''){
        if($id === ''){
            $user = $this->session->userdata('user');
            $id = $user['location']; 
        }

        //Get Cash of Station
        $station = $this->Stations_model->getstation($id);
        if($station){
            $cash = (Int)$station[0]->cash;
        }else{
            $cash = 0;
        }
         
        //Get Stock of Station
        $vehicles = $this->Vehicles_model->getTotalInventory($id);
        if($vehicles){
            $stock = (Int)$vehicles[0]->cost;
        }else{
            $stock = 0;
        }
        

        //Sum Both
        $total = $cash + $stock;

        //Calculate Zakat
        $zakat = ceil((2.5/100)*(Int)$total);
        return array(
            'cash' => $cash,
            'stock' => $stock,
            'total' => $total,
            'zakat' => $zakat
            );
        
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
