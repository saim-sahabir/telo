<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Authentication extends CI_Controller {

    public function __construct() {
        parent::__construct(); 
        $this->load->model('Common_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $this->load->view('authentication/login');
    }

    public function loginCheck() {
        if ($this->input->post('submit') != 'submit') {
            redirect("Authentication/index");
        }

        $this->form_validation->set_rules('email_address', 'Email Address', 'required|valid_email|max_length[50]');
        $this->form_validation->set_rules('password', "Password", "required|max_length[50]");
        if ($this->form_validation->run() == TRUE) {
            $email_address = $this->input->post($this->security->xss_clean('email_address'));
            $password = md5($this->input->post($this->security->xss_clean('password')));
            $user_information = $this->Authentication_model->getUserInformation($email_address, $password);


            if ($user_information){
                $user_active_status = $user_information->active_inactive == 'Active';
            }else{
                $user_active_status = '';
            } 

            if ($user_information && $user_active_status == 'Active') {  

                $login_session = array();
                //User Information
                $login_session['user_id'] = $user_information->id;
                $login_session['first_name'] = $user_information->first_name;
                $login_session['last_name'] = $user_information->last_name;  
                $login_session['email_address'] = $user_information->email_address;  
                $login_session['designation_id'] = $user_information->designation_id;  
                //Set session
                $this->session->set_userdata($login_session); 

                redirect("Authentication/userProfile");
            } else {
                $this->session->set_flashdata('exception_1', 'Incorrect Email/Password or inactive user');
                redirect('Authentication/index');
            }
        } else {
            $this->load->view('authentication/login');
        }
    }
 

    public function userProfile() {
        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        $data = array();
        $data['main_content'] = $this->load->view('authentication/userProfile', $data, TRUE);
        $this->load->view('userHome', $data);
    }
  

    public function changePassword() {

        if (!$this->session->has_userdata('user_id')) {
            redirect('Authentication/index');
        }
        if ($this->input->post('submit') == 'submit') { 
            $this->form_validation->set_rules('old_password', 'Old Password', 'required|max_length[50]');
            $this->form_validation->set_rules('new_password', 'New Password', 'required|max_length[50]|min_length[6]');
            if ($this->form_validation->run() == TRUE) {
                $old_password = md5($this->input->post($this->security->xss_clean('old_password')));
                $user_id = $this->session->userdata('user_id'); 

                $password_check = $this->Authentication_model->passwordCheck($old_password, $user_id);

                if ($password_check) {
                    $new_password = md5($this->input->post($this->security->xss_clean('new_password')));

                    $this->Authentication_model->updatePassword($new_password, $user_id);

                    $this->session->set_flashdata('exception', 'Password has been changed successfully!');
                    redirect('Authentication/changePassword');
                } else {
                    $this->session->set_flashdata('exception_1', 'Old Password does not match!');
                    redirect('Authentication/changePassword');
                }
            } else {
                $data = array();
                $data['main_content'] = $this->load->view('authentication/changePassword', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        } else {
            $data = array();
            $data['main_content'] = $this->load->view('authentication/changePassword', $data, TRUE);
            $this->load->view('userHome', $data);
        }
    }

    public function forgotPassword() {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('email_address', 'Email Address', 'required|max_length[50]|valid_email|callback_email_existance_check'); 
            if ($this->form_validation->run() == TRUE) {
                $email_address = $this->input->post('email_address');
                 
                $user_details = $this->db->query("select * from tbl_users where email_address='".$email_address."'")->row(); 

                $user_password = $this->generateRandomString(); 
 

                $user_info = array();
                $user_info['password'] = md5($user_password);  
                $this->Common_model->updateInformation($user_info, $user_details->id, "tbl_users"); 
                 
                $this->sendPasswordToUser($user_details->first_name, $user_details->last_name, $email_address, $user_password); 

                $this->session->set_flashdata('exception', 'Success! Check your email!');
                
                redirect('Authentication/forgotPassword');
            }else{
                $this->load->view('authentication/forgotPassword'); 
            }
        }else{
            $this->load->view('authentication/forgotPassword');
        }
    }  

    public function email_existance_check($string){
        $email_address = $string;
        $email_existance = $this->db->query("SELECT * FROM tbl_users WHERE `email_address`='$email_address'")->row();

        if (!empty($email_existance)) {
            return TRUE;
        } else {
            $this->form_validation->set_message('email_existance_check', 'Account does not exist!');
            return FALSE;
        }
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
        $this->email->subject("Your password has been reset!");
        $data = array();
        $data['first_name'] = $first_name;
        $data['last_name'] = $last_name;
        $data['email_address'] = $email_address;
        $data['password'] = $user_password;   
        $messages = $this->load->view('authentication/emailTemplateForgotPassword', $data, TRUE);
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

    public function updateOrganizationProfile() {
        if ($this->input->post('submit')) { 
            $this->form_validation->set_rules('org_name', 'Organization Name', 'required|max_length[50]');
            $this->form_validation->set_rules('address', 'Address', 'required|max_length[200]');
            $this->form_validation->set_rules('date_format', "Date Format", "required|max_length[50]"); 
            $this->form_validation->set_rules('company_email', "Company Email", "required|valid_email|max_length[50]"); 
            if ($this->form_validation->run() == TRUE) {
                $org_information = array();
                $org_information['org_name'] = $this->input->post($this->security->xss_clean('org_name'));
                $org_information['address'] = $this->input->post($this->security->xss_clean('address'));
                $org_information['date_format'] = $this->input->post($this->security->xss_clean('date_format')); 
                $org_information['company_email'] = $this->input->post($this->security->xss_clean('company_email')); 
     
                $this->Authentication_model->updateOrganizationProfile($org_information); 

                $this->session->set_flashdata('exception', 'Organization Profile has been updated successfully!');
                redirect('Authentication/updateOrganizationProfile');
            } else {
                $data = array(); 
                $data['org_information'] = $this->Authentication_model->getOrgInformation();
                $data['main_content'] = $this->load->view('authentication/updateOrgProfile', $data, TRUE);
                $this->load->view('userHome', $data);
            }
        }else{
            $data = array(); 
            $data['org_information'] = $this->Authentication_model->getOrgInformation();
            $data['main_content'] = $this->load->view('authentication/updateOrgProfile', $data, TRUE);
            $this->load->view('userHome', $data);
        }
    }
 

    public function logOut() {
        //User Information 
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('full_name');
        $this->session->unset_userdata('mobile_no');
        $this->session->unset_userdata('email_address');
        $this->session->unset_userdata('role');
        $this->session->unset_userdata('shop_id');
        //Shop Information
        $this->session->unset_userdata('client_id');
        $this->session->unset_userdata('shop_name');
        $this->session->unset_userdata('address');
        $this->session->unset_userdata('collect_vat');
        $this->session->unset_userdata('vat_reg_no');
        $this->session->unset_userdata('invoice_print');

        redirect('Authentication/index');
    }

}
