<?php if ( ! defined("BASEPATH")) exit("Hahaha No direct script access allowed");

class Notifications_model extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }


  //Insert Function  
  public function add($data){ 
    $this -> db -> insert("notifications", $data);
    $insert_id = $this -> db -> insert_id();
    return $insert_id;
  }



  //Purchaser Notification
  public function purchaserNotification(){
    
    $this -> db -> select('*');
    $this->db->where("receiver",'purchaser');
    $this->db->where("status",'new');
    $query = $this->db->get("notifications");
    
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }

  }

  //Seller Notification
  public function sellerNotification($id){
    
    $this -> db -> select('*');
    $this->db->where("receiver",$id);
    $this->db->where("status",'new');
    $query = $this->db->get("notifications");
    
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }

  }
              
  //Select All Function
  public function getall(){
    $this->db->select("
      notifications.id AS id, 
      notifications.name AS name, 
      notifications.chassis AS chassis, 
      notifications.date AS date, 
      notifications.status AS status,
      stations.name AS location");
    //$this->db->where("notifications.status",'InStock');
    $this -> db -> join('stations', 'notifications.current_location = stations.id');
    $this -> db -> order_by('notifications.id',"desc");
    $query = $this->db->get("notifications");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  
  //Station notifications
  public function getStationnotifications($id){
     
    $this -> db -> select_sum('amount');
    $this -> db -> select('type');
    $this -> db -> where("station_id", $id);
    $this -> db -> group_by('type');

    $query = $this->db->get("notifications");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }

  }

              
  //Update Function
  public function update($id, $data){
    $this->db->where("id", $id);
    $this->db->update("notifications", $data);
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
  //Delete Function
  public function delete($id){
    $this->db->where("id", $id);
    $this->db->delete("notifications");
    if ( $this->db->affected_rows() == "1" ){
      return TRUE;
    }else{
      return FALSE;
    }
  }


              
}
?>