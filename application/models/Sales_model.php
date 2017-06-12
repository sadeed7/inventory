<?php if ( ! defined("BASEPATH")) exit("Hahaha No direct script access allowed");

class Sales_model extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }


  //Insert Function  
  public function add($data){ 
    $this -> db -> insert("sales", $data);
    $insert_id = $this -> db -> insert_id();
    return $insert_id;
  }


              
  //Select All Function
  public function getall($from, $to){
    $this->db->select("
      sales.id AS id,
      vehicles.name AS name,
      stations.name AS location,
      vehicles.chassis As chassis,
      sales.price As price,
      sales.date AS date
      ");

    $this->db->where("sales.date >=", $from);
    $this->db->where("sales.date <=" ,$to);
    $this->db->join("vehicles",'vehicles.id = sales.vehicle_id');
    $this->db->join("stations",'stations.id = sales.sold_at');
    $query = $this->db->get("sales");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

//By Station
public function get($from, $to, $station){
    $this->db->select("
      sales.id AS id,
      vehicles.name AS name,
      stations.name AS location,
      vehicles.chassis AS chassis,
      sales.price AS price,
      sales.date AS date
    ");
    $this->db->where('sales.sold_at', $station);
    $this->db->where("sales.date >=", $from);
    $this->db->where("sales.date <=" ,$to);
    $this->db->join("vehicles",'vehicles.id = sales.vehicle_id');
    $this->db->join("stations",'stations.id = sales.sold_at');
    $query = $this->db->get("sales");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

              
  //Select By Id Function
  public function getsale($id){
    $this->db->select("id,vehicle_id,sold_by,price,date");
    $this->db->where("vehicle_id", $id);
    $query = $this->db->get("sales");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }


              
  //Update Function
  public function update($id, $data){
    $this->db->where("id", $id);
    $this->db->update("sales", $data);
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
  //Delete Function
  public function delete($id){
    $this->db->where("id", $id);
    $this->db->delete("sales");
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
}
?>