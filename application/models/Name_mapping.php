<?php

Class Name_mapping extends QG_Model {

  private $mapping;

  public function __construct() {
    parent::__construct();
    $this->mapping['user_group'] = $this->load_name_mapping('user_group', 'id', 'name');
    $this->mapping['permission'] = $this->load_name_mapping('permission', 'id', 'name');
    $this->mapping['country'] = $this->load_name_mapping('country', 'code', 'name');
    $this->mapping['language'] = $this->load_name_mapping('language', 'code', 'name');
    $this->mapping['currency'] = $this->load_name_mapping('currency', 'code', 'name');
  }

  public function get_code_mapping($type) {
    return $this->mapping[$type];
  }

  public function get_code_name($type, $code) {
    return $this->mapping[$type][$code];
  }

  //Take care of security
  protected function load_name_mapping($table, $code_col, $name_col) {
    $this->db->select($code_col . ',' . $name_col);
    $query = $this->db->get($table);
    foreach ($query->result_array() as $row) {
      $array[$row[$code_col]] = $row[$name_col];
    }
    return $array;
  }
}

?>
