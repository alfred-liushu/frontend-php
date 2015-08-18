<?php
/**
 * Display result data
 *
 * @author	liushu@qinggukeji.com
 */
Class Result_display extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model('profile');
    $this->load->model('result_data');
  }

  public function show_result() {
    $this->load->view('result_page');
  }

}

?>