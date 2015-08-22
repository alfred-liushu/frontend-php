<?php
/**
 * Common operations
 *
 * @author	liushu@qinggukeji.com
 */
Class QG_Model extends CI_Model {

  public function query_by_id($table, $output_col, $id_col, $id) {
    $this->db->select($output_col);
    $this->db->where($id_col, $id);
    $query = $this->db->get($table);
    return $query->result_array();
  }

  public function query_by_id_unique($table, $output_col, $id_col, $id) {
    $this->db->select($output_col);
    $this->db->where($id_col, $id);
    $this->db->limit('1');
    $query = $this->db->get($table);
    return $query->row_array();
  }

  public function find_by_id($table, $id_col, $id) {
    $this->db->select('1');
    $this->db->where($id_col, $id);
    $query = $this->db->get($table);
    return $query->num_rows() > 0;
  }

  public function set_by_id($table, $data, $id_col, $id) {
    if ($this->find_by_id($table, $id_col, $id)) {
      $this->db->where($id_col, $id);
      $this->db->update($table, $data);
    } else {
      $this->db->set($id_col, $id);
      $this->db->insert($table, $data);
    }
    return $this->db->affected_rows() > 0;
  }

  public function set_by_auto_id($table, $data, $id_col=null, $id=null) {
    if ($id_col!=null && $id!=null) {
      if (!$this->find_by_id($table, $id_col, $id)) return false;
      $this->db->where($id_col, $id);
      $this->db->update($table, $data);
    } else {
      $this->db->insert($table, $data);
    }
    return $this->db->affected_rows() > 0;
  }

  public function delete_by_id($table, $id_col, $id) {
    $this->db->where($id_col, $id);
    $this->db->delete($table);
    return $this->db->affected_rows() > 0;
  }

}

?>