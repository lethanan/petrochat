<?php
require 'global.php';

// Generate Server Identity (cosmetic)
$name = random_int(23,9999); // random cosmetic "ID"
$color = random_int(0,222222); // color scheme for background

// Insert Server (gets new cosmetic name from sponsor table)
$insert = $db->prepare("
INSERT INTO servers(number, title, color) VALUES (:number,(SELECT name FROM titles WHERE used=0 LIMIT 1),:color);
UPDATE titles SET used = 1 WHERE used = 0 LIMIT 1;
");

$insert->execute(array(
	'number'=>$name,
	'color'=>$color,
));
$newID = $db->lastInsertId();
 

if($ajax){
	// echo
	echo '{"newID":'.$newID.'}';
}
else{
	// redirect
	header('Location: ../chat.php?s='.$newID);
}