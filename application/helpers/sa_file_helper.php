<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Scratchalong File Helpers
 *
 * @package		Scrcatchalong
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Big Stokes
 * @link		http://www.scratchalong.com
 */

// --------------------------------------------------------------------

/**
 * Remove all but specified files
 *
 * This is a helper function that removes all files from
 * a folder except the keep_file and it's thumb. This
 * function lets us deal with a keep_ile with multiple
 * periods, like: my.cool.jpg
 *
 * @access public
 * @param	string directory
 * @param	array files to keep
 * @param	bool
 * @return array
 */
function clean_dir($dir, $keep_files, $del_dir = FALSE)
{
  if ( ! $dir = @realpath($dir))
    return;
  
  if ( ! $dh = @opendir($dir))
    return;
  
  while (false !== ($obj = readdir($dh)))
  {
    if ($obj == '.' OR $obj == '..')
      continue;
    
    if ( ! in_array($obj, $keep_files))
    {
      @unlink($dir . '\\' . $obj);
    }
  }
  
  closedir($dh);
  
  if ($del_dir)
  {
    @rmdir($dir);
  }
  
  return;
}

?>