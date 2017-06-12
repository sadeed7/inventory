<?php if ( ! defined("BASEPATH")) exit("Hahaha No direct script access allowed");

class Vehicles_model extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }


  //Insert Function  
  public function add($data){ 
    $this -> db -> insert("vehicles", $data);
    $insert_id = $this -> db -> insert_id();
    return $insert_id;
  }


              
  //Select All Function
  public function getall(){
    $this->db->select("
      vehicles.id AS id, 
      vehicles.name AS name, 
      vehicles.chassis AS chassis, 
      vehicles.date AS date,
      sales.date AS saledate, 
      vehicles.status AS status,
      stations.name AS location");
    //$this->db->where("vehicles.status",'InStock');
    $this -> db -> join('stations', 'stations.id = vehicles.current_location');
    $this -> db -> join('sales', 'sales.vehicle_id = vehicles.id', 'left outer');
    $this -> db -> order_by('vehicles.id',"desc");
    $query = $this->db->get("vehicles");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  //Get Specific Stations Inventory
  public function getstationinventory($id){
    $this->db->select("
      vehicles.id AS id, 
      vehicles.name AS name, 
      vehicles.chassis AS chassis, 
      vehicles.date AS date,
      sales.date AS saledate,
      vehicles.status AS status, 
      stations.name AS location
    ");
    //$this->db->where("vehicles.status",'InStock');
    $this->db->where("vehicles.current_location",$id);
    $this -> db -> join('stations', 'stations.id = vehicles.current_location');
    $this -> db -> join('sales', 'sales.vehicle_id = vehicles.id', 'left outer');
    $this -> db -> order_by('vehicles.id',"desc");
    $query = $this->db->get("vehicles");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }
              
  //Select By Id Function
  public function getvehicle($id){
    $this->db->select("
      vehicles.id AS id, 
      vehicles.name AS name,
      vehicles.chassis AS chassis,
      vehicles.make AS make,
      vehicles.model AS model, 
      vehicles.year AS year, 
      vehicles.stars AS stars, 
      vehicles.purchase_price AS price, 
      vehicles.status AS status,
      vehicles.cost AS cost,
      vehicles.date AS date, 
      users.fullname AS addedby, 
      stations.name AS location
    ");
    $this->db->where("vehicles.id", $id);
    $this -> db -> join('stations', 'vehicles.current_location = stations.id');
    $this -> db -> join('users', 'vehicles.added_by = users.user_id');

    $query = $this->db->get("vehicles");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  //Stations Inventory
  public function getTotalInventory($id){
    $this->db->select_sum('vehicles.cost');
    $this->db->where("vehicles.status", 'InStock');
    $this->db->where("vehicles.current_location", $id);
    

    $query = $this->db->get("vehicles");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }
              
  //Select All Purchases
  public function getpurchases($from, $to){
    $this->db->select("
      vehicles.id AS id, 
      vehicles.name AS name, 
      vehicles.chassis AS chassis, 
      vehicles.date AS date, 
      vehicles.status AS status,
      stations.name AS location,
      vehicles.purchase_price AS price");
    $this->db->where("vehicles.date >=",$from);
    $this->db->where("vehicles.date <=",$to);
    $this -> db -> join('stations', 'vehicles.current_location = stations.id');
    $this -> db -> order_by('vehicles.id',"desc");
    $query = $this->db->get("vehicles");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  //Multiple Vehicles Cost
  public function vehiclesCost($vehicles){
    $this->db->select_sum('cost');
    $this->db->where_in('id', $vehicles);
    $query = $this->db->get("vehicles");
    if ($query->num_rows() > 0) {
      return $query->result()[0];
    }else{
      return false;
    }
  }


  //Select All Function
  public function getnotexported(){
    $this->db->select("
      vehicles.id AS id, 
      vehicles.name AS name, 
      vehicles.chassis AS chassis,
      vehicles.year AS year, 
      ");
    $this->db->where("vehicles.container",null);
   
    $this -> db -> order_by('vehicles.id',"desc");
    $query = $this->db->get("vehicles");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }



  //Update Function
  public function update($id, $data){
    $this->db->where("id", $id);
    $this->db->update("vehicles", $data);
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
  //Delete Function
  public function delete($id){
    $this->db->where("id", $id);
    $this->db->delete("vehicles");
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
}
?>