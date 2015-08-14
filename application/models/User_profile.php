<?php

Class User_profile extends QG_Model {

  public function update_profile($user_login_uuid, $data) {
    return $this->insert_update_unique_record_by_id('user_profile', 'user_login_uuid', $user_login_uuid, $data);
  }

  public function verify_user_permission($user_login_uuid, $permission_id) {
    $sql = 'SELECT 1 FROM 
      (SELECT user_group_id FROM user_profile WHERE user_login_uuid = ? LIMIT 1)t_user 
      INNER JOIN user_group_permission ON (t_user.user_group_id = user_group_permission.user_group_id) 
      WHERE permission_id = ?';
    $query = $this->db->query($sql, array($user_login_uuid, $permission_id));
    return $query->num_rows() > 0;
  }

  public function query_user_profile($user_login_uuid) {
    return $this->query_unique_record_by_id('user_profile', 'user_login_uuid', $user_login_uuid, 'company,currency_code,balance');
  }

}

?>
