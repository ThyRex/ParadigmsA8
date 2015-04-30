<?php
$incoming = file_get_contents('php://input');

if($incoming != null) {
	$useThis = $incoming;
}
if(isset($useThis)) {
	$cur_dir = $useThis;
}
else
	$cur_dir = getcwd();

$ob2 = new stdClass();
$ob2->dir = $cur_dir;
$ob2->folders = glob($cur_dir . "/*", GLOB_ONLYDIR);
$ob2->files = array_values(array_diff(glob($cur_dir . "/*"),glob($cur_dir . "/*", GLOB_ONLYDIR)));

header('Content-Type: application/json');
print(json_encode($ob2));
?>
