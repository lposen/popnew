<?php
/**
 * @package WordPress
 * @subpackage Default_Theme

	Template Name: Season of 1000 Promises Exporter

 */

?>

<?php

if (current_user_can("publish_pages")) {
	$api = new PodAPI('season1000', 'csv'); 
	$data = $api->export();
	$data_keys = array_keys($data[0]);
  
	$fp = fopen('s1000export/season1000.csv', 'w', true);
	fputcsv($fp, $data_keys);
	foreach ($data as $line) { 
		fputcsv($fp, $line);
	}
	fclose($fp);
  
	echo "Export complete.<br>\n";
	echo "Open <a href='/s1000export/season1000.csv'>season1000.csv</a><br><br>\n"; //Download link to get the file.
} else {
	echo "You must be an administrator to perform this action.";
}
?>
