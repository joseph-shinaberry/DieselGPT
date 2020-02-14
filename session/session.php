<?php 
session_start();
$member = $_SESSION['userid'];
$dna_member_data = $database->show_member_data($member);

if(!$_SESSION['userid'] || $_SESSION['token'] == ''){

header("location:index");	
	
}elseif($_SESSION['token'] != $dna_member_data['token'])
{
header("location:index");
}

?>