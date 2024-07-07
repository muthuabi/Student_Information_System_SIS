<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dashboard.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Admin Dashboard</title>
    <script src="../tools/MyCookie.js"></script>
    <script src="../tools/printarea.js"></script>
</head>
<?php include_once("../Connection/Connection.php");
session_start();
if(isset($_SESSION['aredirect']))
unset($_SESSION['aredirect']);
if(isset($_SESSION['admin']))
{

    if(!isset($_SESSION['admin']))
        $_SESSION['admin']=$_COOKIE['admin'];
    $admin=$_SESSION['admin'];
    $mainqry="SELECT * FROM admin where ADMINID='$admin'";
    if($mainres=mysqli_query($conn,$mainqry))
    {
        if(mysqli_num_rows($mainres)>0)
            $MainResult=mysqli_fetch_assoc($mainres);
    }
    $photo="admin.jpg";

?>
<style>

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
                <button type="submit" class="btn btn-dark not-mobile" name='Logout'>Logout</button>
            </form>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3" >
                <div class='sidebar' id="sidebar" style="overflow:scroll">
                <span class="mobile" id="close" >X</span>
                <div class="sidebar-head">
                    <img src="../photo/<?php echo $photo; ?>" alt="profile">
                    <h5><?php echo $MainResult['Name']; ?></h5>
                    <b><?php echo $MainResult['ADMINID']; ?></b>
                    <form>
                        <button type="submit" class="btn btn-dark" name='Logout'>Logout</button>
                    </form>
                    <?php
                    if(isset($_GET['Logout']))
                    {
                        session_destroy();
                     
                        echo "<script>
                        setcookiejs('admin','');
                        window.location.href='../Login.php';
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
                        <li><a href="AttendanceTrack.php">Student Attendance</a></li>
                    </ul>   
                </li>
                <li><a href="Attendance.php">Update Attendance</a></li>
				<li><a href="Notice.php">Add Notice</a></li>
				<li><a href="View_Notice.php">Notices</a></li>
                <li class="dropdown-togg"><a href="#" onclick="showdiv('teacher-details')">Teachers</a>
                    <ul class="my-dropdown">
                        <li><a href="NewTeacher.php">New Teacher</a></li>
                        <li><a href="TeacherList.php">Teacher List</a></li>
                    </ul>   
                </li>
                <li class="dropdown-togg"><a href="#" onclick="showdiv('subject-details')">Subjects</a>
                    <ul class="my-dropdown">
                        <li><a href="SchoolSubjects.php">New Subjects</a></li>
                        <li><a href="SubjectsList.php">Subject List</a></li>
                    </ul>   
                </li>
                <li class="dropdown-togg"><a href="#" onclick="showdiv('department-details')">Department</a>
                    <ul class="my-dropdown">
                        <li><a href="NewDepartment.php">New Department</a></li>
                        <li><a href="DepartmentList.php">Department List</a></li>
						 <li><a href="Dept_Subjects.php">New subjects</a></li>
						  <li><a href="Dept_Sub_List.php">Department Subject</a></li>
                    </ul>   
                </li>
                <li class="dropdown-togg"><a href="#" onclick="showdiv('college-details')">College</a>
                    <ul class="my-dropdown">
                        <li><a href="NewCollege.php">New College</a></li>
                        <li><a href="CollegeList.php">College List</a></li>
                    </ul>   
                </li>
                <li><a href="TotalTrack.php">Track Attendance</a></li>
                
                </ul>
            </div>
        </div>
        
        <div class="col-md-9" id="main-container">
           <?php
           $qry="SELECT (Select count(SID) from student) as student_count,(Select count(TID) from teacher) as teacher_count,(Select count(DID) from department) as department_count,(Select count(CID) from college) as college_count ";
           if($res=mysqli_query($conn,$qry))
           {
            $result=mysqli_fetch_assoc($res);
           }
           ?>
        
           <div class="progress_overview">
                <div class="progresses">
                    <div class="progress" id="progress1">
                        <span id="name">Students</span>
                        <span id="percent"><?php echo $result['student_count']; ?></span>
                    </div>
                    <div class="progress" id="progress2">
                        <span id="name">Teachers</span>
                        <span id="percent"><?php echo $result['teacher_count']; ?></span>
                    </div>
                    <div class="progress" id="progress3">
                        <span id="name">Departments</span>
                        <span id="percent"><?php echo $result['department_count']; ?></span>
                    </div>
                    <div class="progress" id="progress4">
                        <span id="name">Colleges</span>
                        <span id="percent"><?php echo $result['college_count']; ?></span>
                    </div>
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
				<?php include_once("../tools/time.html"); ?>
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
            
            <div id="student-details">
                <h2>Student List</h2>
                <div class="plus">
                    <a class="btn btn-dark" href="NewStudent.php">+ Student</a>
                </div>
                <div class="table-responsive">
                <table class="table">
                <?php
                $qry="SELECT student.SID,Name,DName as 'Department Name' ,CollegeName as 'College Name' FROM student inner join academicdetails on student.SID=academicdetails.SID inner join department on department.DID=academicdetails.DID inner join college on college.CID=department.CID limit 5";
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

              
        <div id="teacher-details">
                <h2>Teacher List</h2>
                <div class="plus">
                    <a class="btn btn-dark" href="NewTeacher.php">+ Teacher</a>
                </div>
                <div class="table-responsive">
                <table class="table">
                <?php
                $qry="SELECT TID,Name,Gender,Phone FROM teacher";
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
                <a href="TeacherList.php">View More</a>
            </div> 
            <div id="department-details">
                <h2>Department List</h2>
                <div class="plus">
                    <a class="btn btn-dark" href="NewDepartment.php">+ Department</a>
                </div>
                <div class="table-responsive">
                <table class="table">
                <?php
                $qry="SELECT DName,Head,CollegeName FROM department inner join college on college.CID=department.CID limit 3";
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
                <a href="DepartmentList.php">View More</a>
            </div> 
            <div id="college-details">
                <h2>College List</h2>
                <div class="plus">
                    <a class="btn btn-dark" href="NewCollege.php">+ College</a>
                </div>
                <div class="table-responsive">
                <table class="table">
                <?php
                $qry="SELECT CollegeName,PrincipalName,Location from college limit 3";
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
                <a href="CollegeList.php">View More</a>
            </div> 
            <div id="subject-details">
                <h2> School Subjects List</h2>
                <div class="plus">
                    <a class="btn btn-dark" href="SchoolSubjects.php">+ Subjects</a>
                </div>
                <div class="table-responsive">
                <table class="table">
                <?php
                $qry="SELECT * from school_subjects limit 3";
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
                <a href="SubjectsList.php">View More</a>
            </div> 

            <div class="dept-subjects-list">
                <h2>Department Subjects</h2>
                <div class="plus">
                    <a class="btn btn-dark" href="Dept_Subjects.php">+ Subjects</a>
                </div>
                <div class="table-responsive">
                <table class="table">
                <?php
                $qry="SELECT Subject_Title,Subject_Type,DName,Semester,Batch,CollegeName from dept_subjects inner join department on department.DID=dept_subjects.DID inner join college on college.CID=department.CID limit 3";
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
                <a href="Dept_Sub_List.php">View More</a>
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
  echo "<center><a href='../Login.php?Loger=Admin'>Login here</a></center>";
}
?>
<script src="../tools/calendar.js"></script>
</html>