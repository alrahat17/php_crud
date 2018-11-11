<?php
	
 	session_start();

 	if (isset ($_SESSION['teacher'])) {
	header('Location:all_user.php');


	
	//exit();
  	# code...
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>teacherlogin</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>



<body>
	<div class="container">
		<div class="login-box animated fadeInUp">
		<form method="post" action="logincheck.php">
		<center>
		<div class="box-header">
		<h2>Teacher Log In</h2>
		<?php  

		if(isset($_SESSION['errorMessage'])){
			echo "<span style='color:red;'>Wrong login information</span>";
			header('login.php');
	
		}

			
		?>

		</div>
		
		<label for="teacher_name">Teacher name or Email</label>
		<br/>
		<input type="text" name="teacher_name" value="<?php if(isset($_POST['teacher_name'])) echo $_POST['teacher_name']; ?>">
		<br>
		<label for="teacher_password">Password</label>
		<br/>
		<input type="password" name="teacher_password">
		<br/>
		<br>
		<button type="submit" class="btn btn-primary" name="submit" value="submit">Sign In</button>
		<br/>

		<a href="teacher_reg.php"><p class="small">Want to register?</p></a>
		</div>

		</center>

		</form>
		</div>
		</body>

		</html>



