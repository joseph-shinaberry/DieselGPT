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
	<a href="dashboard" id="button_active" title="Dashboard" ><p>DASHBOARD</p></a>
	<a href="offers" id="button" title="Offers"><p>OFFERS</p></a>
	<a href="completed_offers" id="button" title="Completed Offers"><p>COMPLETED OFFERS</p></a>
	<a href="rewards" id="button" title="Payments & Rewards"><p>PAYMENTS & REWARDS</p></a>
	<a href="account" id="button" title="Account Info"><p>ACCOUNT INFO</p></a>
	<a href="contact" id="button" title="Contact"><p>CONTACT</p></a>
	</div>
	<div id="stats">
	<div id="stat_header" ></div>
	<div id="stat_container">
	<ul>
		<li>$<?=$dna_member_stats['pending_balance']?><span class="stat_define">PENDING DEPOSIT</span></li>
		<li>$<?=$dna_member_stats['available_balance']?><span class="stat_define">AVAILABLE BALANCE</span></li>
		<li><?=$dna_member_stats['mtd_completed_offers']?><span class="stat_define">MTD COMPLETED OFFERS</span></li>
		<li><?=$dna_member_stats['ytd_completed_offers']?><span class="stat_define">YTD COMPLETED OFFERS</span></li>
	</ul>
	</div>
	</div>

	<div id="news">
	<div id="news_header" ></div>
	<div id="news_container">
	
	<?
	$i = 0;
	$articlenum = 1;
	$getnews		=	$database->show_all_news('','');
	$newscount		=	count($getnews); 
	for($i=0;$i<$newscount;$i++) {
	$news_data	= $database->show_news_details($articlenum);
	$date				= stripslashes($news_data['news_date']);
	$headline			= stripslashes($news_data['headline']);
	$article			= stripslashes($news_data['article']);
	$articlenum++;
	
	?>	
	<p id="news_headline"><?=$date?>  <?=$headline?></p>
	<p id="article"><?=$article?></p> <?}?>
	
	
	
	
	</div>
	</div>

	<div id="wallet">
	<div id="wallet_header" ></div>
	<div id="wallet_container">
	<div id="wallet_title">
	<ul>
		<li>MONTH</li>
		<li>AMOUNT</li>
		<li>STATUS</li>
	</ul>
	</div>
	<div id="wallet_amounts">
	<?
	$dna_user_wallet 	= 	$database->showall_user_wallet($member);
	$walletcount		=	count($dna_user_wallet); 
	?>	
	<?$i = 0;
	for($i=0;$i<$walletcount;$i++) {?>
	<ul>
		<li><?=$dna_user_wallet[$i]['wallet_month']?></li>
		<li>$<?=$dna_user_wallet[$i]['balance']?></li>
		<li><?if($dna_user_wallet[$i]['status'] == 'P'){echo 'Deposit Pending';}?>
			<?if($dna_user_wallet[$i]['status'] == 'D'){echo 'Deposited To Balance';}?>
			<?if($dna_user_wallet[$i]['status'] == 'R'){echo 'Rejected (Not Deposited)';}?>
		</li>
	</ul><?}?>
	
	</div>
	</div>
	</div>
	<br>
	<div id="footer"><div id="footer_text"><?=$getsytle['footer_text']?></div>
	</div>
	</div>
</body>
</html>
