<?php

/**
 * @author diegossena
 * @param string $path
 * @result array
 */
function readDirRecursive($path = '.')
{
  $files = array();
  if (($dir = opendir($path)) === false)
    return $files;
  $last_letter  = $path[strlen($path) - 1];
  $path =  ($last_letter == '\\' || $last_letter == '/')
    ? $path
    : $path . DIRECTORY_SEPARATOR;

  while (false !== ($file_name = readdir($dir))) {
    if ($file_name === '.' || $file_name === '..')
      continue;
    $file_path  = $path . $file_name;
    if (is_dir($file_path))
      $files = array_merge($files, readDirRecursive($file_path));
    else if (is_file($file_path))
      $files[] = $file_path;
  }
  closedir($dir);
  return $files;
}
