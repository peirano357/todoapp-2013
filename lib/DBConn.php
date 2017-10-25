<?

function connectToDB() 
{
    global $db_host;
	global $db_user;
	global $db_pwd;
	global $db_name;
	
	$link = mysql_connect ($db_host, $db_user, $db_pwd);
   
   //$link = mysql_connect ($db_host, $db_user, $db_pwd);
    if (!$link) {
        // we should have connected, but if any of the above parameters
        // are incorrect or we can't access the DB for some reason,
        // then we will stop execution here
        die('Could not connect: ' . mysql_error());
    }

    $db_selected = mysql_select_db($db_name);
    if (!$db_selected) {
        die ('Can\'t use database : ' . mysql_error());
    }
   
	return $link;
}
?>
