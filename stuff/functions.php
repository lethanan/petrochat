<?php
function cleanString($string){
	$string =  preg_replace("/[^A-Za-z0-9 !.&:;, ]/", '',$string);
	return $string;
}
function cleanNumber($string){
	return preg_replace("/[^0-9]/", '',$string);
}