<?php
$incoming = file_get_contents('php://input');
// echo $incoming ."<br>";
if($incoming != null) {
	$useThis = $incoming;
}
if(isset($useThis)){
	$cur_dir = $useThis;
}
else{
	$cur_dir = getcwd();
}

// echo $cur_dir . "<br>";
// chdir($cur_dir . "/assignment7");
// $cur_dir = getcwd();
// echo $cur_dir;
$ob2 = new stdClass();
$ob2->dir = $cur_dir;
$ob2->folders = glob($cur_dir . "/*", GLOB_ONLYDIR);
$ob2->files = array_filter(glob($cur_dir . "/*"), 'is_file');

header('Content-Type: application/json');
// $ob3 = json_encode($ob2);
// echo $ob3 ."<br>";
print(json_encode($ob2));
?>
