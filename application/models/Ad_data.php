<?php
/**
 * Ad creative/budget data
 *
 * @author	liushu@qinggukeji.com
 */
Class Ad_data extends CI_Model {

  public function set_creative($data, $creative_uuid = null) {
    if ($creative_uuid != null) {
      $this->db->where('uuid', $creative_uuid);
      $this->db->update('creative', $data);
    } else {
      $this->db->insert('creative', $data);
    }
    return $this->db->affected_rows() > 0;
  }

  public function delete_creative($creative_uuid) {
    $this->db->where('uuid', $creative_uuid);
    $this->db->delete('creative');
    return $this->db->affected_rows() > 0;
  }

  public function delete_creative_by_user($login_uuid) {
    $this->db->where('login_uuid', $login_uuid);
    $this->db->delete('creative');
    return $this->db->affected_rows() > 0;
  }

  public function query_creative($creative_uuid) {
    $this->db->where('uuid', $creative_uuid);
    return $this->db->get('creative')->row_array();
  }

  public function query_user_creative($login_uuid) {
    $this->db->where('login_uuid', $login_uuid);
    return $this->db->get('creative')->result_array();
  }

  public function set_budget($data, $budget_uuid = null) {
    if ($budget_uuid != null) {
      $this->db->where('uuid', $budget_uuid);
      $this->db->update('budget', $data);
    } else {
      $this->db->insert('budget', $data);
    }
    return $this->db->affected_rows() > 0;
  }

  public function delete_budget($budget_uuid) {
    $this->db->where('uuid', $budget_uuid);
    $this->db->delete('budget');
    return $this->db->affected_rows() > 0;
  }

  public function delete_budget_by_creative($creative_uuid) {
    $this->db->where('creative_uuid', $creative_uuid);
    $this->db->delete('budget');
    return $this->db->affected_rows() > 0;
  }

  public function query_budget($budget_uuid) {
    $this->db->where('uuid', $budget_uuid);
    return $this->db->get('budget')->row_array();
  }

  public function query_creative_budget($creative_uuid) {
    $this->db->where('creative_uuid', $creative_uuid);
    return $this->db->get('budget')->result_array();
  }

}

?>
