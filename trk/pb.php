<?php
require("../db/datenbank.php"); 
$database	= new Database(); 

//>>>>>>>>>>>>>>>>>>Gather Information<<<<<<<<<<<<<<<<<<<<//
$clickid = mysql_real_escape_string($_GET['clickid']);
$instance = date("Y-m-d H:i:s");
$load_click = $database->show_click_info($clickid);
$load_config = $database->get_configuration();
$postback_address = $_SERVER['REMOTE_ADDR'];
//>>>>>>>>>>>>>>>>>>Mind Max Plug-in<<<<<<<<<<<<<<<<<<<<<<//
if($load_config['mindmax'] == true)
{
$license_key = $load_config['maxmindkey'];
$ipaddress   = $load_click['ip'];
$query = "https://minfraud.maxmind.com/app/ipauth_http?l=" . $license_key 
    . "&i=" . $ipaddress;
$proxy = file_get_contents($query);
}
else{ 
$proxy = 0;
}

//>>>>>>>>>>>>>>Update Action Information<<<<<<<<<<<<<<<<<//
if($postback_address != $load_click['ip']){
		$condition									= "clickid='".$clickid."'";
		$update_track['action_instance']	 		= $instance;
		$update_track['proxy_score']				= $proxy;
		$update_track['postback_server']			= $postback_address;
		$update_trackId	= $database->update('action_track',$update_track,$condition);
		
		echo 'Thank You!';
}
?>