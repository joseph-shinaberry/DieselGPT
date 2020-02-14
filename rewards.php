<?php
require("db/datenbank.php"); 
$database	= new Database(); 
include("session/session.php");
$message = 0;

$getsytle = $database->getstyle(); 
@$page = $_GET['page'];
if (empty($page)) {
    $page=1;
}
@$r = $_GET['r'];
@$x = $_GET['x'];
if($r > 0 && $member > 0){
		
		$dna_member_stats = $database->show_member_stats($member);
		$dna_reward_stats = $database->show_reward_by_rid(flucht($r));
		
		$inser_requests['mid']	 			= $member;
		$inser_requests['rid']				= flucht($r);
		$inser_requestsId	= $database->insert('reward_requests',$inser_requests);
		
		$condition		= $member;
		$updatebalance['available_balance']	= $dna_member_stats['available_balance']-$dna_reward_stats['reward_value'];
		$updatebalanceID	= $database->update('member_stats',$updatebalance,$condition);
		$message= 1;
		}
		
if($x > 0 && $member > 0) {
		$dna_request_stats = $database->show_reward_request(flucht($x));
		$dna_member_stats = $database->show_member_stats($member);
		$dna_reward_stats = $database->show_reward_by_rid($dna_request_stats['rid']);
		
		
		$remove_request = $database->removerequest($member, flucht($x));
		
		$condition		= $member;
		$updatebalance['available_balance']	= $dna_member_stats['available_balance']+$dna_reward_stats['reward_value'];
		$updatebalanceID	= $database->update('member_stats',$updatebalance,$condition);
		$message= 2;
}
$dna_member_stats = $database->show_member_stats($member);		
?>
<!DOCTYPE html> 
<html>
<head>
<title>Home/Dashboard | <?=$getsytle['title']?></title>
<link href="css/style.php" rel="stylesheet" type="text/css" />
</head>
<body>
	<?if( $message == 2){?><div id="mini-notification"><p>Reward Successfully Removed</p></div><?}?>
	<?if( $message == 1){?><div id="mini-notification"><p>Reward Successfully Added</p></div><?}?>
	<script src="js/libs/jquery.min.js"></script>
	<script src="js/miniNotification.js"></script>
	<script>
		  $(function() {
			$('#mini-notification').miniNotification({closeButton: false, closeButtonText: '[hide]'});
		  });
	</script>


	<div id="border">
	<div id="content_center">
	<? include 'includes/header.php';?>
	<div id="menu">
	<a href="index" id="button" title="Dashboard" ><p>DASHBOARD</p></a>
	<a href="offers" id="button" title="Offers"><p>OFFERS</p></a>
	<a href="completed_offers" id="button" title="Completed Offers"><p>COMPLETED OFFERS</p></a>
	<a href="rewards" id="button_active" title="Payments & Rewards"><p>PAYMENTS & REWARDS</p></a>
	<a href="account" id="button" title="Account Info"><p>ACCOUNT INFO</p></a>
	<a href="contact" id="button" title="Contact"><p>CONTACT</p></a>
	</div>
	<div id="rewards_top_bar">
	<div id="rewards_header"></div>
	<div id="header_balance">AVAILABLE FUNDS: $<?=$dna_member_stats['available_balance']?></div>
	</div>
	
	<?
	if($page  == '1' || empty($page)){$la = 0; $lb = 6;}
	elseif($page  == '2'){$la = 6; $lb = 12;}
	elseif($page  == '3'){$la = 12; $lb = 18;}
	elseif($page  == '4'){$la = 18; $lb = 24;}
	elseif($page  == '5'){$la = 24; $lb = 30;}
	elseif($page  == '6'){$la = 30; $lb = 36;}
	elseif($page  == '7'){$la = 36; $lb = 42;}
	elseif($page  == '8'){$la = 42; $lb = 48;}
	elseif($page  == '9'){$la = 48; $lb = 54;}
	elseif($page  == '10'){$la = 54; $lb = 58;}
	
	
	$showallrewards 	= 	$database->show_all_rewards($la,$lb);
	$rewardcount			=	count($showallrewards); 
	
	@$page_get 			= 	$database->show_all_rewards();
	$page_amount_count	=	count($page_get);
	?>	
	<?$i = 0;
	for($i=0;$i<$rewardcount;$i++) {?>
	<div id="rewards_box">
	<div id="reward_box_left">
	<img src="<?=$showallrewards[$i]['image_url']?>">
	</div>
	<div id="reward_box_right">
	<ul>
		<li>Reward:<span class="reward_defined"><?=$showallrewards[$i]['reward_name']?></span></li>
		<li>Cost:<span class="reward_defined"><?=$showallrewards[$i]['reward_value']?></span></li>
		<li>Delivery Method:<span class="reward_defined"><?=$showallrewards[$i]['del_method']?></span></li>
		<li>Delivery Time:<span class="reward_defined"><?=$showallrewards[$i]['del_time']?></span></li>
	</ul>	
	</div><?if($dna_member_stats['available_balance'] >= $showallrewards[$i]['reward_value']){?>
	<a href="rewards?r=<?=$showallrewards[$i]['rid']?>" id="request_reward"></a></div><?}else{?>
	<div id="inadequate_funds"></div></div>
	<?}//
	}if($page_amount_count > 7){?>
	<div id="page_nav">
	<? if(@$page > 1){?><a href="rewards?page=<?=@$page-1?>" id="back_button"></a><?}else
	{$page = 1;}if($rewardcount >= 6){?>
	<a href="rewards?page=<?=@$page+1?>" id="next_button"></a><?}?></div><?}?>
	<div id="clear_space"></div>
	
	
	<div id="req_rewards_top_bar">
	<div id="req_rewards_header"></div>
	</div>
	<div id="req_rewards_box">
	
	<table>
	
<tr>
<td><p id="req_table_headtxt">Reward</p></td>
<td><p id="req_table_headtxt">Status</p></td>
<td><p id="req_table_headtxt">Manage</p></td>
</tr>
<?
	$showallrequests 	= 	$database->show_all_requests($member);
	$rewardreqcount			=	count($showallrequests); 
	?>
	<?$i = 0;
	for($i=0;$i<$rewardreqcount;$i++) {?>
<tr>
<td><p id="req_table_txt"><?=$showallrequests[$i]['reward_name']?></p></td>
<td><p id="req_table_txt"><?if($showallrequests[$i]['status'] == 'R'){?>Request Pending<?}?>
						  <?if($showallrequests[$i]['status'] == 'P'){?>Processing<?}?>
						  <?if($showallrequests[$i]['status'] == 'D'){?>Complete Gift Sent/Delivered<?}?></p>
</td>
<td><center><?if($showallrequests[$i]['status'] == 'R'){?><a href="rewards?x=<?=$showallrequests[$i]['qid']?>" id="remove_reward"></a><?}?>
			<?if($showallrequests[$i]['status'] == 'P'){?><div id="processing" title="Processing..." ></div><?}?>
			<?if($showallrequests[$i]['status'] == 'D'){?><div id="requested_reward" title="Item has been sent, transaction complete." ></div><?}?></center></td>
</tr>
<?}?>
</table>
</div>
	
	<div id="footer"><div id="footer_text"><?=$getsytle['footer_text']?></div></div>
	</div>
	</div>
	

</body>
</html>
