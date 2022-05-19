<?php
 
class Report_model extends CI_Model {  


    public function getActivityByQuery($start_date = '', $end_date ='', $user_id = '', $project_id = '') {  
        
/*        if (isset($start_date) || isset($end_date) || isset($user_id) ||isset($project_id)) {
        	# code...
        }*/
/*        $query_builder = 'SELECT * FROM tbl_activities';
        if (!empty($start_date) && !empty($end_date)) {
        	$query_builder .= " WHERE date BETWEEN $start_date AND $end_date";
        }
        if (!empty($user_id)) {
        	$query_builder .= " WHERE user_id=$user_id";
        }
        if (!empty($project_id)) {
        	$query_builder .= " WHERE project_id=$project_id";
        }

        $result = $this->db->query($query_builder)->result();

        return $result;*/

        $this->db->select('*');
        $this->db->from('tbl_activities');
        
        if ($start_date != '') {
            $this->db->where('date >=', $start_date);
        }

        if ($end_date != '') {
			$this->db->where('date <=', $end_date);
		}

		if ($user_id != '') {
			$this->db->where('user_id', $user_id);
		}

		if ($project_id != '') {
			$this->db->where('project_id', $project_id);
		}	

		return $this->db->get()->result();
    } 

  
}
 
