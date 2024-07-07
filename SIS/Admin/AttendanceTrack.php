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
    <?php include_once("../Connection/Connection.php");
    include_once("navbar.php");
    ?>
    <div class="container">
    <form action="" method="get">
        <datalist id="student">
            <?php 
            $qry="SELECT * FROM student";
            if($res=mysqli_query($conn,$qry))
            {
                while($result=mysqli_fetch_assoc($res))
                {
                    $sid=$result['SID'];
                    echo "<option value='$sid'>$sid</option>";
                }
              
            }
            ?>
        </datalist>
        <div class="form-group">
            <label for="">SID</label>
            <input type="text" value="<?php if(isset($_GET['SID'])) echo $_GET['SID']; ?>" list="student" name="SID" id="" class="form-control">
        </div>
        <br>
        <button class="btn btn-primary" type="submit" name="find">Find</button>
    </form>
    <table class="table">
    
        <thead>
            <th>Date</th>
            <th>Hours</th>
        </thead>
        <tbody>
        <?php 
        if(isset($_GET['find']))
        {
            $qry="SELECT COUNT(DISTINCT Date) As 'Date_Count' from attendance";
            if($res=mysqli_query($conn,$qry))
            {
                if(mysqli_num_rows($res)>0)
                {
                    $result=mysqli_fetch_assoc($res);
                    $Date_Count=$result['Date_Count'];
                }
                else
                    $Date_Count=0;

            }
            //echo $Date_Count;
            $sid=$_GET['SID'];
            $arr=array();
            $qry="SELECT * FROM attendance where SID='$sid' and AttStatus='Absent'";
            if($res=mysqli_query($conn,$qry))
            {
                if(mysqli_num_rows($res)>0)
                {
                    while($result=mysqli_fetch_assoc($res))
                    {
                        $date=$result['Date'];
                        $hour=$result['Hour'];
                        $arr[$date][]=$hour;
                    }
                }
                else
                {
                    echo "<center><b>No Records</b></center>";
                    exit(0);
                }
              
            }
        
            foreach($arr as $key=>$val)
            {
                $v=implode(",",$val);
                echo "<tr>";
                echo "<th>$key</th>";
                echo "<td>$v</td>";
                echo "</tr>";
            }
           
            $percent=(($Date_Count-count($arr))/$Date_Count)*100;
            $percent=number_format($percent,2);
            echo "<tr><th>Percentage</th><th>$percent%</th><tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>