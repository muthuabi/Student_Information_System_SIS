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
    <div class="container">
        <table class="table table-bordered">
            <?php
                $qry="SELECT * from sem_marks order by SID,Semester";
                if($res=mysqli_query($conn,$qry))
                {
                    $i=0;
                    while($result=mysqli_fetch_assoc($res))
                    {
                        $marks=$result['Marks'];
                        $marks=json_decode($marks);
                        $sid=$result['SID'];
                        $sem=$result['Semester'];
                        $rowspan=count((array)$marks);
                        if($i==0)
                            echo "<thead><tr><th>SID</th><th>Semester</th><th colspan=2>Marks</th><th>Actions</th></tr></thead>";
                        echo "<tbody>";
                        $i=3;
                        foreach($marks as $key=>$value)
                        {
                            echo "<tr>";
                            if($i==3)
                                echo "<td rowspan=$rowspan>$sid</td><td rowspan=$rowspan >$sem</td>";
                            echo "<td>$key</td><td>$value</td>";
                            if($i==3)
                                echo "<td rowspan=$rowspan> <form><input type=hidden name='Delete_Sem' value=$sem>
                            <button type=submit class='btn btn-danger' name='Delete' value=$sid>Delete</button></form></td>";
                            echo "</tr>";
                            $i=4;
                        }
                        $i=1;
                    }
                }
            ?>
            <?php
            if(isset($_GET['Delete']))
            {
                $deleteid=$_GET['Delete'];
                $sem=$_GET['Delete_Sem'];
                $qry="DELETE FROM sem_marks where SID='$deleteid' and Semester=$sem";
                if(mysqli_query($conn,$qry))
                {
                    echo "Sucess";
                    echo "<script>
                    alert('Deleted Sucessful');
                    window.location.href='SemList.php';</script>";
                }
            } 
            ?>
        </table>
    </div>
</body>
</html>