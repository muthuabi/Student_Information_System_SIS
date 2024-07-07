<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MyStyles.css">
</head>
<body>
<?php
    include_once("../Connection/Connection.php");
include_once("navbar.php");	?>

    <div class="container">
    <form action="" method="get">
        <table class="table table-bordered">
            <thead>
                <th>SID</th>
                <th>Subject</th>
                <th>Mark</th>
                <th colspan="2">Actions</th>
            </thead>
            <tbody>
                <?php
                    $qry="SELECT SID,Subject_Title,Mark from hse inner join school_subjects on school_subjects.Subject_ID=hse.Subject_ID order by SID,school_subjects.Subject_ID";
                    if($res=mysqli_query($conn,$qry))
                    {
                        $i=0;
                        while($result=mysqli_fetch_assoc($res))
                        {
                            $sub=$result['Subject_Title'];
                            $sid=$result['SID'];
                            $mark=$result['Mark'];
                            echo "<tr>";
                            if(($i%6)==0)
                                echo "<th rowspan='6' style='vertical-align: middle;text-align:center;'>$sid</th>";
                            echo "<td>$sub</td>";
                            echo "<td>$mark</td>";
                            if(($i%6)==0)
                            {
                                echo "<td rowspan='6' style='vertical-align: middle;text-align:center;'><button type='submit' name='Delete' value='$sid' class='btn btn-danger'>Delete</button></td>
                                <td rowspan='6' style='vertical-align: middle;text-align:center;'><button type='submit' name='Edit' value='$sid' class='btn btn-warning'>Update</button></td>
                                ";
                            }
                            $i++;

                        }
                    }
                ?>
            </tbody>
            
        </table>
        <?php
               if(isset($_GET['Delete']))
               {
                   $deleteid=$_GET['Delete'];
                   $qry="Delete From hse where SID='$deleteid'";
                   if(mysqli_query($conn,$qry))
                   {
                    echo "<script>alert('Deleted Success');</script>";
                       echo "<script>
                           window.location.href='HSE_List.php'
                       </script>";
                   }
               }
               if(isset($_GET['Edit']))
               {
                   echo $editid=$_GET['Edit'];
                   echo "<script>
                       window.location.href='HSE_Grades.php?Edit=$editid';
                   </script>";
               }
        ?>
    </form>
    </div>
</body>
</html>