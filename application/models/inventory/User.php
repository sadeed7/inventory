<?php if ( ! defined('BASEPATH')) exit('Hahaha No direct script access allowed');

class User extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }

  public  function login($username, $password){
        
    //$password = hash('md5',$password);
    $this->db->select('users.fullname AS fullname, users.role AS role, stations.name as stationname'); 
    $this -> db ->from('users');    
    $this -> db -> where('username',$username);
    $this -> db -> where('password',$password);
    $this -> db -> join('stations', 'users.station = stations.id');
    $result=$this-> db ->get();

    $data = $result->result_array();

    if($result -> num_rows() == 1){
      $data = array(
        'name' => $data[0]['fullname'],
        'username' => $username,
        'station' => $data[0]['stationname'],
      );
      return $data;
    }else{
      return false;
    }
      
  }

    
}?>