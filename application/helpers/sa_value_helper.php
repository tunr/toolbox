<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Scratchalong Value Helpers
 *
 * @package		Scrcatchalong
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Big Stokes
 * @link		http://www.scratchalong.com
 */

/*--------------------------------------------
  VALIDATE QUERY STRING VALUE IS NUMERIC > 0
---------------------------------------------*/
function ValidateNumericNoZeroQs(&$var, $sub, $red)
{
  $var = (isset($var)) ? $var : '';
  
  if ((strlen($var) > 0) && is_numeric($var))
  {
    $var = abs($var);
  }
  else
  {
    $var = ValidationReturn($red, $sub, $var);
  }
}

/*---------------------------------------
  VALIDATE QUERY STRING VALUE IS NUMERIC
---------------------------------------*/
function ValidateNumeric(&$var, $sub, $red)
{
  $var = (isset($var)) ? $var : '';
  
  if (is_numeric($var))
  {
    $var = abs($var);
  }
  else
  {
    $var = ValidationReturn($red, $sub, $var);
  }
}

/*--------------------------------------------
  VALIDATE QUERY STRING VALUE IS NUMERIC > 0
---------------------------------------------*/
function ValidateStringQs(&$var, $valid_values, $sub, $red)
{
  $var = (isset($var)) ? $var : '';
  
  if ( ! in_array($var, $valid_values))
  {
    $var = ValidationReturn($red, $sub, $var);
  }
}

/*-------------------------------------------------------------
  Validate Checkbox List Values Match DB Values
-------------------------------------------------------------*/
function ValidateCheckboxValues($field_name, $rs_valid_values, $delimiter)
{
  $valid_values      = GetValidValues($rs_valid_values);
  $option_list       = array();
  $serialized_values = '';
  
  if (isset($_POST[$field_name]))
  {
    $option_list = $_POST[$field_name];
    foreach($option_list as $key => $option)
    {
      //echo 'key: ' . $key . ' O:' . $option . ' - ' . is_numeric($option) . '<br>';
      
      if (is_numeric($option) && in_array($option, $valid_values))
      {
        $serialized_values = (0 == strlen($serialized_values)) ? $serialized_values = $option : $serialized_values = $serialized_values . $delimiter . $option;
      }
    }
  }
  return $serialized_values;
}

/*-------------------------------------------------------------
  Get Valid Checkbox List Values From DB Recordset
-------------------------------------------------------------*/
function GetValidValues($rs_values)
{
  $valid_values = array();
  if (0 < count($rs_values))
  {
    foreach($rs_values as $key => $option)
    {
      //print_r($option . '<br>');
      array_push($valid_values, $option['value']);
    }
  }
  return $valid_values;
}

/*---------------------------------------
  DETERMINE VALIDATION RETURN VALUE
---------------------------------------*/
function ValidationReturn($red, $sub, $var)
{
  if ((strlen($sub) > 0) OR is_null($sub)) $var = $sub;
  if (strlen($red) > 0) header('Location: ' . $red);
  return $var;
}

/*-------------------------------------------------------------
  Check for populated file field
-------------------------------------------------------------*/
function file_field($field)
{
  if (isset($_FILES[$field]))
  {
    if ( ! $_FILES[$field]['error'] == 4)
    {
      return TRUE;
    }
  }
  return FALSE;
}

/*-------------------------------------------------------------
  Validate unique identifier
-------------------------------------------------------------*/
function isGuid($guid)
{
  // NEEED TO ADD REGEX FORMAT VALIDATION
  if ( ! empty($guid))
  {
    $guid = str_replace(' ', '', $guid);
    if (32 == strlen($guid))
    {
      return TRUE;
    }
  }
  return FALSE;
}

/*-------------------------------------------------------------
  Format local date
-------------------------------------------------------------*/
function format_date($date)
{
  $ci =& get_instance();
  
  //$datestring = "%M %j, %Y %h:%i";
  $datestring = "%M %j, %Y";
  
  $unix   = mysql_to_unix($date);
  $local  = gmt_to_local($unix, $ci->time_zone, TRUE);
  $format = mdate($datestring, $local);
  
  return $format;
}

/*-------------------------------------------------------------
  Take a dump
-------------------------------------------------------------*/
function dump($data)
{
  echo '<pre class="dump">' . chr(10);
  if (is_array($data))
  {
    print_r($data);
  }
  elseif (is_object($data))
  {
    var_dump($data);
  }
  else
  {
    var_dump($data);
  }
  echo '</pre>' . chr(10);
}
?>