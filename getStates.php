<?php 

$partialStates = $_POST['partialStates'];
$states = mysqli_query($conn,"SELECT * FROM tbl_test WHERE user_name LIKE '%$partialStates%' ") or die ("Could not search");
while ($state = mysqli_fetch_assoc($states)) {
	echo "<div> ".$state['user_name']."</div>";
	
}
 ?>
