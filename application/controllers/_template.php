<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matrix extends My_Controller {
  
  function __construct() {
    parent::My_Controller();
  }
  
  function index() {
    $this->load->helper('date');
    $this->load->model('loop_model', '', TRUE);
    
    
    $data['sidebar'] = ''; //$this->load->view('member_toolbar.php', '', TRUE);
    $data['main']    = 'Main';
    $data['sidecol'] = ''; //$this->load->view('member_toolbar.php', '', TRUE);
    
    //$this->load->vars($data);
    $this->load->view('template', $data);
  }
}

/* End of file matrix.php */
/* Location: ./system/application/libraries/matrix.php */