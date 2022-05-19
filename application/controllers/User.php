<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->load->model('Common_model');
        $this->load->model('User_model');
        $this->load->library('form_validation');
        $this->load->library('encrypt');
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
    }
 

    /* ----------------------User Start-------------------------- */

    public function users() { 

        $data = array();
        $data['users'] = $this->Common_model->getAllByTable("tbl_users");
        $data['main_content'] = $this->load->view('user/users', $data, TRUE);
        $this->load->view('userHome', $data);
    }

    public function deleteUser($id) {
        $id = $this->custom->encrypt_decrypt($id, 'decrypt');

        $this->Common_model->deleteStatusChange($id, "tbl_users");

        $this->session->set_flashdata('exception', 'Information has been deleted successfully!');
        redirect('Master/foodMenuCategories');
    }

    public function addEditUser($encrypted_id = "") {
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt'); 
        if ($id != '') {
            $user_details = $this->Common_model->getDataById($id, "tbl_users"); 
        }

        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('first_name', 'First Name', 'required|max_length[50]');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required|max_length[50]');
            if ($id == "") {
                $this->form_validation->set_rules('email_address', "Email Address", "required|valid_email|is_unique[tbl_users.email_address]|max_length[50]");
            }else{
                if ($user_details->email_address != $this->input->post($this->security->xss_clean('email_address'))) {
                    $this->form_validation->set_rules('email_address', "Email Address", "required|valid_email|is_unique[tbl_users.email_address]|max_length[50]");
                }
            }



            if ($id != '') {
                if ($user_details->designation_id != NULL) {
                    $this->form_validation->set_rules('designation_id', 'Designation', 'required|max_length[15]');
                } 
            }elseif ($id == '') {
                $this->form_validation->set_rules('designation_id', 'Designation', 'required|max_length[15]');
            }
            
            

            if ($this->form_validation->run() == TRUE) {
                $user_info = array();
                $user_info['first_name'] = $this->input->post($this->security->xss_clean('first_name'));
                $user_info['last_name'] = $this->input->post($this->security->xss_clean('last_name'));
                $user_info['email_address'] = $this->input->post($this->security->xss_clean('email_address'));
                $user_info['designation_id'] = $this->input->post($this->security->xss_clean('designation_id')); 
                
                $user_password = $this->generateRandomString(); 
 

                if (!empty($user_details)){ 
                    if($user_details->email_address != $user_info['email_address']){
                    $user_info['password'] = md5($user_password); 
                    }
                }else{ 
                    $user_info['password'] = md5($user_password); 
                }

                if ($id == "") { 
                    $user_id = $this->Common_model->insertInformation($user_info, "tbl_users"); 
                    $this->sendPasswordToUser($user_info['first_name'], $user_info['last_name'], $user_info['email_address'], $user_password);  
                    $this->session->set_flashdata('exception', 'Information has been added successfully!');
                } else {
                    
                    $this->Common_model->updateInformation($user_info, $id, "tbl_users");  

                    if ($user_details->email_address != $user_info['email_address']) {
                        $this->sendPasswordToUser($user_info['first_name'], $user_info['last_name'], $user_info['email_address'], $user_password);
                    }

                    $this->session->set_flashdata('exception', 'Information has been updated successfully!');
                }
                redirect('User/users');
            } else {

                if ($id == "") {
                    $data = array(); 
                    $data['designations'] = $this->Common_model->getAllForDropdown('tbl_designations');
                    $data['main_content'] = $this->load->view('user/addUser', $data, TRUE);
                    $this->load->view('userHome', $data);
                } else { 
                    $data = array();
                    $data['encrypted_id'] = $encrypted_id;
                    $data['designations'] = $this->Common_model->getAllForDropdown('tbl_designations');
                    $data['user_info'] = $this->Common_model->getDataById($id, "tbl_users"); 
                    $data['main_content'] = $this->load->view('user/editUser', $data, TRUE);
                    $this->load->view('userHome', $data);
                }
            }
        } else {
            if ($id == "") {
                $data = array(); 
                $data['designations'] = $this->Common_model->getAllForDropdown('tbl_designations');
                $data['main_content'] = $this->load->view('user/addUser', $data, TRUE);
                $this->load->view('userHome', $data);
            } else {
                $data = array();
                $data['encrypted_id'] = $encrypted_id;
                $data['designations'] = $this->Common_model->getAllForDropdown('tbl_designations');
                $data['user_info'] = $this->Common_model->getDataById($id, "tbl_users"); 
                $data['main_content'] = $this->load->view('user/editUser', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }
    } 

    public function deactivateUser($encrypted_id){
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $user_info = array();
        $user_info['active_inactive'] = 'Inactive';
        $this->Common_model->updateInformation($user_info, $id, "tbl_users");
        $this->session->set_flashdata('exception', 'User has been deactivated successfully! This user will no longer be able to login.');
        redirect('User/users');
    }
    
    public function activateUser($encrypted_id){
        $id = $this->custom->encrypt_decrypt($encrypted_id, 'decrypt');
        $user_info = array();
        $user_info['active_inactive'] = 'Active';
        $this->Common_model->updateInformation($user_info, $id, "tbl_users");
        $this->session->set_flashdata('exception', 'User has been activated successfully! This user will be able to login again.');
        redirect('User/users');
    }

    public function sendPasswordToUser($first_name, $last_name, $email_address, $user_password){ 
        $org_details = $this->Common_model->getDataById(1, "tbl_organization"); 

        $this->load->library('email');
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);
        $this->email->from($org_details->company_email, "Tealo");
        $this->email->to($email_address);
        $this->email->subject("You have been assigned as a Team Member!");
        $data = array();
        $data['first_name'] = $first_name;
        $data['last_name'] = $last_name;
        $data['email_address'] = $email_address;
        $data['password'] = $user_password;   
        $messages = $this->load->view('user/emailTemplate', $data, TRUE);
        $this->email->message($messages); 
        $this->email->send();
    }

    public function generateRandomString($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    /* ----------------------User End-------------------------- */ 


}
