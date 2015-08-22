<?php
/**
 * User function management
 *
 * @author	liushu@qinggukeji.com
 */
Class User_management extends QG_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->library('table');
    $this->load->model('value_set');
  }

  public function show_profile_page() {
    $this->header_view('profile_page');
  }

  public function show_profile_form($login_uuid) {
    $data = array(
      'login_uuid' => $login_uuid,
    );
    $this->header_view('profile_form', $data);
  }

  public function set_profile($login_uuid) {
    $this->form_validation->set_rules('company', lang('company'),
                                      'trim|required|xss_clean');
    $this->form_validation->set_rules('currency', lang('currency'),
                                      'trim|required|xss_clean');
    if (!$this->form_validation->run()) {
      $data = array(
        'login_uuid' => $login_uuid,
        'error' => lang('error_invalid_data'),
      );
      $this->header_view('profile_form', $data);
    } else {
      $data = array(
        'company' => $this->input->post('company'),
        'currency' => $this->input->post('currency'),
      );
      $this->profile->set_profile($data, $login_uuid);
      redirect('user_management/show_profile_page');
    }
  }

}

?>