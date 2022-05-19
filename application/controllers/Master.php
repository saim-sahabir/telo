<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Master extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->load->model('Common_model'); 
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
    }

    /* ----------------------Designation Start-------------------------- */

    public function designations() { 

        $data = array();
        $data['designations'] = $this->Common_model->getAllByTable("tbl_designations");
        $data['main_content'] = $this->load->view('master/designation/designations', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteDesignation($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_designations");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/designations');
    }

    public function addEditDesignation($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('designation_name', 'Designation Name', 'required|max_length[50]');
            $this->form_validation->set_rules('description', 'Description', 'max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $dsgn_info = array();
                $dsgn_info['designation_name'] = htmlspecialchars($this->input->post($this->security->xss_clean('designation_name')));
                $dsgn_info['description'] = $this->input->post($this->security->xss_clean('description')); 
                if ($id == "") {
                    $this->Common_model->insertInformation($dsgn_info, "tbl_designations");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($dsgn_info, $id, "tbl_designations");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/designations');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['main_content'] = $this->load->view('master/designation/addDesignation', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['dsgn_info'] = $this->Common_model->getDataById($id, "tbl_designations");
                    $data['main_content'] = $this->load->view('master/designation/editDesignation', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['main_content'] = $this->load->view('master/designation/addDesignation', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['dsgn_info'] = $this->Common_model->getDataById($id, "tbl_designations");
                $data['main_content'] = $this->load->view('master/designation/editDesignation', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Designation End-------------------------- */

    /* ----------------------Project Start-------------------------- */

    public function projects() {
        $tracking_id = $this->session->userdata('tracking_id');

        $data = array();
        $data['projects'] = $this->Common_model->getAllByTable("tbl_projects");
        $data['main_content'] = $this->load->view('master/project/projects', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteProject($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_projects");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/projects');
    }

    public function addEditProject($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('project_name', 'Project Name', 'required|max_length[50]');
            $this->form_validation->set_rules('description', 'Description', 'max_length[50]');
            if ($this->form_validation->run() == TRUE) {
                $prjtct_info = array();
                $prjtct_info['project_name'] = htmlspecialchars($this->input->post($this->security->xss_clean('project_name')));
                $prjtct_info['description'] = $this->input->post($this->security->xss_clean('description')); 
                if ($id == "") {
                    $this->Common_model->insertInformation($prjtct_info, "tbl_projects");
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    $this->Common_model->updateInformation($prjtct_info, $id, "tbl_projects");
                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('Master/projects');
            } else {
                if ($id == "") {
                    $data = array();
                    $data['main_content'] = $this->load->view('master/project/addProject', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else {
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['prjtct_info'] = $this->Common_model->getDataById($id, "tbl_projects");
                    $data['main_content'] = $this->load->view('master/project/editProject', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array();
                $data['main_content'] = $this->load->view('master/project/addProject', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['prjtct_info'] = $this->Common_model->getDataById($id, "tbl_projects");
                $data['main_content'] = $this->load->view('master/project/editProject', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    }

    /* ----------------------Project End-------------------------- */

     


}
