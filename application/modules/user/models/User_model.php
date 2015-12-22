<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{
  public function __construct() {
    parent::__construct();
    $data = array();
  }
  
  function auth($email, $password) {
    $this->db->from('tbl_user');
    $this->db->where('email', $email);
    $this->db->where('password', md5($password));
    $query = $this->db->get();
    if ($query->num_rows() == 1) {  
      $arr = array( 
        'user_id' => $query->row()->user_id, 
        'email' => $query->row()->email, 
        'firstname' => $query->row()->firstname,
        'lastname' => $query->row()->lastname,
        'role' => $query->row()->role,
        'logged_in' => TRUE
        );
      $this->setUserData($arr); 
      return TRUE;
    }
  }
  
  public function setUserData($user = array()) {
    $this->session->set_userdata($user);
  }
  
  public function getUserData($data = null) {
    $user = $this->session->userdata();
    if ($data) {
      return $this->session->userdata($data);
    }
    return $user;
  }
  
  public function getUsers() {
    $this->db->from('tbl_user');
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      return $query->result();
    }
  }
  
  function getUser($id) {
    $this->db->from('tbl_user');
    $this->db->where('user_id', $id);
    $query = $this->db->get();
    if ($query->num_rows() == 1) {
      return $query->result();
    }
  }
  
  function userCreate($data) {
    $this->db->insert('tbl_user', $data);
    $res = array('status' => true, 'message' => 'success');
    return $res;
  }
  
  function userUpdate($id, $data) {
    $this->db->where('user_id', $id);
    $this->db->update('tbl_user', $data);
    $res = array('status' => true, 'message' => 'success');
    return $res;
  }
  function userDelete($id) {
    $this->db->where('user_id', $id);
    $this->db->delete('tbl_user');
    $res = array('status' => true, 'message' => 'success');
    return $res;
  }
}
