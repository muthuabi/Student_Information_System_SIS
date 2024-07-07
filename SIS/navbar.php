<?php include_once("sesbase.php"); ?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header d-flex align-items-center navbar-right ">
       
            <a class="navbar-brand navbar-right" style="color:blue" >PROJECTSIS</a>
            
            <form action="" method="post"> <button type="submit" class="btn btn-primary navbar-btn" name="<?php if((isset($_SESSION['student']) || isset($_SESSION['teacher']) )  && !empty($_SESSION)) echo 'Logout'; else echo 'Login'; ?>" > <?php if((isset($_SESSION['student']) || isset($_SESSION['teacher']) )) echo "Logout"; else echo "Login"; ?>  </button></form> 
            <?php
            //print_r($_COOKIE);
            //echo $_SESSION['student'];
            if(isset($_POST['Logout']))
            {
                /*if(isset($_SESSION['student'])) setcookie("student",'',-time()+24400);
                if(isset($_SESSION['admin'])) setcookie("admin",'',-time()+24400);
                if(isset($_SESSION['teacher'])) setcookie("teacher",'',-time()+24400);*/
                session_destroy();
                header("Refresh:1");
            }
            if(isset($_POST['Login']))
            {
                header("location:Login.php");
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
                <li class="nav-item active "><a class="nav-link active" href="MIndex.html#">Home</a></li>
               
               
                <!-- <li class="nav-item dropdown dropdown-togg"><a class="nav-link dropdown-toggle " href="#">Services <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item">Service 1</a></li>
                        <li><a class="dropdown-item">Service 2</a></li>
                        <li><a class="dropdown-item">Service 3</a></li>
                    </ul>
                </li> -->
          
                <li class="nav-item"><a class="nav-link" href="#about-us">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact-us">Contact</a></li>
                <div class="prof" style="display: flex;align-items: center; gap:1rem">
                <div class="inner-nav d-md-flex d-lg-flex " >
                    <li class="nav-item "><a class="nav-link " href="#"><?php if(isset($_SESSION['student']) || isset($_SESSION['teacher']) ) echo $SessionBase[0]; else echo "No User"; ?></a></li>
                    <li class="nav-item "><a class="nav-link " href="#"><?php if(isset($_SESSION['student']) || isset($_SESSION['teacher'])) echo $SessionBase[1]; else echo "No User"; ?></a></li>
                </div>
            </div>
            </ul>
        </div>
    </div>
</nav>
<script src="navcollapse.js"></script>
