<!DOCTYPE html>
<?php
//session_start(); ?>
<?php require_once("../Connection/Connection.php") ?>
<?php
    if(isset($_GET['Edit']))
    {
        $Edit=$_GET['Edit'];
        $qry="SELECT * FROM student inner join residential on student.SID=residential.SID inner join scholarship on student.SID=scholarship.SID inner join academicdetails on student.SID=academicdetails.SID where student.SID='$Edit'";
        $res=mysqli_query($conn,$qry);
        if($res)
            $ResEdit=mysqli_fetch_assoc($res);
        //print_r($ResEdit);
    }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/bootstrap-stack.png" type="image/x-icon">
    <title>New Student</title>
   
    <!-- <link rel="stylesheet" href="Bootstrap/css/bootstrap.css"> -->
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
   
    <link rel="stylesheet" href="../MyStyles.css">
    
    
</head>
<style>
 @keyframes anime {
    from{
        opacity: 0%;
        transform: translateY(20px);
    }
    to
    {
        opacity: 100%;
        transform: translateY(0px);
    }
    
   }
.tab-content
{
display: none;
animation: anime 1s;
}
.active-tab{
display: block;
}

</style>
<body>
  
    <div class="container-fluid">
        <?php include_once("navbar.php"); ?>
   <div class="row">
  
    <div class="col-md-12">
        <nav class="nav-stacked">
            <ul class="nav nav-tabs  d-flex" id="navtab" style="background-color: white;">
                <li class="nav-item"><a class="nav-link active" data-number=0  data-tab="student_personal" href="#">Personal Details</a></li>
                <li class="nav-item"><a class="nav-link" data-number=1 data-tab="residential_details" href="#residential_details">Residential Details</a></li>
                <li class="nav-item"><a class="nav-link" data-number=2 data-tab="academic_details" href="#academic_details">Academic Details</a></li>
                <li class="nav-item"><a class="nav-link" data-number=3 data-tab="scholarship_details" href="#scholarship_details">Scholarship Details</a></li>
                <!-- <li class="nav-item"><a class="nav-link" data-number=4 data-tab="complete_details" href="#complete_details">Complete Details</a></li> -->
            </ul>
            <style>
     
            </style>
        </nav>
            <form id="NewStudentForm" action="NewUserHandle.php" enctype="multipart/form-data" method="post" class="d-flex flex-column gap-2 p-2">
                <!-- <h2 class="panel-heading text-center">New Student Form</h2> -->
                <div class="tab-content active-tab col-md-12 gap-5 " id="student_personal">
                    <div class="row">
                <div class="col-md-6 col-xs-12 gap-2">
                    <?php if(isset($ResEdit['SID']))
                    {
                     ?>
                     <div class="form-group ">
                        <label for="input-name">SID</label>
                        <input type="text" name="SID"  value="<?php echo $ResEdit['SID']; ?>"  id="input-name" maxlength="30" class="form-control" readonly required>

                    </div>
                     <?php
                    }
                     ?>
                    <div class="form-group ">
                        <label for="input-name">Name</label>
                        <input type="text" pattern="^[A-Z][a-z A-Z]*$"  value="<?php if(isset($ResEdit['Name'])) echo $ResEdit['Name'];?>" name="Name" id="input-name" maxlength="30" class="form-control" required>
                        <li>Name should</li>
                        <li>Eg: Sukas A S</li>
                    </div>
                    <div class="form-group">
                        <label for="input-file">Choose file</label>
                        <input type="file" name="File" id="input-file" class="form-control"  <?php if(!isset($_GET['Edit'])) echo "required"; ?>  >
                        <?php echo"<span>";if(isset($ResEdit['File'])) echo $ResEdit['File']; echo "</span>";?>
                     
                            <li>File should be of type PNG/JPEG</li>
                            <li>File Size should be lesser than 400kb</li>
                     
                    </div>
                    <script>
                        const files=document.getElementById("input-file");
                        const type=['image/jpeg','image/png'];
                        files.addEventListener("input",(e)=>{
                            if(!type.includes(files.files[0].type))
                            {
                                files.setCustomValidity("File should be PNG or JPEG");
                            }
                            else if(files.files[0].size>(400*1024))
                            {
                                files.setCustomValidity("File should not be more than 400kb");
                            }
                            else
                            {
                                files.setCustomValidity("");
                            }
                        })
                    </script>
                    <div class="form-group">
                        <label for="input-dob">Date of Birth</label>
                        <input type="date" required  name="Dob" value="<?php if(isset($ResEdit['Dob'])) echo $ResEdit['Dob'];?>" max="<?php echo date("Y-m-d",time()-(15*365*24*60*60)) ?>" id="input-dob" class="form-control">
                         <li> Enter correct date of birth</li>
                    </div>
                    <div class="form-group">
                        <label for="input-gender">Gender</label>
                        <div class="gender">
                            <input type="radio" required name="Gender" id="gender_male" value="Male"  <?php if(isset($ResEdit['Gender']) && $ResEdit['Gender']=="Male") echo "checked"; ?> >
                            <label for="gender_male" class="" >Male</label>
                            <input type="radio" required name="Gender" id="gender_female" value="Female" <?php if(isset($ResEdit['Gender']) && $ResEdit['Gender']=="Female") echo "checked"; ?> >
                            <label for="gender_female">Female</label>
                            <input type="radio" required name="Gender" id="gender_others" value="Others" <?php if(isset($ResEdit['Gender']) && $ResEdit['Gender']=="Others") echo "checked"; ?> >
                            <label for="gender_others">Transgender</label>
                        </div>
                    </div>
               
                    <div class="form-group">
                        <label for="input-aadhar">Aadhar Number</label>
                        <input type="number" value="<?php if(isset($ResEdit['Aadhaar'])) echo $ResEdit['Aadhaar'];?>" name="Aadhaar" id="input-aadhar" maxlength="12" class="form-control" placeholder="number should be 12 digits">
                       <li> The number should be digits of 12</li>
                    </div>
                    <!-- <div class="form-group">
                        <label for="input-address">Address</label>
                        <textarea type="text" name="Address" id="input-address"  class="form-control"></textarea>
                    </div> -->
                    <div class="form-group">
                        <label for="input-phone">Phone Number</label>
                        <input type="number" value="<?php if(isset($ResEdit['Phone'])) echo $ResEdit['Phone'];?>" name="Phone" id="input-phone" class="form-control" placeholder="number should be 10 digits">
                        <li>The numbers should be digits of 10</li>
                    </div>
                    <div class="form-group">
                        <label for="">Religion</label>
                        <select name="Religion" id="" class="form-control">
                            <option value="Hindu" <?php if(isset($ResEdit['Religion']) && $ResEdit['Religion']=='Hindu') echo 'selected'; ?>>Hindu</option>
                            <option value="Christian" <?php if(isset($ResEdit['Religion']) && $ResEdit['Religion']=='Christian') echo 'selected'; ?>>Christian</option>
                            <option value="Muslim" <?php if(isset($ResEdit['Religion']) && $ResEdit['Religion']=='Muslim') echo 'selected'; ?>>Muslim</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Religion</label>
                        <select name="Community" id="" class="form-control">
                            <option value="BC" <?php if(isset($ResEdit['Community']) && $ResEdit['Community']=='BC') echo 'selected'; ?>>BC</option>
                            <option value="MBC" <?php if(isset($ResEdit['Community']) && $ResEdit['Community']=='MBC') echo 'selected'; ?>>MBC</option>
                            <option value="SC" <?php if(isset($ResEdit['Community']) && $ResEdit['Community']=='SC') echo 'selected'; ?>>SC</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12  gap-2">
                  
                    <div class="form-group">
                        <label for="input-email">Email</label>
                        <input type="email" required value="<?php if(isset($ResEdit['Email'])) echo $ResEdit['Email'];?>" name="Email" id="input-email" class="form-control" placeholder="Enter your email">
                    <li>Enter your valid email</li>
                    </div>
                    <div class="form-group">
                        <label for="input-father">
                            Father Name
                        </label>
                        <input type="text" required  name="FatherName" pattern="^[A-Z][a-zA-Z ]*$" value="<?php if(isset($ResEdit['FatherName'])) echo $ResEdit['FatherName'];?>" id="input-father" class="form-control">
                    <li>Only alphabets and spaces are allowed</li>

                    </div>
                    <div class="form-group">
                        <label for="input-mother">
                            Mother Name
                        </label>
                        <input type="text" required name="MotherName" pattern="^[A-Z][a-zA-Z ]*$" value="<?php if(isset($ResEdit['MotherName'])) echo $ResEdit['MotherName'];?>" id="input-mother" class="form-control">
                   <li>Only alphabets and spaces are allowed</li>
                    </div>
                    
               
                    <div class="form-group">
                        <label for="input-father">
                            Father Occupation
                        </label> 
                        <input type="text" required name="FatherOccupation" pattern="^[A-Z][a-zA-Z ]*$" value="<?php if(isset($ResEdit['FatherOccupation'])) echo $ResEdit['FatherOccupation'];?>" id="input-fatheroccup" class="form-control">
                   <li>Only alphabets and spaces are allowed</li>
                    </div>
                    <div class="form-group">
                        <label for="input-mother">
                            Mother Occupation
                        </label>
                        <input type="text" required name="MotherOccupation" pattern="^[A-Z][a-zA-Z ]*$" value="<?php if(isset($ResEdit['MotherOccupation'])) echo $ResEdit['MotherName'];?>" id="input-motheroccup" class="form-control">
                       <li>Only alphabets and spaces are allowed</li>
                    </div>
                    <div class="form-group">
                        <label for="input-fatherno">
                            Father Number
                        </label>
                        <input type="number" required name="FPhone" id="input-fatherno" value="<?php if(isset($ResEdit['FPhone'])) echo $ResEdit['FPhone'];?>" class="form-control">
                    <li>The numbers should be digits of 10</li>
                     </div>
                    <div class="form-group">
                        <label for="input-motherno">
                            Mother Number
                        </label>
                        <input type="number" required name="MPhone" id="input-motherno" value="<?php if(isset($ResEdit['MPhone'])) echo $ResEdit['MPhone'];?>" class="form-control">
                    <li>The numbers should be digits of 10</li>
                    </div>
                   
                </div>
                    </div>
            </div>
            <div class="tab-content  col-md-12 " id="residential_details" >
                <div class="form-group">
                    <label for="input-address">Address</label>
                    <textarea name="Address" required  id="input-address" class="form-control" placeholder="Door no,place,district,Thaluk,pin-code should be must"><?php if(isset($ResEdit['Address'])) echo $ResEdit['Address'];?></textarea>
                </div>
                <div class="form-group">
                    <label for="input-country">Country</label>
                    <input name="Country" id="input-country" value="<?php if(isset($ResEdit['Country'])) echo $ResEdit['Country'];else echo 'INDIA';?>" readonly value="INDIA" class="form-control">
                
                </div>
                <div class="form-group">
                    <label for="input-state">
                        Select State
                    </label>
                    <select name="State" value="<?php if(isset($ResEdit['State'])) echo $ResEdit['State'];?>" id="input-state" class="form-control">
                     
                    </select>
                    <li>select the option carefully and correctly</li>
                </div>
                <div class="form-group">
                    <label for="input-district">
                        Select District
                    </label>
                    <select name="District" value="<?php if(isset($ResEdit['District'])) echo $ResEdit['District'];?>" id="input-district" class="form-control">
                     
                   </select>
                <li>select your district</li>
                </div>
                <div class="form-group">
                    <label for="input-taluk">Taluk</label>
                    <input type="text" required name="Taluk" value="<?php if(isset($ResEdit['Taluk'])) echo $ResEdit['Taluk'];?>" id="input-taluk" class="form-control">
              <li>Enter your thaluk</li>
                </div>
            </div>
            <div class=" tab-content  col-md-12 " id="academic_details" >
                <div class="form-group">
                    <label for="input-batch">Batch</label>
                    <input type="number" required class="form-control" value="<?php if(isset($ResEdit['Batch'])) echo $ResEdit['Batch'];?>" name="Batch" id="input-batch">
              
              <li>Enter correct acedamic year</li>  </div>
              <div class="form-group">
                    <label for="">Join Date</label>
                    <input type="date" required name="Join_Date" value="<?php if(isset($ResEdit['Join_Date'])) echo $ResEdit['Join_Date']; ?>" id="" class="form-control">
              </div>
                <div class="form-group">
                    <label for="input-year">Year</label>
                    <select name="Year" id="input-year" class="form-control">
                        <option value="1" <?php if(isset($ResEdit['Year']) && $ResEdit['Year']=="1") echo "selected"; ?> >I</option>
                        <option value="2" <?php if(isset($ResEdit['Year']) && $ResEdit['Year']=="2") echo "selected"; ?> >II</option>
                        <option value="3"  <?php if(isset($ResEdit['Year']) && $ResEdit['Year']=="3") echo "selected"; ?> >III</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="input-type">Institution Type</label>
                    <div class="typeaid gender">
                        <input type="radio" name="Type" id="input-collegetype" value="Government" <?php if(isset($ResEdit['Type']) && $ResEdit['Type']=="Government") echo "checked"; ?> >
                        <label for="input-collegetype" class="">Government</label>
                        <input type="radio" name="Type" id="input-schooltype" value="Government-Aided" <?php if(isset($ResEdit['Type']) && $ResEdit['Type']=="Government-Aided") echo "checked"; ?> >
                        <label for="input-schooltype">Government-Aided</label>
                        <input type="radio" name="Type" id="input-schoolstype" value="Private" <?php if(isset($ResEdit['Type']) && $ResEdit['Type']=="Private") echo "checked"; ?> >
                        <label for="input-schoolstype">Private</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="input-college">Select College</label> 
                    <select id="input-college" name="CID" class="form-control">
                   
                        
                    
                </select>
            <li>select your college</li>    
            </div>
                <div class="form-group">
                    <label for="input-course">Select Course</label> 
                    <select name="DID" id="input-course" class="form-control">
                       
                        <!-- <optgroup label="Arts">
                            <option value="English">English</option>
                            <option value="Tamil">Tamil</option>
                            <option value="Economics">Economics</option>
                            <option value="Commerce">Commerce</option>
                        </optgroup>
                        <optgroup label="Science">
                            <option value="Computer Science">Computer Science</option>
                            <option value="Mathematics">Mathematics</option>
                            <option value="Physics">Physics</option>
                            <option value="Chemistry">Chemistry</option>
                        </optgroup> -->
                    </select>
                <li>select your course </li>
                </div>
                <div class="form-group">
                    <label for="input-status">Status</label>
                    <!--<input type="text" name="Status" value="<?php if(isset($ResEdit['Status'])) echo $ResEdit['Status'];?>"; id="input-status" class="form-control"> -->
                    <select name="Status" id="" class="form-control">
                        <option value="Active" <?php if(isset($ResEdit['Status']) && $ResEdit['Status']=='Active' ) echo 'selected';?> >Active</option>
                        <option value="InActive" <?php if(isset($ResEdit['Status']) && $ResEdit['Status']=='InActive' ) echo 'selected';?> >InActive</option>
                    </select>
                </div>
            </div>
            <div class="tab-content  col-md-12 " id="scholarship_details" >
                <div class="form-group">
                    <label for="input-scholarshipname">Scholarship Name</label>
                    <select name="ScholarshipName" id="input-scholarshipname" class="form-control">
                        <option value="Post-Matric Scholarship" <?php if(isset($ResEdit['ScholarshipName']) && $ResEdit['ScholarshipName']=="Post-Matric Scholarship") echo "selected"; ?> >Post-Matric Scholarship</option>
                        <option value="Adi-Dravidar Scholarhip" <?php if(isset($ResEdit['ScholarshipName']) && $ResEdit['ScholarshipName']=="Adi-Dravidar Scholarhip") echo "selected"; ?> >Adi-Dravidar Scholarhip</option>
                        <option value="Pre-Matric Scholarship"  <?php if(isset($ResEdit['ScholarshipName']) && $ResEdit['ScholarshipName']=="Pre-Matric Scholarship") echo "selected"; ?> >Pre-Matric Scholarship</option>
                    </select>
               <li>Select yours carefully</li>
                </div>
                <div class="form-group">
                    <label for="input-scholaramount">Scholarship Amount</label>
                    <input type="number" required max="200000" min="1000" value="<?php if(isset($ResEdit['Amount'])) echo $ResEdit['Amount'];?>" id="input-scholaramount" name="Amount" class="form-control">
                <li>Enter amount</li>
                </div>
                <div class="form-group">
                    <label for="input-scholardate">Scholarship Issued date</label>
                    <input type="date" required  id="input-scholardate" name="IssuedDate" value="<?php if(isset($ResEdit['IssuedDate'])) echo $ResEdit['IssuedDate'];?>"  class="form-control">
                </div>
                <div class="form-group">
                    <label >Scholarship Provider</label>
                    <div class="typescholar gender">
                        <input type="radio" name="ScholarshipType" id="input-govtype" value="Government"  <?php if(isset($ResEdit['ScholarshipType']) && $ResEdit['ScholarshipType']=="Government") echo "checked"; ?> >
                        <label for="input-govtype" class="">Government</label>
                        <input type="radio" name="ScholarshipType" id="input-privatetype" value="Private" <?php if(isset($ResEdit['ScholarshipType']) && $ResEdit['ScholarshipType']=="Private") echo "checked"; ?> >
                        <label for="input-privatetype">Private</label>
                       
                    </div>
                </div>
            </div>
            <!-- <div class="tab-content  col-md-12 " id="complete_details" >
                <div class="form-group">

                </div>
               
            </div> -->

        
            <script>
                //Dynamic Injection of State and District Code 
                const statedistrict={
                    "Tamil Nadu":["Chennai","Thoothukudi","Tirunelveli"],
                    "Kerala":["Thiruvanathapuram","Kerala1","kerala2"],
                    "Andhra Pradesh":["Andhra1","Andhra2","Andhra3"]
                }
                const selectstate="<?php if(isset($ResEdit['State'])) echo $ResEdit['State'];?>";
                const selectdistrict="<?php if(isset($ResEdit['District'])) echo $ResEdit['District'];?>";
                const state=document.getElementById("input-state");
                const district=document.getElementById("input-district");
                Object.keys(statedistrict).forEach(element=>{
                    const option=document.createElement("option");
                    option.value=option.innerHTML=element;
                    if(option.value==selectstate)
                        option.selected=true;
                    else
                        option.selected=false;
                    state.appendChild(option);
                })
                setDistrict(state.value)
                
                function setDistrict(val)
                {
                  
                    let child=district.lastChild;
                    while(child)
                    {
                        district.removeChild(child);
                        child=district.lastChild;
                    }
                    statedistrict[val].forEach(element=>{
                        const option=document.createElement("option");
                        option.value=option.innerHTML=element;
                        if(option.value==selectdistrict)
                        option.selected=true;
                        district.appendChild(option);   
                    })
                }
              
                state.addEventListener("change",(e)=>{
                   setDistrict(e.target.value)
                })
            

            </script>
            <script>
                // let jsonar='[<?php if(isset($ResEdit)) echo json_encode($ResEdit); ?>]';
                // console.log(jsonar);
                // jsonar=JSON.parse(jsonar);
                // const newstudentform=document.querySelectorAll("#NewStudentForm input[type='text']");
            </script>
         
            <br>
          
            <style>
            .navic{
                    display: flex;
                    justify-content: space-between;
            }
            </style>
              <button type="submit" style="width: 100%;margin: 1rem 0rem" class="btn btn-primary btn-block" id="create-button"   <?php if(isset($ResEdit)) echo  "name='Update'>Update"; else echo "name='Create'>Create"; ?></button>
            <div class="navic">
                <button type="button" class="btn btn-primary" id="prev">prev</button>
                <button type="button" class="btn btn-primary" id="next">next</button>
            </div>
            </form>
        </div>
      
    </div>
</div>

<script>

    //Form Navigation Goes Here 
    const tabs=document.querySelectorAll("#navtab li a");
    let curin=0,i;
    const prev=document.getElementById("prev");
    const next=document.getElementById("next");
    const create=document.getElementById("create-button");
    create.disabled=true;
    function showtabs()
    {
        for(i=0;i<tabs.length;i++)
        {
            document.getElementById(tabs[i].dataset.tab).style.display="none";
            tabs[i].classList.remove("active");
        }
        if(curin<=0)
        {
            curin=0;
            prev.disabled=true;
        }
        else
            prev.disabled=false;
        if(curin>=tabs.length-1)
        {
            curin=tabs.length-1;
            next.disabled=true;
            create.disabled=false;

        }
        else
            next.disabled=false;
        document.getElementById(tabs[curin].dataset.tab).style.display="block";
        tabs[curin].classList.add("active");

    }
    showtabs();

    prev.addEventListener("click",(e)=>{
        curin=(curin-1);
        showtabs();
    })
    next.addEventListener("click",(e)=>{
       let i,flag=0;
       const curtab=document.querySelectorAll("#"+tabs[curin].dataset.tab+" input");
       for(i=0;i<curtab.length;i++)
       {
     
            if(!curtab[i].reportValidity())
            {
                flag=1;
                break;
            }  
       }
       if(flag==0)
       {
        curin=(curin+1);
        showtabs();
       }
    })
    //Form validation Goes Here
    function numvalid(target,minlen,maxlen)
    {
        if(target.name=="Aadhaar")
            minlen=maxlen=12
        if(target.name=="Batch")
            minlen=maxlen=4
        target.value=target.value.slice(0,maxlen);
        console.log(target.value.length)
        console.log(target)
        if(target.value.length<minlen)
            target.setCustomValidity("Invalid Length");
        else if(target.name=='Phone' || target.name=='FPhone' || target.name=='MPhone' || target.name=='Aadhaar')
        {    if(target.name=='Aadhaar')
                target.setCustomValidity("");
            if(target.value[0]<6 && target.name!='Aadhaar')
                target.setCustomValidity("Number should Be start from More than 5")
            else
                target.setCustomValidity("");
        }
        else
            target.setCustomValidity("");
    }

    const numbertype=document.querySelectorAll("#NewStudentForm input[type='number']:not([name='Amount'])")
    numbertype.forEach(element=>{
        console.log(element)
        numvalid(element,10,10);
        element.addEventListener("input",(e)=>{
            console.log(e);
            numvalid(e.target,10,10);
         }) 
         element.addEventListener("DOMContentLoaded",(e)=>{
            console.log(e);
            numvalid(e.target,10,10);
         }) 
        //  element.addEventListener("load",(e)=>{
        //     console.log(e);
        //     numvalid(e.target,10,10);
        //  }) 
    })
  
   

 
</script>
<?php
if(isset($_GET['Edit']))
{
    echo "<script>
    tabs.forEach(element=>{
        element.addEventListener('click',(e)=>{
            curin=parseInt(e.target.dataset.number);
            showtabs();
        })
    })
    </script>";
} 
?>
<!-- <script src="navcollapse.js"></script> -->
<script>
    const collegeselect="<?php if(isset($ResEdit['CID'])) echo $ResEdit['CID'];?>";
    const deptselect="<?php if(isset($ResEdit['DID'])) echo $ResEdit['DID'];?>";
    const college=document.getElementById("input-college");
    const dept=document.getElementById("input-course");
    fetch("../fetchcollege.php")
    .then(r=>r.json())
    .then(res=>{
        collegeoptions(res);
    })
    .catch(e=>console.error(e))

    college.addEventListener("change",(e)=>{
        // college.firstElementChild.disabled=true;
        deptoptions(college.value);
    })
    function collegeoptions(data)
    {
        data.forEach(element => {
            const option=document.createElement("option");
            option.innerHTML=element.CollegeName;
            option.value=element.CID;
            if(option.value==collegeselect)
                option.selected=true;
            else
                option.selected=false;
            college.appendChild(option)
        });   
        deptoptions(college.value) 
    }
    function deptoptions(val)
    {
        let last=dept.lastChild;
        while(last)
        {
            dept.removeChild(last);
            last=dept.lastChild;
        }
        fetch("../fetchdepartment.php?college="+val+"")
        .then(r=>r.json())
        .then(data=>{
        data.forEach(element=>{
            const option=document.createElement("option");
            option.innerHTML=element.DName;
            option.value=element.DID;
            if(option.value==deptselect)
                option.selected=true;
            dept.appendChild(option)
        });
        })
        .catch(e=>console.error(e))
        
    }
</script>
<?php include_once("../toparrow.html") ?>
<?php include_once("../confirmmodal.html"); ?>
</body>
<!-- <script src="history.js"></script> -->

<script>
    if(document.getElementById("create-button").name=='Update')
        formsubmit("NewStudentForm","Update","Update Modal","Are You Sure to Update?","Update","Cancel");
    else if(document.getElementById("create-button").name=='Create')
        formsubmit("NewStudentForm","Create","Create Modal","Are You Sure to Create?","Create","Cancel");
</script>
</html>