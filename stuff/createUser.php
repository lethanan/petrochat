<?php
require 'global.php';

// data
$name = cleanString($_REQUEST['newusername']);
$serverid = cleanNumber($_REQUEST['serverid']);
$color = random_int(444444,16777215); // color scheme for text

// Insert
$insert = $db->prepare("
INSERT INTO users(name,serverid,color) VALUES (:name,:serverid,:color);
");

$insert->execute(array(
	'name'=>$name,
	'serverid'=>$serverid,
	'color'=>$color,
));
$newID = $db->lastInsertId();
 

if($ajax){
	// echo
	echo '{"newID":'.$newID.'}';
}
else{
	// redirect
	header('Location: ../chat.php?s='.$serverid);
}