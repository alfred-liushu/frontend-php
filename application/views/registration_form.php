<!--
Form for registration
@author	liushu@qinggukeji.com
//-->

<?php
  $data = array('register' => true);
  if (isset($success)) $data['success'] = $success;
  if (isset($error)) $data['error'] = $error;
  $this->load->view('login_registration_form', $data);
?>
