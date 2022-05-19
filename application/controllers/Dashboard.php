<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->load->model('Common_model'); 
        $this->load->model('Dashboard_model'); 
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
    }

    /* ----------------------Dashboard Start-------------------------- */

    public function dashboard() { 
        if ($this->input->post('date')) {
            $date = date('Y-m-d', strtotime($this->input->post('date')));
        } else{
            $date = date('Y-m-d');
        }
        
        $data = array();
        $data['date'] = $date;
        $data['team_member_count'] = $this->Dashboard_model->countByTable('tbl_users');
        $data['project_count'] = $this->Dashboard_model->countByTable('tbl_projects');
        $data['total_hour_count'] = $this->Dashboard_model->countByCriteria('hour_spent','tbl_activities');
        $data['activity_count'] = $this->Dashboard_model->countByTable('tbl_activities');
        $data['team_members'] = $this->Common_model->getAllForDropdown('tbl_users');
        $data['projects'] = $this->Common_model->getAllForDropdown('tbl_projects');
        $data['main_content'] = $this->load->view('dashboard/dashboard', $data, TRUE);
        $this->load->view('userHome', $data);
    }
 
    /* ----------------------Dashboard End-------------------------- */

     

     


}
