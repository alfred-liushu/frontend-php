<?php
/**
 * Various value sets
 *
 * @author	liushu@qinggukeji.com
 */
Class Value_set extends CI_Model {

  public function get_country_set() {
    $this->db->distinct();
    $this->db->select('country');
    return array_column($this->db->get('country_language')->result_array(), 'country');
  }

  public function get_charge_currency_set() {
    $this->db->select('currency');
    $this->db->where('can_charge', true);
    return array_column($this->db->get('currency')->result_array(), 'currency');
  }

}

?>
