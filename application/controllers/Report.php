<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $user = $this->session->userdata('user');
        if(!isset($user)){
        	redirect('Login');
        }
        $this->load->model('Expenses_model');
        $this->load->model('Vehicles_model');
        $this->load->model('Stations_model');
        $this->load->model('Notifications_model');
        $this->load->model('Sales_model');
        $this->load->model('Account_model');
        date_default_timezone_set('Asia/Karachi');

    }


	public function index()
	{			
		//$this->load->view('dashboard');
	}

                        //////////////*Sales*//////////////


    public function sales(){
        $data['notifications'] = $this->getNotifications();
        $data['stations'] = $this->Stations_model->getall();
        $this->load->view('sales',$data);
    }

    public function getsales(){
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $station_id = $this->input->post('station');
        $filter = $this->input->post('pre');
        $data = array();

        //Custom With Station
        if(isset($from) && $from !== '' && isset($to) && $to !== '' && isset($station_id) && $station_id !== ""){
            //If Station Is Set
            //Station Sales
            $data = $this->stationsalesdata($from, $to, $station_id);

        }


        //Custom With Out Station
        else if(isset($from) && $from !== '' && isset($to) && $to !== ''){
            //Total Sales
            $data = $this->totalsalesdata($from, $to);
        }


        //PreDefined Filter With Station
        else if(isset($filter) && isset($station_id) && $station_id !== ''){
            if($filter === 'year'){
                $from = '01/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'month'){
                $from = date('m').'/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'week'){
                $from = date('m/d/Y',strtotime('last monday'));
                $to = date('m/d/Y');    
            }
            //Station Sales
            $data = $this->stationsalesdata($from, $to, $station_id);


        }


        //PreDefined Filter Without Station
        else if(isset($filter)){
            if($filter === 'year'){
                $from = '01/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'month'){
                $from = date('m').'/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'week'){
                $from = date('m/d/Y',strtotime('last monday'));
                $to = date('m/d/Y');  
            }

            //Total Sales
            $data = $this->totalsalesdata($from, $to);
            

        }
        else{
            //If Dates Not Provided
            $data = array('status'=>'error', 'msg' => 'Incomplete Data.');
        }


        $data['stations'] = $this->Stations_model->getall();
        $data['notifications'] = $this->getNotifications();
        $this->load->view('sales',$data);
    }

    //Station's Sales Data
    private function stationsalesdata($from, $to, $station_id){
        $sales = $this->Sales_model->get($from, $to, $station_id);
        if($sales){
            $total = 0;
            foreach ($sales as $sale) {
                $total += (Int)$sale->price;
            }
                return array('sales' => $sales, 'total' => $total, 'count' => Count($sales), 'from' => $from, 'to' => $to);
        }else{
            //No Data Found
            return array('status'=>'error', 'msg' => 'No Sales For Given Dates.','from' => $from, 'to' => $to);
        }
    }

    //All Station Sales Data
    public function totalsalesdata($from, $to){
        $user = $this->session->userdata('user');
        if($user['role'] === 'admin'){
            //If Admin
            $sales = $this->Sales_model->getall($from, $to);
            if($sales){
                $total = 0;
                foreach ($sales as $sale) {
                    $total += (Int)$sale->price;
                }
                return array('sales' => $sales, 'total' => $total, 'count' => Count($sales), 'from' => $from, 'to' => $to );
            }else{
                //No Data Found
                return array('status'=>'error', 'msg' => 'No Sales For Given Dates.','from' => $from, 'to' => $to);
            }
        }else if($user['role'] === 'seller'){
            //If Seller
            $station = $user['location'];
            $sales = $this->Sales_model->get($from, $to, $station);
            if($sales){
                $total = 0;
                foreach ($sales as $sale) {
                    $total += (Int)$sale->price;
                }
                return array('sales' => $sales, 'total' => $total, 'count' => Count($sales), 'from' => $from, 'to' => $to);
            }else{
                //No Data Found
                return array('status'=>'error', 'msg' => 'No Sales For Given Dates.', 'from' => $from, 'to' => $to);
            }
        }

        else{

            //If Purchaser
            return array('status'=>'error', 'msg' => 'You Do Not Have Access');
        }
    }

                        //////////////*Sales*//////////////


                        //////////////*Purchase*//////////////

    public function purchase(){
        $data['notifications'] = $this->getNotifications();
        $this->load->view('purchase',$data);
    }


    public function getpurchase(){
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $station_id = $this->input->post('station');
        $filter = $this->input->post('pre');
        $data = array();
        

        //Custom With Out Station
        if(isset($from) && $from !== '' && isset($to) && $to !== ''){
            $data = $this->purchaseData($from, $to);
        }

        //PreDefined Filters
        else if(isset($filter)){
            if($filter === 'year'){
                $from = '01/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'month'){
                $from = date('m').'/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'week'){
                $from = date('m/d/Y',strtotime('last monday'));
                $to = date('m/d/Y');  
            }

            $data = $this->purchaseData($from, $to);

        }else{
            //If Dates Not Provided
            $data = array('status'=>'error', 'msg' => 'Incomplete Data.');
        }   

        $data['notifications'] = $this->getNotifications();
        $this->load->view('purchase',$data);

    }


    private function purchaseData($from, $to){

        $purchases = $this->Vehicles_model->getpurchases($from, $to);
        if($purchases){
            $total = 0;
            foreach ($purchases as $purchase) {
                $total += (Int)$purchase->price;
            }
                return array('purchases' => $purchases, 'total' => $total, 'count' => Count($purchases), 'from' => $from, 'to' => $to);
        }else{
            //No Data Found
            return array('status'=>'error', 'msg' => 'No Purchases For Given Dates.','from' => $from, 'to' => $to);
        }
        
    }
	           
                        //////////////*Purchase*//////////////

    


                            //////////////*Account*////////////


    public function account(){
        $data = $this->accountData();
        $data['stations'] = $this->Stations_model->getall();
        $data['notifications'] = $this->getNotifications();

        $this->load->view('accounts',$data);
    }

    //Single Account Data
    public function singleAccount(){
        $id = $this -> input ->post('id');
        if(isset($id)){
            $data = $this->accountData($id);
            $data['notifications'] = $this->getNotifications();
            echo json_encode(array('status' => 'success', 'account' => $data));
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Invalid Data'));
        }
    }

    //All Stations Accounts
    public function all(){
        $stations = $this->Stations_model->getall();
        $data = array();
        $index = 0;
        if(isset($stations) && $stations){
           foreach ($stations as $station) {
                $account = $this->accountData($station->id);
                $data[$index] = array('station' => $station->name, 'account' => $account);
                $index++;
            }
            echo json_encode(array('status' => 'success', 'accounts' => $data)); 
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'No Accounts Found'));
        }
        

    }

    //Account Data
    private function accountData($id = ''){
        if($id === ''){
            $user = $this->session->userdata('user');
            $id = $user['location'];
        }

        //Get Stations Assets And Expenses
        $inventory = $this->Vehicles_model->getTotalInventory($id)[0]->cost;
        
        $cash = $this->Stations_model->getstation($id)[0]->cash;
        
        $from = date('m').'/01/'.date('Y');
        $to = date('m/d/Y');


        $expenses = $this->Expenses_model->getStationExpenses($id, $from, $to);  

        return array(
            'Assets' => array(
                'Cash' => $cash,
                'Inventory' => $inventory
                ),
            'Expenses' => $expenses
        );  
           
    }

                                //////////////*Account*////////////






            //////////////*Account Details*//////////////


    public function accountdetails(){
        $data['notifications'] = $this->getNotifications();
        $data['stations'] = $this->Stations_model->getall();
        $this->load->view('account',$data);
    }

    public function getaccountdetails(){
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $station_id = $this->input->post('station');
        $filter = $this->input->post('pre');

        $data = array();

        //Custom With Station
        if(isset($from) && $from !== '' && isset($to) && $to !== '' && isset($station_id) && $station_id !== ""){
            //If Station Is Set
            //Station Sales
            $data = $this->stationaccountdetails($from, $to, $station_id);

        }


        //Custom With Out Station
        else if(isset($from) && $from !== '' && isset($to) && $to !== ''){
            //Total Sales
            $data = $this->totalaccountdetails($from, $to);
        }


        //PreDefined Filter With Station
        else if(isset($filter) && isset($station_id) && $station_id !== ''){
            if($filter === 'year'){
                $from = '01/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'month'){
                $from = date('m').'/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'week'){
                $from = date('m/d/Y',strtotime('last monday'));
                $to = date('m/d/Y');    
            }
            //Station Sales
            $data = $this->stationaccountdetails($from, $to, $station_id);


        }


        //PreDefined Filter Without Station
        else if(isset($filter)){
            if($filter === 'year'){
                $from = '01/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'month'){
                $from = date('m').'/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'week'){
                $from = date('m/d/Y',strtotime('last monday'));
                $to = date('m/d/Y');  
            }

            //Total Sales
            $data = $this->totalaccountdetails($from, $to);
            

        }
        else{
            //If Dates Not Provided
            $data = array('status'=>'error', 'msg' => 'Incomplete Data.');
        }


        $data['stations'] = $this->Stations_model->getall();
        $data['notifications'] = $this->getNotifications();
        $this->load->view('account',$data);
    }

    //Station's Sales Data
    private function stationaccountdetails($from, $to, $station_id){
        $details = $this->Account_model->get($from, $to, $station_id);
        if($details){
            //$total = 0;
            /*foreach ($details as $detail) {
                $total += (Int)$detail->price;
            }*/
                return array('details' => $details, 'from' => $from, 'to' => $to);
        }else{
            //No Data Found
            return array('status'=>'error', 'msg' => 'No Data For Given Dates.','from' => $from, 'to' => $to);
        }
    }

    //All Station Sales Data
    public function totalaccountdetails($from, $to){
        $user = $this->session->userdata('user');
        $station = $user['location'];
            $details = $this->Account_model->get($from, $to, $station);
            if($details){
                /*$total = 0;
                foreach ($details as $detail) {
                    $total += (Int)$detail->price;
                }*/
                return array('details' => $details, 'from' => $from, 'to' => $to);
            }else{
                //No Data Found
                return array('status'=>'error', 'msg' => 'No Data For Given Dates.', 'from' => $from, 'to' => $to);
            }
        
    }

                        //////////////*Account Details*//////////////











                                //////////////*Expense*////////////
    public function expense(){
        
        $data['notifications'] = $this->getNotifications();
        $data['stations'] = $this->Stations_model->getall();
        $this->load->view('expenses',$data);
    }
                                

    public function getexpense(){
        $from = $this->input->post('from');
        $to = $this->input->post('to');
        $station_id = $this->input->post('station');
        $filter = $this->input->post('pre');
        $data = array();

        //Custom With Station
        if(isset($from) && $from !== '' && isset($to) && $to !== '' && isset($station_id) && $station_id !== ""){
            //If Station Is Set
            $expenses = $this->Expenses_model->get($from, $to, $station_id);
            if($expenses){
                $total = 0;
                foreach ($expenses as $expense) {
                    $total += (Int)$expense->price;
                }
                $data = array('expenses' => $expense, 'total' => $total);
            }else{
                    //No Data Found
                $data = array('status'=>'error', 'msg' => 'No Expenses For Given Dates.','from' => $from, 'to' => $to);
            }

        }


        //Custom With Out Station
        else if(isset($from) && $from !== '' && isset($to) && $to !== ''){
            $user = $this->session->userdata('user');
            if($user['role'] === 'admin' || $user['role'] === 'purchaser'){
                //If Admin
                $expenses = $this->Expenses_model->getall($from, $to);
                if($expenses){
                    $total = 0;
                    foreach ($expenses as $expense) {
                        $total += (Int)$expense->price;
                    }
                    $data = array('expenses' => $expenses, 'total' => $total, 'from' => $from, 'to' => $to );
                }else{
                    //No Data Found
                    $data = array('status'=>'error', 'msg' => 'No Expenses For Given Dates.','from' => $from, 'to' => $to);
                }
            }else if($user['role'] === 'seller'){
                //If Seller
                $station = $user['location'];
                $expenses = $this->Expenses_model->get($from, $to, $station);
                if($expenses){
                    $total = 0;
                    foreach ($expenses as $expense) {
                        $total += (Int)$expense->price;
                    }
                    $data = array('expenses' => $expenses, 'total' => $total, 'from' => $from, 'to' => $to);
                }else{
                    //No Data Found
                    $data = array('status'=>'error', 'msg' => 'No Expenses For Given Dates.', 'from' => $from, 'to' => $to);
                }
            }
        }


        //PreDefined Filter With Station
        else if(isset($filter) && isset($station_id) && $station_id !== ''){
            if($filter === 'year'){
                $from = '01/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'month'){
                $from = date('m').'/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'week'){
                $from = date('m/d/Y',strtotime('last monday'));
                $to = date('m/d/Y');    
            }



            $expenses = $this->Expenses_model->get($from, $to, $station_id);
            if($expenses){
                $total = 0;
                foreach ($expenses as $expense) {
                    $total += (Int)$expense->price;
                }
                $data = array('expenses' => $expenses, 'total' => $total);
            }else{
                    //No Data Found
                $data = array('status'=>'error', 'msg' => 'No Expenses For Given Dates.','from' => $from, 'to' => $to);
            }


        }


        //PreDefined Filter Without Station
        else if(isset($filter)){
            if($filter === 'year'){
                $from = '01/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'month'){
                $from = date('m').'/01/'.date('Y');
                $to = date('m/d/Y');
            }else if($filter === 'week'){
                $from = date('m/d/Y',strtotime('last monday'));
                $to = date('m/d/Y');  
            }



            $user = $this->session->userdata('user');
            if($user['role'] === 'admin' || $user['role'] === 'purchaser'){
                //If Admin
                $expenses = $this->Expenses_model->getall($from, $to);
                if($expenses){
                    $total = 0;
                    foreach ($expenses as $expense) {
                        $total += (Int)$expense->price;
                    }
                    $data = array('expenses' => $expenses, 'total' => $total, 'from' => $from, 'to' => $to );
                }else{
                    //No Data Found
                    $data = array('status'=>'error', 'msg' => 'No Expenses For Given Dates.','from' => $from, 'to' => $to);
                }
            }else if($user['role'] === 'seller'){
                //If Seller
                $station = $user['location'];
                $expenses= $this->Expenses_model->get($from, $to, $station);
                if($expenses){
                    $total = 0;
                    foreach ($expenses as $expense) {
                        $total += (Int)$expense->price;
                    }
                    $data = array('expenses' => $expenses, 'total' => $total, 'from' => $from, 'to' => $to);
                }else{
                    //No Data Found
                    $data = array('status'=>'error', 'msg' => 'No Expenses For Given Dates.', 'from' => $from, 'to' => $to);
                }
            }



        }
        else{
            //If Dates Not Provided
            $data = array('status'=>'error', 'msg' => 'Incomplete Data.');
        }


        $data['stations'] = $this->Stations_model->getall();
        $data['notifications'] = $this->getNotifications();
        $this->load->view('expenses',$data);
    }



                                //////////////*Expense*////////////        


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
