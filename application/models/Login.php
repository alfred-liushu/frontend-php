<?php
/**
 * Registration & login, password API needs PHP 5.5+
 *
 * @author	liushu@qinggukeji.com
 */
Class Login extends QG_Model {

  public function user_register($email, $password) {
    if ($this->find_by_id('login', 'email', $email)) return false;
    $data = array(
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT)
    );
    return $this->set_by_auto_id('login', $data);
  }

  public function user_login($email, $password) {
    $row = $this->query_by_id_unique('login', 'password', 'email', $email);
    return password_verify($password, $row['password']);
  }

  public function query_login_uuid($email) {
    $row = $this->query_by_id_unique('login', 'uuid', 'email', $email);
    return $row['uuid'];
  }

}

?>
