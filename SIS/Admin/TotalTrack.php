<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
   
   <link rel="stylesheet" href="../MyStyles.css">
   <script src="../tools/printarea.js"></script>
</head>
<body>
    <?php include_once("../Connection/Connection.php");
    include_once("navbar.php");
    ?>
    <div class="container">
    <form action="" method="get">
        <h2>Track</h2>
        <div class="form-group">
       <select name="DID" id="" class="form-control">
        <option value="0">All</option>
       <?php 
            $qry="SELECT DID,DName,CollegeName FROM department inner join college on college.CID=department.CID";
            if($res=mysqli_query($conn,$qry))
            {
                while($result=mysqli_fetch_assoc($res))
                {
                    $did=$result['DID'];
                    echo "<option value='$did' ";
                    if(isset($_GET['DID']) && $_GET['DID']==$did)
                        echo "selected";
                    echo ">$result[DName] $result[CollegeName]</option>";
                }
              
            }
            ?>
       </select>
       </div>
       <div class="form-group">
            <label for="">Percentage</label>
            <input type="number" class="form-control" name="percent" value="<?php if(isset($_GET['percent'])) echo $_GET['percent']; else echo '100'; ?>" id="">
       </div>
       <br>
        <button class="btn btn-primary" type="submit" name="find">Find</button>
    </form>
    <div id="print-area">
    <table class="table">
    
        <thead>
            <th>SID</th>
            <th>Name</th>
            <th>Department</th>
            <th>College</th>
            <th>Percentage</th>
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
            
            $did=$_GET['DID'];
            $per=$_GET['percent'];
            $qry1="SELECT student.SID,Name,DName,CollegeName From student inner join academicdetails on student.SID=academicdetails.SID inner join department on department.DID=academicdetails.DID inner join college on college.CID=department.CID where department.DID=$did";
            if($did==0)
                $qry1="SELECT student.SID,Name,DName,CollegeName From student inner join academicdetails on student.SID=academicdetails.SID inner join department on department.DID=academicdetails.DID inner join college on college.CID=department.CID";
           
            if($res1=mysqli_query($conn,$qry1))
            {
                if(mysqli_num_rows($res1)>0)
                {
                    $i=0;
                    while($result1=mysqli_fetch_assoc($res1))
                    {
                        $sid=$result1['SID'];
                        $inputs[$i]['SID']=$sid;
                        $inputs[$i]['Name']=$result1['Name'];
                        $inputs[$i]['DName']=$result1['DName'];
                        $inputs[$i]['CollegeName']=$result1['CollegeName'];
                        $i++;
                    }
                }
                else
                    $inputs=array();
                    
            }
            for($i=0;$i<count($inputs);$i++)
            {
                $arr=array();
                $sid=$inputs[$i]['SID'];
                $dname=$inputs[$i]['DName'];
                $name=$inputs[$i]['Name'];
                $cname=$inputs[$i]['CollegeName'];
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
                    
                  
                }
              
            }
            // foreach($arr as $key=>$val)
            // {
            //     $v=implode(",",$val);
            //     echo "<tr>";
            //     echo "<th>$key</th>";
            //     echo "<td>$v</td>";
            //     echo "</tr>";
            // }
            $percent=(($Date_Count-count($arr))/$Date_Count)*100;
            $percent=number_format($percent,2);
            if(round($percent)<=$per)
            echo "<tr><th>$sid</th><th>$name</th><th>$dname</th><th>$cname</th><th>$percent%</th><tr>";
            }
            
        }
        ?>
        </tbody>
    </table>
    </div>
    <button class="btn btn-dark" type="button" onclick="printSection('print-area')">Print</button>
</div>
</body>
</html>