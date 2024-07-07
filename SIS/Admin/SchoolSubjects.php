<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="MyStyles.css">
    <?php include_once("../Connection/connection.php");
       
    ?>
</head>
<style>

</style>
<body>
<?php include_once("navbar.php"); ?>
  <div class="container" style="display:flex;flex-direction:column;">
  <!-- <a class="btn btn-dark" style="width:fit-content" href="dashboard.php">Go to Dashboard</a>  -->
<form action="" name="school_subjects" class="col-md-12" method="post">
    <div class="form-group subcount"  id="school_subjects">
        <label for="input-subcount">Enter Number of Subjects to Enter</label>
           <input type="number" min="1" max="9" placeholder="Enter any number" name="sub_count" id="input-subcount" class="form-control">
           <br>
           <button type="submit" name="sub_count_btn" class="btn btn-primary btn-block">Go</button>
           
</div>
<div class="subjects">
    <?php
    if(isset($_POST['sub_count_btn'])&& $_POST['sub_count']>0) 
    {
        $n=$_POST['sub_count'];
        echo "<input type='hidden' name='sub_count' value='$n'>";
        for($i=1;$i<$n+1;$i++)
        {
            ?>
            <style>
                #school_subjects
                {
                    display:none;
                }
            </style>
             <div class="form-goup">
                <label for="input-sub_<?php 
                echo $i; ?> Title </label>">
                Subject <?php echo $i; ?> Title </label>
                <input type="text" required name="sub_title_<?php 
                echo $i; ?>" id="input-sub_<?php echo $i; ?>" class="form-control">
                <br>
        </div>
        <div class="form-group">
            <lable for="input-subtype_<?php echo $i; ?>">
             Subject <?php echo $i; ?> Type </label>
             <input type="text" required pattern="Theory|Practical" name="sub_type_<?php echo $i; ?>" class="form-control">
             <br>

             </div>
             <?php
        }
        echo "<button type='submit' class='btn btn-primary btn-block' name='Create_Subs'>Create Subjects </button>";

    }
    ?>
    </div>
    <?php 
      if(isset($_POST['Create_Subs']))
      {
        $n=$_POST['sub_count'];
        $flag=1;
        for($i=1;$i<$n+1;$i++)
        {
            $subtitle="sub_title_".$i;
            $subtype="sub_type_".$i;
            $subtitle=$_POST[$subtitle];
            $subtitle=mysqli_real_escape_string($conn,$subtitle);
            $subtype=$_POST[$subtype];
            try{
                $qrys="INSERT INTO school_subjects(Subject_Title,Subject_Type) Values('$subtitle','$subtype');";
                if(mysqli_query($conn,$qrys))
                {
                    echo "";
                    
                }
                else
                {
                    mysqli_rollback($conn);
                    echo "<script>alert('Insert Failed');</script>";
                    $flag=0;
                    break;
                    
                }
            }
            catch(Exception $e)
            {
                echo "<center>";
                echo $e->getMessage();
                echo "</center>";
            }
        }
        if($flag!=0)
          echo "<script>alert('Insert Sucess');</script>";
       // header("Location:School_Subjects.html");

      }
?>
</form>
<br>
</div>
</body>
<script>
    if(window.history.replaceState)
    {
        window.history.replaceState(null,null,window.location.href);
    }
    </script>
</html>