<?php
	
	define("host", "localhost");
	define("dbname", "student");
	define("user", "root");
	define("pass", "");

	$conn=new MySQLi(host,user,pass,dbname);

	if($conn->connect_errno)
	{
		die("Error: ->".$conn->connect_error);
	}
?>	