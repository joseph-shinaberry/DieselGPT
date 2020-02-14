<?php
include("../db/datenbank.php"); 

$database	= new Database(); 

$getstyle = $database->getstyle(); 

header("Content-type: text/css");
?>
/*------Multiple Pages--------*/

body {
	background-color:#<?=$getstyle['main_bg'] ?>;
	background: url(<?=$getstyle['bg_image'] ?>) repeat-x;
}

p{
	font-family:<?=$getstyle['p_font']?>;
} 

#border {
	margin-bottom:50px;
	margin-top: 5px;
	border:1px solid;
	border-radius: 10px;
	border-color:#999999;
	background-color:#ffffff;
	-webkit-box-shadow:0 0 5px #666666; 
	-moz-box-shadow: 0 0 5px #666666; 
	box-shadow:0 0 5px #666666;
	width: 1000px;
	margin-left: auto;
	margin-right: auto;
	position: relative;
	left:0px;
	right:0px;
	height:auto;
}

#content_center {
  width: 1000px;
  margin-top:0px;
  height:auto;
  margin-left: auto;
  margin-right: auto;
  position: relative;
}

#header {
  display: block;
  margin-top:5px;
  height:100%;
  margin-left: auto;
  margin-right: auto;
  position: relative;
}

#logo {
  display: block;
  background: url(../images/logo.png) no-repeat;
  width: 394px;
  height: 63px; 
  margin-left: 100px;
  margin-top:35px;
  position:relative;
}

#user_info {
  margin-top:-100px;	
  width:150px;
  margin-right: 0px;
  margin-left: auto;
  position: relative;
  text-align:right;
}

#user_greeting {
	color:#<?=$getstyle['box_txt']?>;
	font-size: 10px;
	margin-right:10px;
}

#user_info_box {
  margin-top:-10px;	
  width:140px;
  position: relative;
  background-color: #<?=$getstyle['box_colors']?>;
}

#user_info_box ul li {
	border-bottom:1px solid #ffffff;
	width:140px;
    display: block;
    height: 24px;
    line-height: 24px;
    font-size: 16px;
	font-weight: bold;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	margin-left:-40px;
	position: relative;
	text-align:left;
	padding-top:3px;
	padding-bottom:3px;
	padding-left:3px;
}

#user_info_box img {
    vertical-align: middle;
	margin-left: 0px;
	padding-right:50px;
}

#menu {
	height:55px;
	width:100%;
	background:#<?=$getstyle['box_colors']?>;
	border-bottom:10px solid #333333;
	position:relative;
}

/*
#sub_menu {
	height:30px;
	width:990px;
	background:#<?=$getstyle['box_colors']?>;
	position:relative;
}
*/

#button_active {
	height:55px;
	background:#333333;
	float:left;
	text-decoration:none;
	padding-left:20px;
	padding-right:20px;
	color:#ffffff;
	font-weight:bold;
	position:relative;
}

#button_active  a {
  display: block; 
  vertical-align: middle; 
  text-align: center;
}	

#button {
	height:55px;
	background:#<?=$getstyle['box_colors']?>;
	float:left;
	text-decoration:none;
	padding-left:20px;
	padding-right:20px;
	font-weight:bold;
	transition-duration: 1s;
	-webkit-transition-duration: 1s;
	color:#666666;
	position:relative;
}

#button:hover {
	height:55px;
	background:#AFD0FE;
	float:left;
	text-decoration:none;
	padding-left:20px;
	padding-right:20px;
	color:#666666;
	font-weight:bold;
}
	
#button a {
  display: table-cell; 
  vertical-align: middle; 
  text-align: center;
}	


#page_nav{
	width: 400px;
	height: 50px;
	padding-right:25px;
	float:right;
	position:relative;
	bottom:0px;
}

#next_button{
	display: block;
	background: url(../images/buttons/next.png) no-repeat;
	width:156px;
	height:34px;
	padding:0px 10px 0px 10px;
	position:relative;
	float:right;
	}
	
#back_button{
	display: block;
	background: url(../images/buttons/back.png) no-repeat;
	width:156px;
	height:34px;
	padding:0px 10px 0px 10px;
	position:relative;
	float:left;
	}
	

#footer {
	margin-top: 10px;
	clear:both;
	width: 100%;
	height: 50px;
	background:#<?=$getstyle['box_colors']?>;
	border-top: 5px solid #333333;
	position:relative;
}

#footer_text{
	margin:5px 5px 0px 0px;
	float:right;
	text-align:right;
	font-family:<?=$getstyle['p_font']?>;
	color:#666666;
	font-size:12px;
}

#mini-notification {
    display: none;
    position: fixed;
    cursor: pointer;
    width: 100%;
    background: #66B3FF;
    font-size: 24px;
    text-align: center;
    border-top: 2px solid #fff;
    z-index:9999;
    color: #3C3C3C;
    -moz-box-shadow:0 0em 0.5em rgba(0, 0, 0, 0.3);
    -webkit-box-shadow:0 0em 0.5em rgba(0, 0, 0, 0.3);
    box-shadow:0 0em 0.5em rgba(0, 0, 0, 0.3);
}

#mini-notification .inner {
    position: relative;
    width: 800px;
    margin:  0 auto;
    padding-right: 60px;
}

#mini-alert {
    display: none;
    position: fixed;
    cursor: pointer;
    width: 100%;
    background: #FF5050;
    font-size: 24px;
    text-align: center;
    border-top: 2px solid #fff;
    z-index:9999;
    color: #3C3C3C;
    -moz-box-shadow:0 0em 0.5em rgba(0, 0, 0, 0.3);
    -webkit-box-shadow:0 0em 0.5em rgba(0, 0, 0, 0.3);
    box-shadow:0 0em 0.5em rgba(0, 0, 0, 0.3);
}

#mini-alert .inner {
    position: relative;
    width: 800px;
    margin:  0 auto;
    padding-right: 60px;
}

/*--------Login Page ------------*/

#login_box {
	margin-bottom:50px;
	margin-top: 100px;
	border:1px solid;
	border-radius: 10px;
	border-color:#999999;
	background-color:#ffffff;
	-webkit-box-shadow:0 0 5px #666666; 
	-moz-box-shadow: 0 0 5px #666666; 
	box-shadow:0 0 5px #666666;
	width: 500px;
	margin-left: auto;
	margin-right: auto;
	position: relative;
	left:0px;
	right:0px;
	min-height:550px;
}

#login_center {
  width: 400px;
  margin-top:0px;
  height:auto;
  margin-left: auto;
  margin-right: auto;
  position: relative;
}

#sign_up {
  display: block;
  background: url(../images/buttons/signup.png) no-repeat;
  width: 409px;
  height: 65px; 
  margin-top:35px;
  position:relative;
}

#login_logo {
  display: block;
  background: url(../images/logo.png) no-repeat;
  width: 394px;
  height: 63px; 
  margin-top:35px;
  position:relative;
}

#login_input_box{
	margin:30px -35px 25px 52px;
	padding:5px 0px 0px 15px;
	width:400px;
	background:#<?=$getstyle['box_colors']?>;
	margin-left: auto;
	margin-right: auto;
	position: relative;
	border-radius:10px;
}
#login_label {
	margin:5px 5px 5px 5px;
	font-family:<?=$getstyle['p_font']?>;
	color:#666666;
	font-size:12px;
	float:left;
	border-radius:5px;
}

#login_input_text{
	padding: 10px 10px 10px 10px;
	width:375px;
	height:35px;
	font-size:24px;
	color:#<?=$getstyle['input_color']?>;
	border:0px;
	border-radius:5px;
	-webkit-box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
    -moz-box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
    box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
}
#login_input_text:hover, #login_input_text:focus {
	-webkit-box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;
    -moz-box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;
    box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;
}


#login{
	margin:15px 5px 5px 15px;
    width:173px;
    height:150px;
	background:url(../images/buttons/login.png) no-repeat;
    cursor:pointer;
    border: none;
	float: left;
}

#reset{
	margin:15px 5px 5px 5px;
    width:173px;
    height:150px;
	background:url(../images/buttons/reset.png) no-repeat;
    cursor:pointer;
    border: none;
	float: left;
}

#login_alert{
	font-family:<?=$getstyle['p_font']?>;
	color:#FF0000;
	font-weight:bold;
	text-align:center;
}

/*------Dashboard Page--------*/
#stats {
	position:relative;
	margin: 50px 60px 50px 50px;
	width:420px;
	height:200px;
	background:#<?=$getstyle['box_colors']?>;
	float:left;
	
}

#stat_header {
	margin-left:10px;
	margin-top:-20px;
	background: url(../images/header_stats.png) no-repeat;
	position:relative;
	width:134px;
	height:43px;
}

#stat_container {
	padding-top:25px;
	padding-left:10px;
	width:100%;
	height:175px;
	position:relative;
}

#stat_container ul li {
	margin-top:-50px;
	width:400px;
    display: block;
    font-size: 30px;
	font-weight: bold;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	position: relative;
	text-align:left;
	padding-bottom:60px;
	padding-left:3px;
	float: left;
}

.stat_define{
	margin: 10px 60px 0px 0px;
	font-size:14px;
	font-weight:bold;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	float:right;
}

#news {
	margin:50px 0px 0px 0px;
	width:420px;
	background:#<?=$getstyle['box_colors']?>;
	float:left;
	position:relative;
}

#news_header {
	margin-left:10px;
	margin-top:-15px;
	background: url(../images/header_news.png) no-repeat;
	position:relative;
	width:133px;
	height:42px;
}

#news_container {
	padding-left:10px;
	padding-right:10px;
	width:400px;
}

#news_headline {
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	font-weight: bold;
	margin-bottom: -15px;
}

#article{
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
}

#wallet {
	margin:50px 0px 50px 50px;
	width:900px;
	background:#<?=$getstyle['box_colors']?>;
	float:left;
	position:relative;
}

#wallet_header {
	margin-left:10px;
	margin-top:-20px;
	background: url(../images/header_wallet.png) no-repeat;
	position:relative;
	width:158px;
	height:39px;
}

#wallet_container {
	padding-top:25px;
	width:100%;
}

#wallet_title {
	width: 100%;
	padding-bottom: 15px;
	border-bottom:5px solid #333333;;
}

#wallet_title ul li {
	width:250px;
    display: block;
    font-size: 14px;
	font-weight: bold;
	text-align:center;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	float: left;
}

#wallet_amounts{
	width: 100%;
}

#wallet_amounts ul li{
	width:250px;
	padding-bottom: 5px;
    display: block;
    font-size: 18px;
	text-align:center;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	float: left;
	border-bottom:1px solid #FFFFFF;
}

/*------Offers Page & Completed Offer Page--------*/

#offer_top_bar {
	margin:50px 0px 25px 50px;
	width: 900px;
	height: 45px;
	background:#<?=$getstyle['box_colors']?>;
	border-bottom: 5px solid #333333;
	position:relative;
}

#approved {
	margin:-10px 0px 0px 100px;
	background: url(../images/offer_approved.png) no-repeat;
	width:43px;
	height:38px;
	position:absolute;
}

#pending {
	margin:-10px 0px 0px 100px;
	background: url(../images/offer_pending.png) no-repeat;
	width:40px;
	height:44px;
	position:absolute;
}

#unapproved {
	margin:-10px 0px 0px 100px;
	background: url(../images/offer_unapproved.png) no-repeat;
	width:36px;
	height:38px;
	position:absolute;
}

#offer_header {
	margin-left:10px;
	margin-top:-20px;
	background: url(../images/header_offer.png) no-repeat;
	position:absolute;
	width:156px;
	height:46px;
}

#completed_header {
	margin-left:10px;
	margin-top:-20px;
	background: url(../images/header_completed_offers.png) no-repeat;
	position:absolute;
	width:319px;
	height:46px;
}



#offer_dropdown{
	width: 300px;
	float:right;
	position:relative;
}

.sort-select select {
	background: transparent;
	width: 268px;
	padding: 5px;
	font-size: 16px;
	font-family:<?=$getstyle['p_font']?>;
	font-weight:bold;
	color:#<?=$getstyle['box_txt']?>;
	line-height: 1;
	border: 0;
	border-radius: 0;
	height: 34px;
	-webkit-appearance: none;
	float:left;
   }

.sort-select {
	margin-top:5px;
	width: 240px;
	height: 34px;
	overflow: hidden;
	background: url(../images/down_arrow_select.jpg) no-repeat right #ddd;
	border: 1px solid #ccc;
	float:left;
   }
   
.submit_sort {
	margin:5px 15px 0px 0px;
    background:url(../images/sort_submit.png) no-repeat;
    cursor:pointer;
    width: 33px;
    height: 33px;
    border: none;
	float:right;
} 
   
#offer {
	margin:25px 0px 25px 50px;
	width:420px;
	background:#<?=$getstyle['box_colors']?>;
	float:left;
	position:relative;
}

#offer_title {
	margin: 5px 0px 5px 5px;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	font-weight: bold;
}

#offer_box_left{
	padding: 10px 10px 10px 10px;
	width:150px;
	float:left;
}
#offer_box_left img {
	margin-left: 10px;
}

#rating {
	margin-top:-10px;
	width: 150px;
	text-align:center;
	font-size: 14px;
	font-weight: bold;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
}
#star {
  margin: -10px 2.5px 0px 2.5px;
  display: block;
  background: url(../images/star.png) no-repeat;
  width: 25px;
  height: 24px;
  position:relative;
  float:left;
}

#half_star {
  margin: -10px 2.5px 0px 2.5px;
  display: block;
  background: url(../images/half_star.png) no-repeat;
  width: 25px;
  height: 24px;
  position:relative;
  float:left;
}
   
#offer_box_right{
	margin-top:-20px;
	padding: 0px 0px 0px 0px;
	width:225px;
	float:left;
}   

#offer_box_right ul li {
	margin-left:-30px;
	padding: 2.5px 0px 2.5px 0px;
	list-style-type: none;
	width:225px;
    font-size: 14px;
	font-weight: bold;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	border-bottom: 1px solid #AFD0FE;

}

.offer_defined{
	font-size:14px;
	font-weight:bold;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	float:right;
}
   
#offer_details {
	margin:-10px 0px 0px 10px;
	font-size: 14px;
	font-weight: bold;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
} 

#details {
	margin:0px 0px 0px 10px;
	font-size: 14px;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
}  

#complete_offer {
	margin:5px -20px 5px 0px;
	display: block;
	background: url(../images/buttons/complete_offer.png) no-repeat;
	width: 150px;
	height: 22px; 
	position:relative;
	float:right;
}

/*------Rewards Page--------*/

#rewards_top_bar {
	margin:50px 0px 25px 50px;
	width: 900px;
	height: 45px;
	background:#<?=$getstyle['box_colors']?>;
	border-bottom: 5px solid #333333;
	position:relative;
}

#header_balance{
	margin: 10px 0px 0px 0px;
	width: 300px;
	float:right;
	position:relative;
	font-size: 20px;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	font-weight:bold;
}

#rewards_header {
	margin-left:10px;
	margin-top:-28px;
	background: url(../images/header_rewards.png) no-repeat;
	position:absolute;
	width:192px;
	height:48px;
}

#rewards_box{
	margin:0px -35px 25px 52px;
	width:440px;
	background:#<?=$getstyle['box_colors']?>;
	float:left;
	position:relative;
}

#reward_box_left{
	padding: 5px 5px 5px 5px;
	width:150px;
	height:100%;
	float:left;
	position:relative;
}
#reward_box_right{
	margin:-15px 0px 0px 0px;
	width:280px;
	height:100%;
	float:right;
	position:relative;
}
	
#reward_box_right ul li {
	margin:0px 0px 0px -40px;
	padding: 2.5px 0px 2.5px 0px;
	list-style-type: none;
	width:275px;
    font-size: 14px;
	font-weight: bold;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	border-bottom: 1px solid #AFD0FE;
}

.reward_defined{
	font-size:14px;
	font-weight:bold;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;;
	float:right;
}	

#request_reward {
	margin:0px 5px 5px 250px;
	display: block;
	background: url(../images/buttons/request.png) no-repeat;
	width: 150px;
	height: 22px; 
	position:relative;
	float:right;
}

#requested_reward {
	display: block;
	background: url(../images/buttons/requested.png) no-repeat;
	width: 150px;
	height: 22px; 
	position:relative;
}

#remove_reward {
	background: url(../images/buttons/remove.png) no-repeat;
	display: block;
	width: 150px;
	height: 22px; 
	position:relative;
}

#processing {
	display: block;
	background: url(../images/buttons/processing.png) no-repeat;
	width: 150px;
	height: 22px; 
	position:relative;
}

#inadequate_funds {
	margin:0px 5px 5px 200px;
	display: block;
	background: url(../images/buttons/inadequate_funds.png) no-repeat;
	width: 179px;
	height: 22px; 
	position:relative;
	float:right;
}

#req_rewards_top_bar {
	margin:50px 0px 10px 50px;
	width: 900px;
	height: 45px;
	background:#<?=$getstyle['box_colors']?>;
	border-bottom: 5px solid #333333;
	position:relative;
}

#req_rewards_header {
	margin-left:10px;
	margin-top:-35px;
	background: url(../images/header_requested_rewards.png) no-repeat;
	position:absolute;
	width:343px;
	height:59px;
}

#req_rewards_box {
	margin:0px 0px 50px 50px;
	width:900px;
	background:#<?=$getstyle['box_colors']?>;
	position:relative;
}

#req_rewards_box table {
padding:10px;
width:100%;
border:0;
}

#req_rewards_box td {
text-align:center;
}

#req_table_headtxt {
	font-family:<?=$getstyle['p_font']?>;
	font-weight:bolder;
}

#req_table_txt {
	margin:0px 0px 0px 0px;
	font-family:<?=$getstyle['p_font']?>;
	font-weight:normal;
}
/*------Account Info Page--------*/

#account_top_bar {
	margin:50px 0px 25px 20px;
	width: 950px;
	height: 45px;
	background:#<?=$getstyle['box_colors']?>;
	border-bottom: 5px solid #333333;
	position:relative;
}

#account_header {
	margin-left:10px;
	margin-top:-20px;
	background: url(../images/header_account.png) no-repeat;
	position:absolute;
	width:316px;
	height:40px;
}

#account_container_left{
	padding: 5px 0px 5px 5px;
	width:490px;
	height:100%;
	float:left;
	position:relative;
}

#account_container_right{
	padding: 5px 5px 5px 0px;
	width:490px;
	height:100%;
	float:left;
	position:relative;
}

#account_infobox{
	margin:0px -35px 25px 52px;
	padding:15px 0px 5px 5px;
	width:440px;
	background:#<?=$getstyle['box_colors']?>;
	margin-top:0px;
	height:auto;
	margin-left: auto;
	margin-right: auto;
	position: relative;
}

#account_info_null{
	margin-left:10px;
	margin-top:-30px;
	background: url(../images/account_info_null.png) no-repeat;
	position:absolute;
	width:24px;
	height:27px;
}

#account_info_check{
	margin-left:10px;
	margin-top:-25px;
	background: url(../images/account_info_check.png) no-repeat;
	position:absolute;
	width:24px;
	height:27px;
}

#account_info_alert{
	margin-left:10px;
	margin-top:-30px;
	background: url(../images/account_info_alert.png) no-repeat;
	position:absolute;
	width:24px;
	height:27px;
}

#account_info_text {
	margin:5px 5px 5px 5px;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	font-size:18px;
	text-align:center;
}

#account_box{
	margin:0px -35px 25px 52px;
	padding:0px 0px 0px 5px;
	width:440px;
	background:#<?=$getstyle['box_colors']?>;
	margin-top:0px;
	height:auto;
	margin-left: auto;
	margin-right: auto;
	position: relative;
}

#account_left_text {
	margin:5px 5px 5px 5px;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	font-size:18px;
	float:left;
}
#account_right_text {
	margin:5px 10px 5px 5px;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['box_txt']?>;
	font-size:18px;
	float:right;
}

#account_box input[type='password']{
	margin:5px 5px 5px 5px;
	padding: 2px 2px 2px 2px;
	width:200px;
	border:0;
	border-radius:5px;
	float:right;
	color:#<?=$getstyle['input_color']?>;
	-webkit-box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
    -moz-box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
    box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
}
#account_box input[type='password']:hover ,#account_box input[type='password']:focus{
	-webkit-box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;
    -moz-box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;
    box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;
}

#divider {
	margin-top:5px;
	margin-bottom:5px;
	width:375px;
	border-bottom: 1px solid #AFD0FE;
	margin-left: auto;
	margin-right: auto;
	position: relative;
}

#clear_space {
	clear:both;
	}
	
#password_update {
	margin:0px 5px 5px 0px;
	display: block;
	background: url(../images/buttons/pass_update.png) no-repeat;
	width: 197px;
	height: 26px; 
	position:relative;
	float:right;
	border:0;
	cursor:pointer;
}	

/*------Contact Page--------*/

#contact_top_bar {
	margin:50px 0px 25px 20px;
	width: 950px;
	height: 45px;
	background:#<?=$getstyle['box_colors']?>;
	border-bottom: 5px solid #333333;
	position:relative;
}

#contact_header {
	margin-left:10px;
	margin-top:-20px;
	background: url(../images/header_contact.png) no-repeat;
	position:absolute;
	width:222px;
	height:43px;
}

#contact_box{
	width: 900px;
	margin-top:0px;
	height:auto;
	margin-left: auto;
	margin-right: auto;
	position: relative;
	background:#<?=$getstyle['box_colors']?>;
}

#contact_box_inside{
	width: 700px;
	margin-top:0px;
	height:auto;
	margin-left: auto;
	margin-right: auto;
	position: relative;
}

#contact_left_text {
	margin:5px 5px 5px 5px;
	font-family:<?=$getstyle['p_font']?>;
	color:#666666;
	font-size:18px;
	float:left;
}

#contact_right_text {
	margin:5px 5px 5px 5px;
	font-family:<?=$getstyle['p_font']?>;
	color:#666666;
	font-size:18px;
	float:right;
}

#contact_box input[type='text']{
	margin:5px 5px 5px 5px;
	padding:5px 5px 5px 5px;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['input_color']?>;
	font-size:20px;
	width: 575px;
	height:24px;
	float:right;
	border:0px;
	border-radius:5px;
	-webkit-box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
    -moz-box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
    box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
}
#contact_box input[type='text']:hover, #contact_box input[type='text']:focus{
  -webkit-box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;
    -moz-box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;
    box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;}
#contact_box textarea{
	margin:5px 5px 5px 5px;
	padding:5px 5px 5px 5px;
	font-family:<?=$getstyle['p_font']?>;
	color:#<?=$getstyle['input_color']?>;
	width: 575px;
	height: 120px;
	float:right;
	border:0px;
	border-radius:5px;
	-webkit-box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
    -moz-box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
    box-shadow: 0 0 1px #<?=$getstyle['input_shadow_color']?>;
}
#contact_box textarea:hover, #contact_box textarea:focus{
  -webkit-box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;
    -moz-box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;
    box-shadow: 0 0 4px #<?=$getstyle['input_shadow_color']?>;
}
#send_message {
	margin: 5px 5px 5px 5px;
	display: block;
	float:right;
	background: url(../images/buttons/send_message.png) no-repeat;
	width: 150px;
	height: 22px; 
	position:relative;
	border:0;
}