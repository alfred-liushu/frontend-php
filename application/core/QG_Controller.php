<?php
/**
 * Common operations
 *
 * @author	liushu@qinggukeji.com
 */
Class QG_Controller extends CI_Controller {

  public function template_view($page, $page_data = array()) {
    $data = array(
      'page' => $page,
      'language' => 'zh-CN',
    );
    $this->load->view('template', $data);
    $this->load->view($page, $page_data);
  }

  public function header_view($page, $page_data = array()) {
    $data = array(
      'page' => $page,
      'language' => 'zh-CN',
    );
    $this->load->view('template', $data);
    $data = array(
      'page' => $page,
    );
    $this->load->view('header', $data);
    $this->load->view($page, $page_data);
  }

}

?>