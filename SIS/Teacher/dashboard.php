<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dashboard.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Teacher Dashboard</title>
    <script src="../tools/MyCookie.js"></script>
</head>
<?php include_once("../Connection/Connection.php");
session_start();
if(isset($_SESSION['tredirect']))
unset($_SESSION['tredirect']);
if(isset($_SESSION['teacher']))
{
    if(!isset($_SESSION['teacher']))
           $_SESSION['teacher']=$_COOKIE['teacher'];
    $teacher=$_SESSION['teacher'];
    $mainqry="SELECT * FROM teacher where TID='$teacher'";
    if($mainres=mysqli_query($conn,$mainqry))
    {
        if(mysqli_num_rows($mainres)>0)
            $MainResult=mysqli_fetch_assoc($mainres);
    }
    $photo=$MainResult['Photo'];

?>
<style>

.progresses
{
    display:flex;
    gap:0.5rem;
    flex-wrap:wrap;
    justify-content:center;
    width:100%;
}
.progress
{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    width: 200px;
    padding: 1rem;
    border: 2px gray solid;
    background-color: white;
    border-radius: 5px;
}
.progress span
{
    font-weight: bolder;
    font-size: 20px;
    cursor: pointer;
}
@keyframes animeli {
    from
    {
        opacity:50%;
        transform:translateY(-10px);
    }
    to{
        opacity:100%;
        transform:translateY(0px);
    }
}
.my-dropdown{
    display: none;
    animation:animeli 0.5s;
}

.dropdown-togg:hover > .my-dropdown{
    display:block;
}
.plus
{
    width:100%;
    position:relative;
    display:flex;
    justify-content:flex-end;
    padding: 1rem 0.5rem;
}
nav{
    opacity:10%;
    transition: opacity 0.3s;
}
nav:hover
{
    opacity: 100%;
}
</style>
<style>
        .message
        {
            display: flex;
            flex-direction: column;
            border: 1px solid rgb(228, 226, 226);
            padding:0.5rem;
            background-color: rgb(255, 255, 255);
            border-radius: 5px;
            box-shadow: 0px 2px 5px 2px rgb(207, 204, 204);
            /* max-height: 70px; */
            overflow: hidden;
            transition: all 1s;
        }
      
        .message .tr
        {
            min-width: fit-content;
            max-width: 40%;
            display: flex;
            flex-direction: column;
          
        }
        textarea[name='Reason']
        {
            display: none;
            margin:1rem 0rem;
            width: 70%;
        }
        #reason:checked ~ textarea[name='Reason']
        {
            display: block;
        }
        #reason
        {
            text-align: left;
            width: fit-content;
        }
    </style>
<body>
    <nav>
        <div class="navbar-header">
            <a href="" class="navbar-brand">SIS</a>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
        </div>
        <div class="nav-user">
            <img src="../photo/<?php echo $photo; ?>" alt="">
            <button class="btn btn-dark mobile" id="open">Menu</button>
            <form>
                <button type="submit" class="btn btn-dark d-none d-md-inline-block " name="Logout">Log Out</button>
                
            </form>
            <form >
                <button type="button" class="btn btn-light" id="cpass" >⚙</button>
            </form>
        </div>
    </nav>
   <?php include_once("changepassword.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3" >
                <div class='sidebar' id="sidebar" style="overflow:scroll">
                <span class="mobile" id="close" >X</span>
                <div class="sidebar-head">
                    <img src="../photo/<?php echo $photo; ?>" alt="profile">
                    <h5><?php echo $MainResult['Name']; ?></h5>
                    <b><?php echo $MainResult['TID']; ?></b>
                    <form>
                        <button type="submit" class="btn btn-dark" name='Logout'>Logout</button>
                    </form>
                    <?php
                    if(isset($_GET['Logout']))
                    {
                        session_destroy();
                        echo "<script>
                        setcookiejs('teacher','');
                        window.location.href='../MIndex.php';
                        </script>";
                    }
                    ?>
                </div>
                <ul class="sidebar-body">
                <li><a href="#" onclick="showall()">Dashboard</a></li>
                <li><a href="#" onclick="showdiv('calendar-container')">Calendar</a></li>
                <li class="dropdown-togg"><a href="#" onclick="showdiv('student-details')">Students</a>
                    <ul class="my-dropdown">
                        <li><a href="NewStudent.php">New Student</a></li>
                        <li><a href="StudentList.php">Student List</a></li>
                    </ul>   
                </li>
                <li class="dropdown-togg"><a href="#" >HSE Grades</a>
                    <ul class="my-dropdown">
                        <li><a href="HSE_Grades.php">Assign Marks</a></li>
                        <li><a href="HSE_List.php">Marks List</a></li>
                    </ul>   
                </li>
                <li class="dropdown-togg"><a href="#" >SSLC Grades</a>
                    <ul class="my-dropdown">
                        <li><a href="SSLC_Grades.php">Assign Marks</a></li>
                        <li><a href="SSLC_List.php">Marks List</a></li>
                    </ul>   
                </li>
                <li class="dropdown-togg"><a href="#" >Semester Grades</a>
                    <ul class="my-dropdown">
                        <li><a href="SemMarks.php">Assign Marks</a></li>
                        <li><a href="SemList.php">Marks List</a></li>
                    </ul>   
                </li>
                <li><a href="#" onclick="showdiv('response-details')">Responses</a></li>
                <li><a href="Attendance.php">Attendance</a></li>
				 <li><a href="View_Notice.php">Notices</a></li>
                </ul>
            </div>
        </div>
        
        <div class="col-md-9" id="main-container">
           <?php
           $qry="SELECT (Select count(SID) from student where CreatedBy='$teacher') as student_count,(Select count(TID) from request where TID='$teacher') as response_count,(Select count(DID) from department) as department_count,(Select count(CID) from college) as college_count ";
           if($res=mysqli_query($conn,$qry))
           {
            $result=mysqli_fetch_assoc($res);
           }
           ?>
        
           <div class="progress_overview">
                <div class="progresses">
                    <div class="progress" style="height:5rem" id="progress1">
                        <span id="name">Students</span>
                        <span id="percent"><?php echo $result['student_count']; ?></span>
                    </div>
                    <div class="progress" style="height:5rem" id="progress2">
                        <span id="name">Responses</span>
                        <span id="percent"><?php echo $result['response_count']; ?></span>
                    </div>
                    <!-- <div class="progress" id="progress3">
                        <span id="name">Departments</span>
                        <span id="percent"><?php echo $result['department_count']; ?></span>
                    </div>
                    <div class="progress" id="progress4">
                        <span id="name">Colleges</span>
                        <span id="percent"><?php echo $result['college_count']; ?></span>
                    </div> -->
                </div>
            </div>
        <script>
            
            const percents=document.querySelectorAll(".progress #percent");
            percents.forEach(percent=>{
                let p=0,count=percent.innerHTML;
                function counter()
                {
                    if(p<=count)
                    {
                        percent.innerHTML=p;
                        p++;
                        setTimeout(counter,200);
                    }
                }
                counter()
            });
        </script>
        

        
            <div class="calendar-container" id="calendar-container">
                <header>
                    <h1 id="monthYear">Calendar</h1>
                </header>
                <div class="controls">
                    <div>
                        <button onclick="previousYear()" class="btn btn-default">Previous Year</button>
                        <button onclick="nextYear()" class="btn btn-default">Next Year</button>
                        <button onclick="previousMonth()" class="btn btn-default">Previous Month</button>
                        <button onclick="nextMonth()" class="btn btn-default">Next Month</button>
                    </div>
                </div>
                <div class="calendar" id="calendar"></div>
            </div>
            <div id="personal-details">
                    <?php
                        //$qry="SELECT * from student where SID='$student'";
                       // if($res=mysqli_query($conn,$qry))
                        //{
                            echo " <div class='card'>
                            <h2 class='card-header'>Profile</h2>
                            <div class='profile'>
                                    <img src='../photo/$photo' style='' alt='' class='card-img-top'>
                            </div>
                            <div class='card-body'>
                                <h2 class='card-title'>$MainResult[Name]</h2>
                                <b class='card-text'> $MainResult[TID] </b>
                            </div>
                            <ul class='list-group list-group-flush'>
                                <li class='list-group-item'><img src='../icons/student.png' class='icon'>$MainResult[Gender]</li>
                                <li class='list-group-item'><img src='../icons/certificate.png' class='icon'>$MainResult[Dob]</li>
                                <li class='list-group-item'> <img src='../icons/college-01.png' class='icon'> <b>$MainResult[Email]</b></li>
                            </ul>
                          
                        </div>";
                        //} 
                        // setInterval(()=>{location.reload()},1000);
                    ?>
                    <br>
                    <button class="btn btn-dark" onclick="printSection('personal-details')" >Print</button>
                </div>
            
            <div id="student-details">
                <h2>Student List</h2>
                <div class="plus">
                    <a class="btn btn-dark" href="NewStudent.html">+ Student</a>
                </div>
                <div class="table-responsive">
                <table class="table">
                <?php
                $qry="SELECT student.SID,Name,Gender,Dob As 'Date of Birth',Join_Date,Batch,DName as Department FROM student inner join academicdetails on student.SID=academicdetails.SID inner join department on department.DID=academicdetails.DID where CreatedBy='$teacher' limit 3";
                if($res=mysqli_query($conn,$qry))
                {  
                    $i=0;
                    while($result=mysqli_fetch_assoc($res))
                    {
                        if($i==0)
                        {
                            echo "<thead><tr>";
                            foreach($result as $key=>$val)
                            {
                                echo "<th>$key</th>";
                            }
                            echo "</tr></thead>";
                        }
                            echo "<tbody>";
                            echo "<tr>";
                            foreach($result as $val)
                            {
                                echo"<td>$val</td>";
                            }
                            echo "</tr>";
                            echo "</tbody>";
                            $i=1;
                        
                    }
                }
                    ?>
                    </table>
                </div>
                <a href="StudentList.php">View More</a>
            </div> 

              
        
            <div id="subject-details">
                <h2>Subjects List</h2>
                <div class="plus">
                    
                </div>
                <div class="table-responsive">
                <table class="table">
                <?php
                $qry="SELECT Subject_Title,Subject_Type from school_subjects limit 3";
                if($res=mysqli_query($conn,$qry))
                {  
                    $i=0;
                    while($result=mysqli_fetch_assoc($res))
                    {
                        if($i==0)
                        {
                            echo "<thead><tr>";
                            foreach($result as $key=>$val)
                            {
                                echo "<th>$key</th>";
                            }
                            echo "</tr></thead>";
                        }
                            echo "<tbody>";
                            echo "<tr>";
                            foreach($result as $val)
                            {
                                echo"<td>$val</td>";
                            }
                            echo "</tr>";
                            echo "</tbody>";
                            $i=1;
                        
                    }
                }
                    ?>
                    </table>
                </div>
                
            </div> 
            <div class="dept-subjects">
            <h2>Your Department Subjects</h2>
                <div class="plus">
                    
                </div>
                <div class="table-responsive">
                <table class="table">
                <?php
                $qry="SELECT Subject_Title,Subject_Type,Semester,Batch from dept_subjects where DID=(Select DID from teacherdetails where TID='$teacher') order by Semester";
                if($res=mysqli_query($conn,$qry))
                {  
                    $i=0;
                    while($result=mysqli_fetch_assoc($res))
                    {
                        if($i==0)
                        {
                            echo "<thead><tr>";
                            foreach($result as $key=>$val)
                            {
                                echo "<th>$key</th>";
                            }
                            echo "</tr></thead>";
                        }
                            echo "<tbody>";
                            echo "<tr>";
                            foreach($result as $val)
                            {
                                echo"<td>$val</td>";
                            }
                            echo "</tr>";
                            echo "</tbody>";
                            $i=1;
                        
                    }
                }
                    ?>
                    </table>
                </div>
            </div>
            <div id="response-details">
                <h2>Response Details</h2>
                <?php
            $qry="Select * from request where TID='$teacher'  order by CreatedAt DESC limit 2";
            if($res=mysqli_query($conn,$qry))
            {
              
                while($result=mysqli_fetch_assoc($res))
                {
                    $rid=$result['Request_ID'];
                    echo "
                    <div class='message'>
                        <h5>$result[TID] | $result[SID]</h5>";
                        if($result['Status']=="Rejected")
                        echo "<strong style='color:red'>$result[Status]</strong>";
                        elseif($result['Status']=="Submitted")
                        echo "<strong style='color:blue'>$result[Status]</strong>";
                        else
                        echo "<strong style='color:green'>$result[Status]</strong>";

                        echo "<label>Reason</label>
                        <p>";
                            if(empty($result['Reason']))
                                echo "No Reason Specified";
                            else
                                echo $result['Reason'];
                        echo "</p>";

                       
                        echo "<div class='tr'>
                        <table>
                            <tr><th>($result[Field_Name]) Field</th></tr>
                            <tr><td>From</td><th>$result[Old_Value]</th></tr>
                            <tr><td>To</td><th> $result[New_Value] </th></tr>
                        </table>
                        </div>
                        <label>Message</label>
                        <p>";
                            if(empty($result['Message']))
                                echo "No Reason Specified";
                            else
                                echo $result['Message'];
                        echo "</p>"; 
                    //    if($result['Status']!="Updated")
                    //    {
                    //     echo "<form action='' method=''>";
                    //     echo "
                    //         <button type='submit' style='width: fit-content;' name='Accept' value='$rid' class='btn btn-secondary'>Accept</button>";
                    //         echo "
                    //         <button type='submit' style='width: fit-content;' name='AcceptUpdate' value='$rid' class='btn btn-success'>Accept And Update</button>";
                    //         if($result['Status']!="Rejected")
                            
                    //         echo "

                    //         <button type='submit' style='width: fit-content;' name='Reject' value='$rid' class='btn btn-danger'>Reject</button>
                    //         <input type='checkbox' id='reason'>Reason?<textarea name='Reason' class='form-control'></textarea>
                    //         ";
                          
                    //     echo "</form>";
                    //    }
                    echo "
                    </div>
                    <br>
                    ";
                   
                }
          
            } 
            ?>
            <a href="Messages.php">View More</a>
            </div>

        </div>
    </div>


    <script>
        const opens=document.getElementById("open");
        const closes=document.getElementById("close");
        const sidebar=document.getElementById("sidebar");
        opens.addEventListener("click",(e)=>{
            sidebar.classList.toggle("side");
        })
        closes.addEventListener("click",(e)=>{
            sidebar.classList.toggle("side");
        })
    </script>
</body>
<script>
    const containers=document.querySelectorAll("#main-container > div");
    console.log(containers);
    function showdiv(val)
    {
        const active=document.getElementById(val);
        containers.forEach(element => {
            element.classList.add("inactive");
        });
        active.classList.remove("inactive");
        closes.click();
    }
    function showall()
    {
        location.reload();
    }
</script>
<?php
}
else
{
  echo "<center>Login and Come</center>";
  echo "<center><a href='../Login.php?Loger=Teacher'>Login here</a></center>";
}
?>
<script src="../tools/calendar.js"></script>
</html>