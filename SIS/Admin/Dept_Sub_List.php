<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="MyStyles.css">
    <?php include_once("../Connection/connection.php");
        //mysqli_report(MYSQLI_REPORT_ERROR);
    ?>
</head>
<style>

</style>
<body>
<?php include_once("navbar.php"); ?>
<div class="container" style="display:flex;flex-direction:column;">
<!-- <a class="btn btn-dark" href="dashboard.php">Go to Dashboard</a>  -->

<form action="" method="post">
<div class="form-group">
        <label for="">Department</label>
        <select name="DID" id="" class="form-control">
            <?php
            
                $qry="SELECT * from department inner join college on college.CID=department.CID";
                if($res=mysqli_query($conn,$qry))
                {
                    while($result=mysqli_fetch_assoc($res))
                    {
                        
                        print_r($result);
                        $did=$result['DID'];
                        $dname=$result['DName'];
                        $head=$result['Head'];
                        $cname=$result['CollegeName'];
                        echo "<option value='$did'";
                        if(isset($ResEdit['DID']) && $ResEdit['DID']==$did)
                        echo "selected";
                        echo ">$dname ($cname)</option>";
                    }
                }
                
        
            ?>
        </select>
            </div>
        <div class="form-group">
            <label for="">Semester</label>
            <select name="Semester" id="" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Batch</label>
                <select name="Batch" id="" class="form-control">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
        </div>
        <button type=submit name="search" class="btn btn-primary"> Search </button>
</form>
<?php
if(isset($_POST['search'])) 
{
    $did=$_POST['DID'];
    $sem=$_POST['Semester'];
    $batch=$_POST['Batch'];
?>
<form action="" class="col-md-12" method="get">
    <table class="table table-bordered">
        <thead>
            <th>Subject Title</th>
            <th>Subject Type</th>
            <th colspan="2" style="text-align:center;">Actions</th>
</thead>
<tbody>
    <?php
    $qry="SELECT * from dept_subjects where DID=$did and Semester=$sem and Batch=$batch ;";
    if($res=mysqli_query($conn,$qry))
    {
        while($result=mysqli_fetch_assoc($res))
        {
            $subid=$result['Subject_ID'];
            echo $subid;
            echo "<tr>";
             echo "<td><input type='text' class='form-control' name='Subject_Title_$subid' value='".$result['Subject_Title']."' ></td>";
            echo "<td><input type='text' class='form-control' palceholder='Theory/Practical' name='Subject_Type_$subid' value='".$result['Subject_Type']."'></td>";
            echo "<td style-'text-align: center;'><button type='submit' class='btn btn-warning' name='Edit' value='".$result['Subject_ID']."'>Edit</button></td>";
            echo "<td style-'text-align: center;'><button type='submit' class='btn btn-danger' name='Delete' value='".$result['Subject_ID']."'>Delete</button></td>";
            echo "</tr>";

        }
    }  
    ?>
    </tbody>
</table>
<?php
if(isset($_GET['Delete']))
{
    $deleteid=$_GET['Delete'];
    $qry="DELETE FROM dept_subjects where Subject_ID=$deleteid";
    if(mysqli_query($conn,$qry))
    {
        echo "<script>alert('Deleted')</script>";
        //header("Location:SchoolSubjects.html");
        //echo "<script>window.location.href='SubjectsList.php'</script>";

    }
    else
    echo "<script>alert('Delete Failed')</script>";
}
if(isset($_GET['Edit']))
{
    echo $editid=$_GET['Edit'];
    echo $subtitle=$_GET["Subject_Title_$editid"];
    echo $subtype=$_GET["Subject_Type_$editid"];
    $qry="UPDATE dept_subjects set Subject_Title='$subtitle',Subject_Type='$subtype' where Subject_ID=$editid";
    if(mysqli_query($conn,$qry))
    {
        echo "<script>alert('Update Success')</script>";
       //header("Location:dept_subjects.html");
       //echo "<script>window.location.href='SubjectsList.php'</script>";
   }
   else
   echo "<script>alert('Update Failed')</script>";
}
?>
</form>
<?php
}
?>
</div>
</body>
</html>