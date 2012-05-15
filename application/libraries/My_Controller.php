<?php

class My_Controller extends Controller {

  /*---------------------------------------------------------------------------
    Site Settings
  ---------------------------------------------------------------------------*/
  var $session_timout    = 30;
  var $time_zone         = 'UM8';
  
  /*---------------------------------------------------------------------------
    Page Settings
  ---------------------------------------------------------------------------*/
  var $session_id    = '';
  var $so            = 0;
  
  function My_Controller()
  {
    parent::Controller();
    
    $session_cookie = FALSE; //get_cookie('session');
    
    if ($session_cookie)
    {
      $this->load->library('session');
      $this->session_id = $this->session->userdata('session_id');
      $this->signed_in  = (bool) $this->session->userdata('signed_in');
    }
    
    $data['time_zone'] = $this->time_zone;
    
    $so       = ($_SERVER['HTTP_HOST'] == 'dev') ? 0 : 1;
    $page     = $this->uri->segment(2 - $so);
    $this->so = $so;
    
    $data['page']       = (empty($page)) ? 'home' : $page;
    $data['page_class'] = (empty($page)) ? ' class="home"' : '';
    $data['show_logo']  = (empty($page)) ? FALSE : TRUE;
    
    $this->load->vars($data);
  }
  
}

/* End of file my_controller.php */
/* Location: ./system/application/libraries/my_controller.php */