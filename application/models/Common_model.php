<?php

 
class Common_model extends CI_Model {  
 
    public function getAllByTable($table_name) {
        $this->db->select("*");
        $this->db->from($table_name); 
        $this->db->order_by('id', 'DESC'); 
        $this->db->where("del_status", 'Live');
        return $this->db->get()->result();
    }   
    public function getAllByUserId($user_id, $table_name) {
        $this->db->select("*");
        $this->db->from($table_name); 
        $this->db->order_by('id', 'DESC'); 
        $this->db->where('user_id', $user_id);
        $this->db->where("del_status", 'Live');
        return $this->db->get()->result();
    }   
 
    public function getAllForDropdown($table_name) {
        $result = $this->db->query("SELECT * 
          FROM $table_name 
          WHERE del_status = 'Live'  
          ORDER BY 2")->result(); 
        return $result; 
    }  

    public function deleteStatusChange($id, $table_name) { 
        $this->db->set('del_status', "Deleted");
        $this->db->where('id', $id);
        $this->db->update($table_name);
    }
 

    public function insertInformation($data, $table_name) {
        $this->db->insert($table_name, $data);
        return $this->db->insert_id();
    }
    
    public function getDataById($id, $table_name){
        $this->db->select("*");
        $this->db->from($table_name); 
        $this->db->where("id", $id); 
        return $this->db->get()->row();
    } 

    public function updateInformation($data, $id, $table_name) {
        $this->db->where('id', $id);
        $this->db->update($table_name, $data);
    }
 



}
 
