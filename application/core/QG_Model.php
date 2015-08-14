<?php

Class QG_Model extends CI_Model {

  protected function insert_with_auto_id($table, $data) {
    $this->db->insert($table, $data);
    return $this->db->affected_rows() > 0;
  }

  protected function insert_update_unique_record_by_id($table, $id_col, $id, $data) {
    $this->db->select('1');
    $this->db->where($id_col, $id);
    $query = $this->db->get($table);
    if ($query->num_rows() == 1) {
      $this->db->where($id_col, $id);
      $this->db->update($table, $data);
    } else {
      $this->db->set($id_col, $id);
      $this->db->insert($table, $data);
    }
    return $this->db->affected_rows() > 0;
  }

  protected function query_by_id($table, $id_col, $id, $output_col) {
    $this->db->select($output_col);
    $this->db->where($id_col, $id);
    return $this->db->get($table);
  }

  protected function query_unique_record_by_id($table, $id_col, $id, $output_col) {
    $this->db->select($output_col);
    $this->db->where($id_col, $id);
    $this->db->limit(1);
    return $this->db->get($table);
  }

}

?>
