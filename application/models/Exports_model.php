<?php if ( ! defined("BASEPATH")) exit("Hahaha No direct script access allowed");

class Exports_model extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }


  //Insert Function  
  public function add($data){ 
    $this -> db -> insert("exports", $data);
    $insert_id = $this -> db -> insert_id();
    return $insert_id;
  }


              
  //Select All Function
  public function getall(){
    $this -> db -> select("
      exports.id AS id,
      vehicles.name AS name,
      vehicles.chassis AS chassis,
      stations.name AS station,
      exports.status AS status,
      exports.export_date AS date,

    ");
    //$this -> db -> where("exports.status", 'enroute');
    $this -> db -> join("stations", 'exports.destination = stations.id');
    $this -> db -> join("vehicles", 'exports.vehicle_id = vehicles.id');
    $this -> db -> order_by('exports.id',"desc");
    $query = $this->db->get("exports");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }



  //Get Single Export
  public function getexport($id){
    $this -> db -> select("
      exports.id AS id,
      exports.vehicle_id AS vid,
      exports.shipment_price AS shipment,
      exports.status AS status,
      exports.export_date AS date,
      exports.delivery_date AS deliverydate,
      exports.receive_date AS receiveddate,
      exports.tax_paid AS tax,
      exports.transport_charges AS transport,
      vehicles.name AS name,
      vehicles.make AS make,
      vehicles.stars AS stars,
      vehicles.year AS year,
      vehicles.cost AS cost,
      vehicles.container AS container,
      stations.name AS destination,
      users.fullname AS user
    ");
    $this -> db -> where("exports.id", $id);
    $this -> db -> join("stations", 'exports.destination = stations.id');
    $this -> db -> join("vehicles", 'exports.vehicle_id = vehicles.id');
    $this -> db -> join("users", 'exports.exported_by = users.user_id');
    $query = $this -> db -> get("exports");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

 
 //Get Single Export
  public function getexportcontainer($id){
    $this -> db -> select("
      exports.id AS id,
      exports.vehicle_id AS vid,
      exports.shipment_price AS shipment,
      exports.status AS status,
      exports.export_date AS date,
      exports.delivery_date AS deliverydate,
      exports.receive_date AS receiveddate,
      exports.tax_paid AS tax,
      exports.transport_charges AS transport,
      vehicles.name AS name,
      vehicles.make AS make,
      vehicles.stars AS stars,
      vehicles.year AS year,
      vehicles.cost AS cost,
      vehicles.chassis AS chassis,
      stations.name AS destination,
      users.fullname AS user
    ");
    $this -> db -> where("exports.vehicle_id", $id);
    $this -> db -> join("stations", 'exports.destination = stations.id');
    $this -> db -> join("vehicles", 'exports.vehicle_id = vehicles.id');
    $this -> db -> join("users", 'exports.exported_by = users.user_id');
    $query = $this -> db -> get("exports");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  } 



              
  //Select By Vehicle ID
  public function getvehicle($id){
    $this->db->select("
      id,
      vehicle_id,
      destination,
      shipment_price,
      status,
      export_date,
      delivery_date,
      exported_by,
      receive_date,
      tax_paid,
      transport_charges
    ");
    $this->db->where("vehicle_id", $id);
    $query = $this->db->get("exports");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

      

  //Get Imports
  public function getimports($station){
    $this -> db -> select("
      exports.id AS id,
      vehicles.id AS vehicleid,
      exports.status AS status,
      vehicles.name AS name,
      vehicles.chassis AS chassis,
      stations.name AS station,
      exports.export_date AS date,
      
    ");
    $this -> db -> where("exports.destination", $station);
    $this -> db -> join("stations", 'exports.destination = stations.id');
    $this -> db -> join("vehicles", 'exports.vehicle_id = vehicles.id');
    $this -> db -> order_by('exports.id',"desc");
    $query = $this->db->get("exports");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }



  //Update Function
  public function update($id, $data){
    $this->db->where("id", $id);
    $this->db->update("exports", $data);
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
  //Delete Function
  public function delete($id){
    $this->db->where("id", $id);
    $this->db->delete("exports");
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
}
?>