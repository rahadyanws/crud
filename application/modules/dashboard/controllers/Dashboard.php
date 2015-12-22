<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MX_Controller
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
    $this->template->title('TECHGRID', 'Home')
      ->set_partial('nav', 'layouts/nav_dashboard')
      ->set_partial('dashboard_script', 'dashboard_script')
      ->build('dashboard', array('data' => $this->data));
  }
  
}
