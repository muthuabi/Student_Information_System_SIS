<?php
     include_once("../Connection/connection.php");
        print_r($_POST);
        mysqli_report(MYSQLI_REPORT_ERROR);
        if(isset($_POST['Create']))
        {
            $y = date ("Y");
            $time= "".time();
            $id="TID".$y.substr($time,7);
            $pass=substr(uniqid("PD"),0,10);
            $password=$pass;
            $name=$_POST['Name'];
            $email=$_POST['Email'];
            $gender=$_POST['Gender'];
            $dob=$_POST['Dob'];
            $address=$_POST['Address'];
            $address=mysqli_real_escape_string($conn,$address);
            $pincode=$_POST['Pincode'];
            $aadhar=$_POST['Aadhar'];
            $phone=$_POST['Phone'];
            $dor=$_POST['DoR'];
            $salary=$_POST['Salary'];
            $maritial=$_POST['Maritial_Status'];
            $degree=$_POST['Degree'];
            $desig=$_POST['Designation'];
            $cid=$_POST['CID'];
            $did=$_POST['DID'];
            $ext=pathinfo($_FILES['Photo'] ['name'],PATHINFO_EXTENSION);
            $photo=$id.'.'.$ext;
            $flag=0;
            if(!file_exists("../photo/"))
            mkdir("../photo/",0777);
            if(move_uploaded_file($_FILES['Photo'] ['tmp_name'],"../photo/".$photo))
            {
                echo "";
                $flag=1;
            }
            else{
                die("");
            }
            if($flag!=0)
            {
                $qry="INSERT INTO teacher(TID,Photo,Name,Email,Dob,Aadhar,Gender,Phone,Address,Pincode,Password) VALUES('$id','$photo','$name','$email','$dob','$aadhar','$gender',$phone,'$address','$pincode','$password')";
                $qry1="INSERT INTO teacherdetails(TID,Degree,Designation,Maritial_Status,DoR,Salary,DID,CID) VALUES('$id','$degree','$desig','$maritial','$dor','$salary','$did','$cid')";
                if(mysqli_query($conn,$qry) && mysqli_query($conn,$qry1))
                {
                    echo "<script>alert('Inserted Successfully');</script>";
                    echo "<script>window.location.href='TeacherList.php'</script>";
                }
                else
                {
                    echo "<script>alert('Insert Failed'); </script>";
                }
            }
        }
        if(isset($_POST['Update']))
        {
            $tid=$_POST['TID'];
            $name=$_POST['Name'];
            $email=$_POST['Email'];
            $gender=$_POST['Gender'];
            $dob=$_POST['Dob'];
            $address=$_POST['Address'];
            $address=mysqli_real_escape_string($conn,$address);
            $pincode=$_POST['Pincode'];
            $aadhar=$_POST['Aadhar'];
            $phone=$_POST['Phone'];
            $dor=$_POST['DoR'];
            $salary=$_POST['Salary'];
            $maritial=$_POST['Maritial_Status'];
            $degree=$_POST['Degree'];
            $desig=$_POST['Designation'];
            $cid=$_POST['CID'];
            $did=$_POST['DID'];
            $target="../photo/";
            if(isset($_FILES['Photo']))
            {
            
               
                    //echo "IN FIKLES";
                    $file=$_FILES['Photo']['name'];
                    $filext=pathinfo($file,PATHINFO_EXTENSION);
                   
                    $file=$_POST['TID'].".".$filext;
                   
                    $flag=0;
                    if(move_uploaded_file($_FILES['Photo']['tmp_name'],$target.$file))
                    {
                        echo "File Uploaded Sucessful";
                        $flag=1;
                        $qry="UPDATE teacher set Photo='$file' where TID='$tid'";
                        if(mysqli_query($conn,$qry))
                            echo "";
                        else
                            die("");
                        
                    }
                    else
                    {
                        echo "<script>alert('File Error');</script>";
                        exit(0);
                    }
            }

            $qry="UPDATE teacher set Name='$name',Email='$email',Dob='$dob',Aadhar=$aadhar,Gender='$gender',Phone=$phone,Address='$address',Pincode='$pincode' where TID='$tid'";
            $qry1="UPDATE teacherdetails set Degree='$degree',Designation='$desig',Maritial_Status='$maritial',DoR='$dor',Salary='$salary',DID=$did,CID=$cid where TID='$tid'";
            if(mysqli_query($conn,$qry) && mysqli_query($conn,$qry1))
                echo "<script>alert('Update Success');</script>";
            else
            echo "<script>alert('Update  Failed');</script>";
        }
        ?>
            
        
  
    