<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MyStyles.css">
</head>
<body>
<?php
    include_once("../Connection/Connection.php");
include_once("navbar.php");	?>

    <div class="container">
   
    <form action="" id="HSE_Grades" method="post">
        <div class="form-group">
            <label for="">SID</label>
            <?php   
            if(!isset($_GET['Edit']))
            {
                ?>
                <select name="SID" class="form-control">
                    <?php
                        $qry="SELECT SID from student where SID not in (SELECT SID from hse)";
                        
                        if($res=mysqli_query($conn,$qry))
                        {
                            while($result=mysqli_fetch_assoc($res))
                            {
                                $sid=$result['SID'];
                                echo "<option value='$sid'>$sid</option>";
                            }
                        } 
                    ?>
                </select>
            <?php
            }
            else
            {
                $id=$_GET['Edit'];
                $qry="SELECT * from hse where SID='$id'";
                if($res=mysqli_query($conn,$qry))
                {
                    while($result=mysqli_fetch_assoc($res))
                    {
                        $ResEdit[]=$result;
                        
                    }
                }
                echo "<input type='text' name='SID' maxlength='10' value=".$_GET['Edit']." class='form-control' readonly >";
            } 
            ?>
        </div>
        <?php 
        for($i=1;$i<=6;$i++)
        {
            ?>
            <br>
            <div class="form-group" style="display:flex;gap:1rem;">
                <select class="form-control my-select" name='Subject_<?php echo $i; ?>' <?php if(isset($_GET['Edit'])) echo 'readonly'; ?> >

                    <?php

                        $qry="SELECT * from school_subjects";
                        if($res=mysqli_query($conn,$qry))
                        {
                            while($result=mysqli_fetch_assoc($res))
                            {
                                $subid=$result['Subject_ID'];
                                $subname=$result['Subject_Title'];
                                echo "<option value='$subid' ";
                                if(isset($ResEdit[$i-1]['Subject_ID']) && $ResEdit[$i-1]['Subject_ID']==$subid) echo "selected";
                                echo ">$subname </option>";
                            
                            }
                        }
                    ?>
                </select>
                <input type="number" required placeholder="mark should be greater than 0" name='Mark_<?php echo $i; ?>' min="0" max="100" class="form-control" value="<?php if(isset($ResEdit[$i-1]['Mark'])) echo $ResEdit[$i-1]['Mark']; ?>">
            </div>
        <?php
        }?>
     
        <button type="submit" style="width: 100%;margin: 1rem 0rem"  class="btn btn-primary btn-block" <?php if(isset($_GET['Edit'])) echo "name='Update'>Update"; else echo "name='Create'>Create"; ?></button>
    <?php
        if(isset($_POST['Create']))
        {
            $sid=$_POST['SID'];
            $flag=1;
            for($i=1;$i<=6;$i++)
            {
                try{
                    $sub=$_POST["Subject_$i"];
                    $mark=$_POST["Mark_$i"];
                    $qry="INSERT INTO hse(SID,Subject_ID,Mark) VALUES('$sid',$sub,$mark)";
                    if(mysqli_query($conn,$qry))
                    {
                        echo "";
                    }
                    else
                    {
                        $flag=0;
                      
                        break;
                    }
                    
                }
                catch(Exception $e)
                    {
                        $flag=0;
                        echo "<script>alert('Insertion Failed');</script>";
                        echo $e->getMessage();
                        break;
                    }
               
            }
            if($flag!=0)
                echo "<script>alert('Inserted Success');</script>";
        }
        if(isset($_POST['Update']))
        {
            $sid=$_POST['SID'];
            //print_r($_POST);
            $flag=0;
            for($i=1;$i<=6;$i++)
            {
                try{
                    $sub=$_POST["Subject_$i"];
                    $mark=$_POST["Mark_$i"];
                    $qry="Update hse set Mark=$mark where Subject_ID=$sub";
                    if(mysqli_query($conn,$qry))
                    {
                        echo "";
                    }
                    else
                    {
                        echo "<script>alert('Update Failed');</script>";
                        $flag=1;
                        break;
                    }
                    
                }
                catch(Exception $e)
                    {
                        echo $e->getMessage();
                        break;
                    }
               
            }
            if($flag!=1)
            {
                echo "<script>alert('Updated Success');</script>";
            }
        }
    ?>
    </form>
</div>
<script>
const fom=document.getElementById("HSE_Grades");
fom.addEventListener("submit",(e)=>{


    const selects=document.querySelectorAll(".my-select");
    let flag=0;
    let i,j;
    final:
    for(i=0;i<selects.length;i++)
    {
        for(j=i+1;j<selects.length;j++)
        {
            if(selects[i].value==selects[j].value)
            {
                flag=1;
                console.log("find");
                break final;
            }
        }
    }
    console.log(flag);
    if(flag==1)
    {
        e.preventDefault();
        alert("Choose Distinct Subjects");
    }
    else
    {
        fom.submit();
    }
})  


    </script>
    
</body>
</html>