<?php
require("../db/datenbank.php"); 
$database	= new Database(); 
$geoplugin = new geoPlugin();
$geoplugin->locate();
//>>>>>>>>>>>>>>>>>>Gather Information<<<<<<<<<<<<<<<<<<<<//
$member = mysql_real_escape_string($_GET['member']);
$oid = mysql_real_escape_string($_GET['oid']);
$instance = date('Y-m-d H:i:s'); //Current DATE & Time
$ip = $_SERVER['REMOTE_ADDR']; //IP Address
$browser = $_SERVER['HTTP_USER_AGENT']; // Browser Used
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$geocity = $geoplugin->city; // City
$georegion = $geoplugin->region; // State Or Region
$geocountry = $geoplugin->countryCode; // Country Code
$web_referrer = $_SERVER["HTTP_REFERER"]; // Referring Website
$ctx = hash_init('sha1');
hash_update($ctx, $member. $instance. $oid);
$clickid = hash_final($ctx); //Click ID
$load_offer = $database->show_offer_by_oid($oid);
$load_member = $database->show_member_data($member);
$load_config = $database->get_configuration();
//>>>>>>>>>>>>>>>>>>>>>>Set Cookie<<<<<<<<<<<<<<<<<<<<<<<<<<<//
setcookie("clickid", $clickid, time()+60*60*24*30);

//>>>>>>>>>>>>>>>>>>>>>>Insert Info<<<<<<<<<<<<<<<<<<<<<<<<<<<//
if($load_offer['status'] == 'A' && $load_member['status'] == 'A'){	
	$insert_track['clickid']	 				= $clickid;
	$insert_track['click_instance']	 			= $instance;
	$insert_track['oid']	 					= $oid;
	$insert_track['member']	 					= $member;
	$insert_track['ip']	 						= $ip;
	$insert_track['browser']	 				= $browser;
	$insert_track['lang']	 					= $lang;
	$insert_track['geocity']	 				= $geocity;
	$insert_track['georegion']	 				= $georegion;
	$insert_track['geocountry']	 				= $geocountry;
	$insert_track['web_referrer']	 			= $web_referrer;
	$insert_trackId	= $database->insert('action_track',$insert_track);
	
//>>>>>>>>>>>>>>>>>End Of Insert > Begin Track Out<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

$load_offer = $database->show_single_offer($oid); 
$urlstart = $load_offer['tracking_url'];
$pass1 = str_replace('{member}',$member,$urlstart);
$urlend = str_replace('{clickid}',$clickid,$pass1);
//bye
header("location:$urlend");
}
elseif($load_member['status'] == 'B'){ echo 'Your Account Has Been Blocked, Please Contact Support.';}
elseif($load_offer['status'] == 'E'){ 
if($load_config['catch_all_url'] != '')
{header("location:".$load_config['catch_all_url']);}
	else{echo 'Offer Has Expired';}
	}
?>