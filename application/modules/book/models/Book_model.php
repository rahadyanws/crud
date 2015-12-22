<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends CI_Model
{
  public function __construct() {
    parent::__construct();
    $data = array();
  }
  
  public function getBooks() {
    $this->db->from('tbl_book');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }
  
  function getBook($id) {
    $this->db->from('tbl_book');
    $this->db->where('book_id', $id);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->result();
    }
  }
  
  function bookCreate($data) {
    $this->db->insert('tbl_book', $data);
    $res = array('status' => true, 'message' => 'success');
    return $res;
  }
  
  function bookUpdate($id, $data) {
    $this->db->where('book_id', $id);
    $this->db->update('tbl_book', $data);
    $res = array('status' => true, 'message' => 'success');
    return $res;
  }
  function bookDelete($id) {
    $this->db->where('book_id', $id);
    $this->db->delete('tbl_book');
    $res = array('status' => true, 'message' => 'success');
    return $res;
  }
}
