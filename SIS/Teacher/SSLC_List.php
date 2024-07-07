<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MyStyles.css">
</head>
<?php include_once("../Connection/Connection.php"); ?>
<body>
<?php include_once("navbar.php"); ?>
<br>
    <div class="container">
    <form action="" class="col-md-12" method="get">
            <table class="table table-bordered">
                <thead>
                <th>SID</th>
                <th>Tamil</th>
                <th>English</th>
                <th>Maths</th>
                <th>Science</th>
                <th>Social</th>
                <th colspan="2">Actions</th>
            </thead>
            <tbody>
                <?php
                    $qry="SELECT SID,Tamil,English,Mathematics,Science,Social_Science from sslc";
                    if($res=mysqli_query($conn,$qry))
                    {
                        while($result=mysqli_fetch_assoc($res))
                        {
                            echo "<tr>";
                            foreach($result as $val)
                            {
                                echo "<td>$val</td>";

                            }
                            echo "<td><button type='submit' name='Delete' value='$result[SID]' class='btn btn-danger'>Delete</button></td>
                                <td><button type='submit' name='Edit' value='$result[SID]' class='btn btn-warning'>Update</button></td>
                                ";
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
                $qry="Delete  From sslc where SID='$deleteid'";
                if(mysqli_query($conn,$qry))
                {
                    echo "<script>alert('Deleted Success');</script>";
                    echo "<script>
                        window.location.href='SSLC_List.php'
                    </script>";
                }
                else
                {
                    echo "<script>alert('Delete Failed');</script>";
                }
            }
            if(isset($_GET['Edit']))
            {
                echo $editid=$_GET['Edit'];
                echo "<script>
                    window.location.href='SSLC_Grades.php?Edit=$editid';
                </script>";

            } 
            ?>
        </form>
    </div>
</body>
</html>