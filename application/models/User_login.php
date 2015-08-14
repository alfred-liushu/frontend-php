<?php

//Password API needs PHP 5.5+
Class User_login extends QG_Model {

  public function register($email, $password) {
    $query = $this->query_unique_record_by_id('user_login', 'email', $email, '1');
    $data = array(
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT)
    );
    return $query->num_rows() == 0 && $this->insert_with_auto_id('user_login', $data);
  }

  public function login($email, $password) {
    $query = $this->query_unique_record_by_id('user_login', 'email', $email, 'password');
    return $query->num_rows() == 1 && password_verify($password, $query->row()->password);
  }

  public function query_user_login_uuid($email) {
    $query = $this->query_unique_record_by_id('user_login', 'email', $email, 'uuid');
    return $query->num_rows() == 1 ? $query->row()->uuid : null;
  }

}

?>
