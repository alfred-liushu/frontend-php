<?php

Class User_authentication extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('user_login');
    $this->load->model('user_profile');
    $this->load->model('input_data');
  }

  public function index() {
    $this->load->view('login_registration_form');
  }

  public function show_registration() {
    $this->load->view('login_registration_form', array('register'=>''));
  }

  public function register() {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    $this->form_validation->set_rules('company', 'Text', 'trim|required|xss_clean');
    if (!$this->form_validation->run()) {
      $this->load->view('login_registration_form', array('register'=>'', 'message'=>'请输入合法的邮箱和密码！'));
    } else {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      if ($this->user_login->register($email, $password)) {
        $user_login_uuid = $this->user_login->query_user_login_uuid($email);
        if (!empty($user_login_uuid)) {
          $this->user_profile->update_profile($user_login_uuid, array('company'=>$this->input->post('company')));
        }
        $this->load->view('login_registration_form', array('message'=>'注册成功！'));
      } else {
        $this->load->view('login_registration_form', array('register'=>'', 'message'=>'该邮箱已存在！'));
      }
    }
  }

  public function login() {
    $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
    if ($this->form_validation->run() == false) {
      if (isset($this->session->userdata['logged_in'])) {
        $this->load->view('main_page');
      } else {
        $this->load->view('login_registration_form');
      }
    } else {
      $email = $this->input->post('email');
      $password = $this->input->post('password');
      if ($this->user_login->login($email, $password)) {
        $user_login_uuid = $this->user_login->query_user_login_uuid($email);
        if (!empty($user_login_uuid)) {
          $this->session->set_userdata('logged_in', array('email'=>$email, 'user_login_uuid'=>$user_login_uuid));
          $this->load->view('main_page');
        } else {
          $this->load->view('login_registration_form', array('error_message'=>'数据库发生错误！'));
        }
      } else {
        $this->load->view('login_registration_form', array('error_message'=>'用户名或密码不存在！'));
      }
    }
  }

  public function logout() {
      $this->session->unset_userdata('logged_in');
      $this->load->view('login_registration_form', array('message'=>'已退出登陆！'));
  }

}

?>