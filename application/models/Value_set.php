<?php
/**
 * Various value sets
 *
 * @author	liushu@qinggukeji.com
 */
Class Value_set extends QG_Model {

  public function get_country_set() {
    $this->db->distinct();
    $this->db->select('country');
    $array = $this->db->get('country_language')->result_array();
    return array_column($array, 'country');
  }

  public function get_charge_currency_set() {
    $array = $this->query_by_id('currency', 'currency', 'can_charge', true);
    return array_column($array, 'currency');
  }

}

?>
