<?php

include_once "dbconfig.php";
error_reporting( ~E_NOTICE ); // avoid notice
session_start();
if (!isset ($_SESSION['teacher'])) {
	header('Location:login.php');
	exit();
  	# code...
}


$sql="SELECT * FROM tbl_test  ORDER BY user_id DESC";
$result=$conn->query($sql);
$total_students=mysqli_num_rows($result);
$results_per_page = 2;
$number_of_pages = ceil($total_students/$results_per_page);


if (!isset($_GET['page'])) {
	$page=1;
}
else{
	$page =$_GET['page'];
}
$first_result=($page-1)* $results_per_page;
$paginated_sql="SELECT * FROM tbl_test ORDER BY user_id DESC LIMIT ". $first_result . ',' . $results_per_page;
$paginated_result = $conn->query($paginated_sql);


$output = '';

if(isset($_POST['search'])) {
  	//return alert('button pressed');
	$search = $_POST['search'];
	$search = preg_replace("#[^0-9a-z]i#","", $search);

	$search_query = mysqli_query($conn,"SELECT * FROM tbl_test WHERE user_name LIKE '$search' ") or die ("Could not search");
    //$search_result = $conn->query($search_query);
	$search_count=mysqli_num_rows($search_query);


	if($search_count == 0){
		$output = "There was no search results!";

	}else{


		while ($row = mysqli_fetch_assoc($search_query)) {

			$user_name = $row ['user_name'];
			$user_email = $row ['user_email'];
			$output .='<div>Name: '.$user_name.'<br>Email:'.$user_email.'</div>';

		}

	}
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>allstudent</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>




	<div class="container">
		<center>
			<h3>Welcome</3>
				<p><?php echo $_SESSION['teacher']; ?></p>
				
				<input type="button" class="btn btn-lg btn-primary" onclick="location.href='reg.php';" value="Add new" />
				<input type="button" class="btn btn-lg btn-warning" onclick="location.href='logout.php';" value="Log Out" />
				
				<h3>All Students</h3>
				<form action ="all_user.php" method = "post">

					<input name="search" id="search" type="text" size="30" placeholder="Search"/>

					<input type="submit" value="Search"/>

				</form> 

				<?php print ("$output");?>

				
				
			</center>
			
			<table class="table">
				<thead>
					<tr>
						
						<th>Name</th>
						<th>Gender</th>
						<th>Email</th>
						<th>Class</th>
						<th>Section</th>
						<th>Roll</th>
						<th>Hobby</th>
						<th>Course</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
				</thead>

				<tbody>

					<?php



					while($row=$paginated_result->fetch_assoc()){         
						?>  

						<tr>
							
							<td><?php echo $row['user_name'];?></td>
							<td><?php echo $row['user_gender'];?></td>
							<td><?php echo $row['user_email'];?></td>
							<td><?php echo $row['user_class'];?></td>
							<td><?php echo $row['user_section'];?></td>
							<td><?php echo $row['user_roll'];?></td>
							<td><?php echo $row['user_hobby'];?></td>
							<td><?php echo $row['user_course'];?></td>

							<td><a  href="images/<?php echo $row['user_photo'];?>">
  							<img src="thumbnails/<?php echo $row['user_photo'];?>" alt="Forest" style="width:150px">
							</a></td>

							
							<td>
								<a href="all_user.php?delete=<?php echo $row['user_id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
								<a href="update.php?edit=<?php echo $row['user_id']; ?>">Edit</a> 
							</td>


						</tr>
						<?php
					}

					if (isset($_GET['delete'])) {
						$delete_user_id = $_GET['delete'];

						$sql_del="DELETE FROM tbl_test WHERE user_id = '$delete_user_id' ";
						$result=$conn->query($sql_del);
						header("refresh:1;all_user.php");

					}

					if (isset($_GET['edit'])) {
						$edit_user_id = $_GET['edit'];

						$sql_edit="SELECT * FROM tbl_test WHERE user_id = '$edit_user_id' ";
						$result=$conn->query($sql_edit);
						header('reg.php');



					}


					?>

				</tbody>
			</table>
		</div>


		<?php 

		for ($page=1; $page <=$number_of_pages ; $page++) { 
			echo '<ul class="pagination"><li><a href="all_user.php?page=' . $page .'">' . $page . '</a></li></ul>';
		}



		?>


	</body>
	</html>
