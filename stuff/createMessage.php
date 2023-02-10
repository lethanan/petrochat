<?php
require 'global.php';

// data
$content = cleanString($_REQUEST['content']);
$userid = cleanString($_REQUEST['userid']);
$serverid = cleanNumber($_REQUEST['serverid']);

// Insert
$insert = $db->prepare("
INSERT INTO messages(content,userid,serverid) VALUES (:content,:userid,:serverid);
");

$insert->execute(array(
	'content'=>$content,
	'userid'=>$userid,
	'serverid'=>$serverid,
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