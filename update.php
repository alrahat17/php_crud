<?php


error_reporting( ~E_NOTICE ); 
require_once 'dbconfig.php';


$edit_user_id = $_GET['edit'];

  $sql_edit="SELECT * FROM tbl_test WHERE user_id = '$edit_user_id'";
$result=$conn->query($sql_edit);
$count = mysqli_num_rows($result);
if ($count==0) {
   echo "No data found";
   header('Refresh:1;all_user.php');
}



if(isset($_POST['submit']))
{
  
  $user_name = $_POST['user_name'];
  $user_gender = $_POST['user_gender'];
  $user_email = $_POST['user_email'];
  $user_class = $_POST['user_class'];
  $user_section = $_POST['user_section'];
  $user_roll = $_POST['user_roll']; 

  $hobbies = array();
  $hobbies = $_POST['user_hobby'];
  $values=implode(",", $hobbies); 

  $courses = array();
  $courses = $_POST['user_course'];
  $course_values=implode(",", $courses);  


  if (isset($_FILES['user_photo']['name']) && !empty($_FILES['user_photo']['name'])) {

  
    $upload_dir ="images";
    $temp = explode(".", $_FILES["user_photo"]["name"]);
    $file_name=$temp[0]. '_'.time();
    $file_ext=$temp[1];
    $img=$file_name . '.' . $file_ext;

    copy($_FILES['user_photo']['tmp_name'], "$upload_dir/$img");

     // $img_sql = "UPDATE tbl_test SET user_photo='$img' WHERE user_id = '$edit_user_id'";
     // $img_edited = $conn->query($img_sql);
  }
  else{
      $img = $_POST['user_old_photo']; 
  }
  


  if(!isset($errMSG))
  {
    

    $stmt= "UPDATE tbl_test  SET user_name='$user_name',user_gender='$user_gender',user_email='$user_email',user_class='$user_class',user_section='$user_section',user_roll='$user_roll',user_hobby='$values',user_course='$course_values',user_photo='$img' WHERE user_id = '$edit_user_id'";
    $user_edited=$conn->query($stmt);


    if($user_edited)
    {
      $successMSG = "record succesfully edited ...";
    
        header("refresh:2;all_user.php"); // redirects image view page after 5 seconds.
      }
      else
      {
        $error = $conn->errno . ' ' . $conn->error;
        echo $error; 
      }
    }
  }

  ?>





  <!DOCTYPE html>
  <html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>addnewstudent</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">



    <!-- Special version of Bootstrap that only affects content wrapped in .bootstrap-iso -->
    <link rel="stylesheet" href="https://formden.com/static/cdn/bootstrap-iso16.css" /> 

    <!--Font Awesome (added because you use icons in your prepend/append)-->
    <link rel="stylesheet" href="https://formden.com/static/cdn/font-awesome/4.4.0/css/font-awesome.min.css" />




  </head>

  <body>


    <div class="bootstrap-iso">

     <?php
     if(isset($errMSG))
     {
      ?>
      <div class="alert alert-danger">
        <span class="fa fa-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
      </div>
      <?php
    }
    else if(isset($successMSG))
    {
      ?>
      <div class="alert alert-success">
        <strong><span class="fa fa-info-sign"></span> <?php echo $successMSG; ?></strong>
      </div>
      <?php
    }
    ?>   

    <div class="container-fluid">

      <div class="row">
       <div class="col-md-6 col-sm-6 col-xs-12">
        <form method="post" enctype="multipart/form-data"s>
         <div class="form-group ">
          <br><br>
          <?php
          while($row=$result->fetch_assoc()){
            ?>


            <label class="control-label requiredField" for="user_name">
             User Name
             
          </label>
          <input class="form-control" id="user_name" name="user_name" type="text" required="" value="<?php echo $row['user_name']; ?>">
        </div>

        <div class="form-group ">
          <label class="control-label requiredField" for="user_gender">
            Gender
          </label><br> 
          <input type="radio" name="user_gender" <?php if ($row["user_gender"]=='male') {
           echo "checked";}?> value="male">Male<br>
           <input type="radio" name="user_gender" <?php if ($row["user_gender"]=='female') {
             echo "checked";}?> value="female">Female<br>         
           </div>   


           <div class="form-group ">
            <label class="control-label requiredField" for="user_email">
             Email
             
          </label>
          <input class="form-control" id="user_email" name="user_email" type="email" value="<?php echo $row['user_email']; ?>"/>
        </div>
        <div class="form-group ">
          <label class="control-label requiredField" for="user_class">
           Class
           
        </label>
        <input class="form-control" id="user_class" name="user_class" type="text" value="<?php echo $row['user_class']; ?>"/>
      </div>
      <div class="form-group ">
        <label class="control-label requiredField" for="user_section">
         Section
        
      </label>
      <input class="form-control" id="user_section" name="user_section" type="text" value="<?php echo $row['user_section']; ?>"/>
    </div>
    <div class="form-group ">
      <label class="control-label requiredField" for="user_roll">
       Roll
       
    </label>


    <input class="form-control" id="user_roll" name="user_roll" type="text" value="<?php echo $row['user_roll']; ?>"/>
  </div>
  <?php

  $hobbies_to_edit = $row['user_hobby']; 
  $hobby_edit_values=explode(",",$hobbies_to_edit );
  ?>
  <div class="form-group ">
  <label class="control-label requiredField" for="user_hobby">
   Hobby
 </label> <br>  
 <input type="checkbox" id="user_hobby" name="user_hobby[]" <?php if (in_array("Reading", $hobby_edit_values)) {
    echo "checked";} ?> value="Reading">Reading<br>
 <input type="checkbox" id="user_hobby" name="user_hobby[]" <?php if (in_array("Singing", $hobby_edit_values)) {
    echo "checked";} ?> value="Singing">Singing<br> 
 <input type="checkbox" id="user_hobby" name="user_hobby[]" <?php if (in_array("Debating", $hobby_edit_values)) {
    echo "checked";} ?> value="Debating">Debating<br>  
</div>

<?php

  $courses_to_edit = $row['user_course']; 
  $course_edit_values=explode(",",$courses_to_edit );
  ?>

<div class="form-group">
  <label class="control-label requiredField" for="user_course">
   Courses
 </label> <br> 
  <select class="select form-control" name="user_course[]" id="user_course" multiple>
  <option value="Bangla" <?php if (in_array("Bangla", $course_edit_values)) {
    echo "selected";} ?>>Bangla</option>
  <option value="English" <?php if (in_array("English", $course_edit_values)) {
    echo "selected";} ?>>English</option>
  <option value="Physics" <?php if (in_array("Physics", $course_edit_values)) {
    echo "selected";} ?>>Physics</option>
  <option value="Chemistry" <?php if (in_array("Chemistry", $course_edit_values)) {
    echo "selected";} ?>>Chemistry</option>
  <option value="Math" <?php if (in_array("Math", $course_edit_values)) {
    echo "selected";} ?>>Math</option>
</select>  
</div>

<div class="form-group ">
      <label class="control-label requiredField" for="user_photo">
       Photo
     </label><br>
  <img src="images/<?php echo $row['user_photo'];?>" style="width:128px;height:128px"><br><br>
  <input class="form-control" type="file" name="user_photo" id="user_photo"> 
  <input class="form-control" type="hidden" name="user_old_photo" value="<?php echo $row['user_photo'];?>"> 
  

</div> 




<?php 
}

?>




<div class="form-group">
  <div>
   <button class="btn btn-primary " name="submit" type="submit">
    Submit
  </button>
</div>
</div>
</form>
</div>
</div>

</div>

</div>




<!-- Bootstrap core JavaScript -->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Extra JavaScript/CSS added manually in "Settings" tab -->
<!-- Include jQuery -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>





</body>

</html>
