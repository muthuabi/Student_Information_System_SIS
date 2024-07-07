<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
</head>
<?php require_once("../Connection/Connection.php");
	include_once("navbar.php");
 ?>
<body>
    <div class="container">
        <form action="" method="post" class="col-md-12">
            <h2>Notices</h2>
            <div class="form-group">
                <label for="">Notice From</label>
                <input type="text" name="Notice_From" id="" class="form-control">
            </div>
            <div class="form-group">
                <label for="">Notice To</label>
                <select name="Notice_To" id="" class="form-control">
                    <option value="all">All</option>
                    <option value="student">All Students</option>
                    <option value="teacher">All Teachers</option>
                </select>
            </div>
            <div class="form-group">
                <label for="">Notice</label>
                <textarea name="Notice" id="" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">Link</label>
                <input type="url" name="Notice_Link" id="" class="form-control">
            </div>
            <br>
            <button class="btn btn-primary" name="Submit" style="width:100%">Put Notice</button>
        </form>
        <?php
         if(isset($_POST['Submit']))
         {
            print_r($_POST);
            $from=$_POST['Notice_From'];
            $to=$_POST['Notice_To'];
            $notice=$_POST['Notice'];
            $link=$_POST['Notice_Link'];
            if(empty($link))
                $link="No Links";
            $qry="INSERT INTO notice(Notice_From,Notice_To,Notice,Notice_Link) VALUES('$from','$to','$notice','$link')";
            if(mysqli_query($conn,$qry))
            {
                echo "Notice Added";
            }
         } 
        ?>
    </div>
</body>
</html>