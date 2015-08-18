<?php
/**
 * Registration & login
 *
 * @author	liushu@qinggukeji.com
 */
Class User_authentication extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('login');
    $this->load->model('profile');
    $this->load->model('ad_data');
  }

  public function index() {
    $this->load->view('profile_page');
  }

  public function show_login() {
    $this->load->view('login_registration_form');
  }

  public function show_registration() {
    $this->load->view('login_registration_form', array('register'=>true));
  }

  public function register() {
    $this->form_validation->set_rules('email', lang('email'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', lang('password'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('company', lang('company'), 'trim|required|xss_clean');
    if (!$this->form_validation->run()) {
      $this->load->view('login_registration_form', array('register'=>true, 'message'=>lang('error_invalid_data')));
    } else {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      if ($this->login->user_register($email, $password)) {
        $login_uuid = $this->login->query_login_uuid($email);
        if (!empty($login_uuid)) {
          $data = array(
            'company' => $this->input->post('company'),
          );
          $this->profile->set_profile($data, $login_uuid);
        }
        $this->load->view('login_registration_form', array('message'=>lang('register_success')));
      } else {
        $this->load->view('login_registration_form', array('register'=>true, 'message'=>lang('error_email_exist')));
      }
    }
  }

  public function login() {
    $this->form_validation->set_rules('email', lang('email'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', lang('password'), 'trim|required|xss_clean');
    if ($this->form_validation->run() == false) {
      if (isset($this->session->userdata['logged_in'])) {
        redirect('');
      } else {
        $this->load->view('login_registration_form');
      }
    } else {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      if ($this->login->user_login($email, $password)) {
        $login_uuid = $this->login->query_login_uuid($email);
        if (!empty($login_uuid)) {
          $session_data = array(
            'email' => $email,
            'login_uuid' => $login_uuid,
          );
          $this->session->set_userdata('logged_in', $session_data);
          redirect('');
        } else {
          $this->load->view('login_registration_form', array('error_message'=>lang('error_database')));
        }
      } else {
        $this->load->view('login_registration_form', array('error_message'=>lang('error_email_password')));
      }
    }
  }

  public function logout() {
      $this->session->unset_userdata('logged_in');
      $this->load->view('login_registration_form', array('message'=>lang('logout_success')));
  }

}

?>