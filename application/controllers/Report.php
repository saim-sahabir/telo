<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->model('Report_model');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
    }

    /* ----------------------Report Start-------------------------- */

    public function report() {
        if ($this->input->post('submit')) {
            $start_date = '';
            $end_date = '';
            $user_id = '';
            $project_id = '';

            if ($this->input->post('start_date')) {
                $start_date = date("Y-m-d", strtotime($this->input->post('start_date')));
            }
            
            if ($this->input->post('end_date')) {
                $end_date = date("Y-m-d", strtotime($this->input->post('end_date')));
            }

            if ($this->input->post('user_id')) {
                $user_id = $this->input->post('user_id');
            }

            if ($this->input->post('project_id')) {
                $project_id = $this->input->post('project_id');
            }
        
            $data = array(); 
            $data['team_members'] = $this->Common_model->getAllForDropdown('tbl_users');
            $data['projects'] = $this->Common_model->getAllForDropdown('tbl_projects');
            $data['activities'] = $this->Report_model->getActivityByQuery($start_date, $end_date, $user_id, $project_id);
            $data['main_content'] = $this->load->view('report/report', $data, TRUE);
            $this->load->view('userHome', $data);

            
        } else { 
            $data = array(); 
            $data['team_members'] = $this->Common_model->getAllForDropdown('tbl_users');
            $data['projects'] = $this->Common_model->getAllForDropdown('tbl_projects');
            $data['main_content'] = $this->load->view('report/report', $data, TRUE);
            $this->load->view('userHome', $data);
        }
    }

    /* ----------------------Report End-------------------------- */
}
