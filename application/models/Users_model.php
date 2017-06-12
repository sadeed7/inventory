<?php if ( ! defined("BASEPATH")) exit("Hahaha No direct script access allowed");

class Users_model extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }


  //Insert Function  
  public function adddata($data){ 
    $this -> db -> insert("users", $data);
    $insert_id = $this -> db -> insert_id();
    return $insert_id;
  }


              
  //Select All Function
  public function getall(){

    $this -> db ->select('
      users.user_id AS id, 
      users.fullname AS fullname, 
      users.username AS username, 
      users.role AS role, 
      stations.name as stationname'); 
    $this -> db ->where('users.role !=','admin');
    $this -> db ->from('users');
    $this -> db -> join('stations', 'users.station = stations.id');
    $this -> db -> order_by('users.user_id',"desc");
    $query = $this-> db ->get();

    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }


              
  //Select By Id Function
  public function getuser($id){
    $this->db->select("user_id AS id,fullname,username,password,role,station,date,time");
    $this->db->where("user_id", $id);
    $query = $this->db->get("users");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }


              
  //Update Function
  public function update($id, $data){
    $this->db->where("user_id", $id);
    $this->db->update("users", $data);
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
  //Delete Function
  public function delete($id){
    $this->db->where("user_id", $id);
    $this->db->delete("users");
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


  //Login User
  public  function login($username, $password){
        
    $password = hash('md5',$password);
    $this->db->select('users.user_id AS userid, users.fullname AS fullname, users.role AS role, stations.id AS stationid,stations.name as stationname'); 
    $this -> db ->from('users');    
    $this -> db -> where('username',$username);
    $this -> db -> where('password',$password);
    $this -> db -> join('stations', 'users.station = stations.id');
    $result=$this-> db ->get();

    $data = $result->result_array();

    if($result -> num_rows() == 1){
      $data = array(
        'user' => $data[0]['userid'],
        'name' => $data[0]['fullname'],
        'username' => $username,
        'role' => $data[0]['role'],
        'station' => $data[0]['stationname'],
        'location' => $data[0]['stationid']
      );
      return $data;
    }else{
      return false;
    }
      
  }

              
}
?>