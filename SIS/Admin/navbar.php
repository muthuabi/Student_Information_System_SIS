<?php include_once("sesbase.php"); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
 <link rel="stylesheet" href="../MyStyles.css">
 <script src="../tools/printarea.js"></script>
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header d-flex align-items-center navbar-right ">
       
            <a class="navbar-brand navbar-right" >PROJECTSIS</a>
            
            <form action="" method="post"> <button type="submit" class="btn btn-primary navbar-btn" name="<?php if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) echo 'Logout'; else echo 'Login'; ?>" > <?php if(isset($_SESSION['admin']) && !empty($_SESSION['admin'])) echo "Logout"; else echo "Login"; ?>  </button></form> 
            <?php
            if(isset($_POST['Logout']))
            {

                if(isset($_SESSION['admin'])) 
                session_destroy();
                header("Refresh:1");
            }
            if(isset($_POST['Login']))
            {
                header("location:../Login.php");
            }
            ?>
            <!-- <button  class="navbar-toggler btn btn-primary">Toggle</button> -->
        </div>
        <style>
            #mynav img
            {
                height: 25px;
                width: 25px;
                border-radius: 50%;
                object-fit: cover;
            }
        </style>
     <button class="navbar-btn btn btn-secondary" id="menu-toggle"><span class="navbar-brand"></span></button>
        <div class="navbar-expand " id="mynav"><!--Not Use-->
            <ul class="nav navbar-nav d-flex gap-md-2 nav-left"  >
                <li class="nav-item active "><a class="nav-link active" href="dashboard.php">Dashboard</a></li>
				  <!-- <li class="nav-item dropdown dropdown-togg"><a class="nav-link dropdown-toggle " href="#">Services <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="dropdown-item" href="Messages.php">Messages</a></li>
                        <li class=""><a class="dropdown-item" href="Attendance.php">Attendance</a></li>
                    </ul> -->
                </li>
               
				  <li class="nav-item dropdown dropdown-togg"><a class="nav-link dropdown-toggle " href="#">Teacher<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="dropdown-item" href="NewTeacher.php#">New Teacher</a></li>
                        <li class=""><a class="dropdown-item" href="TeacherList.php">Teachers List</a></li>
                    </ul> 
                </li>
                <li class="nav-item dropdown dropdown-togg"><a class="nav-link dropdown-toggle " href="#">Subjects <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="dropdown-item" href="Dept_Subjects.php#">Department Subjects</a></li>
                        <li class=""><a class="dropdown-item" href="Dept_Sub_List.php">Department Subjects List</a></li>
						 <li class=""><a class="dropdown-item" href="SchoolSubjects.php#">School Subjects</a></li>
                        <li class=""><a class="dropdown-item" href="SubjectsList.php">School Subjects List</a></li>
                    </ul> 
                </li>
				 
                <li class="nav-item dropdown dropdown-togg"><a class="nav-link dropdown-toggle " href="#">Organisation<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="dropdown-item" href="NewCollege.php">New College</a></li>
                        <li class=""><a class="dropdown-item" href="CollegeList.php">College List</a></li>
						<li class=""><a class="dropdown-item" href="NewDepartment.php#">New Department</a></li>
                        <li class=""><a class="dropdown-item" href="DepartmentList.php">Department List</a></li>
    
					</ul> 
                </li>
				 <li class="nav-item dropdown dropdown-togg"><a class="nav-link dropdown-toggle " href="#">Student <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="dropdown-item" href="NewStudent.php#">New Student</a></li>
                        <li class=""><a class="dropdown-item" href="StudentList.php">Students List</a></li>
                    </ul> 
                </li>
				
				 <!-- <li class="nav-item dropdown dropdown-togg"><a class="nav-link dropdown-toggle " href="#">Academics<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class=""><a class="dropdown-item" href="HSE_Grades.php#">HSE</a></li>
                        <li class=""><a class="dropdown-item" href="HSE_List.php#">HSE List</a></li>
                        <li class=""><a class="dropdown-item" href="SSLC_Grades.php#">SSLC</a></li>
                        <li class=""><a class="dropdown-item" href="SSLC_List.php#">SSLC List</a></li>
                        <li class=""><a class="dropdown-item" href="SemMarks.php">Sem Marks</a></li>
                        <li class=""><a class="dropdown-item" href="SemList.php">Sem Marks List</a></li>
                    </ul> 
                </li> -->
               
                <div class="prof" style="display: flex;align-items: center; gap:1rem;margin-right:1rem">
                <li class="nav-item "><a class="nav-link " href="#"> <img src="../photo/<?php if(isset($_SESSION['admin'])) echo 'admin.jpg'; else echo 'No User';?>" alt="No Image"></a></li>
                <div class="inner-nav d-md-none" style="display: flex; flex-direction:column;">
                    <li class="nav-item "><a class="nav-link " href="#"><?php if(isset($_SESSION['admin'])) echo $_SESSION['admin']; else echo "No User"; ?></a></li>
                    <li class="nav-item "><a class="nav-link " href="#"><?php if(isset($_SESSION['admin'])) echo $SessionBase['Name']; else echo "No User"; ?></a></li>
                </div>
            </div>
            </ul>
        </div>
    </div>
</nav>
<script src="navcollapse.js"></script>
