<?php
/**
 * Registration & login, password API needs PHP 5.5+
 *
 * @author	liushu@qinggukeji.com
 */
Class Login extends CI_Model {

  public function user_register($email, $password) {
    $this->db->select('1');
    $this->db->where('email', $email);
    $query = $this->db->get('login');
    if ($query->num_rows() > 0) return false;
    $data = array(
      'email' => $email,
      'password' => password_hash($password, PASSWORD_DEFAULT)
    );
    $this->db->insert('login', $data);
    return $this->db->affected_rows() > 0;
  }

  public function user_login($email, $password) {
    $this->db->select('password');
    $this->db->where('email', $email);
    $query = $this->db->get('login');
    return $query->num_rows() == 1 && password_verify($password, $query->row()->password);
  }

  public function query_login_uuid($email) {
    $this->db->select('uuid');
    $this->db->where('email', $email);
    $query = $this->db->get('login');
    return $query->num_rows() == 1 ? $query->row()->uuid : null;
  }

}

?>
