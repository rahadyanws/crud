<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MX_Controller
{
  
  public function __construct() {
    parent::__construct();
    $this->data = array();
    $this->load->model(array('book/book_model','user/user_model'));
    $this->load->helper('form');
    $this->load->library('form_validation');
    if(!$this->user_model->getUserData('logged_in')) {
      redirect('web');
    }
  }
  
  public function index() {
    $this->data['user'] = $this->user_model->getUsers();
    $this->data['logged_in'] = $this->user_model->getUserData('logged_in');
    $this->data['email'] = $this->user_model->getUserData('email');
    $this->data['firstname'] = $this->user_model->getUserData('firstname');
    $this->data['lastname'] = $this->user_model->getUserData('lastname');
    $this->data['role'] = $this->user_model->getUserData('role');
    $this->template->title('TECHGRID', 'Book')
      ->set_partial('nav', 'layouts/nav_dashboard')
      ->set_partial('user_script', 'user_script')
      ->build('user', array('data' => $this->data));
  }

  public function add() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('firstname', 'Firstname', 'required');
    $this->form_validation->set_rules('lastname', 'Lastname', 'required');
    $this->form_validation->set_rules('role', 'Role', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $createUser = array(
        'firstname' => $post['firstname'], 
        'lastname' => $post['lastname'], 
        'role' => $post['role'], 
        'email' => $post['email'], 
        'password' => md5($post['password'])
        );
      $user = $this->user_model->userCreate($createUser);
      echo json_encode($user);
    }
    exit();
  }

  public function detail() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('user_id', 'User Id', 'required');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $user = $this->user_model->getUser($post['user_id']);
      $res = array('status' => true, 'message' => $user);
      echo json_encode($res);
    }
  }

  public function edit() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('firstname', 'Firstname', 'required');
    $this->form_validation->set_rules('lastname', 'Lastname', 'required');
    $this->form_validation->set_rules('role', 'Role', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $updateUser = array(
        'firstname' => $post['firstname'], 
        'lastname' => $post['lastname'], 
        'role' => $post['role'], 
        'email' => $post['email']
        );
      if($post['password']!= ""){
        $updateUser = array(
        'firstname' => $post['firstname'], 
        'lastname' => $post['lastname'], 
        'role' => $post['role'], 
        'email' => $post['email'], 
        'password' => md5($post['password'])
        );
      }
      $user = $this->user_model->userUpdate($post['user_id'], $updateUser);
      echo json_encode($user);
    }
    exit();
  }

  public function delete() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('user_id', 'User Id', 'required');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $user = $this->user_model->userDelete($post['user_id']);
      echo json_encode($user);
    }
    exit();
  }
  
}
