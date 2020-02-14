<?php
require("../db/datenbank.php"); 
$database	= new Database(); 

//>>>>>>>>>>>>>>>>>>Gather Information<<<<<<<<<<<<<<<<<<<<//
$clickid = $_COOKIE['clickid'];
$pid = mysql_real_escape_string($_GET['pid']);
$instance = date("Y-m-d H:i:s");
$load_click = $database->show_click_info($clickid);
$load_offer = $database->show_offer_by_pixel($pid);
$load_config = $database->get_configuration();


//>>>>>>>>>>>>>>>>>>Mind Max Plug-in<<<<<<<<<<<<<<<<<<<<<<//
if($load_config['mindmax'] == true){
		$license_key = $load_config['maxmindkey'];
		$ipaddress   = $load_click['ip'];
		$query = "https://minfraud.maxmind.com/app/ipauth_http?l=" . $license_key . "&i=" . $ipaddress;
		$proxy = file_get_contents($query);
		}
		
else	{ 
		$proxy = 0; 
		}

//>>>>>>>>>>>>>>Update Action Information<<<<<<<<<<<<<<<<<//
if($load_offer['oid'] == $load_click['oid']){
		$condition									= "clickid='".$clickid."'";
		$update_track['action_instance']	 		= $instance;
		$update_track['proxy_score']				= $proxy;
		$update_trackId	= $database->update('action_track',$update_track,$condition);
}

//>>>>>>>>>>>>>>>>>>>Present Pixel<<<<<<<<<<<<<<<<<<<<<<<<//
header("Content-type: image/gif");
header("Content-length: 43");
$fp=fopen("php://output","wb");
fwrite($fp,"GIF89a\x01\x00\x01\x00\x80\x00\x00\xFF\xFF",15);
fwrite($fp,"\xFF\x00\x00\x00\x21\xF9\x04\x01\x00\x00\x00\x00",12);
fwrite($fp,"\x2C\x00\x00\x00\x00\x01\x00\x01\x00\x00\x02\x02",12);
fwrite($fp,"\x44\x01\x00\x3B",4);
fclose($fp);

?>