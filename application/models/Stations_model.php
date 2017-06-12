<?php if ( ! defined("BASEPATH")) exit("Hahaha No direct script access allowed");

class Stations_model extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }


  //Insert Function  
  public function adddata($data){ 
    $this -> db -> insert("stations", $data);
    $insert_id = $this -> db -> insert_id();
    return $insert_id;
  }


              
  //Select All Function
  public function getall(){
    $this->db->select("id,name,location,cash,date");
    $query = $this->db->get("stations");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }


              
  //Select By Id Function
  public function getstation($id){
    $this->db->select("id,name,location,cash,date");
    $this->db->where("id", $id);
    $query = $this->db->get("stations");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }


              
  //Update Function
  public function update($id, $data){
    $this->db->where("id", $id);
    $this->db->update("stations", $data);
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
  //Delete Function
  public function delete($id){
    $this->db->where("id", $id);
    $this->db->delete("stations");
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
}
?>