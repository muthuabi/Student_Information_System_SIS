<?php

session_start();
//mysqli_report(MYSQLI_REPORT_ERROR);
require_once("../Connection/Connection.php");
if(isset($_POST['Create']))
{
print_r($_POST);
$sid="SID".date("Y").substr(time(),7);
$name=$_POST['Name'];
$file=$_FILES['File']['name'];
$filext=pathinfo($file,PATHINFO_EXTENSION);

$gender=$_POST['Gender'];
$phone=$_POST['Phone'];
$aadhar=$_POST['Aadhaar'];
$email=$_POST['Email'];
$dob=$_POST['Dob'];
$religion=$_POST['Religion'];
$commun=$_POST['Community'];
$join=$_POST['Join_Date'];
$fathername=$_POST['FatherName'];
$mothername=$_POST['MotherName'];
$fatheroccup=$_POST['FatherOccupation'];
$motheroccup=$_POST['MotherOccupation'];
$fatherno=$_POST['FPhone'];
$motherno=$_POST['MPhone'];
$address=$_POST['Address'];
$address= mysqli_real_escape_string($conn,$address);
$country=$_POST['Country'];
$state=$_POST['State'];
$district=$_POST['District'];
$taluk=$_POST['Taluk'];
$acadtype=$_POST['Type'];
$college=$_POST['CID'];
$course=$_POST['DID'];
$status=$_POST['Status'];
$joindate=$_POST['Batch'];
$year=$_POST['Year'];
$scholarshipname=$_POST['ScholarshipName'];
$scholarshipamount=$_POST['Amount'];
$scholarshipissued=$_POST['IssuedDate'];
$scholartype=$_POST['ScholarshipType'];
$target="../photo/";
if(!file_exists($target))
    mkdir($target,0777);
$file=$sid.".".$filext;

$flag=0;
$pass=substr(uniqid("PD"),0,10);
if(move_uploaded_file($_FILES['File']['tmp_name'],$target.$file))
{
    echo "File Uploaded Sucessful";
    $flag=1;
}
else
{
	$flag=0;
    echo "<script>alert('File Failed');</script>";
}
if($flag!=0)
{
   
    
    try{
    $qry="INSERT INTO student(SID,Name,File,Dob,Gender,Aadhaar,Phone,Religion,Community,Email,FatherName,MotherName,FatherOccupation,MotherOccupation,FPhone,MPhone) 
    Values('$sid','$name','$file','$dob','$gender',$aadhar,$phone,'$religion','$commun','$email','$fathername','$mothername','$fatheroccup','$fatheroccup',$fatherno,$motherno); ";
    if(isset($_SESSION['teacher']))
     {
         $creator=$_SESSION['teacher'];
         $qry="INSERT INTO student(SID,Name,File,Dob,Gender,Aadhaar,Phone,Email,FatherName,MotherName,FatherOccupation,MotherOccupation,FPhone,MPhone,CreatedBy) 
         Values('$sid','$name','$file','$dob','$gender',$aadhar,$phone,'$email','$fathername','$mothername','$fatheroccup','$fatheroccup',$fatherno,$motherno,'$creator');";
     }
    $qry1="INSERT INTO academicdetails(SID,Batch,Join_Date,Year,Type,Status,DID,CID) Values('$sid','$joindate','$join',$year,'$acadtype','$status',$course,'$college');";
    $qry2="INSERT INTO residential(SID,Address,Taluk,District,State,Country) VALUES('$sid','$address','$taluk','$district','$state','$country');";
    $qry3="INSERT INTO scholarship(SID,ScholarshipName,Amount,IssuedDate,ScholarshipType) Values('$sid','$scholarshipname','$scholarshipamount','$scholarshipissued','$scholartype');";
    $qry4="INSERT INTO password(SID,Password) VALUES('$sid','$pass')";
    if(mysqli_query($conn,$qry) && mysqli_query($conn,$qry1) && mysqli_query($conn,$qry2) && mysqli_query($conn,$qry3) && mysqli_query($conn,$qry4))
    {
        echo "Sucess";
        echo "
        <script>
            alert('Insert Success');
            setTimeout(()=>{window.location.href='StudentList.php'},500)
        </script>
        ";
    }
    else
    {
        echo "Error";
        echo "<script>
        alert('Insert Failed');
            //history.back();
        </script>";
        mysqli_rollback($conn);
    }

       
    }
    catch(Exception $e)
    {
        echo "Error";
    }

}
}
if(isset($_POST['Update']))
{
    //print_r($_POST);
    $updates=array();
    $SID="'".$_POST['SID']."'";
    foreach($_POST as $key=>$value)
    {

        if($key=='Update' || $key=='File')
            continue;
        if(ctype_digit($value))
        {
            $updates[]="$key=$value";
            continue;
        }
        if($key=="Address")
        { 
            $value=mysqli_real_escape_string($conn,$value);
            $updates[]="$key='$value'"; 
            continue;
        }
        $updates[]="$key='$value'";  
    }
    $target="../photo/";
    if(isset($_FILES['File']))
    {
    
       
            echo "IN FIKLES";
            echo $file=$_FILES['File']['name'];
            $filext=pathinfo($file,PATHINFO_EXTENSION);
            echo $filext;
            $file=$_POST['SID'].".".$filext;
            echo $file;
            $flag=0;
            if(move_uploaded_file($_FILES['File']['tmp_name'],$target.$file))
            {
                echo "File Uploaded Sucessful";
                $flag=1;
                $qry="UPDATE student set File='$file' where SID=$SID";
                if(mysqli_query($conn,$qry))
                    echo "";
                else
                    die("");
                
            }
            else
              echo "";
    }
    //print_r($updates);
    echo "<br>";
    $studetails=array_slice($updates,0,15);
    $studetails=implode(",",$studetails);
    $resdetails=array_slice($updates,15,5);
    // array_unshift($resdetails,$updates[0]);
    echo $resdetails=implode(",",$resdetails);
    $acadetails=array_slice($updates,20,7);
    // array_unshift($acadetails,$updates[0]);
    $acadetails=implode(",",$acadetails);
    $scholardetails=array_slice($updates,27,4);
    // array_unshift($scholardetails,$updates[0]);
    $scholardetails=implode(",",$scholardetails);
 
    $qry="Update student set $studetails where SID=$SID";
    $qry1="Update academicdetails set $acadetails where SID=$SID";
    $qry2="Update residential set $resdetails where SID=$SID";
    $qry3="Update scholarship set $scholardetails where SID=$SID";
    if(mysqli_query($conn,$qry) && mysqli_query($conn,$qry1) && mysqli_query($conn,$qry2) && mysqli_query($conn,$qry3))
    {
        //echo "Update Sucess";
        echo "
        <script>
            alert('Update Success');
            setTimeout(()=>{window.location.href='StudentList.php'},500)
        </script>
        ";
    }
    else
    {
        echo "<script>alert('Update Failed');
           // history.back();</script>";

    }
}
?>


       
