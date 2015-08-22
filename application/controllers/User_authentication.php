<?php
/**
 * Registration & login
 *
 * @author	liushu@qinggukeji.com
 */
Class User_authentication extends QG_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('login');
    $this->load->model('ad_data');
  }

  public function index() {
    redirect('user_management/show_profile_page');
  }

  public function show_login() {
    $this->header_view('login_form');
  }

  public function show_registration() {
    $this->header_view('registration_form');
  }

  public function register() {
    $this->form_validation->set_rules('email', lang('email'),
                                      'trim|required|xss_clean');
    $this->form_validation->set_rules('password', lang('password'),
                                      'trim|required|xss_clean');
    if (!$this->form_validation->run()) {
      $data = array(
        'error' => lang('error_invalid_data'),
      );
      $this->header_view('registration_form', $data);
    } else {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      if ($this->login->user_register($email, $password)) {
        $login_uuid = $this->login->query_login_uuid($this->input->post('email'));
        if (!empty($login_uuid)) $this->profile->set_profile(array(), $login_uuid);
        $data = array(
          'success' => lang('register_success'),
        );
        $this->header_view('login_form', $data);
      } else {
        $data = array(
          'error' => lang('error_email_exist'),
        );
        $this->header_view('registration_form', $data);
      }
    }
  }

  public function login() {
    $this->form_validation->set_rules('email', lang('email'),
                                      'trim|required|xss_clean');
    $this->form_validation->set_rules('password', lang('password'),
                                      'trim|required|xss_clean');
    if ($this->form_validation->run() == false) {
      $data = array(
        'error' => lang('error_invalid_data'),
      );
      $this->header_view('login_form', $data);
    } else {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      if ($this->login->user_login($email, $password)) {
        $login_uuid = $this->login->query_login_uuid($email);
        if (!empty($login_uuid)) {
          $data = array(
            'email' => $email,
            'login_uuid' => $login_uuid,
          );
          $this->session->set_userdata('logged_in', $data);
          redirect('user_management/show_profile_page');
        } else {
          $data = array(
            'error' => lang('error_database'),
          );
          $this->header_view('login_form', $data);
        }
      } else {
        $data = array(
          'error' => lang('error_email_password'),
        );
        $this->header_view('login_form', $data);
      }
    }
  }

  public function logout() {
      $this->session->unset_userdata('logged_in');
      $data = array(
        'success'=>lang('logout_success'),
      );
      $this->header_view('login_form', $data);
  }

}

?>