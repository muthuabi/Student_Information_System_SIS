<!DOCTYPE html>
<?php
session_start();
if(isset($_SESSION['student']))
unset($_SESSION['student']);
if(isset($_SESSION['admin']))
unset($_SESSION['admin']);
if(isset($_SESSION['teacher']))
unset($_SESSION['teacher']);
include_once("Connection/Connection.php");

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/bootstrap-stack.png" type="image/x-icon">
    <title>Login</title>

    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="MyStyles.css">
    <!-- <link rel="stylesheet" href="Bootstrap4/dist/css/bootstrap.min.css"> -->
</head>
<style>
.portals
{
    display: flex;
    gap:1rem;
    flex-wrap: wrap;
    justify-content: center;
    height: 100vh;
    padding: 1rem;
    box-sizing: border-box;
   
}
.portal
{
 
    margin: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background-color: antiquewhite;
    width: 30rem;
    border-radius: 15px;
    animation: popup 0.3s ease-in-out;
    transition: box-shadow 0.5s;

}
.portal button
{
    cursor: pointer;
    transition: transform 0.5s;
}
.portal button:hover
{
    transform: scale(1.1);
}
.portals img
{
    width: 45%;
    height: 45%;
    object-fit: contain;
    filter: invert(1);
}
#portals{
    display:flex;
    transform: scale(1);
} 
#login{
   
    display:none;
    transform: scale(1);
    animation: popup 0.3s ease-in-out;
    }
    .portal:hover
    {
        box-shadow:  0px 0px 10px 10px rgb(247, 226, 197);
    }

@keyframes popup {
    from{
        transform: scale(0);
    }
    to{
        transform: scale(1);
    }
}
body
{
    background-image: url("images/bg1.webp");
    background-position: center;
}
form#login-form
{
    padding:1rem;
    background-color:rgba(155,255,255,0.5);
    border-radius:15px;
}
</style>
<body>
<?php 

if(isset($_GET['Loger']) && empty($_GET['Loger']))
{
    echo "<script>window.location.href='Login.php';</script>";
}
if(isset($_GET['Loger']) && $_GET['Loger']=='Student' && isset($_COOKIE['student']))
{
    $_SESSION['student']=$_COOKIE['student'];
   // echo "<script>window.location.href='MIndex.html'</script>";
}
if(isset($_GET['Loger']) && $_GET['Loger']=='Teacher' && isset($_COOKIE['teacher']))
{
    $_SESSION['teacher']=$_COOKIE['teacher'];
    //echo "<script>window.location.href='MIndex.html'</script>";
}
if(isset($_GET['Loger']) && $_GET['Loger']=='Admin' && isset($_COOKIE['admin']))
{
    $_SESSION['admin']=$_COOKIE['admin'];
    //echo "<script>window.location.href='MIndex.html'</script>";
}

if(isset($_GET['Loger'])) 
echo "<style>#portals{display:none} #login{display:flex}</style>";
else
echo "<style>#portals{display:flex} #login{display:none}</style>";
$loger=array("Student"=>"^SID[0-9]{7}$","Teacher"=>"^TID[0-9]{7}$","Admin"=>"^ADMIN[0-9]{5}$");

?>

<form action="forgotpass.php" id="forgot-form" method="GET">
    <input type="hidden" name='sid' value="<?php if(isset($_POST['sid'])) echo $_POST['sid']; else echo ''; ?>">
</form>
<form>
    <div class="container" >
    <div class="portals" id="portals">
        <div class="portal" id="Student">
            <img src="icons/student.png" alt="">
            <h3>Student Login</h3>
            <button name="Loger" value="Student" style="background-color: rgb(252, 212, 153);width:50%;border-radius: 15px;" class="btn  btn-block">Login</button>
        </div>
        <div class="portal" id="Teacher">
            <img src="icons/teacher-01.png" alt="">
            <h3>Teacher Login</h3>
            <button name="Loger" value="Teacher" style="background-color: rgb(252, 212, 153);width:50%;border-radius: 15px;" class="btn  btn-block">Login</button>
        </div>
        <div class="portal" id="Admin">
            <img src="icons/college-01.png" alt="">
            <h3>Admin Login</h3>
            <button name="Loger" value="Admin" style="background-color: rgb(252, 212, 153);width:50%;border-radius: 15px;" class="btn  btn-block">Login</button>
        </div>
		
    </div>

</div>
</form>
<script src="tools/MyCookie.js"></script>
<script>

</script>

    <div class="container" >
        <div class="row">
            <div class="col-md-12 justify-content-center p-2" id="login">
            <form action="" method="post" id="login-form" class="d-flex flex-column ">
                <h2 class="panel-heading text-center">Login Form</h2>
                <div class="form-group">
                    <label for="input-sid"><?php if(isset($_GET['Loger'])){ echo $_GET['Loger'];$log=$_GET['Loger'];} else echo 'Student'; ?> ID</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                  
                    <input type="text" name="sid" id="input-sid" pattern="<?php echo $loger[$log]; ?>" value="<?php if(isset($_POST['sid'])) echo $_POST['sid']; ?>" maxlength="10" class="form-control" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-password">Password</label>
                    <div class="input-group">
                        <span class="input-group-text">@</span>
                  
                    <input type="password" name="password" id="input-password" class="form-control" required>
                    </div>
                </div>
              <!--  <div class="form-group" style="display: flex;justify-content: safe;align-items:center;padding-left: 0.5rem;gap:1rem; position: relative;">
                   <input type="checkbox" style="width:1rem;height:1rem;cursor: pointer;" name="<?php if(isset($_GET['Loger'])) echo $_GET['Loger'].'_cook';?>" value="<?php if(isset($_GET['Loger'])) echo $_GET['Loger'].'_cook';?>" id="addcook">
                    <label for="addcook" style="font-weight:normal">Sign in me at Next login</label>
                </div> -->
             
                <button type="submit" name="<?php if(isset($_GET['Loger'])) echo $_GET['Loger'];else echo 'Student'; ?>" class="btn btn-primary">Login</button>
                <?php
                    if(isset($_GET['Loger']) && $_GET['Loger']!='Admin')  
                    {
                ?>
                <button class="btn btn-link" form="forgot-form" name="Forgot" value='<?php if(isset($_GET['Loger'])) echo $_GET['Loger']; ?>'>Forgot Password?</button>
                <?php
                } 
                ?>
                <center> 

                <?php
               
                if(isset($_POST['Student']))
                {
                    $sid=$_POST['sid'];
                    $password=$_POST['password'];
                ?>
                    <h4 class='bg bg-danger' style='color:white;padding:1rem;border-radius: 10px;'>
                <?php 
                     if($res=mysqli_query($conn,"SELECT student.SID,password.Password FROM student inner join password on student.SID=password.SID where student.SID='$sid'"))
                     {
                        if(mysqli_affected_rows($conn))
                        {
                        
                            while($r=mysqli_fetch_assoc($res))
                            {
                            if($sid==$r['SID'] && $password==$r['Password'] )
                            {
                               
                                $_SESSION['student']=$sid;
                                if(isset($_POST['Student_cook']))
                                  echo "<script>setcookiejs('student','$sid',10);</script>";
                                // if(isset($_SERVER['HTTP_REFERER']))
                                // {
                                //     echo $ref=$_SERVER['HTTP_REFERER'];
                                   
                                // }
                                //print_r($_SESSION);
                                if(isset($_SESSION['sredirect']))
                                {
                                    $red=$_SESSION['sredirect'];
                                    echo"<script>window.location.href='$red'</script>";
                                }
                                echo"<script>window.location.href='Student/dashboard.php'</script>";
                            }
                            else
                                echo "Password Incorrect";
                            }
                        }
                        else
                            echo "User Name Not found";
                       
                     }
                     else
                        echo "Incorrects start";
                    echo "</h4>";
                }
                
                if(isset($_POST['Teacher']))
                {
                    $sid=$_POST['sid'];
                    $password=$_POST['password'];
                    echo " <h4 class='bg bg-danger' style='color:white;padding:1rem;border-radius: 10px;'>";
                     if($res=mysqli_query($conn,"SELECT TID,Password from teacher where teacher.TID='$sid'"))
                     {
                        if(mysqli_affected_rows($conn))
                        {
                            while($r=mysqli_fetch_assoc($res))
                            {
                            if($sid==$r['TID'] && $password==$r['Password'] )
                            {
                                echo "Sucess";
                                $_SESSION['teacher']=$sid;
                                if(isset($_POST['Teacher_cook']))
                                    echo "<script>setcookiejs('teacher','$sid',10);</script>";
                                if(isset($_SESSION['tredirect']))
                                {
                                    $red=$_SESSION['tredirect'];
                                    echo"<script>window.location.href='$red'</script>";
                                }
                                echo "<script>window.location.href='Teacher/dashboard.php'</script>";
                            }
                            else
                                echo "Password Incorrect";
                            }
                        }
                        else
                            echo "User Name Not found";
                     }
                     else
                        echo "Incorrects start";
                    echo "</h4>";
                }
                if(isset($_POST['Admin']))
                {
                    $sid=$_POST['sid'];
                    $password=$_POST['password'];
                    echo "<h4 class='bg bg-danger' style='color:white;padding:1rem;border-radius: 10px;'>";
                     if($res=mysqli_query($conn,"SELECT ADMINID,Password from admin where ADMINID='$sid'"))
                     {
                        
                        if(mysqli_affected_rows($conn))
                        {
                            while($r=mysqli_fetch_assoc($res))
                            {
                            if($sid==$r['ADMINID'] && $password==$r['Password'] )
                            {
                                $_SESSION['admin']=$sid;
                                if(isset($_POST['Admin_cook']))
                                    echo "<script>setcookiejs('admin','$sid',10);</script>";
                                if(isset($_SESSION['aredirect']))
                                {
                                        $red=$_SESSION['aredirect'];
                                        echo"<script>window.location.href='$red'</script>";
                                }
                                echo "<script>window.location.href='Admin/dashboard.php'</script>";
                            }
                            else
                                echo "Password Incorrect";
                            }
                        }
                        else
                            echo "User Name Not found";
                       
                     }
                     else
                        echo "Incorrects start";
                    echo "</h4>";
                }
                ?>
               </center>
               <button type="button" class="btn btn-default"><a style="text-decoration: none;" href="Login.php">Back to Portal</a></button>
            </form>
         
        </div>
        </div>
        <center><a class="btn btn-link" style="text-decoration: none;"   href="MIndex.php">Back to Home</a></center>
    </div>
</body>
<script>
    // document.addEventListener("DOMContentLoaded",(el)=>{
    //     document.querySelectorAll("#portals .portal").forEach(element=>{
    //     element.addEventListener("click",(e)=>{
    //         console.log(e.target.id);
    //         window.location.href=window.location.href+"?Loger="+e.target.id;
            
    //     })
    // })
    // })
    
</script>
<!-- <script src="history.js"></script> -->
</html>