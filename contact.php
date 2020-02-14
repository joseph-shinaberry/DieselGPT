<?php
require("db/datenbank.php"); 
$database	= new Database(); 
include("session/session.php");

$dna_member_stats = $database->show_member_stats($member);
$getsytle = $database->getstyle(); 
?>
<!DOCTYPE html> 
<html>
<head>
<title>Home/Dashboard | <?=$getsytle['title']?></title>
<link href="css/style.php" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="border">
	<div id="content_center">
	<? include 'includes/header.php';?>
	<div id="menu">
	<a href="dashboard" id="button" title="Dashboard" ><p>DASHBOARD</p></a>
	<a href="offers" id="button" title="Offers"><p>OFFERS</p></a>
	<a href="completed_offers" id="button" title="Completed Offers"><p>COMPLETED OFFERS</p></a>
	<a href="rewards" id="button" title="Payments & Rewards"><p>PAYMENTS & REWARDS</p></a>
	<a href="account" id="button" title="Account Info"><p>ACCOUNT INFO</p></a>
	<a href="contact" id="button_active" title="Contact"><p>CONTACT</p></a>
	</div>
	<div id="contact_top_bar">
	<div id="contact_header"></div>
	</div>
	<div id="contact_box">
	<div id="contact_box_inside">
	<div id="contact_left_text">Username</div>
	<div id="contact_right_text"><?=$dna_member_data['username']?></div>
	<div id="clear_space"></div>
	<div id="contact_left_text">Subject</div>
	<input type="text" name="subject">
	<div id="clear_space"></div>
	<div id="contact_left_text">Message</div>
	<textarea name="message"></textarea>
		<div id="clear_space"></div>
	<input type="submit" value="" id="send_message" /></div>
	<div id="clear_space"></div></div>
	</div>

	<div id="footer"><div id="footer_text"><?=$getsytle['footer_text']?></div></div>
	</div>
	</div>
	

</body>
</html>
