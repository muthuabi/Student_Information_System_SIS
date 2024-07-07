<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MyStyles.css">
</head>
<style>
    #chooseform
    {
        display: flex;
        flex-direction: column;
    }
</style>
<body>
    <?php include_once("../Connection/Connection.php");
    include_once("navbar.php");
    ?>

    <div class="container">
    <h3 style="text-align: center;">ATTENDANCE</h3>
    <?php include_once("../tools/time.html"); ?>
    <form action="" method="get" id="chooseform" class="col-md-12"  >
        <div class="form-group">
            <label for="input-date">Date</label>
            <input type="date" name="Date" <?php if(isset($_SESSION['teacher'])) echo "readonly"; ?> value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>"  id="input-date" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Select Department</label>
            <select name="department" class="form-control">
            <?php 
                $qry="Select DID,DName,college.CollegeName from department inner join  college on college.CID=department.CID ";
                if($res=mysqli_query($conn,$qry))
                {
                    while($result=mysqli_fetch_array($res))
                    {
                        $did=$result['DID'];
                        $dname=$result['DName'];
                        $CollegeName=$result['CollegeName'];
                        echo "<option value='$did'>$dname ($CollegeName) </option>";
                    }
                }
            ?>
            </select>

        </div>
        <div class="form-group">
            <label for="">Select Year</label>
            <select name="year" id="" class="form-control">
                <option value="1" <?php if(isset($_GET['year']) && $_GET['year']==1) echo "Selected"; ?>  >I</option>
                <option value="2" <?php if(isset($_GET['year']) && $_GET['year']==2) echo "Selected"; ?>  >II</option>
                <option value="3" <?php if(isset($_GET['year']) && $_GET['year']==3) echo "Selected"; ?>  >III</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Hour</label>
            <select name="hour" id="" class="form-control">
                <option value="1" <?php if(isset($_GET['hour']) && $_GET['hour']==1) echo "Selected"; ?> >I</option>
                <option value="2" <?php if(isset($_GET['hour']) && $_GET['hour']==2) echo "Selected"; ?> >II</option>
                <option value="3" <?php if(isset($_GET['hour']) && $_GET['hour']==3) echo "Selected"; ?> >III</option>
                <option value="4" <?php if(isset($_GET['hour']) && $_GET['hour']==4) echo "Selected"; ?> >IV</option>
                <option value="5" <?php if(isset($_GET['hour']) && $_GET['hour']==5) echo "Selected"; ?>>V</option>
            </select>
        </div>
        <br>
        <button type="submit" name="choose" class="btn btn-primary btn-block">Choose</button>

    </form>
    <?php
        if(isset($_GET['choose']))
        {
    ?>
        <style>
            #chooseform
            {
                display:none;
            }
            #attendanceform{
                display: flex;
            }
            table input
            {
                border:none;
                background: none;
                color: none;
            }
            table .form-control:read-only
            {
                border:none;
                background: none;
                color: none;
            }
        </style>
        <form action="" id="attendanceform" method="post" class="col-md-12" style='display:flex;flex-direction:column'>
        <button class="btn btn-secondary" type="button" onclick="formchange()" >ReChoose</button>
        <script>
            function formchange()
            {
                document.getElementById("chooseform").style.display="flex";
                document.getElementById("attendanceform").style.display="none";
            }
        </script>
            <table class="table ">
                <thead>
                    <th>SID</th>
                    <th>Student Name</th>
                    <th colspan="2">Action</th>
                </thead>
                <style>
                    input[type='radio']
                    {
                            display: none;
                    }
                    input[type='radio'] +label
                    {
                        background-color: white;
                        border-radius: 15px;
                        cursor: pointer;
                        padding: 0.2rem 1rem;
                    }
                    input[value='Present']:checked +label
                    {
                        background-color: green;
                    }
                    input[value='Absent']:checked +label
                    {
                        background-color: red;
                    }
                </style>
                <tbody>
                    <?php
                     $department=$_GET['department'];
                     $year=$_GET['year'];
                     $hour=$_GET['hour'];
                    echo $date=$_GET['Date'];
                
                     echo "<input type=hidden name='hour' value='$hour'>";
                     echo "<input type=hidden name='year' value='$year'>";
                     echo "<input type=hidden name='department' value='$department'>";
                     echo "<input type=hidden name='Date' value='$date'>";
                     $qry0="SELECT * from attendance where DID=$department and Year=$year and Hour=$hour  and Date='$date'";
                     $flag=0;
                    if($res0=mysqli_query($conn,$qry0))
                    {
                        
                        if(!mysqli_num_rows($res0)>0)
                        {
                            echo "<center><b>Attendance Not Marked</b></center>";
                            exit(0);
                            //echo "Hello";
                        }
                        else
                        {
                            $flag=1;
                        }
                        while($result0=mysqli_fetch_assoc($res0))
                        {
                            $id=$result0['SID'];
                            $stat=$result0['AttStatus'];
                            $Attend[$id]=$stat;
                        }
                       // if(isset($Attend))
                        // print_r($Attend);
                    }
                     $qry="Select student.SID,student.Name,DID,Year From student inner join academicdetails on student.SID=academicdetails.SID where DID=$department and Year=$year";
                     if($flag!=0)
                     {
                        $qry="Select student.SID,student.Name,DID,Year From student inner join academicdetails on student.SID=academicdetails.SID where DID=$department and Year=$year and student.SID in (SELECT SID from attendance where DID=$department and Year=$year and Hour=$hour  and Date='$date')";
                     }
                     
                     if($res=mysqli_query($conn,$qry))
                     {
                        $i=1;
                        while($result=mysqli_fetch_assoc($res))
                        {
                            $sid=$result['SID'];
                            $name=$result['Name'];
                            //echo $i;
                            echo "<input type='hidden' name='count' value='$i'>";
                            echo "<tr>";
                            echo "<td><input type='text' class='form-control' readonly name='SID_$i' value='$sid'></td> ";
                            echo "<td><input type='text' class='form-control'readonly name='Name_$i' value='$name'></td> ";
                          
                            echo "<td><input type='radio' checked ";
                            if(!isset($Attend))
                            {
                            if(isset($_POST["AttStatus_$i"]) && $_POST["AttStatus_$i"]=="Present")
                            { echo "checked";}
                            }
                            else
                            {
                                if(isset($Attend) &&  $Attend[$sid]=="Present")
                                    echo "checked";
                            }
                            echo " name='AttStatus_$i' value='Present' id='att_p_$i' >

                            <label for='att_p_$i'>P</label> </td>";
                            echo "<td><input type='radio' ";
                            if(!isset($Attend))
                            {
                            if(isset($_POST["AttStatus_$i"]) && $_POST["AttStatus_$i"]=="Absent")
                            { echo "checked";}
                            }
                            else
                            {
                                if(isset($Attend) && $Attend[$sid]=="Absent")
                                    echo "checked";
                            }
                            echo " name='AttStatus_$i' value='Absent' id='att_a_$i' >
                            <label for='att_a_$i'>A</label></td>";
                            echo "</tr>";
                            $i++;                            
                        }
                        $i=$i-1;
                        echo "<input type='hidden' name='count' value='$i'>";
                     }
                    ?>
                </tbody>
            </table>
            <button type="submit"  style="width: 100%;margin: 1rem 0rem" <?php if(isset($Attend)) echo "name='update_attendance' class='btn btn-primary'>Update"; else echo "name='submit_attendance' class='btn btn-primary'>Submit"; ?>  </button>
            <?php
                if(isset($_POST['submit_attendance']))
                {
                   
                    $date=$_POST['Date'];
                    $count=$_POST['count'];
                    $hour=$_POST['hour'];
                    $year=$_POST['year'];
                    $department=$_POST['department'];
                    $flag=0;
                    for($i=1;$i<=$count;$i++)
                    {   
                       
                        echo $sid=$_POST["SID_$i"];
                        echo $status=$_POST["AttStatus_$i"];
                        echo "<br>";
                        try{
                            $qry="INSERT INTO attendance(SID,Date,Year,DID,Hour,AttStatus) VALUES('$sid','$date',$year,$department,$hour,'$status')";
                             if(mysqli_query($conn,$qry))
                                echo "";
                            else
                            {
                                $flag=1;
                                echo "<script>alert('Attendance Failed');</script>";
                                break;
                            }
                        }
                        catch(Exception $e)
                        {
                            echo $e->getMessage();
                            $flag=1;
                            break;
                        }
                    }
                    if($flag!=1)
                    {
                        echo "Attendance Submitted";
                       
                    }

                }
                if(isset($_POST['update_attendance']))
                {
                    //print_r($_POST);
                    $date=$_POST['Date'];
                    $count=$_POST['count'];
                    $hour=$_POST['hour'];
                    $year=$_POST['year'];
                    $department=$_POST['department'];
                    $flag=0;
                    for($i=1;$i<=$count;$i++)
                    {   
                        
                        $sid=$_POST["SID_$i"];
                        $status=$_POST["AttStatus_$i"];
                        echo "<br>";
                        try{
                            $qry="UPDATE attendance set AttStatus='$status' where SID='$sid' and Hour=$hour and Year=$year and date='$date'";
                             if(mysqli_query($conn,$qry))
                                echo "";
                            else
                            {
                                $flag=1;
                                echo "<script>alert('Update Failed');</script>";
                                break;
                            }
                        }
                        catch(Exception $e)
                        {
                            //echo $e->getMessage();
                            $flag=1;
                            break;
                        }
                    }
                    if($flag!=1)
                    {
                        echo "<script>alert('Attendance Update Submitted');</script>";
                       
                    }
                } 
            ?>
        </form>
    <?php
        }
    ?>
    </div>
    <script src="history.js"></script>
</body>
</html>