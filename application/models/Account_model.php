<?php if ( ! defined("BASEPATH")) exit("Hahaha No direct script access allowed");

class Account_model extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }


  //Insert Function  
  public function add($data){ 
    $this -> db -> insert("accountdetails", $data);
    $insert_id = $this -> db -> insert_id();
    return $insert_id;
  }


              
  //Select All Function
  public function getall($from, $to){
    $this->db->select("
      accountdetails.id AS id, 
      accountdetails.type AS type,
      accountdetails.refrence AS refrence, 
      accountdetails.amount AS price, 
      accountdetails.date AS date,
      accountdetails.balance AS balance,
      stations.name AS location");
    $this->db->where("accountdetails.date >=",$from);
    $this->db->where("accountdetails.date <=",$to);
    $this -> db -> join('stations', 'stations.id = accountdetails.station');
    $this -> db -> order_by('accountdetails.id',"asc");
    $query = $this->db->get("accountdetails");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  public function get($from, $to, $station){
    $this->db->select("
      accountdetails.id AS id, 
      accountdetails.type AS type,
      accountdetails.refrence AS refrence, 
      accountdetails.amount AS price, 
      accountdetails.date AS date,
      accountdetails.balance AS balance,
      stations.name AS location");

    $this->db->where('accountdetails.station', $station);
    $this->db->where("accountdetails.date >=",$from);
    $this->db->where("accountdetails.date <=",$to);
    $this -> db -> join('stations', 'stations.id = accountdetails.station');
    $this -> db -> order_by('accountdetails.id',"asc");
    $query = $this->db->get("accountdetails");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  //Get Specific Stations Inventory
  public function getstationinventory($id){
    $this->db->select("
      accountdetails.id AS id, 
      accountdetails.name AS name, 
      accountdetails.chassis AS chassis, 
      accountdetails.date AS date,
      accountdetails.status AS status, 
      stations.name AS location
    ");
    //$this->db->where("accountdetails.status",'InStock');
    $this->db->where("accountdetails.current_location",$id);
    $this -> db -> join('stations', 'accountdetails.current_location = stations.id');
    $this -> db -> order_by('accountdetails.id',"desc");
    $query = $this->db->get("accountdetails");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }
              
  //Select By Id Function
  public function getvehicle($id){
    $this->db->select("
      accountdetails.id AS id, 
      accountdetails.name AS name,
      accountdetails.chassis AS chassis,
      accountdetails.make AS make,
      accountdetails.model AS model, 
      accountdetails.year AS year, 
      accountdetails.stars AS stars, 
      accountdetails.purchase_price AS price, 
      accountdetails.status AS status,
      accountdetails.cost AS cost, 
      users.fullname AS addedby, 
      stations.name AS location
    ");
    $this->db->where("accountdetails.id", $id);
    $this -> db -> join('stations', 'accountdetails.current_location = stations.id');
    $this -> db -> join('users', 'accountdetails.added_by = users.user_id');

    $query = $this->db->get("accountdetails");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }



  //Station accountdetails
  public function accountdetails($id, $from, $to){
     
    $this -> db -> select_sum('amount');
    $this -> db -> select('type');
    $this -> db -> where("station_id", $id);
    $this -> db -> where("expensedate >=", $from);
    $this -> db -> where("expensedate <=", $to);
    $this -> db -> group_by('type');

    $query = $this->db->get("expenses");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }

  }

              
  //Update Function
  public function update($id, $data){
    $this->db->where("id", $id);
    $this->db->update("expenses", $data);
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
  //Delete Function
  public function delete($id){
    $this->db->where("id", $id);
    $this->db->delete("expenses");
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
}
?>