<!DOCTYPE html>
<?php
//session_start(); ?>
<?php require_once("../Connection/Connection.php") ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MyStyles.css">
</head>
<body>
   <style>
        table img
        {
            height: 150px;
            width: 150px;
        }
        .search-box{
            display: flex;
            flex-direction: column;
            padding: 1rem;
            width:100%;
            align-items: center;
            
        }
        .search-box .form-group
        {
            width:80%;
            display: flex;
            gap:0.5rem;
        }
   </style>
  
    <div class="container-fluid">
		
        <?php include_once("navbar.php");
		
        $lmt=3;
		if(isset($_POST['lmt']))
		{
			$_SESSION['lmt']=$_POST['lmt'];
		}
		if(isset($_SESSION['lmt'])) $lmt=$_SESSION['lmt'];
		?>
        <div class="container">
          
            <div class="search-box">
                <div class="form-group">
                    <input type="search" name="" id="input-search" class="form-control">
                    <button type="button" id="search-btn" class="btn btn-primary">Search</button>
					<form action="" method="post">
					<div class='form-group' >
						<input type="number" name="lmt" value="<?php if(isset($lmt)) echo $lmt;else echo '3';   ?>"  min="0" max="9" class='form-control' style="width:50px">
						<button class='btn btn-dark'  type='submit'>set</button>
					</div>	
					</form>
				</div>
			
                <div id="matches">
                   <span>(<span id="nomatch"></span>) Matches</span> 
                </div>
            </div>
        <div class="table-responsive" style='border: 1px rgb(194, 19$lmt, 19$lmt) solid;border-radius: 5px;overflow:scroll;height:70vh'>
        <table class="table table-bordered " id="student_table">
        <?php 
        $offset=(isset($_GET['offset']))?$_GET['offset']:0;
        $limit=(isset($_GET['offset']))?"Limit $lmt":'Limit 1000';
        $qry="SELECT student.SID,Name,Dob FROM student $limit offset $offset";
        //$qry="SELECT student.SID,Name,File,Gender,Dob As 'Date of Birth',Batch,Join_Date,DName as 'Department Name',CollegeName FROM student inner join academicdetails on student.SID=academicdetails.SID inner join college on college.CID=academicdetails.CID inner join department on department.DID=academicdetails.DID ";
        $res=mysqli_query($conn,$qry);
        $i=0;
        if($res)
        {
			
			if(($rows=mysqli_num_rows($res))>0)
			{
				if(!isset($_SESSION['rows']))
                $_SESSION['rows']=$rows;
            while($r=mysqli_fetch_assoc($res))
            {
                if($i==0)
                {
                    echo "<tr>";
                    echo "<th>Delete</th>";
                    echo "<th>Edit</th>";
                    foreach($r as $key=>$val)
                        echo "<th>$key</th>";
                    echo "</tr>";
                }
                echo "<tr><td><form><button type='submit' name='Delete' value='$r[SID]' class='btn btn-danger'>Delete</button></form></td>
                    <td><form><button type='submit' name='Edit' value='$r[SID]' class='btn btn-warning'>Edit</button></form></td>
                    ";
                foreach($r as $key=>$val)
                {
                    if($key=="File")
                    {
                        echo "<td><img src='../photo/$val' alt='No Photo'/></td>";
                        continue;
                    }
                    echo "<td>$val</td>";  
                }
                echo "</tr>";
                $i=1;
             
            }
			}
			else
				echo "<center>No Records</center>";
           
        }

       
        ?>
        
        </table>
       
    </div>
	   <br>
    <ul class="pagination">
    <?php
  
    $rows=$_SESSION['rows'];
    for($i=0;$i<$rows;$i++)
    {

		if($lmt==0)
				$lmt=3;
		if($i==0)
        {
        echo "<li class='page-item ";
        if(!isset($_GET['offset']))
                echo "active";
        echo "'><a href='StudentList.php' class='page-link'>All</a></li>";
        }
        if($i%$lmt==0)
        {
			
            $num=($i/$lmt)+1;
            
            echo "<li class='page-item ";
            if(isset($_GET['offset']) && $offset==$i)
                echo "active";
            echo" '><a href='StudentList.php?offset=$i' class='page-link '>";
			echo ($num==0)?1:$num;
			echo"</a></li>";
        }
        
    }
    ?>
</ul>
    <?php
    include_once("../confirmmodal.html");
    if(isset($_GET['Delete']))
    {
        $Deleteid=$_GET['Delete'];
        $qry="DELETE FROM student where SID='$Deleteid'";
        if(mysqli_query($conn,$qry))
        {
            echo "Sucess";
        echo "<script>
		alert('Deleted Successfully');
            window.location.href='StudentList.php';
        </script>";
        }
    }
    if(isset($_GET['Edit']))
    {
        echo "Edit";
        $Editid=$_GET['Edit'];
        echo $Editid;
        echo "
        <script>
		
        window.location.href='NewStudent.php?Edit=$Editid'
        </script>
        ";

    }
    ?>
    </div>

</div>
</body>
<script src="../SearchTool.js"></script>

</html>