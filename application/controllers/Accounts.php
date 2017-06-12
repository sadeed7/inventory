<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Accounts extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        $user = $this->session->userdata('user');
        if(!isset($user)){
        	redirect('Login');
        }
        $this->load->model('Expenses_model');
        $this->load->model('Stations_model');
        $this->load->model('Funds_model');
        $this->load->model('Notifications_model');
        $this->load->model('Account_model');
        date_default_timezone_set('Asia/Karachi');
    }


	public function index()
	{			
		//$this->load->view('accounts');
	}

    public function addexpense(){
        $this->form_validation->set_rules('type', 'Expense Type', 'required');
        $this->form_validation->set_rules('amount', 'Expense Amount', 'required|numeric');
        $this->form_validation->set_rules('date', 'Expense Date', 'required'); 
        
        $user = $this->session->userdata('user');

        if ($this->form_validation->run() == FALSE){
            echo json_encode(array('status' => 'error', 'msg' => validation_errors()));
        }else{
            $expense = array(
                'station_id' => $user['location'],
                'type' => $this->input->post('type'),
                'amount' => $this->input->post('amount'),
                'expensedate' => $this->input->post('date'),
                'addeddate' => date('m/d/Y'),
                'addeddate' => date('h:i A')
            );

            $expenseid = $this->Expenses_model->add($expense);

            //Making Transaction
            $this->maketransaction('debit',(Int)$this->input->post('amount'),$expense['type']);

            //Subtracting From Cash Account
            $cash = (Int)$this->Stations_model->getstation($user['location'])[0]->cash - (Int)$this->input->post('amount');

            

            $this->Stations_model->update($user['location'], array('cash' => $cash));

            echo json_encode(array('status' => 'success', 'msg' => 'Report/account'));
        } 

    }

    public function transfer(){
        $this->form_validation->set_rules('amount', 'Expense Amount', 'required|numeric');
        
        $user = $this->session->userdata('user');
        if ($this->form_validation->run() == FALSE){
            echo json_encode(array('status' => 'error', 'msg' => validation_errors()));
        }else{
            $transfer = array(
                'sender_station' => $user['location'],
                'sender' => $user['user'],
                'amount' => $this->input->post('amount'),
                'status' => 'Transfered',
                'date' => date('m/d/Y'),
                'time' => date('h:i A')
            );

            $inserted_id = $this->Funds_model->add($transfer);

            //Making Transaction
            $this->maketransaction('debit', (Int)$this->input->post('amount'), "Funds Transfer");

            //Subtracting From Cash Account
            $cash = (Int)$this->Stations_model->getstation($user['location'])[0]->cash - (Int)$this->input->post('amount');
            $this->Stations_model->update($user['location'], array('cash' => $cash));

            
            //Adding Notification
            $this->addnotification('purchaser', 'funds', $user['station']." Transfered $".$this->input->post('amount')." Funds", $inserted_id);


            echo json_encode(array('status' => 'success', 'msg' => 'Report/account'));

        }

    }


    //Funds Received
    public function received(){
        $fundid = $this->input->post('fund');
        $notification = $this->input->post('notification');
        if(isset($fundid) && isset($notification)){
            //Add Fund 
            $received = $this->Funds_model->update($fundid, array('status'=>'Received'));
            if($received){
                $amount = $this->Funds_model->getfund($fundid)[0]->amount;

                $user = $this->session->userdata('user');

                //Making Transaction
                $this->maketransaction('credit', (Int)$amount, "Funds Received");

                //Add To Account
                $cash = (Int)$this->Stations_model->getstation($user['location'])[0]->cash + (Int)$amount;
                $this->Stations_model->update($user['location'], array('cash' => $cash));

                

                //Update Notification
                $this->Notifications_model->update($notification, array('status' => 'seen'));
                echo json_encode(array('status' => 'success', 'msg' => 'Funds Successfully Received'));
            }else{
                echo json_encode(array('status' => 'error', 'msg' => 'Data Received Failed'));
            }
            
        }else{
            echo json_encode(array('status' => 'error', 'msg' => 'Data Incomplete'));
        }
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
    private function addnotification($receiver, $type, $msg, $fundid){
        $notification = array(
            'receiver' => $receiver,
            'type' => $type,
            'message' => $msg,
            'fund' => $fundid,
            'status' => 'new',
            'date' => date('m/d/Y'),
            'time' => date('h:i A')
        );

        $this->Notifications_model->add($notification);
    }


    

}
