<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
</head>
<body>
    <?php 
    mysqli_report(MYSQLI_REPORT_ERROR);
    include_once("../Connection/connection.php");
    ?>
    <?php include_once("navbar.php"); ?>
<div class="container">
<!-- <a class="btn btn-dark" href="dashboard.php">Go to Dashboard</a>  -->
<form action="" method="post">

<div class="form-group">
    <label for="">CollegeName</label>
    <input type="text" name="CollegeName" required placeholder="Enter your college name" maxlength="30" pattern="^[A-Za-z' ]*$"  id="" class="form-control">
    <li>Name should not contain '.' ',' or any other symbols</li>
</div>
<div class="form-group">
    <label for="">PrincipalName</label>
    <input type="text" name="PrincipalName" required placeholder="Enter your college principal name" maxlength="30" pattern="^[A-Z][a-z A-Z.]*$" id="" class="form-control">
    <li>Name should not contain '.' ',' or any other symbols</li>
</div>
<div class="form-group">
    <label for="">EstablishedDate</label>
    <input type="date" name="EstablishedDate" required id="" max="<?php  echo date('Y-m-d'); ?>"  class="form-control">
    <li>Enter date correctly and carefully</li>
</div>
<div class="form-group">
    <label for="">ContactNumber</label>
    <input type="text" name="ContactNumber" required placeholder="Enter your college contact number" maxlength=10 required  minlength=10 pattern="^[6-9]{1}[0-9]{9}$"  id="" class="form-control">

    <li>Phone Number should of Indian Standard</li>
</div>
<div class="form-group">
  <label for="">ContactMail</label>
  <input type="email" name="ContactMail" required placeholder="Eg:example123@gmail.com" id="" class="form-control">
  <li>Enter email correctly</li>
</div>
<div class="form-group">
    <label for="">CollegeType</label>
    <input type="radio" name="CollegeType" id="" value="Government-Aided" required>
    <label>Government Aided</label>
    <input type="radio" name="CollegeType" id ="" value="Private" required>
    <label>Private</label>
    <input type="radio" name="CollegeType" id ="" value="Government" required>
    <label>Government</label>
</div>
<div class="form-group">
    <label for="">Location</label>
    <textarea name="Location" required id="" class="form-control">
</textarea>
<li>Enter your college location correctly</li>
</div>

<button type="submit" name="Create" class="btn btn-primary btn btn-block">Create</button>
<br>
<br>
<?php
if(isset($_POST['Create']))
{
   $collegename=$_POST['CollegeName'];
   $collegename=mysqli_real_escape_string($conn,$collegename);
   $type=$_POST['CollegeType'];
   $location=$_POST['Location'];
   $location=mysqli_real_escape_string($conn,$location);
   $principal=$_POST['PrincipalName'];
   $contactnumber=$_POST['ContactNumber'];
   $contactmail=$_POST['ContactMail'];
   $established=$_POST['EstablishedDate'];
   try{
    $qry="INSERT INTO college(CollegeName,CollegeType,Location,EstablishedDate,PrincipalName,ContactNumber,ContactMail) VALUES('$collegename','$type','$location','$established','$principal','$contactnumber','$contactmail')";
    if(mysqli_query($conn,$qry))
    {
        echo "<script>alert('Creation Success');</script>";
        echo "<script> window.location.href='CollegeList.php'</script>";
    }
    else
    {
        echo "<script>alert('Creation Failed');</script>";
    }
   }
   catch(Exception $e)
   {
    echo $e->getMessage();
   }
}
?>
</form>
</div>
</body>
</html>