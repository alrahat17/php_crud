<?php

include_once "dbconfig.php";
error_reporting( ~E_NOTICE ); // avoid notice
session_start();
$search_key = $_SESSION['search_p'];


if (!isset ($_SESSION['teacher'])) {
	header('Location:login.php');
	exit();
  	# code...
}



if(!empty($_SESSION['search_p'])){
$search_query = mysqli_query($conn,"SELECT * FROM tbl_test WHERE user_name LIKE '$search_key%' ");
$search_count=mysqli_num_rows($search_query);
$search_results_per_page = 2;
$number_of_search_pages = ceil($search_count/$search_results_per_page);


if (!isset($_GET['search_page'])) {
	$search_page=1;
}
else{
	$search_page =$_GET['search_page'];
}
$first_search_result=($search_page-1)* $search_results_per_page;
$paginated="SELECT * FROM tbl_test WHERE user_name LIKE '$search_key%' LIMIT ". $first_search_result . ',' . $search_results_per_page;
$paginated_search_result = $conn->query($paginated);

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
	<script src="jquery-3.3.1.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
</head>
<body>

	<div class="container">
		<center>
			<h3>Welcome</3>
				<p><?php echo $_SESSION['teacher']; ?></p>
				<h4>Search completed for: <?php echo $_SESSION['search_p'];?></h4>
				<h4>Total Result Found: <?php echo $search_count  ?></h4>
				<input type="button" class="btn btn-lg btn-success" onclick="location.href='all_user.php';" value="All User" />
				<input type="button" class="btn btn-lg btn-primary" onclick="location.href='reg.php';" value="Add new" />
				<input type="button" class="btn btn-lg btn-warning" onclick="location.href='logout.php';" value="Log Out" />
			</div>


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



				while($row=$paginated_search_result->fetch_array()){         
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

	for ($search_page=1; $search_page <=$number_of_search_pages ; $search_page++) { 
		echo '<ul class="pagination"><li><a href="user_search.php?search_page=' . $search_page .'">' . $search_page . '</a></li></ul>';
	}

	?>


</body>
</html>




