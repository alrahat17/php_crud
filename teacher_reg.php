<?php

require_once 'dbconfig.php';

  error_reporting( ~E_NOTICE ); // avoid notice

  $nameError = $emailError = $classError = $sectionError = $idError = $passwordError ="";

      // On submitting form below function will execute.
  if(isset($_POST['submit'])){

    if (empty($_POST["teacher_name"])) {
      $nameError = "Name is required";
    } else {
      $teacher_name = test_input($_POST["teacher_name"]);
  // check name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z ]*$/",$teacher_name)) {
        $nameError = "Only letters and white space allowed";
      }
    }

    if (empty($_POST["teacher_email"])) {
      $emailError = "Email is required";
    } 

    $email_pattern = '/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/';
    preg_match($email_pattern, $_POST["teacher_email"], $email_matches);
    if(!$email_matches[0]) {
      $emailError = "Must be of valid email format";     
    }

    else{
      $teacher_email = test_input($_POST["teacher_email"]);
    }

    if(empty($_POST["teacher_id_card_no"])){
      $idError = "ID required";
    }
    else{
      $teacher_id_card_no = $_POST['teacher_id_card_no'];
    }
    if(empty($_POST["teacher_password"])){
      $PasswordError = "Password required";
    }
    else{
      $teacher_password = md5($_POST['teacher_password']);
      
    }

    if ($nameError==""||$emailError==""||$idError==""||$PasswordError=="") {

      $stmt = $conn->prepare("INSERT INTO tbl_teacher(teacher_name,teacher_email,teacher_id_card_no,teacher_password) VALUES(?,?,?,?)");
      $stmt->bind_param("ssss",$teacher_name,$teacher_email,$teacher_id_card_no,$teacher_password);
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

    <title>teacher_reg</title>

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
       <div class="col-md-6 col-sm-6 col-xs-12">
        <form method="post">
         <div class="form-group ">
          <br><br>
          <h4><center>Teacher Registration</center></h4>

          <label class="control-label requiredField" for="teacher_name">
           Teacher Name
         </label>
         <input class="form-control" id="teacher_name" name="teacher_name" type="text"  value="<?php echo $teacher_name; ?>">
         <span class="error" style="color: red;"><?php echo $nameError;?></span>
       </div>    

       <div class="form-group ">
        <label class="control-label requiredField" for="teacher_email">
         Email
       </label>
       <input class="form-control" id="teacher_email" name="teacher_email" type="email"  value="<?php echo $teacher_email; ?>"/>
       <span class="error" style="color: red;"><?php echo $emailError;?></span>
     </div>
     
 <div class="form-group ">
  <label class="control-label requiredField" for="teacher_id_card_no">
   ID card no
 </label>
 <input class="form-control" id="teacher_id_card_no" name="teacher_id_card_no" type="number" value="<?php echo $teacher_id_card_no; ?>"/>
 <span class="error" style="color: red;"><?php echo $idError;?></span>
</div>


<div class="form-group ">
  <label class="control-label requiredField" for="teacher_password">
   Password
 </label>
 <input class="form-control" id="teacher_password" name="teacher_password" type="password" value="<?php echo $teacher_password; ?>"/>
 <span class="error" style="color: red;"><?php echo $PasswordError;?></span>
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


