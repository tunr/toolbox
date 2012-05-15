<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact extends My_Controller {
  
  function __construct() {
    parent::My_Controller();
  }

  // --------------------------------------------------------------------

	/**
	 * Contact
	 */
  function index() {
    $this->load->helper('form', 'sa_form');
    $this->load->library('form_validation');
    
    $form_errors   = '';
    $first_name    = '';
    $last_name     = '';
    $email         = '';
    $book_show     = '';
    $exhibit_art   = '';
    $produce_merch = '';
    
    $this->form_validation->set_rules('first_name', 'Screen Name', 'trim|required|max_length[20]'); //xss_clean
    $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|max_length[20]'); //xss_clean
    $this->form_validation->set_rules('email', 'E-Mail', 'trim|required|valid_email|max_length[100]');
    
    if (TRUE == $this->form_validation->run())
    {
      $first_name  = $this->input->post('first_name');
      $last_name   = $this->input->post('last_name');
      $email       = $this->input->post('email');
      
      // SEND MAIL CHIMP EMAIL
      
      // DISPLAY CONFIRMATION MESSAGE
      
      //if (empty($form_errors)) redirect('/member/');
    }
    else
    {
      $form_errors = validation_errors();
    }
    
    $data['form_errors']   = $form_errors;
    $data['first_name']    = $first_name;
    $data['last_name']     = $last_name;
    $data['email']         = $email;
    
    $data['book_show']     = $book_show;
    $data['exhibit_art']   = $exhibit_art;
    $data['produce_merch'] = $produce_merch;
    
    
    $this->load->view('contact', $data);
  }

}

/* End of file contact.php */
/* Location: ./system/application/controllers/contact.php */