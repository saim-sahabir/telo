<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user_model
 *
 * @author user
 */
class Authentication_model extends CI_Model {

    public function getUserInformation($email_address, $password) {
        $this->db->select("*");
        $this->db->from("tbl_users");
        $this->db->where("email_address", $email_address);
        $this->db->where("password", $password);
        $this->db->where("active_inactive", 'Active'); 
        return $this->db->get()->row();
    } 

    public function saveUserInfo($user_info) {
        $this->db->insert('tbl_users', $user_info);
        return $this->db->insert_id();
    }

    public function updateTrackingId($user_id) {
        $this->db->set('tracking_id', $user_id);
        $this->db->where('id', $user_id);
        $this->db->update('tbl_users');
    }

      
    public function passwordCheck($old_password, $user_id) { 
        $row = $this->db->query("SELECT * FROM tbl_users WHERE id=$user_id AND password='$old_password'")->row();
        return $row;
    }

    public function updatePassword($new_password, $user_id) {
        $this->db->set('password', $new_password);
        $this->db->where('id', $user_id);
        $this->db->update('tbl_users');
    }

    public function getOrgInformation() {
        $this->db->select("*");
        $this->db->from("tbl_organization"); 
        $this->db->where("id", 1);
        return $this->db->get()->row();
    }

    public function updateOrganizationProfile($org_information) {
        $this->db->set('org_name', $org_information['org_name']);
        $this->db->set('address', $org_information['address']);
        $this->db->set('date_format', $org_information['date_format']); 
        $this->db->set('company_email', $org_information['company_email']); 
        $this->db->where('id', 1);
        $this->db->update('tbl_organization');
    }
 
 
    

 

}

?>
