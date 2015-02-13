<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->view('/users/index');
	}

	public function register()
	{
		$this->load->model('User');
		$this->User->registration($this->input->post());
		$this->load->view('/books/index');
		// redirect("/books/$id");
	}

	public function login()
	{
		$this->load->model('User');
		$user = $this->User->login($this->input->post());
		$this->load->model('Book');
		$reviews = $this->Book->show_all();
		$data = array("user" => $user, "reviews" => $reviews);
		$this->load->view('/books/index', $data);
	}

	public function logout()
	{
		$this->session->unset_userdata('id');
    	redirect('/users/index');
	}

	public function profile($id)
	{
		$this->load->model('User');
		$user_data = $this->User->get_profile($id);
		$data = array("data" => $user_data);
		$this->load->view("/users/profile", $data);
	}

}

//end of main controller