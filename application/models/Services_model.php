<?php if ( ! defined("BASEPATH")) exit("Hahaha No direct script access allowed");

class Services_model extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }


  //Insert Function  
  public function add($data){ 
    $this -> db -> insert("services", $data);
    $insert_id = $this -> db -> insert_id();
    return $insert_id;
  }


              
  //Select All Function
  public function getall(){
    $this->db->select("id,vehicle_id,service_name,service_price,date");
    $query = $this->db->get("services");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  //Select By Vehicle Id 
  public function getservices($id){
    $this->db->select("id,vehicle_id,service_name,service_price,date");
    $this->db->where("vehicle_id", $id);
    $query = $this->db->get("services");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

              
  //Select By Id Function
  public function getservice($id){
    $this->db->select("id,vehicle_id,service_name,service_price,date");
    $this->db->where("id", $id);
    $query = $this->db->get("services");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

              
  //Update Function
  public function update($id, $data){
    $this->db->where("id", $id);
    $this->db->update("services", $data);
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
  //Delete Function
  public function delete($id){
    $this->db->where("id", $id);
    $this->db->delete("services");
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
}
?>