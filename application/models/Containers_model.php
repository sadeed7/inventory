<?php if ( ! defined("BASEPATH")) exit("Hahaha No direct script access allowed");

class Containers_model extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }


  //Insert Function  
  public function add($data){ 
    $this -> db -> insert("containers", $data);
    $insert_id = $this -> db -> insert_id();
    return $insert_id;
  }


              
  //Select All Function
  public function getall(){
    $this->db->select("
      containers.id AS id, 
      containers.refrence AS refrence,
      containers.vehicles AS vehicles,
      containers.deliverydate AS deliverydate,
      containers.date AS shippingdate, 
      containers.status AS status,
      stations.name AS location");

    $this -> db -> join('stations', 'stations.id = containers.destination');
    
    $this -> db -> order_by('containers.id',"desc");
    $query = $this->db->get("containers");
    if ($query->num_rows() > 0) {

      return $query->result();
    }else{

      return false;
    }
  }

  //Get Specific Stations Container
  public function getstationcontainer($id){
    $this->db->select("
      containers.id AS id, 
      containers.refrence AS refrence,
      containers.vehicles AS vehicles,
      containers.deliverydate AS deliverydate,
      containers.date AS shippingdate,
      containers.shippingprice AS cost, 
      containers.status AS status,
      stations.name AS location");
    //$this->db->where("containers.status",'InStock');
    $this->db->where("containers.destination",$id);
    $this -> db -> join('stations', 'stations.id = containers.destination');
    $this -> db -> order_by('containers.id',"desc");
    $query = $this->db->get("containers");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }
              
  //Select By Id Function
  public function getcontainer($id){
    $this->db->select("
      containers.id AS id, 
      containers.refrence AS refrence,
      containers.vehicles AS vehicles,
      containers.deliverydate AS deliverydate,
      containers.date AS shippingdate,
      containers.shippingprice AS cost, 
      containers.status AS status,
      stations.name AS location
    ");
    $this->db->where("containers.id", $id);
    $this -> db -> join('stations', 'containers.destination = stations.id');

    $query = $this->db->get("containers");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  //Stations Inventory
  public function getTotalInventory($id){
    $this->db->select_sum('containers.cost');
    $this->db->where("containers.status", 'InStock');
    $this->db->where("containers.current_location", $id);
    

    $query = $this->db->get("containers");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }
              
  //Select All Purchases
  public function getpurchases($from, $to){
    $this->db->select("
      containers.id AS id, 
      containers.name AS name, 
      containers.chassis AS chassis, 
      containers.date AS date, 
      containers.status AS status,
      stations.name AS location,
      containers.purchase_price AS price");
    $this->db->where("containers.date >=",$from);
    $this->db->where("containers.date <=",$to);
    $this -> db -> join('stations', 'containers.current_location = stations.id');
    $this -> db -> order_by('containers.id',"desc");
    $query = $this->db->get("containers");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  //Update Function
  public function update($id, $data){
    $this->db->where("id", $id);
    $this->db->update("containers", $data);
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
  //Delete Function
  public function delete($id){
    $this->db->where("id", $id);
    $this->db->delete("containers");
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
}
?>