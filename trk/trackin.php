<?php

if($settings['mindmax'] == 'true')
{
$license_key = $settings['maxmindkey'];
$ipaddress   = $ip;
$query = "https://minfraud.maxmind.com/app/ipauth_http?l=" . $license_key 
    . "&i=" . $ipaddress;
$score = file_get_contents($query);
}

?>