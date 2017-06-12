<?php if ( ! defined('BASEPATH')) exit('Hahaha No direct script access allowed');

class Stations extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }

  public  function getall(){
        
    $this->db->select('*'); 
    $this -> db ->from('stations');    
    $result=$this-> db ->get();

    $data = $result->result_array();

    if($result -> num_rows() > 0){
      return $data;
    }else{
      return false;
    }
      
  }

    
}?>