<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Scratchalong Form Helpers
 *
 * @package		Scrcatchalong
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Big Stokes
 * @link		http://www.scratchalong.com
 */

/*-------------------------------------------------------------
  Form element wrapper block
-------------------------------------------------------------*/
function sa_form_elem_open($class = 'item')
{
  return '<div class="' . $class . '">' . chr(10);
}

function sa_form_elem_close()
{
  return '</div>' . chr(10);
}

/*-------------------------------------------------------------
  Form element attribute defaults
-------------------------------------------------------------*/
function sa_form_elem_default(&$data)
{
  $data['id']       = $data['name'];
  $data['tabindex'] = 9;
}

/*-------------------------------------------------------------
  Form element label
-------------------------------------------------------------*/
function sa_form_label(&$data, $attributes = array())
{
  $element = '';
  if (isset($data['label']))
  {
    $label = $data['label'];
    $name  = (isset($data['name'])) ? $data['name'] : '' ;
    $element .= form_label($label, $name, $attributes) . chr(10);
    unset($data['label']);
  }
  return $element;
}

/*-------------------------------------------------------------
  Form element required
-------------------------------------------------------------*/
function sa_form_required(&$data)
{
  $element  = (isset($data['required'])) ? ' <span class="star">*</span>' : '';
  unset($data['required']);
  return $element;
}

/*-------------------------------------------------------------
  Form element post text
-------------------------------------------------------------*/
function sa_form_post_text(&$data)
{
  $element = (isset($data['post_text'])) ? ' <span style=" text-align: bottom; ">' . $post_text . '</span>' . chr(10) : '';
  unset($data['post_text']);
  return $element;
}

/*-------------------------------------------------------------
  Textbox form element display
-------------------------------------------------------------*/
function sa_form_input($data)
{
  sa_form_elem_default($data);
  
  $rows = isset($data['rows']) ? TRUE : FALSE;
  $data['class'] = 'field '; // . $data['class']; - May need ability to append a class
  
  $element  = sa_form_elem_open();
  $element .= sa_form_label($data);
  $element .= sa_form_required($data);
  $element .= (($rows) ? form_textarea($data) : form_input($data)) . chr(10);
  $element .= sa_form_post_text($data);
  $element .= sa_form_elem_close();
  
  return $element;
}

/*-------------------------------------------------------------
  Password form element display
-------------------------------------------------------------*/
function sa_form_password($data)
{
  $data['type'] = 'password';
  return sa_form_input($data);
}

/*-------------------------------------------------------------
  Password form element display
-------------------------------------------------------------*/
function sa_form_upload($data)
{
  $data['type'] = 'file';
  return sa_form_input($data);
}

/*-------------------------------------------------------------
  Select box form element display
-------------------------------------------------------------*/

function sa_form_dropdown($data, $options, $selected, $default_option = '', $default_value = '')
{
  $name             = $data['name'];
  $data['tabindex'] = 9;
  $select_option    = '';
  
  $element  = sa_form_elem_open();
  $element .= sa_form_label($data);
  $element .= sa_form_required($data) . chr(10);
  
  $element .= '<select id="' . $name . '" name="' . $name . '" tabindex="9" class="select">' . chr(10);
  if ( ! empty($default_option)) echo '<option value="' . $default_value . '">' . $default_option . '</option>' . chr(10);
  if ( ! empty($options))
  {
    foreach($options as $key => $option)
    {
      $option_name  = $option['name'];
      $option_value = $option['value'];
    	if ((string)($option_value) == (string)($selected)) $select_option = ' selected="selected"';
    	$element .= '<option value="' . $option_value . '"' . $select_option . '>' . $option_name . '</option>' . chr(10);
    	$select_option = '';
    }
  }
  $element .= '</select>' . chr(10);
  $element .= sa_form_post_text($data) . chr(10);
  $element .= sa_form_elem_close();
  return $element;
}

/*-------------------------------------------------------------
  Validate form element is numeric
-------------------------------------------------------------*/

function sa_form_checkbox_raw($data, $ext)
{
  $element = form_checkbox($data, '', TRUE, $ext) . chr(10);
  
  return $element;
}

function sa_form_checkbox($data, $ext)
{
  sa_form_elem_default($data);
  
  $data['class'] = 'checkbox';
  
  $element  = sa_form_elem_open();
  $element .= form_checkbox($data, '', TRUE, $ext) . chr(10);
  $element .= sa_form_label($data, array('class'=>'check_label'));
  $element .= sa_form_elem_close();
  
  return $element;
}

/*-------------------------------------------------------------
  Validate form element is numeric
-------------------------------------------------------------*/
function sa_form_tag_checklist($data, $option_list, $checked_list)
{
  $check_state = '';
  
  $output  = '<div id="form_tag_box">' . chr(10);
  $output .= sa_form_label($data);
  $output .= sa_form_required($data) . chr(10);
  $output .= '<ul>' . chr(13);
  
  if (0 < count($option_list))
  {
    foreach($option_list as $key => $option)
    {
      $option_name  = $option['name'];
      $option_value = $option['value'];
      if ( ! empty($checked_list))
      {
        $check_state = (0 < substr_count($checked_list, $option_value)) ? ' checked="checked"' : '';
      }
      $output .= '<li><label><input type="checkbox" name="' . $data['name'] . '[]" value="' . $option_value . '"' . $check_state . ' class="checkbox"> ' . $option_name . '</label></li>';
    }
  }
  $output .= '</ul>' . chr(10);
  $output .= '<div class="clear"></div>' . chr(10);
  //$output .= '<div class="field_post_text">' . $data['post_text'] . '</div>'. chr(10);
  $output .= '</div>' . chr(10);
  
  return $output;
}

/*-------------------------------------------------------------
  Display form errors
-------------------------------------------------------------*/
/*
function sa_form_button_bar($button, $cancel)
{
  echo '<table border=0 cellpadding=0 cellspacing=0 class="submitbox">';
  echo '<tr>';
  foreach($button as $key => $value)
  {
    echo '<td align="left"><input type="submit" id="Submit" name="Submit" value="' . $value . '" tabindex=200 class="submit">&nbsp;</td>';
  }
  
  if (is_array($cancel))
  {
    echo '<td align="left"><a href="' . $cancel[1] . '">' . $cancel[0] . '</a></td>';
  }
  echo '</tr>';
  echo '</table>';
  //echo '<input type="hidden" name="enter" value="enter">';
}
*/

/*-------------------------------------------------------------
  Display form errors
-------------------------------------------------------------*/
function sa_form_errors($form_errors, $header = NULL)
{
  $output = '';
  if ( ! empty($form_errors))
  {
    $output .= '<div id="form_errors">' . chr(10);
    $output .= ( ! empty($header)) ? '<h5>' . $header . '</h5>' : '';
    $output .= $form_errors . chr(10);
    $output .= '</div>' . chr(10);
  }
  return $output;
}

/*-------------------------------------------------------------
  Validate URL
-------------------------------------------------------------*/
function valid_url($str)
{
  //return ( ! preg_match('/^(http|https|ftp):\/\/([a-z0-9][a-z0-9_-]*(?:\.[a-z0-9][a-z0-9_-]*)+):?(\d+)?\/?/i', $str)) ? FALSE : TRUE;
  //return ( ! preg_match('/^(http|https|ftp):\/\/([a-z0-9][a-z0-9_-]*(?:\.[a-z0-9][a-z0-9_-]*)+):?(\d+)?\/?/i', $str)) ? FALSE : TRUE;
  return ( ! preg_match('/^(https?:\/\/)?[a-z0-9]+([-.]{1}[a-z0-9]+)*\.[a-z]{2,5}(([0-9]{1,5})?\/.*)?$/ix', $str)) ? FALSE : TRUE;
}

?>