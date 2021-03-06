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
	<a href="completed_offers" id="button_active" title="Completed Offers"><p>COMPLETED OFFERS</p></a>
	<a href="rewards" id="button" title="Payments & Rewards"><p>PAYMENTS & REWARDS</p></a>
	<a href="account" id="button" title="Account Info"><p>ACCOUNT INFO</p></a>
	<a href="contact" id="button" title="Contact"><p>CONTACT</p></a>
	</div>
	<div id="offer_top_bar">
	<div id="completed_header"></div>
	<div id="offer_dropdown">
	<div class="sort-select">
	<form name="sortby" method="GET" action="completed_offers"><select name="sortby">
      <option value="null">SORT BY</option>
	  <option value="status">STATUS</option>
      <option value="action">ACTION REQUIRED</option>
	  <option value="amountup">AMOUNT - ASCENDING</option>
	  <option value="amountdown">AMOUNT - DESCENDING</option>
	  <option value="ratingup">RATING - ASCENDING</option>
	  <option value="ratingdown">RATING - DESCENDING</option>
	  <option value="reporting">REPORTING</option>
   </select>
	</div>
	 <input type="submit" class="submit_sort" value=""></form>  
	</div>
	</div>

	
	<?
	if($_GET['sortby'] == 'action'){$sortby = 'action';}
	elseif($_GET['sortby'] == 'amountup'){$sortby = 'payout ASC';}
	elseif($_GET['sortby'] == 'amountdown'){$sortby = 'payout DESC';}
	elseif($_GET['sortby'] == 'ratingup'){$sortby = 'rating ASC';}
	elseif($_GET['sortby'] == 'ratingdown'){$sortby = 'rating DESC';}
	elseif($_GET['sortby'] == 'reporting'){$sortby = 'reporting';}
	elseif($_GET['sortby'] == 'status'){$sortby = 'approval_status DESC';}
	else{$sortby = 'reporting';}
	
	if($page  == '1' || empty($page)){$la = 0; $lb = 10;}
	elseif($page  == '2'){$la = 11; $lb = 20;}
	elseif($page  == '3'){$la = 21; $lb = 30;}
	elseif($page  == '4'){$la = 31; $lb = 40;}
	elseif($page  == '5'){$la = 41; $lb = 50;}
	elseif($page  == '6'){$la = 51; $lb = 60;}
	elseif($page  == '7'){$la = 61; $lb = 70;}
	elseif($page  == '8'){$la = 71; $lb = 80;}
	elseif($page  == '9'){$la = 81; $lb = 90;}
	elseif($page  == '10'){$la = 91; $lb = 100;}
	
	$showcompletedoffers 	= 	$database->show_completed_offers($member,$sortby,$la,$lb);
	$offercount		=	count($showcompletedoffers); 
	?>	
	<?$i = 0;
	for($i=0;$i<$offercount;$i++) {?>	
	<div id="offer">
	<div id="offer_title"><?=$showcompletedoffers[$i]['title']?></div>
	<div id="offer_box_left">
	<div id="approved"></div>
	<img src="images/no_image.png">
	<div id="rating"><p>OFFER RATING</p>
	<?	if($showcompletedoffers[$i]['rating'] == 0.5){?><div id="half_star"></div><?}?>
	<?	if($showcompletedoffers[$i]['rating'] == 1.0){?><div id="star"></div><?}?>
	<?	if($showcompletedoffers[$i]['rating'] == 1.5){?><div id="star"></div><div id="half_star"></div><?}?>
	<?	if($showcompletedoffers[$i]['rating'] == 2.0){?><div id="star"></div><div id="star"></div><?}?>
	<?	if($showcompletedoffers[$i]['rating'] == 2.5){?><div id="star"></div><div id="star"></div><div id="half_star"></div><?}?>
	<?	if($showcompletedoffers[$i]['rating'] == 3.0){?><div id="star"></div><div id="star"></div><div id="star"></div><?}?>
	<?	if($showcompletedoffers[$i]['rating'] == 3.5){?><div id="star"></div><div id="star"></div><div id="star"></div><div id="half_star"></div><?}?>
	<?	if($showcompletedoffers[$i]['rating'] == 4.0){?><div id="star"></div><div id="star"></div><div id="star"></div><div id="star"></div><?}?>
	<?	if($showcompletedoffers[$i]['rating'] == 4.5){?><div id="star"></div><div id="star"></div><div id="star"></div><div id="star"></div><div id="half_star"></div><?}?>
	<?	if($showcompletedoffers[$i]['rating'] == 5.0){?><div id="star"></div><div id="star"></div><div id="star"></div><div id="star"></div><div id="star"></div><?}?>
	</div>
	</div>
	<div id="offer_box_right">
	<ul>
		<li>Payout:<span class="offer_defined">$<?=$showcompletedoffers[$i]['payout']?></span></li>
		<li>Status:<span class="offer_defined">
		<?if($showcompletedoffers[$i]['approval_status'] == 'P'){echo "Pending Approval";} ?>
		<?if($showcompletedoffers[$i]['approval_status'] == 'A'){echo "Approved";} ?>
		<?if($showcompletedoffers[$i]['approval_status'] == 'D'){echo "Declined";} ?>
		</span></li>
		<li>Action Required:<span class="offer_defined"><?=$showcompletedoffers[$i]['action']?></span></li>
	</ul>
	<p id="offer_details">Offer Details:</p>
	<p id="details"><?=$showcompletedoffers[$i]['details']?></p>
	</div>
	</div>
	
	<?}if($offercount >10){?>
	<div id="page_nav">
	<? if(@$page > 1){?><a href="offers.php?page=<?=@$_GET['page']-1?>&sortby=<?=$_GET['sortby']?>" id="back_button"></a><?}?>
	<a href="offers.php?page=<?=@$_GET['page']+1?>&sortby=<?=$_GET['sortby']?>" id="next_button"></a></div><?}?>
	<div id="footer"><div id="footer_text"><?=$getsytle['footer_text']?></div></div>
	</div>
	</div>
	

</body>
</html>
