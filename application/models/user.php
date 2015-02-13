<?php 

class User extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
    date_default_timezone_set('America/Los_Angeles');
  }

  public function registration($post)
  {
    // echo "here";
    $this->load->library('form_validation');
    $this->form_validation->set_rules('name', 'Name', 'required');
    $this->form_validation->set_rules('alias', 'Alias', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
    $this->form_validation->set_rules('confirm_password', 'Confirm PW', 'matches[password]');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('registration_error', validation_errors());
      redirect('/users/index');
    }
    else
    {
      $test = $this->db->query("SELECT * FROM users WHERE email = ?", array($post['email']))->row_array();
      if (count($test) > 0)
      {
        $this->session->set_flashdata('registration_error', "Email is already registered!");
        redirect('/users/index');
      }
      else
      {
        $query = "INSERT INTO users (name, alias, email, password, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)";
        $values = array($post['name'], $post['alias'], $post['email'], md5($post['password']), "NOW()", "NOW()");
        $this->db->query($query, $values);
        $this->session->set_userdata('id', $this->db->insert_id());
      }
    }
  }

  public function login($post)
  {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
    $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

    if ($this->form_validation->run() == FALSE)
    {
      $this->session->set_flashdata('login_error', validation_errors());
      redirect('/users/index');
    }   
    else
    {
      $query = "SELECT * FROM users WHERE email = ? AND password = ?";
      $values = array($post['email'], md5($post['password']));
      $user_data = $this->db->query($query, $values)->row_array();
      if (count($user_data) > 0)
      {
        $this->session->set_userdata('id', $user_data['id']);
        return $user_data;
      }
    }
  }

  public function get_user($id)
  {
    $query = "SELECT * FROM users WHERE id = ?";
    $values = array($this->session->userdata('id'));
    return $this->db->query($query, $values)->row_array();
  }

  public function get_profile($id)
  {
    $query = "SELECT books.id, books.title, users.name, users.alias, users.email FROM users LEFT JOIN reviews ON users.id = reviews.user_id LEFT JOIN books ON reviews.book_id = books.id WHERE users.id = ?";
    $values = array($id);
    return $this->db->query($query, $values)->result_array();
  }
}

?>