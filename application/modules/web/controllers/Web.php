<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Web extends MX_Controller
{
  
  public function __construct() {
    parent::__construct();
    $this->data = array();
    $this->load->model(array('book/book_model','user/user_model'));
    $this->load->helper('form');
    $this->load->library('form_validation');
  }
  
  public function index() {
    $this->data['book'] = $this->book_model->getBooks();
    $this->template->title('TECHGRID', 'Home')->set_partial('nav', 'layouts/nav_web')->set_partial('web_script', 'web_script')->build('web', array('data' => $this->data));
  }
  
  public function login() {
    $this->load->view('login');
  }
  
  public function auth() {
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required');
    if ($this->form_validation->run() == FALSE) {
      $this->load->view('login');
    } 
    else {
      $loginData = $this->user_model->auth($this->input->post('email'), $this->input->post('password'));
      if ($loginData == true) {
        redirect('dashboard');
      } 
      else if ($loginData == false) {
        // $this->session->set_flashdata('message', 'invalid <b>Login</b> ! please insert form correctly ');
        redirect('web/login');
      }
    }
  }
  
  public function logout() {
    $this->session->sess_destroy();
    redirect("/", 'refresh');
  }
}
