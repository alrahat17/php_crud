
<?php 

include_once "dbconfig.php";
error_reporting( ~E_NOTICE ); // avoid notice
session_start();
if (!isset ($_SESSION['teacher'])) {
	header('Location:login.php');
	exit();
  	# code...
}
$user_pro_id = $_GET['profile'];

$sql_profile = mysqli_query($conn,"SELECT * FROM tbl_test WHERE user_id = '$user_pro_id'");

 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>singleprofile</title>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="jquery-3.3.1.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
 </head>
 <body>
    

 	<input type="button" class="btn btn-lg btn-default" onclick="location.href='all_user.php';" value="Go Back" />
 	<?php 
 	while ($row = mysqli_fetch_assoc($sql_profile)) {

 		?>
 		<center>

 		<ul>
 		<img style="width:400px;height:400px;" src="images/<?php echo $row['user_photo'];?>">
 		<li>Name: <?php echo $row['user_name'];?></li>
 		<li>Email: <?php echo $row['user_email'];?></li>
 		<li>Gender: <?php echo $row['user_gender'];?></li>
 		<li>Class: <?php echo $row['user_class'];?></li>
 		<li>Section: <?php echo $row['user_section'];?></li>
 		<li>Roll: <?php echo $row['user_roll'];?></li>
 		<li>Hobby: <?php echo $row['user_hobby'];?></li>
 		<li>Course: <?php echo $row['user_course'];?></li>
 		<ul>	
 		</center>
 		
 	<?php 
 	}

 	 ?>
 	<div>
 		
 	</div>
 
 </body>
 </html>