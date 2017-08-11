<?php 

	$db = mysqli_connect('localhost', '9279834aa847', 'abc18b3122ba48ed', 'balafilmsdb'); //nombrehost,user,password,databasetoconnect
	if(mysqli_connect_errno())
	{
		echo 'Failed to connect to MySQL: '.mysqli_connect_error();
	}

 ?>