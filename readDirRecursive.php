<?php

/**
 * @author diegossena
 * @param string $path
 * @param int $depth
 * @result array
 */
function readDirRecursive($path = '.', $depth = PHP_INT_MAX)
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
      if ($depth)
        $files = array_merge($files, readDirRecursive($file_path, $depth - 1));
      else
        $files[] = $file_path;
    else if (is_file($file_path))
      $files[] = $file_path;
  }
  closedir($dir);
  return $files;
}
