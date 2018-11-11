<?php
 
  session_start();
  if (!isset ($_SESSION['user'])) {
  	header('Location:login.php');
  	exit();
  	# code...
  }

  
?>

<!DOCTYPE html>
<body>
<center>
<h2>You are logged in</h2>

				
<p>Hello</p>
<p><?php echo $_SESSION['user']; ?></p>

<a href="logout.php">Logout</a>
	
</center>

</body>
</html>
