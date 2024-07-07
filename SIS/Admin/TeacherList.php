<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="MyStyles.css">
</head>
<style>
        table img
        {
            height: 50px;
            width: 50px;
        }
        table th
        {
            text-align:center;
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
<body>
<?php include_once("navbar.php"); ?>
    <div class="container">
    <!-- <a class="btn btn-dark" href="dashboard.php">Go to Dashboard</a>  -->
        <div class="col-md-12" style="padding: 1rem;">
        <form>
            <div class="form-group" 
            style="display:flex;flex-direction:column;justify-content: center;align-items:center;gap:1 rem">
            <div class="form-group" style="display: flex; gap: 0.5rem;width: 70%">
            <input type="search" placeholder="Search Here"  id="input-search" class="form-control">
            <button type="button" type="button" class="btn btn-primary" name="search-btn" id="search-btn"><span class="glyphicon glyphicon-search"></span> Search </button>
</div>
<br>
<h4> (<span id="nomatch"></span>) Matches</h4>
</div>
<?php
include_once("../Connection/connection.php");
try{
    $qry="Select * from teacher inner join teacherdetails on teacher.TID=teacherdetails.TID";
    $r=mysqli_query($conn,$qry);
    echo "<div class='table-responsive' style='border: 1px solid gray;border-radius: 7px;'>";
    echo "<table class='table table bordered' id='teacher_table' >";
    $i=0;
    while($res=mysqli_fetch_assoc($r))
    {
     
        if($i==0)
        {
            echo "<tr clas='text-uppercase'>";
            echo "<th>Delete</th>";
            echo "<th>Edit</th>";
            foreach($res as $key=>$val)
            echo "<th>$key</th>";
            echo "</tr>";
        }
        echo "<tr style='transition:all 0.5s'>";
        echo "<td class=text-center><button id='delete-btn' class='btn btn-danger' name='Delete' value=".$res['TID']." type=submit >Delete</button></td>";
        echo "<td class=text-center><button id='edit-btn'class='btn btn-warning' name='Edit' value=".$res['TID']." type=submit  >Edit</button></td>";
        foreach($res as $key=>$val)
        {  
            if($key=="Photo")
            {
                echo "<td><img src='../photo/$val' alt='No Photo'/></td>";
                continue;
            }
            echo "<td>$val</td>";
        }
        echo "</tr>";
        $i=1;
    }

  echo "</table>";
  echo "<div>";
}
catch(Expection$e)
{
    echo $e->getMessage();
}
?>
<?php
if(isset($_GET['Delete']))
{
    $deleteid=$_GET['Delete'];
    echo $deleteid;

try{
    $qry="DELETE FROM teacher where TID='$deleteid'";
    if(mysqli_query($conn,$qry))
    { echo "Deleted Come";
    
    }
}
catch(Exception $e)
{
    echo $e->getMessage();
}
}
if(isset($_GET['Edit']))
{
    $editid=$_GET['Edit'];
    echo "<script>
        window.location.href='NewTeacher.php?Edit=$editid'
    </script>";
}
?>
</body>
<script>
    const deletebtn=document.querySelectorAll("#delete-btn");
    const tdata=document.querySelectorAll("table tr:not(:first-child)");
    const search=document.getElementById("input-search");
    const searchbtn=document.getElementById("search-btn");
    const matches=document.getElementById("nomatch");
    matches.parentElement.style.display="none";
    let count;
    function searching(e)
    {
        matches.parentElement.style.display="block";
        count=0;
        tdata.forEach(element => {
            element.style.display="none";
            if(element.innerHTML.toUpperCase().match(e.value.trim().toUpperCase()))
            {
                element.style.display="table-row";
                count++;
            }
        });
        matches.innerHTML=count;
    }
    search.addEventListener("keyup",(e) => {
        searching(e.target);
        if(e.key=="Enter")
        searching(e.target);
        if(!e.target);
        {
            matches.parentElement.style.display="none";
            tdata.forEach(element => {
                element.style.display="table-row";
            })
        }
    })
    searchbtn.addEventListener("click",(e) => {
        searching(search)
    })
</script>
</html>
