<?php
/**
 * User profile
 *
 * @author	liushu@qinggukeji.com
 */
Class Profile extends CI_Model {

  public function set_profile($data, $login_uuid) {
    $this->db->select('1');
    $this->db->where('login_uuid', $login_uuid);
    $query = $this->db->get('profile');
    if ($query->num_rows() > 0) {
      $this->db->where('login_uuid', $login_uuid);
      $this->db->update('profile', $data);
    } else {
      $this->db->set('login_uuid', $login_uuid);
      $this->db->insert('profile', $data);
    }
    return $this->db->affected_rows() > 0;
  }

  public function verify_permission($login_uuid, $permission) {
    $this->db->select('usergroup');
    $this->db->where('login_uuid', $login_uuid);
    $usergroup_query = $this->db->get('profile');
    if ($usergroup_query->num_rows() <= 0) return false;
    $this->db->where(array('usergroup'=>$usergroup_query->row()->usergroup, 'permission'=>$permission));
    $permission_query = $this->db->get('usergroup_permission');
    return $permission_query->num_rows() > 0;
  }

  public function query_profile($login_uuid) {
    $this->db->where('login_uuid', $login_uuid);
    return $this->db->get('profile')->row_array();
  }

}

?>
