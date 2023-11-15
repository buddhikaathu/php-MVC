<?php
session_start();
if (!isset($HOST_ADDRESS)){
	$_SESSION["HOST_ADDRESS"]="localhost"; 
}
if (!isset($HOST_USER)){
	$_SESSION["HOST_USER"]="root";	
}
if (!isset($HOST_PASSWORD)){
	$_SESSION["HOST_PASSWORD"]="";	
} 
if (!isset($HOST_DATABASE)){
	$_SESSION["HOST_DATABASE"]= "mydb";	
}

if (!isset($HOST_URL)){
	$_SESSION["HOST_URL"]= "http://localhost/";
}
if (!isset($HOST_ADMIN_URL)){
	$_SESSION["HOST_ADMIN_URL"]= "http://localhost/";	
}

if (!isset($PAGE_TITLE)){
	$_SESSION["PAGE_TITLE"]="";
}

if (!isset($BOPAGE_TITLE)){
	$_SESSION["BOPAGE_TITLE"]="";
}

