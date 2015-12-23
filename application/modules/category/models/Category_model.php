<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
{
  public function __construct() {
    parent::__construct();
    $data = array();
  }
  
  public function getCategorys() {
    $this->db->from('tbl_category');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }
  
  function getCategory($id) {
    $this->db->from('tbl_category');
    $this->db->where('category_id', $id);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->result();
    }
  }
  
  function categoryCreate($data) {
    $this->db->insert('tbl_category', $data);
    $res = array('status' => true, 'message' => 'success');
    return $res;
  }
  
  function categoryUpdate($id, $data) {
    $this->db->where('category_id', $id);
    $this->db->update('tbl_category', $data);
    $res = array('status' => true, 'message' => 'success');
    return $res;
  }
  function categoryDelete($id) {
    $this->db->where('category_id', $id);
    $this->db->delete('tbl_category');
    $res = array('status' => true, 'message' => 'success');
    return $res;
  }
}
