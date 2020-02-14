<?php
include("sperren.php"); 
 
$_hostname = HOST_NAME; 
$_database = DATABASE_NAME;  
$_username = USER_NAME; 
$_password = PASSWORD; 

$_verbinden = mysql_connect($_hostname, $_username, $_password); 
mysql_select_db($_database, $_verbinden); 

define('MYSQL_TYPES_NUMERIC', 'int real ');

define('MYSQL_TYPES_DATE', 'datetime timestamp year date time ' );

define('MYSQL_TYPES_STRING', 'string blob ' );

function flucht($value)
{
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
    $replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");

    return str_replace($search, $replace, $value);
}

class Database

{

   var $last_error;

   var $last_query;   

   var $host;   

   var $user;

   var $pw;

   var $db;  

   var $db_link;     

   var $auto_slashes; 



	var		$HostName;

	var		$UserName;

	var		$PassWord;

	var		$DatabaseName;

	var		$DatabaseLink;



function Database($hostName = HOST_NAME, $userName = USER_NAME, $password = PASSWORD, $databaseName = DATABASE_NAME)

	{



		 $this->HostName		=	$hostName;

		$this->UserName			=	$userName;

		$this->PassWord			=	$password;

		$this->DatabaseName		=	$databaseName;

		$this->DatabaseLink		=	mysql_connect($this->HostName, $this->UserName, $this->PassWord) or die(mysql_error());

		mysql_select_db($this->DatabaseName,$this->DatabaseLink); 

		//or die("<h3>Error on Server. Please Try Once Again...Thank You!!!<h2><hr>")

	}

function xmlentities($string) {
		return str_replace(array("&", "<", ">", "\"", "'"),
        array("&amp;", "&lt;", "&gt;", "&quot;", "&apos;"), $string);
}	

function insert($table, $data)

      {

	  

	

        if (empty($data))

          {

         $this->last_error = "You must pass an array to the insert_array() function.";

         return false;

          }

       

      $cols = '(';

      $values = '(';

     

      foreach ($data as $key=>$value)

      {

         $cols .= "$key,";

         $col_type = $this->get_column_type($table, $key);  // get column type

         if (!$col_type) return false;  // error!

         if (substr_count(MYSQL_TYPES_NUMERIC, "$col_type "))

		 {

		    if ($this->auto_slashes) $value = addslashes($value);

            $values .= "'$value',";

		  }

         elseif (substr_count(MYSQL_TYPES_DATE, "$col_type "))

         {

            $value = $this->sql_date_format($value, $col_type); // format date

            $values .= "'$value',";

         }

         elseif (substr_count(MYSQL_TYPES_STRING, "$col_type "))

         {

            if ($this->auto_slashes) $value = addslashes($value);

            $values .= "'$value',";

         }

      }

      $cols = rtrim($cols, ',').')';

      $values = rtrim($values, ',').')';   

      $sql = "INSERT INTO $table $cols VALUES $values";

	  //echo $sql;
	//print $sql;
	//exit();
	
	
      return $this->insert_sql($sql);

   }

   function insert_sql($sql) {

       

      $this->last_query = $sql;

     

      $r = mysql_query($sql);

      if (!$r) {

         $this->last_error = mysql_error ();

         return false;

      }

     

      $id = mysql_insert_id();

      if ($id == 0) return true;

      else return $id;

   }



    function get_column_type($table, $column)

    {

     

      $r = mysql_query("SELECT $column FROM $table LIMIT 1");

      if (!$r)

      {

         $this->last_error = mysql_error();

         return false;

      }

      $ret = mysql_field_type($r, 0);

      if (!$ret)

      {

         $this->last_error = "Unable to get column information on $table.$column.";

         mysql_free_result($r);

         return false;

      }

      mysql_free_result($r);

      return $ret;

    }

    function sql_date_format($value, $type)

     {



      if (gettype($value) == 'string') $value = strtotime($value);

      return date('Y-m-d H:i:s', $value);



   }

    

   function update($table, $data, $condition)

   {

           if (empty($data))

           {

         $this->last_error = "You must pass an array to the update_array() function." ;

         return false;

           }

     

      $sql = "UPDATE $table SET";

      foreach ($data as $key=>$value)

     {      // iterate values to input

          $sql .= " $key=";

         $col_type = $this->get_column_type ($table, $key);  // get column type

         if (!$col_type) return false;  // error!

          // determine if we need to encase the value in single quotes

          

         if (substr_count(MYSQL_TYPES_NUMERIC, "$col_type "))

         $sql .= "$value,";

         elseif (substr_count(MYSQL_TYPES_DATE, "$col_type " ))

         {

            $value = $this->sql_date_format ($value, $col_type); // format date

              $sql .= "'$value',";

         }

         elseif (substr_count(MYSQL_TYPES_STRING, "$col_type "))

         {

          if ($this->auto_slashes) $value = addslashes($value);

            $values .= "'$value',";

            $sql=$sql.$values;

            unset($values);

         }

      }

      $sql = rtrim($sql, ','); // strip off last "extra" comma

      if (!empty($condition)) $sql .= " WHERE $condition" ;

    	//echo "sql=$sql";

      // insert values
	  //print $sql;

      return $this->update_sql($sql );

      

   }

     function update_sql($sql) {



    $this->last_query = $sql;

     

      $r = mysql_query($sql);

      if (!$r) {

         $this->last_error = mysql_error ();

         return false;

      }

     

      $rows = mysql_affected_rows();

      if ($rows == 0) return true;  // no rows were updated

      else return $rows;

   }

    

   function select_one_row($id)

   {

    $qry1=mysql_query("select * from s2 where bUserId='$id'");

    $s=mysql_fetch_assoc($qry1);

    return $s;

   }

   

	function mysqlQuery($qry)

	{	

		$rs		=	mysql_query($qry, $this->DatabaseLink);

		return $rs;

		

		echo mysql_error();

	}

	

	function mysqlFetchArray($rs)

	{

		$row	=	array();

		if($rs	===	FALSE)  # In case invalid result resource

			return $row;

		$row	=	mysql_fetch_array($rs);

		return $row;

	}

	

	function mysqlNumRows($rs)

	{

		if($rs	===	FALSE)   # In case invalid result resource

			return 0;

		$rows	=	mysql_num_rows($rs);

		return $rows;

	}

	

	function mysqlFreeResult($rs)

	{

		if($rs	===	FALSE) # In case invalid result resource

			return ;

		mysql_free_result($rs);

	}

	

	function mysqlInsertId()

	{

		$id	=	mysql_insert_id($this->DatabaseLink);

		return $id;

	}

	

	function mysqlClose()

	{

		mysql_close($this->DatabaseLink);

	}



	function getTableArray($qry)	// Returns a Two dimensional array which contains the data associated with the result set

	{

		$dataTable		=	array();

		$rs				=	mysql_query($qry);

		if($rs	===	FALSE)  # In case invalid result resource

			return $dataTable; 

		

		$fieldcount		=	@mysql_num_fields($rs);

		//Fetching the Fields Names from the database.

		$fields			=	array();	

		for ($i=0; $i<$fieldcount; $i++ )

			$fields[$i]		=	@mysql_field_name($rs,$i);

		

		$count		=	0;

		

		while ($row	=	@mysql_fetch_array($rs)) {

			for ($i=0; $i<$fieldcount; $i++ )

				$dataTable[$count][$fields[$i]]		=	$row[$fields[$i]];

			$count++;	

		}

		@mysql_free_result($rs);

		return 	$dataTable;	

	}	

			

		function fetchSingleRow($qry)

	{

		$row		=	array();

		$rs			=	mysql_query($qry);

		if($rs	===	FALSE)

			return $row;

				

		$row		=	mysql_fetch_array($rs);

		mysql_free_result($rs);

		return $row;	

	}

	function fetchSingleAssocRow($qry)

	{

		$row		=	array();

		$rs			=	mysql_query($qry);

		if($rs	===	FALSE)

			return $row;

				

		$row		=	mysql_fetch_assoc($rs);

		mysql_free_result($rs);

		return $row;	

	}

	
	
//-------------------------------------->Start Custom Functions<-------------------------//

	
function getstyle() {
		$cqrycat	=	"SELECT * FROM style where id='1' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
		}
		
function show_member_data($member)
	{
		$cqrycat	=	"SELECT * FROM members where id='$member' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
function show_member_stats($memberstat)
	{
		$cqrycat	=	"SELECT * FROM member_stats where id='$memberstat' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}	

function show_all_news($st,$lt)

	{
	if($lt>0)
		$qrypdt		=	"SELECT * FROM news order by news_date DESC limit $st,$lt";
	else
		$qrypdt		=	"SELECT * FROM news order by news_date DESC";
		$mquery		=	$this->getTableArray($qrypdt);
		$numprod	=	count($mquery);
		return $mquery;
	}
	
function show_news_details($id)
	{
		$cqrycat	=	"SELECT * FROM news where id='$id' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}

function showall_user_wallet($member) // V.A.
	{
		$qrypdt		=	"SELECT * FROM wallet_stats WHERE memberid='$member' ";
		$mquery		=	$this->getTableArray($qrypdt);
		$numprod	=	count($mquery);
		return $mquery;
	}

function showall_offers($sortby,$la,$lb) // V.A.
	{
	if($lb>0)
		$qrypdt		=	"SELECT * FROM offers WHERE status='A' order by $sortby limit $la,$lb";
	else
		$qrypdt		=	"SELECT * FROM offers WHERE status='A' order by $sortby ";
		$mquery		=	$this->getTableArray($qrypdt);
		$numprod	=	count($mquery);
		return $mquery;
	}
	
function show_completed_offers($member,$sortby,$la,$lb) // V.A.
	{
	if($lb>0)	
		$qrypdt	= "SELECT o.oid, o.title as title, o.payout as payout, o.action as action, o.details as details,
				o.rating as rating, a.oid, a.action_instance as action_instance, a.member as member,
				a.approval_status as approval_status FROM offers as o INNER JOIN action_track as a ON o.oid = a.oid WHERE 
				action_instance != '0000-00-00 00:00:00' AND member='$member' order by $sortby limit $la,$lb";
	else
		$qrypdt		=	"SELECT o.oid, o.title as title, o.payout as payout, o.action as action, o.details as details,
				o.rating as rating, a.oid, a.action_instance as action_instance, a.member as member,
				a.approval_status as approval_status FROM offers as o INNER JOIN action_track as a ON o.oid = a.oid WHERE 
				action_instance != '0000-00-00 00:00:00' AND member='$member' order by $sortby";
		$mquery		=	$this->getTableArray($qrypdt);
		$numprod	=	count($mquery);
		return $mquery;
	}	

function show_single_offer($oid)
	{
		$cqrycat	=	"SELECT * FROM offers WHERE oid='$oid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}		
	
function get_configuration()
	{
		$cqrycat	=	"SELECT * FROM configuration where id='1' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}	
	
function show_click_info($clickid)
	{
		$cqrycat	=	"SELECT * FROM action_track WHERE clickid='$clickid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}
	
function show_offer_by_pixel($pid)
	{
		$cqrycat	=	"SELECT * FROM offers WHERE pid='$pid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}	

function show_offer_by_oid($oid)
	{
		$cqrycat	=	"SELECT * FROM offers WHERE oid='$oid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}	
function show_reward_by_rid($rid)
	{
		$cqrycat	=	"SELECT * FROM rewards WHERE rid='$rid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}		
function show_reward_request($qid)
	{
		$cqrycat	=	"SELECT * FROM reward_requests WHERE qid='$qid' ";
		$cdatacat	=	$this->fetchSingleAssocRow($cqrycat);
		return $cdatacat;
	}		
	
	
function show_all_rewards($la,$lb)
	{
	if($lb>0)
		$qrypdt		=	"SELECT * FROM rewards limit $la,$lb";
	else
		$qrypdt		=	"SELECT * FROM rewards";
		$mquery		=	$this->getTableArray($qrypdt);
		$numprod	=	count($mquery);
		return $mquery;
	}	
	
function show_all_requests($member)
	{
		$qrypdt		=	"SELECT 
						r.rid, 						
						r.reward_name as reward_name,
						q.qid,
						q.rid,
						q.status as status,
						q.mid as mid
						FROM rewards as r INNER JOIN reward_requests as q ON r.rid = q.rid WHERE
						mid=$member";
		$mquery		=	$this->getTableArray($qrypdt);
		$numprod	=	count($mquery);
		return $mquery;
	}		
function removerequest($member, $qid)
	{
		$qy = "DELETE FROM reward_requests WHERE mid=$member AND qid=$qid";
		mysql_query($qy);
	}
}

/*>>>>>>>>>>>>>>>>>>>>START GEOPLUGIN CLASS<<<<<<<<<<<<<<<<<<<<<<<
@author geoPlugin (gp_support@geoplugin.com)
@copyright Copyright geoPlugin (gp_support@geoplugin.com)
$version 1.01

This PHP class uses the PHP Webservice of http://www.geoplugin.com/ to geolocate IP addresses. Geographical location of the IP address (visitor) and locate currency (symbol, code and exchange rate) are returned. See http://www.geoplugin.com/webservices/php for more specific details of this free service
*/


class geoPlugin {
	
	//the geoPlugin server
	var $host = 'http://www.geoplugin.net/php.gp?ip={IP}&base_currency={CURRENCY}';
		
	//the default base currency
	var $currency = 'USD';
	
	//initiate the geoPlugin vars
	var $ip = null;
	var $city = null;
	var $region = null;
	var $areaCode = null;
	var $dmaCode = null;
	var $countryCode = null;
	var $countryName = null;
	var $continentCode = null;
	var $latitute = null;
	var $longitude = null;
	var $currencyCode = null;
	var $currencySymbol = null;
	var $currencyConverter = null;
	
	function geoPlugin() {

	}
	
	function locate($ip = null) {
		
		global $_SERVER;
		
		if ( is_null( $ip ) ) {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		
		$host = str_replace( '{IP}', $ip, $this->host );
		$host = str_replace( '{CURRENCY}', $this->currency, $host );
		
		$data = array();
		
		$response = $this->fetch($host);
		
		$data = unserialize($response);
		
		//set the geoPlugin vars
		$this->ip = $ip;
		$this->city = $data['geoplugin_city'];
		$this->region = $data['geoplugin_region'];
		$this->areaCode = $data['geoplugin_areaCode'];
		$this->dmaCode = $data['geoplugin_dmaCode'];
		$this->countryCode = $data['geoplugin_countryCode'];
		$this->countryName = $data['geoplugin_countryName'];
		$this->continentCode = $data['geoplugin_continentCode'];
		$this->latitude = $data['geoplugin_latitude'];
		$this->longitude = $data['geoplugin_longitude'];
		$this->currencyCode = $data['geoplugin_currencyCode'];
		$this->currencySymbol = $data['geoplugin_currencySymbol'];
		$this->currencyConverter = $data['geoplugin_currencyConverter'];
		
	}
	
	function fetch($host) {

		if ( function_exists('curl_init') ) {
						
			//use cURL to fetch data
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $host);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_USERAGENT, 'geoPlugin PHP Class v1.0');
			$response = curl_exec($ch);
			curl_close ($ch);
			
		} else if ( ini_get('allow_url_fopen') ) {
			
			//fall back to fopen()
			$response = file_get_contents($host, 'r');
			
		} else {

			trigger_error ('geoPlugin class Error: Cannot retrieve data. Either compile PHP with cURL support or enable allow_url_fopen in php.ini ', E_USER_ERROR);
			return;
		
		}
		
		return $response;
	}
	
	function convert($amount, $float=2, $symbol=true) {
		
		//easily convert amounts to geolocated currency.
		if ( !is_numeric($this->currencyConverter) || $this->currencyConverter == 0 ) {
			trigger_error('geoPlugin class Notice: currencyConverter has no value.', E_USER_NOTICE);
			return $amount;
		}
		if ( !is_numeric($amount) ) {
			trigger_error ('geoPlugin class Warning: The amount passed to geoPlugin::convert is not numeric.', E_USER_WARNING);
			return $amount;
		}
		if ( $symbol === true ) {
			return $this->currencySymbol . round( ($amount * $this->currencyConverter), $float );
		} else {
			return round( ($amount * $this->currencyConverter), $float );
		}
	}
	
	function nearby($radius=10, $limit=null) {

		if ( !is_numeric($this->latitude) || !is_numeric($this->longitude) ) {
			trigger_error ('geoPlugin class Warning: Incorrect latitude or longitude values.', E_USER_NOTICE);
			return array( array() );
		}
		
		$host = "http://www.geoplugin.net/extras/nearby.gp?lat=" . $this->latitude . "&long=" . $this->longitude . "&radius={$radius}";
		
		if ( is_numeric($limit) )
			$host .= "&limit={$limit}";
			
		return unserialize( $this->fetch($host) );

	}

	
}