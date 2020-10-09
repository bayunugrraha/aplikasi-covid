<?php 
/*!
  iPanorama 360 - jQuery Virtual Tour
  @name get-files.php
  @author Max Lawrence 
  @site http://www.avirtum.com
  @copyright (c) 2016 Max Lawrence (http://www.avirtum.com)
*/

// settings
$directory = 'assets/builder/upload';
$result = array();

// list all files in the directory
foreach(glob($directory.'/*.*') as $file) {
	$result[] = array('filename' => basename($file));
}

// give callback to the angular code with the image src name and the status
echo json_encode($result);

?>