<?php
/**
 * User profile
 *
 * @author	liushu@qinggukeji.com
 */
Class Profile extends QG_Model {

  public function set_profile($data, $login_uuid) {
    return $this->set_by_id('profile', $data, 'login_uuid', $login_uuid);
  }

  public function verify_permission($login_uuid, $permission) {
    $array = $this->query_by_id_unique('profile', 'usergroup',
                                       'login_uuid', $login_uuid);
    if (empty($array['usergroup'])) return false;
    $data = array(
      'usergroup' => $array['usergroup'],
      'permission' => $permission,
    );
    $this->db->where($data);
    $query = $this->db->get('usergroup_permission');
    return $query->num_rows() > 0;
  }

  public function query_profile($login_uuid) {
    return $this->query_by_id_unique('profile', '*',
                                     'login_uuid', $login_uuid);
  }

}

?>
