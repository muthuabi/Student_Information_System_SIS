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
<form action="" name="dept_subjects" class="col-md-12" method="post">
    <div class="form-group">
        <label for="">Department</label>
        <select name="DID" id="" class="form-control">
            <?php
            
                $qry="SELECT * from department inner join college on college.CID=department.CID";
                if($res=mysqli_query($conn,$qry))
                {
                    while($result=mysqli_fetch_assoc($res))
                    {
                        
                        print_r($result);
                        $did=$result['DID'];
                        $dname=$result['DName'];
                        $head=$result['Head'];
                        $cname=$result['CollegeName'];
                        echo "<option value='$did'";
                        if(isset($ResEdit['DID']) && $ResEdit['DID']==$did)
                        echo "selected";
                        echo ">$dname ($cname)</option>";
                    }
                }
                
        
            ?>
        </select>
            </div>
        <div class="form-group">
            <label for="">Semester</label>
            <select name="Semester" id="" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Batch</label>
                <select name="Batch" id="" class="form-control">
                    <option value="2021">2021</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                </select>
        </div>
    
    <div class="form-group subcount"  id="dept_subjects">
        <label for="input-subcount">Enter Number of Subjects to Enter</label>
           <input type="number" required min="1" max="9" placeholder="Enter any number" name="sub_count"  value="<?php if(isset($_POST['sub_count'])) echo $_POST['sub_count']; ?>" id="input-subcount" class="form-control">
        </div>  
           <br>
           <button type="submit" name="sub_count_btn" class="btn btn-primary btn-block">Go</button>
           
  
<div class="subjects">
    <?php
    if(isset($_POST['sub_count_btn'])&& $_POST['sub_count']>0) 
    {
        $n=$_POST['sub_count'];
        $did=$_POST['DID'];
        $sem=$_POST['Semester'];
        $batch=$_POST['Batch'];
        echo "<input type='hidden' name='sub_count' value='$n'>";
        echo "<input type='hidden' name='DID' value='$did'>";
        echo "<input type='hidden' name='Semester' value='$sem'>";
        echo "<input type='hidden' name='Batch' value='$batch'>";
        for($i=1;$i<$n+1;$i++)
        {
            ?>
            <style>
                #dept_subjects
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
        $did=$_POST['DID'];
        $sem=$_POST['Semester'];
        $batch=$_POST['Batch'];
        $flag=1;
        for($i=1;$i<$n+1;$i++)
        {
            $subtitle="sub_title_".$i;
            $subtype="sub_type_".$i;
            $subtitle=$_POST[$subtitle];
            $subtitle=mysqli_real_escape_string($conn,$subtitle);
            $subtype=$_POST[$subtype];
            try{
                $qrys="INSERT INTO dept_subjects(Subject_Title,Subject_Type,DID,Semester,Batch) Values('$subtitle','$subtype',$did,$sem,$batch);";
                if(mysqli_query($conn,$qrys))
                {
                    
                }
                else
                {
                    $flag=0;
                    mysqli_rollback($conn);
                    echo "<script>alert('Insertion Failed');</script>";
                    break;
                    
                }
            }
            catch(Exception $e)
            {
                echo "<center>";
                echo $e->getMessage();
                echo "</center>";
            }
            if($flag!=0)
            {
                echo "<script>alert('Insertion Sucess');</script>";
            }
        }
       // header("Location:dept_subjects.html");

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