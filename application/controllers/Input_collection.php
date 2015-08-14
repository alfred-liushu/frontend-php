<?php

Class Input_collection extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('user_profile');
    $this->load->model('input_data');
  }

  public function input_creative() {
    $this->form_validation->set_rules('title', 'Text', 'trim|required|xss_clean');
    $this->form_validation->set_rules('text', 'Text', 'trim|required|xss_clean');
    $this->form_validation->set_rules('image', 'Text', 'trim|required|xss_clean');
    if (!$this->form_validation->run()) {
      $this->load->view('input_creative_form', array('message'=>'请输入合法的数据！'));
    } elseif (!isset($this->session->userdata['logged_in'])) {
      $this->load->view('login_registration_form', array('message'=>'请重新登陆！'));
    } else {
      $data = array(
        'user_login_uuid' => $this->session->userdata['logged_in']['user_login_uuid'],
        'title' => $this->input->post('title'),
        'text' => $this->input->post('text'),
        'image' => $this->input->post('image'),
      );
      $this->input_data->insert_creative($data);
      $this->load->view('main_page');
    }
  }

}

?>