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

    
</style>
<?php include_once("../Connection/connection.php"); ?>
<?php 
if (isset($_GET['Edit']))
{
    $editid=$_GET['Edit'];
    $result=mysqli_query($conn,"SELECT * FROM teacher inner join teacherdetails on teacher.TID=teacherdetails.TID where teacher.TID='$editid'");
    $ResEdit=mysqli_fetch_assoc($result);
    //print_r($ResEdit);
}
?>
<body>
<?php include_once("navbar.php"); ?>
  <div class="container">
  <!-- <a class="btn btn-dark" href="dashboard.php">Go to Dashboard</a>  -->
    <form action="NewTeacherHandle.php" enctype="multipart/form-data" method="post" class="col-md-12">
    <div class="row">
       <div class="col-md-6">
        <?php if(isset($ResEdit['TID'])) {  ?> 
        <div class="form-group">
          <label>TID</label>
           <input type="text" name="TID" value="<?php 
           if (isset($ResEdit['TID'])) echo $ResEdit['TID']; ?>"
           class="form-control" pattern="TID20[0-9]{6}" readonly>
        </div>
        <?php
    }
    ?>
    <div class="form-group">
        <label form="input-name">Name</label>
        <input type="text" required maxlength="30" pattern="^[A-Z][a-zA-Z ]*$" placeholder="Staff Name" name="Name" id="input-name" class="form-control" value="<?php if(isset($ResEdit['Name']))
        echo $ResEdit['Name']; ?>"/>
    <li>Name should</li>
    <li>Eg: Sukas A S</li>
</div>
    <div class="form-group">
        <label for="input-photo">Photo</label>
        <input type="file" name="Photo" <?php if(!isset($_GET['Edit'])) echo "required";  ?> id="input-photo" class="form-control">
        <?php if(isset($ResEdit['Photo'])) 
        echo $ResEdit['Photo']; ?>
  <li>File should be of type PNG/JPEG</li>
<li>File Size should be lesser than 400kb</li>    
</div>
    <div class="form-group">
        <label for="input-date" >Date of Birth</label>
        <input type="date" required name="Dob" max="<?php echo date('Y-m-d',(time()-15*365*24*60*60)); ?>" id="input-date" class="form-control" value="<?php
        if(isset($ResEdit['Dob'])) echo $ResEdit['Dob']; ?>" />
    </div>
    <div class="form-horizontal">
        <label>Gender</label>
        <div>
            <input type="radio" name="Gender" id="input-Gender1" value="Male" required
            <?php if(isset($ResEdit['Gender'])&& $ResEdit['Gender']=="Male") echo "checked"; ?> />
            <label for="input-Gender1">Male</label>
            <input type="radio" name="Gender" id="input-Gender2" value="Female"  required
            <?php if(isset($REsEdit['Gender'])&& $RedEdit['Gender']=="Female") echo "checked"; ?> />
            <label for="input-Gender2">Female</label> 
            <input type="radio" name="Gender" id="input-Gender3" value="Others" required
            <?php if(isset($ResEdit['Gender'])&& $ResEdit['Gender']=="Others") echo "checked";?> />
            <label for="input-Gender3">Others</label>  
        </div>
    </div> 
    <div class="form-group">
        <label for="input-address">Address</lable>
        <textarea name="Address" required placeholder="Door No,Street Name,City Name" id="input-address" class="form-control"><?php if(isset($ResEdit['Address'])) echo $ResEdit['Address']; ?></textarea> 
    </div>
         <div class="form-group">
            <label for="input-pincode">Pincode</label>
            <input type="text" placeholder="Eg:628601 (All should be Numbers)" required maxlength="6" pattern="^[0-9]{6}" min=111111 max=999999 value="<?php if(isset($ResEdit['Pincode'])) 
            echo $ResEdit['Pincode']; ?>" name="Pincode" class="form-control">
            </div>
            <div class="form-group">
                <label for="input-aadhar">Aadhar</label>
                <input type="text" placeholder="Eg:9876543211234 (All should be Numbers)" required maxlength=12 minlength=12 pattern="^[0-9]*$" value="<?php if(isset($ResEdit['Aadhar']))
                echo $ResEdit['Aadhar']; ?>" name="Aadhar"  class="form-control">
              </div>
              <div class="form-group">
                <label for="input-phone">Phone</label>
                <input type="tel" placeholder="Eg:9876543210 (All should be Numbers)" required value="<?php if(isset($ResEdit['Phone']))
                echo $ResEdit['Phone']; ?>" name="Phone" maxlength=10  minlength=10 pattern="^[6-9]{1}[0-9]{9}$"   class="form-control">
                </div>     
                <div class="form-group">
                <label for="input-email">Email</label>
                <input type="email" placeholder="Eg:example123@gmail.com (Enter your email)"  required value="<?php if(isset($ResEdit['Email']))
                echo $ResEdit['Email']; ?>" name="Email"  class="form-control">      
                  </div>
               </div>
            <div class="col-md-6">
               <div class="form-group">
                <label for="input-degree">Degree</label>
                <input type="text" placeholder="Eg:B.Sc CS, MCA (Enter your degree)" required value="<?php if(isset($ResEdit['Degree']))
                echo $ResEdit['Degree']; ?>" name="Degree" class="form-control">
                </div>
                <div class="form-group">
                <label for="">Designation</label>
                <input type="text" placeholder="Eg:Associative Professor" required value="<?php if(isset($ResEdit['Designation']))
                echo $ResEdit['Designation']; ?>" name="Designation"  class="form-control">
                </div>
                <div class="form-group">
                    <label for="input-date3" >Date of Registration</label>
                    <input type="date" name="DoR" max="" id="input-date3" class="form-control" value="<?php
                    if(isset($ResEdit['DoR'])) echo $ResEdit['DoR']; ?>" />
                </div>
                <div class="form-group">
                    <label for="">Martial Status</label>
                    <select name="Maritial_Status" class="form-control">
                        <option value="Married" <?php if(isset($ResEdit['Maritial Status'])&& $ResEdit['Maritial_Status']=='Married') echo 'selected'; ?> >Married</option>
                        <option value="UnMarried" <?php if(isset($ResEdit['Maritial Status'])&& $ResEdit['Maritial_Status']=='UnMarried') echo 'selected'; ?> >UnMarried</option>
              </select>
                </div>
                    <div class="form-group">
                     <label for="">Salary </label>
                     <input type="number"  placeholder="Eg:1000-200000" required name="Salary" min=10000 max=200000 value="<?php if(isset($ResEdit['Salary'])) echo $ResEdit['Salary']; ?>"   
                     id="" class="form-control"> 
                      </div>
                       <div class="form-group">
                        <label for="">College</label>
                        <select name="CID" class="form-control" >
                        <?php
                        $qry="Select CID,CollegeName from college";
                        if($res=mysqli_query($conn,$qry))
                        {
                            while($result=mysqli_fetch_assoc($res))
                            {
                                $cid=$result['CID'];
                                $cname=$result['CollegeName'];
                                echo "<option value='$cid'";
                                if(isset($ResEdit['CID']) && $ResEdit['CID']==$cid)
                                echo "selected";
                                echo ">$cname</option>";
                            }
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Department(Choose the Department for the College You have Selected)</label>
                        <select name="DID" id="" class="form-control">
                            <?php
                                $qry="SELECT * from department inner join college on college.CID=department.CID";
                                if($res=mysqli_query($conn,$qry))
                                {
                                    while($result=mysqli_fetch_assoc($res))
                                    {
                                        
                                        //print_r($result);
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
                 
                 
         </div>

                    <br>
         <button type="submit" class="btn btn-primary"  style="margin-top:10px"
            <?php if(isset($_GET['Edit'])) echo "name='Update'> Update ";
            else echo "name='Create'> Create "; ?>
         </button>
    </form>
    <script>
        const files=document.getElementById("input-photo");
        const types=['image/jpeg','image/png'];
        files.addEventListener("input",(e)=>{
        console.log(files.files[0].size);
        if(!types.includes(files.files[0].type))
        {
            files.setCustomValidity("File should be of type png or jpg");
        }
        else if(files.files[0].size>(400*1024))
        {
            files.setCustomValidity("File should be less than 400kb");  
        }
        else
        {
            files.setCustomValidity(""); 
        }
    
        });
    </script>
  </div>  
</body>
</html>