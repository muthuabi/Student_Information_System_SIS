<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="MyStyles.css">
</head>
<body>
    <?php
     require_once("Connection/Connection.php");
     session_start();
     if(isset($_GET['Forgot'])) 
     {
        ?>
        <div class="container d-flex justify-content-center align-items-center" style="height:50vh;">
        <form action="" method="post" id="login-form" class="d-flex flex-column w-50 gap-2 ">
                <h2 class="panel-heading text-center">Verify</h2>
                <div class="form-group">
                    <label for="input-sid"><?php if(isset($_GET['Forgot'])){ echo $_GET['Forgot'];$log=$_GET['Forgot'];} else echo 'Student'; ?> ID</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                  
                    <input type="text" name="sid" id="input-sid" value="<?php if(isset($_POST['sid'])) echo $_POST['sid']; else if(!empty($_GET['sid'])) echo $_GET['sid']; ?>" maxlength="10" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-password">Email</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                  
                    <input type="email" name="email" id="input-password" class="form-control" required>
                    </div>
                </div>
            
             
                <button type="submit" name="<?php if(isset($_GET['Forgot'])) echo $_GET['Forgot'];else echo 'Student'; ?>" class="btn btn-primary">Confirm</button>
        </form>
        </div>
         <?php       
     }
     if(isset($_POST['Student']))
     {
        //print_r($_POST);
        $sid=$_POST['sid'];
        $mail=$_POST['email'];
        $qry="SELECT Email FROM student where SID='$sid'";
        if($res=mysqli_query($conn,$qry))
        {
            if(mysqli_num_rows($res)>0)
            {
            $result=mysqli_fetch_assoc($res);
            if($mail==$result['Email'])
            {
                echo "Verified";
                $_SESSION['student']=$sid;
                header("Location:Student/changepassword.php?From");
            }
            }
            else
            {
                echo "Not Found";
            }
        }
    
     }
     if(isset($_POST['Teacher']))
     {
        //print_r($_POST);
        $sid=$_POST['sid'];
        $mail=$_POST['email'];
        $qry="SELECT Email FROM teacher where TID='$sid'";
        if($res=mysqli_query($conn,$qry))
        {
            if(mysqli_num_rows($res)>0)
            {
            $result=mysqli_fetch_assoc($res);
            if($mail==$result['Email'])
            {
                echo "Verified";
                $_SESSION['teacher']=$sid;
                header("Location:Teacher/changepassword.php?From");
            }
            }
            else
            {
                echo "Not Found";
            }
        }
    
     }
    ?>
</body>
</html>