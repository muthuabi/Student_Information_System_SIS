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
    // mysqli_report(MYSQLI_REPORT_ERROR);
    include_once("../Connection/connection.php");
    ?>
    <?php include_once("navbar.php"); ?>
<div class="container">
<!-- <a class="btn btn-dark" href="dashboard.php">Go to Dashboard</a>  -->
<form action="" method="post">
<div class="form-group">
    <label for="">Department Name</label>
    <input type="text" maxlength="30" placeholder="BSC COMPUTER SCIENCE" pattern="^[A-Za-z ]*$"  required name="DName" class="form-control">
</div>
<div class="form-group">
    <label for="">HOD Name</label>
    <input type="text" maxlength="30" placeholder="Enter HOD name" pattern="^[A-Z][a-z A-Z.]*$" name="Head" id="" class='form-control'>
</div>
<div class="form-group">
<label for=""> HOD Contact No:</label>
<input type="tel" maxlength=10 required placeholder="Enter contact number" minlength=10 pattern="^[0-9]*$"  name="HeadNo" class="form-control">
</div>
<div class="form-group">
    <label for="">HOD Mail</label>
    <input type="email" required placeholder="example123@gmail.com" name="HeadMail" class="form-control">
</div>
<div class="form-group">
    <label for="">Started</label>
    <input type="date" name="Started" required max="<?php  echo date('Y-m-d'); ?>"  id="" class="form-control">
</div>
<div class="form-group">
    <label for="">
        College Name
</label>
<select name="CID" id="" class="form-control">
    <?php
    $qry="SELECT CID,CollegeName from college";
    if($res1=mysqli_query($conn,$qry))
    {   
        while($result1=mysqli_fetch_assoc($res1))
        {
            $cid=$result1['CID'];
            $cname=$result1['CollegeName'];
            echo "<option value='$cid' >$cname</option>";
        }
    }
    ?>
    </select>
</div>
<button type="submit" name="Create" class="btn btn-primary btn btn-block">Create</button>
<br>
<br>
<?php
if(isset($_POST['Create']))
{
    $cid=$_POST['CID'];
    $dname=$_POST['DName'];
    $head=$_POST['Head'];
    $started=$_POST['Started'];
    $headno=$_POST['HeadNo'];
    $headmail=$_POST['HeadMail'];
    $qry="INSERT INTO department(DName,Head,Started,HeadNo,HeadMail,CID) Values('$dname','$head','$started',$headno,'$headmail',$cid)";
      if(mysqli_query($conn,$qry))
      {
        echo "<script>alert('Created Succesfully');</script>";
        echo "<script> window.location.href='DepartmentList.php'</script>";
      }
      else
      {
        echo "<script>alert('Creation Failed');</script>";

      }
}
?>
</form>
</body>
</html>