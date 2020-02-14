<?php
include("db/datenbank.php"); 
$database	= new Database(); 
ini_set('session.use_only_cookies',true);
$msg = '';
	

	if($_SERVER['REQUEST_METHOD']=='POST' && $_POST['user_name']!='') 
	{
	$username			=	mysql_real_escape_string($_POST['user_name']);
	$passclean			=	mysql_real_escape_string($_POST['pass']);
	$keyhole     		=	"Dietrich";
	$password			= 	(sha1($passclean,$keyhole));
	$qry_login			=	"Select id,username,password,token,status from members where username='$username' and password='$password'";
	
		$user_data			=	$database->fetchSingleRow($qry_login);
		$tokenstr 			=   date('W').$keyhole;
		$token 				=   md5($tokenstr);
	
	
	$usernamestr		= 	$user_data['username'];
	$qry_check			= 	"select token from members where username='$usernamestr'";
	$result 			= 	mysql_query($qry_check);
	$checkresult 		= mysql_fetch_assoc($result);
	
	if($user_data['token'] == $checkresult['token'] && $user_data['status'] == 'A')
	{	
		$condition				= 	"id=".$user_data['id'];
		$insert_token['token']	=	$token;
		$insert_newtoken		= 	$database->update(members,$insert_token,$condition);
		
		session_start();
		$_SESSION['userid'] 	= 	$user_data['id'];
		$_SESSION['username'] 	= 	$user_data['username'];
		$_SESSION['token'] 		= 	$token;
			
		
		header("location:dashboard"); 					
		exit;
	}elseif($user_data['token'] == '')
	{$msg = "Username/Password Incorrect";}
	elseif($user_data['token'] == $checkresult['token'] && $user_data['status'] != 'A'){
		$msg = "Your account has been blocked! <br>Contact us for more information.";
	}}


$getstyle = $database->getstyle(); 
?>
<!DOCTYPE html> 
<html>
<head>
<title>Home/Dashboard | <?=$getstyle['title']?></title>
<link href="css/style.php" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="login_box">
	<div id="login_center">
	<a href="http://www.dieselgpt.com" id="login_logo"></a>
	
	<a href="signup" id="sign_up"></a>
	
	<div id="login_input_box"><p id="login_alert"><? echo $msg;?></p><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	<div id="login_label">Username:</div>
		<input type="text" id="login_input_text" name="user_name">
	<div id="login_label">Password:</div>
		<input type="password" id="login_input_text" name="pass">
	<input type="submit" value="" id="login" /><input type="reset" value="" id="reset" /></form>
	<div id="clear_space"></div>
	</div>
	</div></div>
</body>
</html>
