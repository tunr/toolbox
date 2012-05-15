<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends My_Controller {
  
  function __construct() {
    parent::My_Controller();
  }

  // --------------------------------------------------------------------

	/**
	 * Homepage
	 */
  function index() {
    
    $reset     = ($this->uri->segment(2 - $this->so) == 'reset') ? TRUE : FALSE;
    $sort      = ($this->uri->segment(2 - $this->so) == 'sort') ? TRUE : FALSE;
    $tool_list = $this->config->item('tools');
    $toolbox_show_list = '';
    $toolbox_hide_list = '';
    $toolbox_menu_list = '';
    $show_cookie = '';
    $hide_cookie = '';
    $menu_cookie = '';
    $hide = '';
    
    if ($reset)
    {
      delete_cookie('show');
      delete_cookie('hide');
      delete_cookie('menu');
    }
    else
    {
      $show_cookie = get_cookie('show');
      $hide_cookie = get_cookie('hide');
      $menu_cookie = get_cookie('menu');
    }
    
    $show_list   = (strlen($show_cookie)) ? explode('_', $show_cookie) : '';
    $hide_list   = (strlen($show_cookie)) ? explode('_', $hide_cookie) : '';
    $menu_list   = (strlen($menu_cookie)) ? explode('_', $menu_cookie) : '';
    
    // Validate # of cookie tools match # of tools
    
    if (empty($show_list) && empty($hide_list))
    {
      // BUILD DEFAULT TOOL LIST
      if ( ! empty($tool_list))
      {
        foreach ($tool_list as $key => $row)
        {
          $toolbox_show_list[$key] = $row;
        }
      }
    }
    else
    {
      // BUILD COOKIE SHOW LIST
      if ( ! empty($show_list))
      {
        foreach ($show_list as $key => $row)
        {
          $tool_id = $show_list[$key];
          if ( ! empty($tool_id)) $toolbox_show_list[$key] = $tool_list[$tool_id];
        }
      }
      
      // BUILD COOKIE HIDE LIST
      if ( ! empty($hide_list))
      {
        foreach ($hide_list as $key => $row)
        {
          $tool_id = $hide_list[$key];
          if ( ! empty($tool_id)) $toolbox_hide_list[$key] = $tool_list[$tool_id];
        }
      }
    }
    
    // BUILD COOKIE MENU LIST
    if ( ! empty($menu_list))
    {
      foreach ($menu_list as $key => $row)
      {
        $tool_id = $menu_list[$key];
        if ( ! empty($tool_id)) $toolbox_menu_list[$key] = $tool_list[$tool_id];
      }
    }
    
    
    $layout_link = ($sort) ? '<a href="' . base_url() . '">Disable Layout Mode</a>' : '<a href="' . base_url() . 'sort/">Enable Layout Mode</a>';
    
    $data['layout_link']       = $layout_link;
    $data['layout_mode']       = $sort;
    $data['tool_list']         = $tool_list;
    $data['toolbox_show_list'] = $toolbox_show_list;
    $data['toolbox_hide_list'] = $toolbox_hide_list;
    $data['toolbox_menu_list'] = $toolbox_menu_list;
    
    $this->load->view('home', $data);
  }

  // --------------------------------------------------------------------

	/**
	 * Order
	 */
  function tool_sort() {
    $show   = $this->input->post('show');
    $hide   = $this->input->post('hide');
    $show   = (is_array($show)) ? implode($show, '_') : '';
    $hide   = (is_array($hide)) ? implode($hide, '_') : '';
    $expire = time() + ($this->session_timout * 60 * 60 * 24 * 14);
    
    // May want to validate tool ids
    
    set_cookie('show', $show, $expire, '', '/', '');
    set_cookie('hide', $hide, $expire, '', '/', '');
    
    dump('SHOW: ' . $show);
    dump('HIDE: ' . $hide);
  }

  // --------------------------------------------------------------------

	/**
	 * Menu Set
	 */
  function menu_set() {
    $menu   = $this->input->post('menu');
    $menu   = (is_array($menu)) ? implode($menu, '_') : '';
    $expire = time() + ($this->session_timout * 60 * 60 * 24 * 14);
    
    // May want to validate tool ids
    
    set_cookie('menu', $menu, $expire, '', '/', '');
    
    dump('MENU: ' . $menu);
  }

  // --------------------------------------------------------------------

	/**
	 * Reset Toolbox
	 */
  function reset_toolbox() {
    
    delete_cookie('show');
    delete_cookie('hide');
    delete_cookie('menu');
    
    
  }

  // --------------------------------------------------------------------

	/**
	 * YMP
	 */
  function ymp() {
    $data = '';
    
    $this->load->view('ymp', $data);
    
  }
  
}

/* End of file home.php */
/* Location: ./system/application/controllers/home.php */