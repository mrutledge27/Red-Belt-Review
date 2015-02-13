<?php 

class Book extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('America/Los_Angeles');
  }

  public function add($post)
  {

    if (isset($post['new_author']))
    {

      $query = "INSERT INTO authors (name, created_at, updated_at) VALUES (?, ?, ?)";
      $values = array($post['new_author'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
      $this->db->query($query, $values);

      $query = "INSERT INTO books (title, author_id, created_at, updated_at) VALUES (?, ?, ?, ?)";
      $values = array($post['title'], $this->db->insert_id(), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
      $this->db->query($query, $values);

      $query = "INSERT INTO reviews (rating, content, user_id, book_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
      $values = array($post['rating'], $post['content'], $this->session->userdata('id'), $this->db->insert_id(), date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
      $this->db->query($query, $values);
    }
    else
    {
      $query = "SELECT books.id AS id FROM books JOIN authors ON authors.id = books.author_id WHERE title = ? AND authors.name = ?";
      $values = array($post['title'], $post['author']);
      $book_id = $this->db->query($query, $values)->row_array();
      if (count($book_id) > 0)
      {
        $query = "INSERT INTO reviews (rating, content, user_id, book_id, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
        $values = array($post['rating'], $post['content'], $this->session->userdata('id'), $book_id['id'], date("Y-m-d H:i:s"), date("Y-m-d H:i:s"));
        $this->db->query($query, $values);
      }
      // echo $book_id['id'];
      // var_dump($book_id);
      // die();
      return $book_id['id'];
    }
  }

  public function show_book($id)
  {
    $query = "SELECT books.id, books.title, authors.name FROM books JOIN authors ON books.author_id = authors.id WHERE books.id = ?";
    $values = array($id);
    $book_info = $this->db->query($query, $values)->row_array();

    $query = "SELECT reviews.id AS review_id, reviews.rating, reviews.content, reviews.created_at, users.id, users.name FROM reviews JOIN users ON reviews.user_id = users.id WHERE book_id = ?";
    $values = array($id);
    $reviews = $this->db->query($query, $values)->result_array();

    return array($book_info, $reviews);
  }

  public function delete_review($id)
  {
    $query = "SELECT book_id FROM reviews WHERE reviews.id = ?";
    $values = array($id);
    $book_id = $this->db->query($query, $values)->row_array();

    $query = "DELETE FROM reviews WHERE reviews.id = ?";
    $values = array($id);
    $this->db->query($query, $values);

    return $book_id;
  }

  public function show_all()
  {
    return $this->db->query("SELECT books.title, books.id AS book_id, reviews.rating, reviews.content, reviews.created_at, users.id AS user_id, users.name FROM users LEFT JOIN reviews ON users.id = reviews.user_id LEFT JOIN books ON reviews.book_id = books.id ORDER BY created_at DESC")->result_array();
  }

  public function get_authors()
  {
    return $this->db->query("SELECT * FROM authors")->result_array();
  }


}

?>