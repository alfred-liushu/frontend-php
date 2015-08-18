<?php
/**
 * Ad creative/budget data collection
 *
 * @author	liushu@qinggukeji.com
 */
Class Ad_data_collection extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('table');
    $this->load->model('profile');
    $this->load->model('ad_data');
    $this->load->model('value_set');
  }

  public function show_creative_page() {
    $this->load->view('creative_page');
  }

  public function show_creative_form($login_uuid, $creative_uuid = null) {
    $this->load->view('creative_form', array('login_uuid'=>$login_uuid, 'creative_uuid'=>$creative_uuid));
  }

  public function set_creative($login_uuid, $creative_uuid = null) {
    $this->form_validation->set_rules('title', lang('title'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('description', lang('description'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('image', lang('image'), 'trim|required|xss_clean');
    if (!$this->form_validation->run()) {
      $this->load->view('creative_form', array('login_uuid'=>$login_uuid, 'creative_uuid'=>$creative_uuid, 'message'=>lang('error_invalid_data')));
    } elseif (!isset($this->session->userdata['logged_in'])) {
      $this->load->view('login_registration_form', array('message'=>lang('error_session_timeout')));
    } else {
      $data = array(
        'login_uuid' => $login_uuid,
        'title' => $this->input->post('title'),
        'description' => $this->input->post('description'),
        'image' => $this->input->post('image'),
      );
      $this->ad_data->set_creative($data, $creative_uuid);
      redirect('ad_data_collection/show_creative_page');
    }
  }

  public function remove_creative($creative_uuid) {
    $this->ad_data->delete_creative($creative_uuid);
    $this->ad_data->delete_budget_by_creative($creative_uuid);
    redirect('ad_data_collection/show_creative_page');
  }

  public function show_budget_page($creative_uuid) {
    $this->load->view('budget_page', array('creative_uuid'=>$creative_uuid));
  }

  public function show_budget_form($creative_uuid, $budget_uuid = null) {
    $this->load->view('budget_form', array('creative_uuid'=>$creative_uuid, 'budget_uuid'=>$budget_uuid));
  }

  public function set_budget($creative_uuid, $budget_uuid = null) {
    $this->form_validation->set_rules('country', lang('country'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('currency', lang('currency'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('monthly_budget', lang('monthly_budget'), 'trim|required|xss_clean|numeric');
    $this->form_validation->set_rules('start_time', lang('start_time'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('end_time', lang('end_time'), 'trim|required|xss_clean');
    $this->form_validation->set_rules('auto_continue', lang('auto_continue'), 'trim|xss_clean');
    if (!$this->form_validation->run()) {
      $this->load->view('budget_form', array('creative_uuid'=>$creative_uuid, 'budget_uuid'=>$budget_uuid, 'message'=>lang('error_invalid_data')));
    } elseif (!isset($this->session->userdata['logged_in'])) {
      $this->load->view('login_registration_form', array('message'=>lang('error_session_timeout')));
    } else {
      $data = array(
        'creative_uuid' => $creative_uuid,
        'country' => $this->input->post('country'),
        'currency' => $this->input->post('currency'),
        'monthly_budget' => $this->input->post('monthly_budget'),
        'start_time' => $this->input->post('start_time'),
        'end_time' => $this->input->post('end_time'),
        'auto_continue' => !empty($this->input->post('auto_continue')),
      );
      $this->ad_data->set_budget($data, $budget_uuid);
      redirect('ad_data_collection/show_budget_page/'.$creative_uuid);
    }
  }

  public function remove_budget($creative_uuid, $budget_uuid) {
    $this->ad_data->delete_budget($budget_uuid);
    redirect('ad_data_collection/show_budget_page/'.$creative_uuid);
  }

}

?>