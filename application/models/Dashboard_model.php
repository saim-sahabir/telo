<?php
 
class Dashboard_model extends CI_Model {  
 
    public function countByTable($table_name) {  
        $this->db->like('del_status', 'Live');
        return $this->db->count_all_results($table_name);
    } 

    public function countByCriteria($field_name, $table_name) {  
       $result = $this->db->query("SELECT sum($field_name) as hour_spent
          FROM $table_name 
          WHERE del_status = 'Live'")->row(); 
        return $result->hour_spent; 
    }  



}
 
