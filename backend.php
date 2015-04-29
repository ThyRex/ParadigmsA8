<?php
$incoming = file_get_contents('php://input');
if($incoming != null) {
	$_POST['dir'] = json_decode($incoming);
	$useThis = $_POST['dir'];
}
	
if(isset($_POST['dir'])) {
	$cur_dir = $useThis->dir;
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
