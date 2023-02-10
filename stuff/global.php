<?php
require 'settings.php';
require 'functions.php';

// DB Setup

try {
	$db = new PDO(
"mysql:host=".$cfg['DBhost'].";dbname=".$cfg['DBname'], $cfg['DBuser'], $cfg['DBpass'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
}
catch (PDOException $e) {
	echo "Error : " . $e->getMessage() . "<br/>";
	die();
}

// Check for ajax parameter (don't redirect, echo data instead)
$ajax = !empty($_REQUEST['ajax']) && $_REQUEST['ajax'];