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
    <?php include_once("../Connection/Connection.php");
    if(isset($_GET['Edit']))
    {
        $editid=$_GET['Edit'];
        $qry="Select * From sslc where SID='$editid'";
        if($res=mysqli_query($conn,$qry))
        {
            $ResEdit=mysqli_fetch_assoc($res);
            //print_r($ResEdit);
        }
    }
    ?>
	 <?php include_once("navbar.php"); ?>
    <div class="container"  style="display: flex;flex-direction:column">
        
        <form action="" method="post" id="SSLC_Grades" class="col-md-12">
            <div class="form-group">
                <label for="">SID</label>
                <?php   
                if(!isset($_GET['Edit']))
                {
                    ?>
                    <select name="SID" class="form-control">
                        <?php
                            $qry="SELECT SID from student where SID not in (SELECT SID from sslc)";
                            
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
                    echo "<input type='text' name='SID' maxlength='10' value=".$_GET['Edit']." class='form-control' readonly >";
                } 
                ?>
            </div>
            <div class="form-group">
                <label for="">Tamil</label>
                <input type="number" required class="form-control" min="0" max="100" name="Tamil" id="" value="<?php if(isset($ResEdit['Tamil'])) echo $ResEdit['Tamil'];?>">
            </div>
            <div class="form-group">
                <label for="">English</label>
                <input type="number" required class="form-control" min="0" max="100" name="English" id="" value="<?php if(isset($ResEdit['English'])) echo $ResEdit['English'];?>">
            </div>
            <div class="form-group">
                <label for="">Mathematics</label>
                <input type="number" required class="form-control" min="0" max="100" name="Mathematics" id="" value="<?php if(isset($ResEdit['Mathematics'])) echo $ResEdit['Mathematics'];?>">
            </div>
            <div class="form-group">
                <label for="">Science</label>
                <input type="number" required class="form-control" min="0" max="100" name="Science" id="" value="<?php if(isset($ResEdit['Science'])) echo $ResEdit['Science'];?>">
            </div>
            <div class="form-group">
                <label for="">Social_Science</label>
                <input type="number" required class="form-control" min="0" max="100" name="Social_Science" id="" value="<?php if(isset($ResEdit['Social_Science'])) echo $ResEdit['Social_Science'];?>">
            </div>
            <br>
            <button type="submit"  style="width: 100%;margin: 1rem 0rem" class="btn btn-primary btn-block" <?php if(isset($_GET['Edit'])) echo "name='Update'>Update"; else echo "name='Create'>Create"; ?></button>
            <?php 
            if(isset($_POST['Create']))
            {
                $sid=$_POST['SID'];
                $tamil=$_POST['Tamil'];
                $english=$_POST['English'];
                $maths=$_POST['Mathematics'];
                $science=$_POST['Science'];
                $social=$_POST['Social_Science'];
                $qry="INSERT INTO sslc(SID,Tamil,English,Mathematics,Science,Social_Science) VALUES('$sid',$tamil,$english,$maths,$science,$social) ";
                if(mysqli_query($conn,$qry))
                {
                    //echo "Sucess";
                    echo "<script>
                    alert('Mark Entered');
                        window.location.href='SSLC_Grades.php'
                    </script>";
                }
                else
                {
                    echo "<script>alert('Insert Failed');</script>";
                }
            }
            if(isset($_POST['Update']))
            {
                $sid=$_POST['SID'];
                $tamil=$_POST['Tamil'];
                $english=$_POST['English'];
                $maths=$_POST['Mathematics'];
                $science=$_POST['Science'];
                $social=$_POST['Social_Science'];
                $qry="UPDATE sslc set Tamil=$tamil,English=$english,Mathematics=$maths,Science=$science,Social_Science=$social where SID='$sid' ";
                if(mysqli_query($conn,$qry))
                {
                   
                    echo "<script>
                    alert('Mark Updated');
                        window.location.href='SSLC_Grades.php'
                    </script>";
                }
                else
                {
                    echo "<script>alert('Update Failed');</script>";
                }

                //print_r($_POST);
            }
            ?>
        </form>
    </div>
</body>
</html>