<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller
{
  
  public function __construct() {
    parent::__construct();
    $this->data = array();
    $this->load->model(array('book/book_model','category/category_model','user/user_model'));
    $this->load->helper('form');
    $this->load->library('form_validation');
    if(!$this->user_model->getUserData('logged_in')) {
      redirect('web');
    }
  }
  
  public function index() {
    $this->data['category'] = $this->category_model->getCategorys();
    $this->data['logged_in'] = $this->user_model->getUserData('logged_in');
    $this->data['email'] = $this->user_model->getUserData('email');
    $this->data['firstname'] = $this->user_model->getUserData('firstname');
    $this->data['lastname'] = $this->user_model->getUserData('lastname');
    $this->data['role'] = $this->user_model->getUserData('role');
    $this->template->title('TECHGRID', 'Book')
      ->set_partial('nav', 'layouts/nav_dashboard')
      ->set_partial('category_script', 'category_script')
      ->build('category', array('data' => $this->data));
  }

  public function add() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('category_name', 'Category Name', 'required');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $createCategory = array(
        'category_name' => $post['category_name']
        );
      // error_log(__FILE__ . ' : ' . __LINE__ . json_encode($createCategory)); die();
      $category = $this->category_model->categoryCreate($createCategory);
      echo json_encode($category);
    }
    exit();
  }

  public function getAll() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $category = $this->category_model->getCategorys();
    $res = array('status' => true, 'message' => $category);
    echo json_encode($res);
  }

  public function detail() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('category_id', 'Category Id', 'required');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $category = $this->category_model->getCategory($post['category_id']);
      $res = array('status' => true, 'message' => $category);
      echo json_encode($res);
    }
  }

  public function edit() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('category_name', 'Category Name', 'required');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $updateCategory = array(
        'category_name' => $post['category_name']
        );
      $category = $this->category_model->categoryUpdate($post['category_id'], $updateCategory);
      echo json_encode($category);
    }
    exit();
  }

  public function delete() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('category_id', 'Category Id', 'required');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $category = $this->category_model->categoryDelete($post['category_id']);
      echo json_encode($category);
    }
    exit();
  }
  
}
