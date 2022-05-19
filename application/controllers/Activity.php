<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Activity extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Common_model');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
    }

    /* ----------------------Activity Start-------------------------- */

    public function myActivities() {
        $user_id = $this->session->userdata('user_id');

        $data = array();
        $data['activities'] = $this->Common_model->getAllByUserId($user_id, "tbl_activities");
        $data['main_content'] = $this->load->view('activity/myActivities', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function allActivities() {

        $data = array();
        $data['activities'] = $this->Common_model->getAllByTable("tbl_activities");
        $data['main_content'] = $this->load->view('activity/allActivities', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteActivity($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_activities");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');

        if ($this->session->userdata('designation_id') == NULL) {
            redirect('Activity/allActivities');
        } else {
            redirect('Activity/myActivities');
        }
    }

    public function addEditActivity($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('date', 'Date', 'required|max_length[50]');
            $this->form_validation->set_rules('project_id', 'Project', 'required|max_length[50]');
            $this->form_validation->set_rules('activity', 'Activity', 'required');
            $this->form_validation->set_rules('hour_spent', 'Hour Spent', 'required|numeric');
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() == TRUE) {
                $actvt_info = array();
                $actvt_info['date'] = date('Y-m-d', strtotime($this->input->post($this->security->xss_clean('date'))));
                $actvt_info['project_id'] = $this->input->post($this->security->xss_clean('project_id'));
                $actvt_info['activity'] = $this->input->post($this->security->xss_clean('activity'));
                $actvt_info['hour_spent'] = $this->input->post($this->security->xss_clean('hour_spent'));
                $actvt_info['status'] = $this->input->post($this->security->xss_clean('status'));
                $actvt_info['user_id'] = $this->session->userdata('user_id');
                if ($id == "") {
                    $this->Common_model->insertInformation($actvt_info, "tbl_activities");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($actvt_info, $id, "tbl_activities");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }

                if ($this->session->userdata('designation_id') == NULL) {
                    redirect('Activity/allActivities');
                } else {
                    redirect('Activity/myActivities');
                }
            } else {
                if ($id == "") {
                    $data = array();
                    $data['projects'] = $this->Common_model->getAllForDropdown('tbl_projects');
                    $data['main_content'] = $this->load->view('activity/addActivity', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['projects'] = $this->Common_model->getAllForDropdown('tbl_projects');
                    $data['actvt_info'] = $this->Common_model->getDataById($id, "tbl_activities");
                    $data['main_content'] = $this->load->view('activity/editActivity', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['projects'] = $this->Common_model->getAllForDropdown('tbl_projects');
                $data['main_content'] = $this->load->view('activity/addActivity', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['projects'] = $this->Common_model->getAllForDropdown('tbl_projects');
                $data['actvt_info'] = $this->Common_model->getDataById($id, "tbl_activities");
                $data['main_content'] = $this->load->view('activity/editActivity', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    public function editActivityByAdmin($encrypted_id) {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('date', 'Date', 'required|max_length[50]');
            $this->form_validation->set_rules('project_id', 'Project', 'required|max_length[50]');
            $this->form_validation->set_rules('activity', 'Activity', 'required');
            $this->form_validation->set_rules('hour_spent', 'Hour Spent', 'required|numeric');
            $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() == TRUE) {
                $actvt_info = array();
                $actvt_info['date'] = date('Y-m-d', strtotime($this->input->post($this->security->xss_clean('date'))));
                $actvt_info['project_id'] = $this->input->post($this->security->xss_clean('project_id'));
                $actvt_info['activity'] = $this->input->post($this->security->xss_clean('activity'));
                $actvt_info['hour_spent'] = $this->input->post($this->security->xss_clean('hour_spent'));
                $actvt_info['status'] = $this->input->post($this->security->xss_clean('status'));
                $actvt_info['user_id'] = $this->input->post($this->security->xss_clean('user_id'));

                $this->Common_model->updateInformation($actvt_info, $id, "tbl_activities");
                $this->session->set_flashdata('exception', 'Information has been updated successfully!');

                redirect('Activity/allActivities');
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['projects'] = $this->Common_model->getAllForDropdown('tbl_projects');
                $data['actvt_info'] = $this->Common_model->getDataById($id, "tbl_activities");
                $data['main_content'] = $this->load->view('activity/editActivityByAdmin', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        } else {

            $data = array();
            $data['encrypted_id'] = $encrypted_id;
            $data['projects'] = $this->Common_model->getAllForDropdown('tbl_projects');
            $data['actvt_info'] = $this->Common_model->getDataById($id, "tbl_activities");
            $data['main_content'] = $this->load->view('activity/editActivityByAdmin', $data, TRUE);
            $this->load->view('userHome', $data);
        }
    }

    /* ----------------------Activity End-------------------------- */
}
