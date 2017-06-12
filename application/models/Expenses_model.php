<?php if ( ! defined("BASEPATH")) exit("Hahaha No direct script access allowed");

class Expenses_model extends CI_Model{

  public function __construct(){
    // Call the Model constructors
    parent::__construct();
  }


  //Insert Function  
  public function add($data){ 
    $this -> db -> insert("expenses", $data);
    $insert_id = $this -> db -> insert_id();
    return $insert_id;
  }


              
  //Select All Function
  public function getall($from, $to){
    $this->db->select("
      expenses.id AS id, 
      expenses.type AS type,
      expenses.refrence AS refrence, 
      expenses.amount AS price, 
      expenses.expensedate AS date,
      stations.name AS location");
    $this->db->where("expenses.expensedate >=",$from);
    $this->db->where("expenses.expensedate <=",$to);
    $this -> db -> join('stations', 'stations.id = expenses.station_id');
    $this -> db -> order_by('expenses.id',"desc");
    $query = $this->db->get("expenses");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  public function get($from, $to, $station){
    $this->db->select("
      expenses.id AS id, 
      expenses.type AS type,
      expenses.refrence AS refrence, 
      expenses.amount AS price, 
      expenses.expensedate AS date,
      stations.name AS location");

    $this->db->where('expenses.station_id', $station);
    $this->db->where("expenses.expensedate >=",$from);
    $this->db->where("expenses.expensedate <=",$to);
    $this -> db -> join('stations', 'stations.id = expenses.station_id');
    $this -> db -> order_by('expenses.id',"desc");
    $query = $this->db->get("expenses");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }

  //Get Specific Stations Inventory
  public function getstationinventory($id){
    $this->db->select("
      expenses.id AS id, 
      expenses.name AS name, 
      expenses.chassis AS chassis, 
      expenses.date AS date,
      expenses.status AS status, 
      stations.name AS location
    ");
    //$this->db->where("expenses.status",'InStock');
    $this->db->where("expenses.current_location",$id);
    $this -> db -> join('stations', 'expenses.current_location = stations.id');
    $this -> db -> order_by('expenses.id',"desc");
    $query = $this->db->get("expenses");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }
              
  //Select By Id Function
  public function getvehicle($id){
    $this->db->select("
      expenses.id AS id, 
      expenses.name AS name,
      expenses.chassis AS chassis,
      expenses.make AS make,
      expenses.model AS model, 
      expenses.year AS year, 
      expenses.stars AS stars, 
      expenses.purchase_price AS price, 
      expenses.status AS status,
      expenses.cost AS cost, 
      users.fullname AS addedby, 
      stations.name AS location
    ");
    $this->db->where("expenses.id", $id);
    $this -> db -> join('stations', 'expenses.current_location = stations.id');
    $this -> db -> join('users', 'expenses.added_by = users.user_id');

    $query = $this->db->get("expenses");
    if ($query->num_rows() > 0) {
      return $query->result();
    }else{
      return false;
    }
  }



  //Station Expenses
  public function getStationExpenses($id, $from, $to){
     
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