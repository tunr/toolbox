<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Brief {
  
  var $brief_cookie_name    = 'brief';
  var $brief_expiration			= 7200;
	var $cookie_prefix				= '';
	var $cookie_path				  = '/';
	var $cookie_domain				= '';
  var $brief_lib     	      = array();
  
	/**
	 * Brief Constructor
	 *
	 * The constructor loads the brief library automatically
	 */
	function __construct($params = array())
	{
		//log_message('debug', "Brief Class Initialized");
    
    // Set the super object to a local variable for use throughout the class
		$this->CI =& get_instance();
    
    $this->brief_lib = $this->CI->config->item('brief_lib');
	}

	// ------------------------------------------------------------------------

	/**
	 * Add or change briefdata.
	 *
	 * @access	public
	 * @param	mixed
	 * @param	string
	 * @return	void
	 */
	function set_briefdata($newdata = array(), $newval = '')
	{
    // Value passed as string name/value pair
		if (is_string($newdata))
		{
			$newdata = array($newdata => $newval);
		}
    
		if ( ! empty($newdata))
		{
			foreach ($newdata as $key => $val)
			{
    		setcookie(
					$this->brief_cookie_name . '[' . $key . ']',
					TRUE,
					$this->brief_expiration + time(),
					$this->cookie_path,
					$this->cookie_domain,
					0
				);
			}
		}
	}

	// ------------------------------------------------------------------------

	/**
	 * Fetch a specific briefdata item from the brief array
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function briefdata($key, $keep = FALSE)
	{
    $cookie = get_cookie($this->brief_cookie_name);
    
    $brief_value = '';
    
    if ($cookie)
    {
  		if (array_key_exists($key, $cookie) && array_key_exists($key, $this->brief_lib))
      {
        //echo $this->brief_lib[$key] . '<br>';
        
        $brief_value = '<p>' . $this->brief_lib[$key] . '</p>';
      }
      
      if ( ! $keep)
      {
        delete_cookie($this->brief_cookie_name . '[' . $key . ']');
      }
    }
    return $brief_value;
	}

	// ------------------------------------------------------------------------

	/**
	 * Unset a specific briefdata item from the brief array
	 *
	 * @access	public
	 * @param	string
	 * @return	string
	 */
	function unset_briefdata($key)
	{
    delete_cookie($this->brief_cookie_name . '[' . $key . ']');
    return TRUE;
	}

	// --------------------------------------------------------------------

	/**
	 * Destroy the current session
	 *
	 * @access	public
	 * @return	void
	 */
	function brief_destroy()
	{
		// Kill the cookie
		setcookie(
			$this->brief_cookie_name,
			'',
			($this->now - 31500000),
			$this->cookie_path,
			$this->cookie_domain,
			0
		);
	}

}
// END Brief Class

/* End of file Brief.php */
/* Location: ./system/libraries/Brief.php */
