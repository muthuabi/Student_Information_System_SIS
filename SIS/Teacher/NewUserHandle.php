<?php
session_start();
$teacher=$_SESSION['teacher'];
//mysqli_report(MYSQLI_REPORT_ERROR);
require_once("../Connection/Connection.php");
include_once("../phpmail.php");
//include_once("sesbase.php");
if(isset($_POST['Create']))
{
// print_r($_POST);
$sid="SID".date("Y").substr(time(),7);
$name=$_POST['Name'];
$file=$_FILES['File']['name'];
$filext=pathinfo($file,PATHINFO_EXTENSION);
//echo $filext;
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
$file."Hello";
$flag=0;
$pass=substr(uniqid("PD"),0,10);
if(move_uploaded_file($_FILES['File']['tmp_name'],$target.$file))
{
    echo "";
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
    $qry="INSERT INTO student(SID,Name,File,Dob,Gender,Aadhaar,Phone,Religion,Community,Email,FatherName,MotherName,FatherOccupation,MotherOccupation,FPhone,MPhone,CreatedBy) 
    Values('$sid','$name','$file','$dob','$gender',$aadhar,$phone,'$religion','$commun','$email','$fathername','$mothername','$fatheroccup','$fatheroccup',$fatherno,$motherno,'$teacher'); ";
    // if(isset($_SESSION['teacher']))
    //  {
    //      $creator=$_SESSION['teacher'];
    //      $qry="INSERT INTO student(SID,Name,File,Dob,Gender,Aadhaar,Phone,Email,FatherName,MotherName,FatherOccupation,MotherOccupation,FPhone,MPhone,CreatedBy) 
    //      Values('$sid','$name','$file','$dob','$gender',$aadhar,$phone,'$email','$fathername','$mothername','$fatheroccup','$fatheroccup',$fatherno,$motherno,'$creator');";
    //  }
    $qry1="INSERT INTO academicdetails(SID,Batch,Year,Join_Date,Type,Status,DID,CID) Values('$sid','$joindate',$year,'$join','$acadtype','$status',$course,'$college');";
    $qry2="INSERT INTO residential(SID,Address,Taluk,District,State,Country) VALUES('$sid','$address','$taluk','$district','$state','$country');";
    $qry3="INSERT INTO scholarship(SID,ScholarshipName,Amount,IssuedDate,ScholarshipType) Values('$sid','$scholarshipname','$scholarshipamount','$scholarshipissued','$scholartype');";
    $qry4="INSERT INTO password(SID,Password) VALUES('$sid','$pass')";
    if(mysqli_query($conn,$qry) && mysqli_query($conn,$qry1) && mysqli_query($conn,$qry2) && mysqli_query($conn,$qry3) && mysqli_query($conn,$qry4))
    {
        echo "Sucess";
        //sendmail($sid,$pass,$name,$email);
        echo "
        <script>
            alert('Inserted Sucessfully');
            setTimeout(()=>{window.location.href='StudentList.php'},500)
        </script>
        ";
    }
    else
    {
        echo "";
        
        mysqli_rollback($conn);
        echo "<script>alert('Insert Failed'); history.back();</script>";
        
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
    // print_r($_POST);
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
    
       
           
            $file=$_FILES['File']['name'];
            $filext=pathinfo($file,PATHINFO_EXTENSION);
            $filext;
            $file=$_POST['SID'].".".$filext;
           
            $flag=0;
            if(move_uploaded_file($_FILES['File']['tmp_name'],$target.$file))
            {
                echo "File Uploaded Sucessful";
                $flag=1;
                $qry="UPDATE student set File='$file' where SID=$SID";
                if(mysqli_query($conn,$qry))
                    echo "File Updated";
                else
                    die("");
                
            }
            else
            echo "<script>alert('File Failed');</script>";
    }
    // print_r($updates);
    echo "<br>";
    $studetails=array_slice($updates,0,15);
    echo $studetails=implode(",",$studetails);
    $resdetails=array_slice($updates,15,5);
    // array_unshift($resdetails,$updates[0]);
    echo $resdetails=implode(",",$resdetails);
    $acadetails=array_slice($updates,20,7);
    // array_unshift($acadetails,$updates[0]);
    echo $acadetails=implode(",",$acadetails);
    $scholardetails=array_slice($updates,27,4);
    // array_unshift($scholardetails,$updates[0]);
    echo $scholardetails=implode(",",$scholardetails);
 
    $qry="Update student set $studetails where SID=$SID";
    $qry1="Update academicdetails set $acadetails where SID=$SID";
    $qry2="Update residential set $resdetails where SID=$SID";
    $qry3="Update scholarship set $scholardetails where SID=$SID";
    if(mysqli_query($conn,$qry) && mysqli_query($conn,$qry1) && mysqli_query($conn,$qry2) && mysqli_query($conn,$qry3))
    {
        //echo "Update Sucess";
        echo "
        <script>
            alert('Updated Sucessfully');
            setTimeout(()=>{window.location.href='StudentList.php'},500)
        </script>
        ";
    }
    else
    {
        echo "<script>alert('Update Failed'); //history.back();</script>";
    }
}
?>


       
