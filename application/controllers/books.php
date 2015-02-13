<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->output->enable_profiler();
	}

	public function index()
	{
		$this->load->model('User');
		$this->load->model('Book');
		$user = $this->User->get_user($this->session->userdata('id'));
		$reviews = $this->Book->show_all();
		$data = array("user" => $user, "reviews" => $reviews);
		$this->load->view('/books/index', $data);
	}

	public function add_view()
	{
		$this->load->model('Book');
		$author_data = $this->Book->get_authors();
		$authors = array("authors" => $author_data);
		$this->load->view('/books/add', $authors);
	}

	public function add()
	{
		$this->load->model('Book');
		$id = $this->Book->add($this->input->post());
		redirect("/books/show/$id");
	}

	public function show($id)
	{
		$this->load->model('Book');
		$reviews = $this->Book->show_book($id);
		$book_data = array("reviews" => $reviews);
		$this->load->view('/books/show', $book_data);
	}

	public function delete($id)
	{
		$this->load->model('Book');
		$book = $this->Book->delete_review($id);
		$id = $book['book_id'];
		redirect("/books/show/$id");
	}
}

//end of main controller