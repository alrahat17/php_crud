<?php

require_once 'dbconfig.php';
session_start();
if (!isset ($_SESSION['teacher'])) {
  header('Location:login.php');
  exit();
    # code...
}
  error_reporting( ~E_NOTICE ); // avoid notice

  $nameError = $genderError =  $emailError = $classError = $sectionError = $rollError  =$hobbyError=$courseError="";

  
      // On submitting form below function will execute.
  if(isset($_POST['submit'])){

      // echo '<pre>';print_r($_FILES);die;

    if (empty($_POST["user_name"])) {
      $nameError = "Name is required";
    } else {
      $user_name = test_input($_POST["user_name"]);
  // check name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$user_name)) {
        $nameError = "Only letters and white space allowed";
      }
    }
    if(empty($_POST["user_gender"])){
      $genderError = "Gender required";
    }
    else{
      $user_gender = $_POST['user_gender'];
    }




    if (empty($_POST["user_email"])) {
      $emailError = "Email is required";
    } 

    $email_pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
    preg_match($email_pattern, $_POST["user_email"], $email_matches);
    if(!$email_matches[0] && !empty($_POST["user_email"])) {
      $emailError = "Must be of valid email format";     
    }

    $check_user_email = $_POST['user_email'];
    $email_check="SELECT * FROM tbl_test where user_email = '$check_user_email'";
    $result=$conn->query($email_check);
    $email_count=$result->num_rows;

    if($email_count>=1) {
     $emailError = "This email is  already used.Try another email";
   }
   else{
    $user_email = test_input($_POST["user_email"]);
  }





  if(empty($_POST["user_class"])){
    $classError = "Class required";
  }
  else{
    $user_class = $_POST['user_class'];
  }
  if(empty($_POST["user_section"])){
    $sectionError = "Section required";
  }
  else{
    $user_section = $_POST['user_section'];
  }
  if(empty($_POST["user_roll"])){
    $rollError = "Roll required";
  }
  else{
    $user_roll = $_POST['user_roll'];
  }
  

  // }
  
  if (isset($_POST['user_hobby'])){
    $hobbies = array();
    $hobbies = $_POST['user_hobby'];
    $values=implode(",", $hobbies);
  }
  else{
    $hobbyError = "At least one hobby required";
  }

  if (isset($_POST['user_course'])){
    $courses = array();
    $courses = $_POST['user_course'];
    $course_values=implode(",", $courses);
    
  } 
  else{
    $courseError = "At least one course required";
  } 

  if (isset($_FILES['user_photo']) && !empty($_FILES['user_photo']['name'])) {

    $upload_dir ="images";
    $thum_dir= "thumbnails";
    $img =   $_FILES["user_photo"]["name"];  
    //$temp = explode(".", $_FILES["user_photo"]["name"]);
    //$file_name = $temp[0].'_'.time();
    //$file_ext = $temp[1];
    //$img = $file_name . '.' . $file_ext;



    $orgfile = $_FILES["user_photo"]["tmp_name"];
    list($width,$height)= getimagesize($orgfile);
    $newfile = imagecreatefromjpeg($orgfile);
    $newwidth = "150";
    $newheight = "100";
    $thum = $_FILES["user_photo"]["name"];

    


 
    $truecolor = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($truecolor, $newfile, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagejpeg($truecolor,$thum,100);


    copy($_FILES['user_photo']['tmp_name'], "$upload_dir/$img");
    copy($_FILES['user_photo']['name'], "$thum_dir/$thum");
  



  }
  else{
    $imageError = "Please upload a photo";
  }


  if ($nameError==""||$genderError==""||$emailError==""||$classError==""||$sectionError==""||$rollError==""||$genderError==""||$hobbyError==""||$courseError==""||$imageError=="") {

    $stmt = $conn->prepare("INSERT INTO tbl_test(user_name,user_gender,user_email,user_class,user_section,user_roll,user_hobby,user_course,user_photo) VALUES(?,?,?,?,?,?,?,?,?)");
    $stmt->bind_param("sssssssss",$user_name,$user_gender,$user_email,$user_class,$user_section,$user_roll,$values,$course_values,$img);
    if($stmt->execute())
    {
      
      $successMSG = "new record succesfully inserted ...";
        header("refresh:2;all_user.php"); // redirects image view page after 5 seconds.
      }
      else
      {
        $errMSG = "new record not inserted ...";
      }
    }

  }
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
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

    <!-- Inline CSS based on choices in "Settings" tab -->
    <style>
    .bootstrap-iso .formden_header h2, .bootstrap-iso .formden_header p, .bootstrap-iso form{font-family: Arial, Helvetica, sans-serif; color: black}.bootstrap-iso form button, .bootstrap-iso form button:hover{color: white !important;}.bootstrap-iso .form-control:focus { border-color: #1e90ff; -webkit-box-shadow: none; box-shadow: none;} .bootstrap-iso .has-error .form-control:focus{-webkit-box-shadow: none; box-shadow: none;} .asteriskField{color: red;}.bootstrap-iso form .input-group-addon {color:#555555; background-color: #fbfbfb; border-radius: 4px; padding-left:12px}
  </style>


</head>

<body>


  <div class="bootstrap-iso">

    <div class="container-fluid ">

      <div class="row">
        <input type="button" class="btn btn-lg btn-primary" onclick="location.href='all_user.php';" value="All Student" />
        <input type="button" class="btn btn-lg btn-warning" onclick="location.href='logout.php';" value="Log Out" />
        <div class="col-md-6 col-sm-6 col-xs-12">
          <form method="post" enctype="multipart/form-data">
           <div class="form-group ">
            <br><br>
            <h4><center>Add New Student</center></h4>

            <label class="control-label requiredField" for="user_name">
             User Name
           </label>
           <input class="form-control" id="user_name" name="user_name" type="text"  value="<?php echo $user_name; ?>">
           <span class="error" style="color: red;"><?php echo $nameError;?></span>
         </div> 
         <div class="form-group ">
          <label class="control-label requiredField" for="user_gender">
            Gender
          </label><br>         
          <input type="radio" name="user_gender" <?php if (isset($user_gender) && $user_gender=="male") echo "checked";?> value="male">Male<br>
          <input type="radio" name="user_gender" <?php if (isset($user_gender) && $user_gender=="female") echo "checked";?> value="female">Female<br>
          <input type="radio" name="user_gender" <?php if (isset($user_gender) && $user_gender=="other") echo "checked";?> value="other">Other<br>
          <span class="error" style="color: red;"><?php echo $genderError;?></span>
        </div>   

        <div class="form-group ">
          <label class="control-label requiredField" for="user_email">
           Email
         </label>
         <input class="form-control" id="user_email" name="user_email" type="email"  value="<?php echo $user_email; ?>"/>
         <span class="error" style="color: red;"><?php echo $emailError;?></span>
       </div>
       <div class="form-group ">
        <label class="control-label requiredField" for="user_class">
         Class
       </label>
       <input class="form-control" id="user_class" name="user_class" type="number" value="<?php echo $user_class; ?>"/>
       <span class="error"style="color: red;"><?php echo $classError;?></span>
     </div>
     <div class="form-group ">
      <label class="control-label requiredField" for="user_section">
       Section
     </label>
     <input class="form-control" id="user_section" name="user_section" type="text" value="<?php echo $user_section; ?>"/>
     <span class="error" style="color: red;"><?php echo $sectionError;?></span>
   </div>
   <div class="form-group ">
    <label class="control-label requiredField" for="user_roll">
     Roll
   </label>
   <input class="form-control" id="user_roll" name="user_roll" type="number" value="<?php echo $user_roll; ?>"/>
   <span class="error" style="color: red;"><?php echo $rollError;?></span>
 </div>
 <div class="form-group ">
  <label class="control-label requiredField" for="user_hobby" >
   Hobby
 </label> <br>  
 <input type="checkbox" id="user_hobby" name="user_hobby[]" <?php if (isset($_POST['user_hobby']) && in_array("Reading", $hobbies)) echo "checked";?> value="Reading">Reading<br>
 <input type="checkbox" id="user_hobby" name="user_hobby[]" <?php if (isset($_POST['user_hobby']) && in_array("Singing", $hobbies)) echo "checked";?> value="Singing">Singing<br> 
 <input type="checkbox" id="user_hobby" name="user_hobby[]" <?php if (isset($_POST['user_hobby']) && in_array("Debating", $hobbies)) echo "checked";?> value="Debating">Debating<br>
 <span class="error" style="color: red;"><?php echo $hobbyError;?></span>  
</div>
<div class="form-group">
  <label class="control-label requiredField" for="user_course">
   Courses
 </label> <br> 
 <select class="select form-control" name="user_course[]" id="user_course" required="" multiple>
  <option value="Bangla" <?php if (isset($_POST['user_course']) && in_array("Bangla", $courses)) echo "selected";?> >Bangla</option>
  <option value="English" <?php if (isset($_POST['user_course']) && in_array("English", $courses)) echo "selected";?> >English</option>
  <option value="Physics" <?php if (isset($_POST['user_course']) && in_array("Physics", $courses)) echo "selected";?> >Physics</option>
  <option value="Chemistry" <?php if (isset($_POST['user_course']) && in_array("Chemistry", $courses)) echo "selected";?> >Chemistry</option>
  <option value="Math" <?php if (isset($user_course) && in_array("Math", $courses)) echo "selected";?> >Math</option>
</select>
<span class="error" style="color: red;"><?php echo $courseError;?></span>    
</div>

<div class="form-group ">
  <label class="control-label requiredField" for="user_photo">
   Photo
 </label>
 <input class="form-control" type="file" name="user_photo" id="user_photo" required="">
 <span class="error" style="color: red;"><?php echo $imageError;?></span>
</div>




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





</body>

</html>


