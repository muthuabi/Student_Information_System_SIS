<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MyStyles.css">
</head>
<?php include_once("../Connection/Connection.php");
  include_once("navbar.php"); ?>
<body>
    <div class="container">
        <table class="table table-bordered">

        </table>
        <form action="" method="get">
            <div class="form-group">
                <label for="">SID</label>
                <select name="SID" id="" class="form-control">
                    <?php 
                        $qry="SELECT student.SID,Year,academicdetails.DID,department.DName,Batch from student inner join
                        academicdetails on student.SID=academicdetails.SID inner join department on department.DID=academicdetails.DID where department.DID=(Select DID from teacherdetails where TID='$teacher')";
                        if($res=mysqli_query($conn,$qry))
                        {
                            while($result=mysqli_fetch_assoc($res))
                            {
                                $id=$result['SID'];
                                $year[$id]=$result['Year'];
                                $department[$id]=$result['DName'];
                                $deptid[$id]=$result['DID'];
                                $batch[$id]=$result['Batch'];
                                echo "<option value=$id ";
                                if(isset($_GET['SID']) && $_GET['SID']==$id) echo "selected";
                                echo">$id</option>";
                            }
                        }
                    ?>
                </select>
            </div>
            <button type="submit"  name="submit_id" class="btn btn-dark">Submit</button>
        </form>
        <?php
            if(isset($_GET['submit_id']))
            {
                $id=$_GET['SID'];
                $year=$year[$id];
                $did=$deptid[$id];
                $dname=$department[$id];
                $batch=$batch[$id];
                echo "<form method=get>";
                echo "<input type=hidden name='Year' value=$year>";
                echo "<input type=hidden name='SID' value=$id>";
                echo "<input type=hidden name='submit_id' value=none>";
         
        ?>
        <div class="form-group">
            <label for="">Year</label>
            <input type="number" name="Year" id="" value="<?php echo $year;?>" class="form-control" readonly>
        </div>
        <div class="form-group">
            <label for="">Department</label>
            <select name="DID" id="" class="form-control">
                <option value="<?php echo $did; ?>"><?php echo $dname; ?></option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Semester</label>
            <select name="Sem" id="" class="form-control">
                <?php
                    for($i=1;$i<=($year*2);$i++)
                        echo "<option value=$i> $i</option>"; 
                
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="">Batch</label>
            <input type="number" name="Batch" id="" value="<?php echo $batch ?>" class="form-control" readonly>
        </div>
        <!-- <div class="form-group">
            <label for="">Count</label>
            <input type="number" name="Count"  id="" class="form-control">
        </div> -->
        <button type="submit" name="submit_count" class="btn btn-dark">Go</button>
        </form>
    <?php 
        }
     ?>
     <?php
        if(isset($_GET['submit_count']))
        {
            // $count=$_GET['Count'];
            $sem=$_GET['Sem'];
            echo "<form action='' method='post' >";
            echo "<input type=hidden name='Year' value=$year>";
            echo "<input type=hidden name='SID' value=$id>";
            echo "<input type=hidden name='DID' value=$did>";
            echo "<input type=hidden name='Sem' value=$sem>";
            $qry="SELECT * from dept_subjects where DID=$did and Semester=$sem and Batch=$batch ;";
            $checkqry="SELECT SID from sem_marks where DID=$did and Semester=$sem and SID='$id'";
            $entered=0;
            if($res=mysqli_query($conn,$checkqry))
            {
                if(mysqli_num_rows($res)>0)
                {
                    echo "<center><b>Marks Entered Already</b></center><br>";
                    $entered=1;
                }
            }
            if(($res=mysqli_query($conn,$qry)) && $entered!=1 )
            {
                $i=1;
                while($result=mysqli_fetch_assoc($res))
                {
                    $subname=$result['Subject_Title'];
                    $subtype=$result['Subject_Type'];
                    $subname=$subname."-".$subtype;
                echo "<label> Subject Name $i</label>";
                echo "<input type=text name=Subject_Name_$i value='$subname' readonly class='form-control' >";
                echo "<label> Subject Mark $i </label>";
                echo "<input type=number required max=100 min=0 name=Subject_Mark_$i class='form-control'>";
                $i++;
                }
                echo "<button name='submit_mark' type=submit class='btn btn-dark' >Submit</button>";
            }
          
            echo"</form>";
        } 
     ?>
     <?php
        if(isset($_POST['submit_mark']))
        {
            print_r($_POST);
            $year=$_POST['Year'];
            $did=$_POST['DID'];
            $sid=$_POST['SID'];
            $sem=$_POST['Sem'];
            $first=array_slice($_POST,0,4);
            print_r($first);
            $_POST=array_slice($_POST,4,null,true);
            for($i=1;$i<=count($_POST)/2;$i++)
                $mark[$_POST["Subject_Name_$i"]]=$_POST["Subject_Mark_$i"];
            $json_mark=mysqli_real_escape_string($conn,json_encode($mark));
            echo $json_mark;
            $qry="INSERT INTO sem_marks(SID,DID,Semester,Marks) values('$sid',$did,$sem,'$json_mark')";
            if(mysqli_query($conn,$qry))
            {
                echo "Sucess";
                echo "<script>
                alert('Inserted Successful');
                window.location.href='SemMarks.php';</script>";
            }
        } 
     ?>
    </div>
</body>
</html>