<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MyStyles.css">
</head>
<?php
//  session_start();
//  require_once("../Connection/Connection.php");

if(isset($_GET['From']))
{
    echo "<button class='btn btn-dark d-none' type='button' id='cpass'>Click</button> ";
    session_start();
    require_once("../Connection/Connection.php");
    echo "<script>setTimeout(()=>{document.getElementById('cpass').click()},100);</script>";
} 

 if(isset($_SESSION['student']))
 { 
    $student=$_SESSION['student'];
?>
<style>
    #doc-upload
    {
        position: fixed;
        background-color: antiquewhite;
        padding:1rem;
        display: flex;
        flex-direction: column;
        border-radius: 10px;
        box-shadow: 1px 2px 10px 5px lightgray;
        top:9.5rem;
        transition: transform 0.3s;
        transform: scale(0);
        z-index: 10000;

      

    }
    .form-container
    {
        width: 100%;
        display: flex;
        justify-content: center;
        z-index: 100001;
  
    }
</style>
<body>
 
    <div class="form-container">
    <form action="" method="post" enctype="multipart/form-data" id="doc-upload">
            <div class="form-group">
                <label for="input-doc">New Password</label>
                <input type="text" type="password" name="Old" required id="input-old" class="form-control">
            </div>
            <div class="form-group">
                <label for="input-des">Confirm Password</label>
                <input name="New" type="password" id="input-new" required class='form-control'>
                <span id="err"></span>
            </div>
            <br>
            <button type="submit" id="doc-submit" name='Change' class='btn btn-primary'>Change</button>
            <br>
            <button type="button" name='cancel' id="doc_cancel" class='btn btn-default'>Cancel</button>
        </form>
    </div>
    <script>
    function docmodal()
    {
        const rate=document.getElementById("cpass");
        const modal=document.getElementById("doc-upload");
        const modalrated=document.getElementById("doc-submit");
        const modalcancel=document.getElementById("doc_cancel");
        const old=document.getElementById("input-old");
        const news=document.getElementById("input-new");
        const err=document.getElementById("err");
        news.addEventListener("keyup",(e)=>{
            if(!e.target.value.match(old.value))
            {
                err.innerText="No Match";
                modalrated.disabled=true;
            }
            else
            {
                err.innerText="Match";
                modalrated.disabled=false;
            }
        })
        rate.addEventListener("click",(e)=>{
            modal.style.transform="scale(1)";
        })
        modalcancel.addEventListener("click",(e)=>{
            modal.style.transform="scale(0)";
        })
    }
    docmodal();
    </script>
    <?php
     if(isset($_POST['Change']))
    {
        //print_r($_POST);
        $pass=$_POST['New'];
        $qry="UPDATE password set Password='$pass' where SID='$student'";
        if(mysqli_query($conn,$qry))
        {
            echo "<script>alert('Password Changed');</script>";  
            echo "<script>window.location.href='../Login.php?Loger=Student';</script>";  
        }
        
    }
    ?>
</body>
<?php
 }
 else
 {

 } 
?>

</html>