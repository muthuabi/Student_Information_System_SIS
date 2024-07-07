<?php include_once("sesbase.php"); ?>
<link rel="stylesheet" href="../MyStyles.css">
<link rel="stylesheet" href="../Bootstrap/fonts/css/fontawesome.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header d-flex align-items-center navbar-right ">
           
            <a class="navbar-brand navbar-right" >PROJECTSIS</a>
            
            <form action="" method="post"> <button type="submit" class="btn btn-primary navbar-btn" name="<?php if(isset($_SESSION['student']) && !empty($_SESSION['student'])) echo 'Logout'; else echo 'Login'; ?>" > <?php if(isset($_SESSION['student']) && !empty($_SESSION['student'])) echo "Logout"; else echo "Login"; ?>  </button></form> 
            <?php
      
            if(isset($_POST['Logout']))
            {
                if(isset($_SESSION['student'])) setcookie("student",'',-time()+24400);
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
                <li class="nav-item active "><a class="nav-link active" href="dashboard.php#">Dashboard</a></li>
                <li class="nav-item "><a class="nav-link" href="Messages.php">Messages</a></li>
                <!-- <li class="nav-item dropdown dropdown-togg"><a class="nav-link dropdown-toggle " href="#">Services <span class="caret"></span></a>
                   
                </li> -->
                <li class="nav-item "><a class="nav-link" href="document.php">My Documents</a></li>
                <li class="nav-item"><a class="nav-link" href="../MIndex.php#about-us">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="../MIndex.php#contact-us">Contact</a></li>
                <div class="prof" style="display: flex;align-items: center; gap:1rem">
                <li class="nav-item "><a class="nav-link " href="#"> <img src="../photo/<?php if(isset($_SESSION['student'])) echo $SessionBase['File']; else echo 'No User';?>" alt="No Image"></a></li>
                <div class="inner-nav d-md-none" style="display: flex; flex-direction:column;">
                    <li class="nav-item "><a class="nav-link " href="#"><?php if(isset($_SESSION['student'])) echo $_SESSION['student']; else echo 'No Student'; ?></a></li>
                    <li class="nav-item "><a class="nav-link " href="#"><?php if(isset($_SESSION['student'])) echo $SessionBase['Name']; else echo 'No Student'; ?></a></li>
                </div>
            </div>
            </ul>
        </div>
    </div>
</nav>
<script src="navcollapse.js"></script>
