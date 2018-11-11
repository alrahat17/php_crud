<?php
	
 	session_start();

 	if (isset ($_SESSION['teacher'])) {
	header('Location:all_user.php');
	
}


 	include_once "dbconfig.php";

 	if(isset($_POST['submit']))
	{
		unset( $_SESSION['errorMessage'] );
		$teacher_name=$_POST['teacher_name']; 
  	 	$teacher_password=md5($_POST['teacher_password']);

 	 	
 	 	$error=false;

 	 	

 	 	if(!$error)
 	 	{
 	 		$sql = $conn->query("SELECT * FROM tbl_teacher WHERE (teacher_name='$teacher_name' AND teacher_password='$teacher_password') OR (teacher_email='$teacher_name' AND teacher_password='$teacher_password')");
 	 		//print_r($_POST);
 	 		$count=$sql->num_rows;
 	 		


 	 		if($count==1)
 	 		{
 	 			$_SESSION['teacher']=$teacher_name;
 	 			header("Location:all_user.php");

 	 		}
 	 		else{
 	 			$_SESSION['errorMessage'] = 1;
 	 			header("Location:login.php");
 	 			
 	 				 				 			
 	 		}	 		

 	 	}
 	 } 
 ?>

