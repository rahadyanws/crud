<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book extends MX_Controller
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
    $this->data['book'] = $this->book_model->getBooks();
    $this->data['logged_in'] = $this->user_model->getUserData('logged_in');
    $this->data['email'] = $this->user_model->getUserData('email');
    $this->data['firstname'] = $this->user_model->getUserData('firstname');
    $this->data['lastname'] = $this->user_model->getUserData('lastname');
    $this->data['role'] = $this->user_model->getUserData('role');
    $this->template->title('TECHGRID', 'Book')
      ->set_partial('nav', 'layouts/nav_dashboard')
      ->set_partial('book_script', 'book_script')
      ->build('book', array('data' => $this->data));
  }

  public function add() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('book_code', 'Book Id', 'required');
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('publisher', 'Publisher', 'required');
    $this->form_validation->set_rules('author', 'Author', 'required');
    $this->form_validation->set_rules('publication_year', 'Publication Year', 'required');
    $this->form_validation->set_rules('stock', 'Stock', 'required');
    $this->form_validation->set_rules('category_id', 'Category', 'required');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $createBook = array(
        'book_code' => $post['book_code'], 
        'title' => $post['title'], 
        'category_id' => $post['category_id'], 
        'publisher' => $post['publisher'], 
        'author' => $post['author'], 
        'publication_year' => $post['publication_year'],
        'stock' => $post['stock']
        );
      // error_log(__FILE__ . ' : ' . __LINE__ . json_encode($createBook)); die();
      $book = $this->book_model->bookCreate($createBook);
      echo json_encode($book);
    }
    exit();
  }

  public function detail() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('book_id', 'Book Id', 'required');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $book = $this->book_model->getBook($post['book_id']);
      $res = array('status' => true, 'message' => $book);
      echo json_encode($res);
    }
  }

  public function edit() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('book_code', 'Book Id', 'required');
    $this->form_validation->set_rules('title', 'Title', 'required');
    $this->form_validation->set_rules('publisher', 'Publisher', 'required');
    $this->form_validation->set_rules('author', 'Author', 'required');
    $this->form_validation->set_rules('publication_year', 'Publication Year', 'required');
    $this->form_validation->set_rules('stock', 'Stock', 'required');
    $this->form_validation->set_rules('category_id', 'Category', 'required');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $updateBook = array(
        'book_code' => $post['book_code'], 
        'title' => $post['title'], 
        'category_id' => $post['category_id'], 
        'publisher' => $post['publisher'], 
        'author' => $post['author'], 
        'publication_year' => $post['publication_year'],
        'stock' => $post['stock']
        );
      $book = $this->book_model->bookUpdate($post['book_id'], $updateBook);
      echo json_encode($book);
    }
    exit();
  }

  public function delete() {
    if (!$this->input->is_ajax_request()) {
      exit('No direct script access allowed');
    }
    $this->form_validation->set_rules('book_id', 'Book Id', 'required');
    if ($this->form_validation->run() == FALSE) {
      $res = array('status' => false, 'message' => validation_errors());
      echo json_encode($res);
    }
    else {
      $post = $this->input->post();
      $book = $this->book_model->bookDelete($post['book_id']);
      echo json_encode($book);
    }
    exit();
  }
  
}
