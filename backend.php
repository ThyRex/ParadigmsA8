<?php
$incoming = file_get_contents('php://input');
// If incoming is an option selected, then use it as the
// goto directory
if($incoming != null) {
	$cur_dir = $incoming;
}
else{
	// otherwise, the current directory is whereever
	// we're working in
	// This means we've just opened the page
	$cur_dir = getcwd();
}


// Code from Gashler
$ob = new stdClass();
$ob->dir = $cur_dir;
// Code from forum
$ob->files = array_filter(glob($cur_dir . "/*"), 'is_file');
$ob->folders = glob($cur_dir . "/*", GLOB_ONLYDIR);

header('Content-Type: application/json');
print(json_encode($ob));
?>
