<?php
require("db/datenbank.php"); 
$database	= new Database(); 
include("session/session.php");

$dna_member_stats = $database->show_member_stats($member);
$getsytle = $database->getstyle(); 


$message = 'FOR YOUR OWN SAFTY YOU MUST CONTACT SUPPORT 
TO CHANGE ANY PERSONAL INFORMATION OTHER THAN YOUR PASSWORD.';
$div_status = "account_info_null";
if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['old_password'] != '' ){

$keyhole     		=	"Dietrich";
$currentpassclean	=	mysql_real_escape_string($_POST['old_password']);
$currentpassword	= 	(sha1($currentpassclean,$keyhole));

if($dna_member_data['password'] == $currentpassword && flucht($_POST['newpassword']) == flucht($_POST['renewpassword'])){
$passclean			=	mysql_real_escape_string($_POST['newpassword']);
$keyhole     		=	"Dietrich";
$password			= 	(sha1($passclean,$keyhole));

	$condition									= "id=".$member;
	$update_member['password']	 				= $password;
	$insert_memberId	= $database->update(members,$update_member,$condition);

	$message = 'YOUR PASSWORD HAS BEEN SUCCESSFULLY CHANGED.';
	$div_status = "account_info_check";
	$status = 1;
}
elseif(flucht($_POST['newpassword']) != flucht($_POST['renewpassword'])){
$message = 'YOUR NEW PASSWORD, DO NOT MATCH, PLEASE TRY AGAIN.';
$div_status = "account_info_alert";
$status = 2;}
elseif($dna_member_data['password'] != $currentpassword){
$message = 'YOUR OLD PASSWORD DOES NOT MATCH, PLEASE TRY AGAIN.';
$div_status = "account_info_alert";
$status = 3;}
}


?>
<!DOCTYPE html> 
<html>
<head>
<title>Home/Dashboard | <?=$getsytle['title']?></title>
<link href="css/style.php" rel="stylesheet" type="text/css" />
</head>
<body>
	<?if( $status == 1){?><div id="mini-notification"><p>Password Successfully Changed</p></div><?}?>
	<?if( $status == 2){?><div id="mini-alert"><p>Password Doesn't Match</p></div><?}?>
	<?if( $status == 3){?><div id="mini-alert"><p>New Password Doesn't Match</p></div><?}?>
	<script src="js/libs/jquery.min.js"></script>
	<script src="js/miniNotification.js"></script>
	<script>
      $(function() {
        $('#mini-notification').miniNotification({closeButton: false, closeButtonText: '[hide]'});
      });
    </script>
	<script>
      $(function() {
        $('#mini-alert').miniNotification({closeButton: false, closeButtonText: '[hide]'});
      });
    </script>

	<div id="border">
	<div id="content_center">
	<? include 'includes/header.php';?>
	<div id="menu">
	<a href="dashboard" id="button" title="Dashboard" ><p>DASHBOARD</p></a>
	<a href="offers" id="button" title="Offers"><p>OFFERS</p></a>
	<a href="completed_offers" id="button" title="Completed Offers"><p>COMPLETED OFFERS</p></a>
	<a href="rewards" id="button" title="Payments & Rewards"><p>PAYMENTS & REWARDS</p></a>
	<a href="account" id="button_active" title="Account Settings"><p>ACCOUNT INFO</p></a>
	<a href="contact" id="button" title="Contact"><p>CONTACT</p></a>
	</div>
	<div id="account_top_bar">
	<div id="account_header"></div>
	</div>
	<div id="account_container_left">
	<div id="account_infobox">
	<div id="<?echo $div_status?>"></div>
	<div id="account_info_text">
	<?echo $message?></div>
	</div>
	
	<div id="account_box">
	<div id="account_left_text">USERNAME/EMAIL</div>
	<div id="account_right_text"><?=$dna_member_data['username']?></div>
	<div id="clear_space"></div>
	</div>
	<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<div id="account_box">
	<div id="account_left_text">OLD PASSWORD</div>
	<input type="password" name="old_password">
	<div id="clear_space"></div>
	<div id="divider"></div>
	<div id="account_left_text">NEW PASSWORD</div>
	<input type="password" name="newpassword">
	<div id="clear_space"></div>
	<div id="account_left_text">RETYPE PASSWORD</div>
	<input type="password" name="renewpassword">
	<div id="clear_space"></div>
	<input type="submit" value="" id="password_update" />
	</form>
	<div id="clear_space"></div>
	</div>
	</div>
	<div id="account_container_right">
	<div id="account_box">
	<div id="account_left_text">FIRST NAME:</div><div id="account_right_text"><?=$dna_member_data['first_name']?></div>
	<div id="clear_space"></div><div id="divider"></div>
	<div id="account_left_text">LAST NAME:</div><div id="account_right_text"><?=$dna_member_data['last_name']?></div>
	<div id="clear_space"></div><div id="divider"></div>
	<div id="account_left_text">DATE OF BIRTH:</div><div id="account_right_text"><?=$dna_member_data['dob']?></div>
	<div id="clear_space"></div><div id="divider"></div>
	<div id="account_left_text">PHONE:</div><div id="account_right_text"><?=$dna_member_data['phone']?></div>
	<div id="clear_space"></div>
	</div>
	
	<div id="account_box">
	<div id="account_left_text">ADDRESS LINE 1:</div><div id="account_right_text"><?=$dna_member_data['address1']?></div>
	<div id="clear_space"></div><div id="divider"></div>
	<div id="account_left_text">ADDRESS LINE 2:</div><div id="account_right_text"><?=$dna_member_data['address2']?></div>
	<div id="clear_space"></div><div id="divider"></div>
	<div id="account_left_text">CITY:</div><div id="account_right_text"><?=$dna_member_data['city']?></div>
	<div id="clear_space"></div><div id="divider"></div>
	<div id="account_left_text">STATE/REGION:</div><div id="account_right_text"><?=$dna_member_data['state_region']?></div>
	<div id="clear_space"></div><div id="divider"></div>
	<div id="account_left_text">COUNTRY:</div><div id="account_right_text"><?=$dna_member_data['country']?></div>
	<div id="clear_space"></div>
	</div>
	
	</div>
		
	<div id="footer"><div id="footer_text"><?=$getsytle['footer_text']?></div></div>
	</div>
	</div>
	

</body>
</html>
