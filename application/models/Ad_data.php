<?php
/**
 * Ad creative/budget data
 *
 * @author	liushu@qinggukeji.com
 */
Class Ad_data extends QG_Model {

  public function query_creative($creative_uuid) {
    return $this->query_by_id_unique('creative', '*', 'uuid', $creative_uuid);
  }

  public function query_user_creative($login_uuid) {
    return $this->query_by_id('creative', '*', 'login_uuid', $login_uuid);
  }

  public function set_creative($data, $creative_uuid = null) {
    return $this->set_by_auto_id('creative', $data, 'uuid', $creative_uuid);
  }

  public function delete_creative($creative_uuid) {
    return $this->delete_by_id('creative', 'uuid', $creative_uuid);
  }

  public function delete_creative_by_user($login_uuid) {
    return $this->delete_by_id('creative', 'login_uuid', $login_uuid);
  }

  public function set_budget($data, $budget_uuid = null) {
    return $this->set_by_auto_id('budget', $data, 'uuid', $budget_uuid);
  }

  public function query_budget($budget_uuid) {
    return $this->query_by_id_unique('budget', '*', 'uuid', $budget_uuid);
  }

  public function query_creative_budget($creative_uuid) {
    return $this->query_by_id('budget', '*', 'creative_uuid', $creative_uuid);
  }

  public function delete_budget($budget_uuid) {
    return $this->delete_by_id('budget', 'uuid', $budget_uuid);
  }

  public function delete_budget_by_creative($creative_uuid) {
    return $this->delete_by_id('budget', 'creative_uuid', $creative_uuid);
  }

}

?>
