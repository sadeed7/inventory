<?php if ( ! defined("BASEPATH")) exit("Hahaha No direct script access allowed");

class Funds_model extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }


  //Insert Function  
  public function add($data){ 
    $this -> db -> insert("funds", $data);
    $insert_id = $this -> db -> insert_id();
    return $insert_id;
  }


              
  //Select All Function
  public function getall(){
    $this->db->select("
      funds.id AS id, 
      funds.name AS name, 
      funds.chassis AS chassis, 
      funds.date AS date, 
      funds.status AS status,
      stations.name AS location");
    //$this->db->where("funds.status",'InStock');
    $this -> db -> join('stations', 'funds.current_location = stations.id');
    $this -> db -> order_by('funds.id',"desc");
    $query = $this->db->get("funds");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  //Get Specific Stations Inventory
  public function getstationinventory($id){
    $this->db->select("
      funds.id AS id, 
      funds.name AS name, 
      funds.chassis AS chassis, 
      funds.date AS date,
      funds.status AS status, 
      stations.name AS location
    ");
    //$this->db->where("funds.status",'InStock');
    $this->db->where("funds.current_location",$id);
    $this -> db -> join('stations', 'funds.current_location = stations.id');
    $this -> db -> order_by('funds.id',"desc");
    $query = $this->db->get("funds");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }
              
  //Select By Id Function
  public function getfund($id){
    $this->db->select("
      funds.id AS id, 
      funds.amount AS amount,
      funds.status AS status,
      funds.date AS date,
      funds.time AS time,
      users.fullname AS sender, 
      stations.name AS sender_station,

    ");
    $this->db->where("funds.id", $id);
    $this -> db -> join('stations', 'funds.sender_station = stations.id');
    $this -> db -> join('users', 'funds.sender = users.user_id');

    $query = $this->db->get("funds");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }



  //Station funds
  public function getStationfunds($id){
     
    $this -> db -> select_sum('amount');
    $this -> db -> select('type');
    $this -> db -> where("station_id", $id);
    $this -> db -> group_by('type');

    $query = $this->db->get("funds");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }

  }

              
  //Update Function
  public function update($id, $data){
    $this->db->where("id", $id);
    $this->db->update("funds", $data);
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
  //Delete Function
  public function delete($id){
    $this->db->where("id", $id);
    $this->db->delete("funds");
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
}
?>