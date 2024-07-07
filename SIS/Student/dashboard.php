<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../dashboard.css">
    <link rel="stylesheet" href="../messages.css">
    <link rel="stylesheet" href="../Bootstrap/fonts/css/fontawesome.min.css">
    <link rel="stylesheet" href="../Bootstrap/fonts/js/fontawesome.min.js">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <link rel="stylesheet" href="../MyStyles.css"> -->
    <script src="../tools/MyCookie.js"></script>
    <script src="../tools/printarea.js"></script>
</head>
<?php
    include_once("../Connection/Connection.php");
  
    session_start();

    if(isset($_SESSION['sredirect']))
        unset($_SESSION['sredirect']);
    if (isset($_SESSION["student"]) || isset($_COOKIE['student'])) 
    {
        if(!isset($_SESSION['student']))
           $_SESSION['student']=$_COOKIE['student'];
        $student=$_SESSION['student'];
        $mainqry="SELECT * FROM student inner join residential on student.SID=residential.SID where student.SID='$student'  ";
        if($mainres=mysqli_query($conn,$mainqry))
        {
            if(mysqli_num_rows($mainres)>0)
                $MainResult=mysqli_fetch_assoc($mainres);
        }
        $photo=$MainResult['File'];
    ?>
<body>
    
    <nav>
        <div class="navbar-header">
            <a href="" class="navbar-brand">SIS</a>
        </div>
        <div class="nav-user">
            <img src="../photo/<?php echo $MainResult['File']; ?>" alt="">
            <button class="btn btn-dark mobile" id="open">Menu</button>
            <form>
                <button type="submit" class="btn btn-dark d-none d-md-inline-block " name="Logout">Log Out</button>
                
            </form>
			<form>
			<button type="button" class="btn btn-light" id="cpass" >⚙</button>
			</form>
        </div>
     
    </nav>
       <?php     include_once("changepassword.php"); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3" id="sidebar-container">
                <div class="sidebar" id="sidebar">
                    <span class="mobile" id="close">X</span>
                    <div class="sidebar-head">
                        <img src=<?php echo "../imagefetch.php?photo=$photo" ?> alt="">
                        <h5><?php echo $MainResult['Name']; ?></h5>
                        <b><?php echo $MainResult['SID']; ?></b>
                        <form>
                            <button type="submit"class="btn btn-dark mobile" name="Logout">Log Out</button>
                        </form>
                        <?php
                            if(isset($_GET['Logout']))
                            {
                                session_destroy();
                                if($student==$_COOKIE['student'])
                                    echo "<script>setcookiejs('student','');</script>";
                                echo "<script>
                                window.location.href='../Login.php';
                                </script>";
                            }
                        ?>
                    </div>
                    <ul class="sidebar-body">
                        <li><a href="#" onclick="showall()">Dashboard</a></li>
                        <li><a href="#" onclick="showdiv('personal-details')">Personal Details</a></li>
                        <li class="dropdown-togg"><a href="#" onclick="showdiv('academic-details')">Academic Details</a>
                            <ul class="my-dropdown">
                                <li><a href="#" onclick="showdiv('sslc-details')" >SSLC Details</a></li>
                                <li><a href="#" onclick="showdiv('hse-details')" >HSE Details</a></li>
                            </ul> 
                        </li>
                        <li ><a href="#" onclick="showdiv('attendance-details')">Attendance Details</a> </li>
                        <li><a href="#" onclick="showdiv('semester-details')">Semester Details</a></li>
                    
                        <li><a href="#" onclick="showdiv('request-details')">Request Details</a></li>
                        <li><a href="#" onclick="showdiv('document-details')">Documents</a></li>
						 <li><a href="View_Notice.php">Notices</a></li>
					</ul>
                </div>
            </div>
            <div class="col-md-9" id="main-container">
                
                <div class="overview">
                    <div class="progresses">
                        <div class="circprogress" id="circprogress1">
                            <span id='percent'>50%</span>
                            <span id='name'></span>
                        </div>
                        <div class="circprogress" id="circprogress2">
                            <span id='percent'>50%</span>
                            <span id='name'></span>
                        </div>
                        <div class="circprogress" id="circprogress3">
                            <span id='percent'>50%</span>
                            <span id='name'></span>
                        </div>
                        <div class="circprogress" id="circprogress4">
                            <span id='percent'>50%</span>
                            <span id='name'></span>
                        </div>
                        <?php include_once("CircularProgress.html"); ?>
                   
                    </div>
                </div>
                <div class="calendar-container">
                            <?php include_once("../tools/time.html"); ?>
                            <header>
                                <h1 id="monthYear"></h1>
                            </header>
                            <div class="controls">
                                <div>
                                    <button onclick="previousYear()" class="btn btn-default">Prev</button>
                                    <button onclick="nextYear()" class="btn btn-default">Next</button>
                                </div>
                                <div>
                                    <button onclick="previousMonth()" class="btn btn-default">Prev</button>
                                    <button onclick="nextMonth()" class="btn btn-default">Next</button>
                                </div>
                            </div>
                            <div id="calendar" class="calendar"></div>
                </div>
                <div id="personal-details">
                    <?php
                        //$qry="SELECT * from student where SID='$student'";
                       // if($res=mysqli_query($conn,$qry))
                        //{
                            echo " <div class='card'>
                            <h2 class='card-header'>Profile</h2>
                            <div class='profile'>
                                    <img src='../imagefetch.php?photo=$photo' style='' alt='' class='card-img-top'>
                            </div>
                            <div class='card-body'>
                                <h2 class='card-title'>$MainResult[Name]</h2>
                                <b class='card-text'> $MainResult[SID] </b>
                            </div>
                            <ul class='list-group list-group-flush'>
                                <li class='list-group-item'><img src='../icons/student.png' class='icon'>$MainResult[Gender]</li>
                                <li class='list-group-item'><img src='../icons/certificate.png' class='icon'>$MainResult[Dob]</li>
                                <li class='list-group-item'> <img src='../icons/college-01.png' class='icon'> <b>$MainResult[Country]</b></li>
                            </ul>
                          
                        </div>";
                        //} 
                        // setInterval(()=>{location.reload()},1000);
                    ?>
                    <br>
                    <button class="btn btn-dark" onclick="printSection('personal-details')" >Print</button>
                </div>
                <!-- <div id="academic-details">
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Placeat deleniti facilis explicabo quibusdam error vel nam et. Incidunt accusantium placeat facilis consequuntur libero dignissimos est illum mollitia, doloremque quibusdam quidem cupiditate labore. Odit earum impedit aut iste, explicabo illum repudiandae. Asperiores repellat tempora repellendus magni animi officiis autem repudiandae optio?</p>
                </div> -->
                <div id="attendance-details">
                    <h2>Attendance</h2>
                    <?php
                        $qry="SELECT SID,Year,Hour,Date,AttStatus from attendance where SID='$student'";
                        if($res=mysqli_query($conn,$qry))
                        {
                            if(mysqli_num_rows($res)> 0)
                            {
                                while($result=mysqli_fetch_assoc($res))
                                {
                                    //print_r($result);
                                    $hour=$result['Hour'];
                                    $year=date("Y",strtotime($result['Date']));
                                    $month=date('M Y',strtotime($result['Date']));
                                    $day=date('d',strtotime($result['Date']));
                                    
                                
                                    if($result['AttStatus']=="Absent")
                                    {
                                        $attendance[$month]['Absent'][]=[
                                            "day"=>$day,
                                            "hour"=>$hour,
                                            "month"=>$month,
                                            "year"=>$year
                                        ];
                                    }
                                    else
                                    {
                                        $attendance[$month]["Present"][]=[
                                            "day"=>$day,
                                            "hour"=>$hour,
                                            "month"=>$month,
                                            "year"=>$year
                                        ];
                                    }
                                }
                                echo "<table class=table><thead>";
                                echo "<tr><th>Month</th><th>No of Present</th><th>No of Absent</th></tr></thead>";
                                echo "<tbody>";
                                $totaldays=0;
                                $totalpresent=0;
                                $totalabsent=0;
                                foreach($attendance as $month=>$value)
                                {
                                    $cpresent=0;
                                    $cabsent=0;
                                    if(isset($value['Absent']))
                                    {
                                        for($i=0; $i<count($value['Absent']);$i++)
                                        {
                                            $absentdays[]=$value['Absent'][$i]['day'];
                                            $uniqa=array_unique($absentdays);
                                        }
                                    }
                                    if(isset($value['Present']))
                                    {
                                        for($i=0; $i<count($value['Present']);$i++)
                                        {
                                            $presentdays[]=$value['Present'][$i]['day'];
                                            $uniqp=array_unique($presentdays);
                                        }
                                    }
                                    if(isset($value['Absent']) && isset($value['Present']))
                                        $uniqp=array_diff($uniqp,$uniqa);
                                        if(isset($value['Present']))
                                            $cpresent=count($uniqp);
                                        if(isset($value['Absent']))
                                            $cabsent=count($uniqa);
                                        $totalpresent+=$cpresent;
                                        $totalabsent+=$cabsent;
                                        $totaldays+=($cpresent+$cabsent);
                                        unset($presentdays);
                                        unset($absentdays);
                                        echo "<tr><th>$month</th><td>$cpresent</td><td>$cabsent</td></tr>";
                                }
                                $totalpercent=($totalpresent/$totaldays)*100;
                                $totalpercent=number_format($totalpercent,2);
                                echo "</tbody>";
                                echo "<tfoot><tr><th>Total Percentage</th><th>$totalpercent%</th></tr></tfoot></table>";
                                echo "<script>startprog($totalpercent,'Attendance','circprogress1','attendance-details')</script>";
                                echo "<details><summary>Absent Days</summary><table class='table' >";
                                echo "<tr><th>Date</th><th>Hour</th></tr>";
                                foreach($attendance as $month=>$value)
                                {
                                    if(isset($value['Absent']))
                                    {
                                        for($i= 0; $i<count($value['Absent']);$i++)
                                        {
                                            $day=$value['Absent'][$i]['day'];
                                            $month=$value['Absent'][$i]['month'];
                                            $hour=$value['Absent'][$i]['hour'];
                                            echo "<tr><td>$day $month</td><td>$hour</td></tr>";
                                        }
                                    }
                                }
                                echo "</table></details>";
                            }
                            else
                            {
                                echo "No Data Available";
                            }
                        }
                        
                    ?>
                    <button class="btn btn-dark" onclick="printSection('attendance-details')" >Print</button>
                </div>
                <div id="sslc-details">
                    <h2>SSLC</h2>
                    <div class="graph">
                        <canvas id="chart_sslc">

                        </canvas>
                    </div>
                    <table class="table" id="marks-sslc">
                            <thead>
                                <th>Subject</th>
                                <th>Mark</th>
                            </thead>
                            <tbody>
                                <?php
                                  include_once("../tools/chart.html");
                                $qry="SELECT Tamil,English,Mathematics,Science,Social_Science from sslc where SID='$student'";
                                if($res=mysqli_query($conn,$qry))
                                {
                                    if(mysqli_num_rows($res)> 0)
                                    {
                                        $mark=0;
                                        $markpercent=0;
                                        $result=mysqli_fetch_assoc($res);
                                        foreach($result as $sub=>$val)
                                        {
                                            echo "<tr><th>$sub</th><td>$val</td></tr>";
                                            $mark+=$val;
                                        }
                                        $markpercent=($mark/500)*100;
                                        $markpercent=number_format($markpercent,2);
                                        echo "<script>createChart('chart_sslc',".json_encode($result).")</script>";
                                    ?>
                                 
                            </tbody>
                            <tfoot>
                                <tr><th>Total Marks</th><td><?php echo $mark; ?></td></tr>
                                <tr><th>Mark Percent</th><th><?php echo "$markpercent%"; ?></th></tr>
                                <?php  echo "<script>startprog($markpercent,'SSLC','circprogress2','sslc-details')</script>"; ?>
                            </tfoot>
                           
                    <?php
                        }
                        else
                        {
                            echo "<center><b>No Data Available</b><center>";
                        }
                        }
                        else
                        {
                            echo "<center><b>Some Error Occured</b><center>";
                        }
                        ?>
                           </table>
                <button class="btn btn-dark" onclick="printSection('sslc-details')"> Print </button>
                </div>
                <div id="hse-details">
                    <h2>HSE</h2>
                    <div class="graph">
                        <canvas id="chart_hse">

                        </canvas>
                    </div>
                    <table class="table">
                            <thead>
                                <th>Subject</th>
                                <th>Mark</th>
                            </thead>
                            <tbody>
                                <?php
                                $qry="SELECT * from hse inner join school_subjects on school_subjects.Subject_ID=hse.Subject_ID where SID='$student'";
                                if($res=mysqli_query($conn,$qry))
                                {
                                    if(mysqli_num_rows($res)> 0)
                                    {
                                        $mark=0;
                                        $markpercent=0;
                                        while($result=mysqli_fetch_assoc($res))
                                        {
                                            $sub=$result['Subject_Title'];
                                            $mark=$result['Mark'];
                                            $marks[$sub]=$mark;
                                        }
                                        foreach($marks as $sub=>$val)
                                        {
                                            echo "<tr><th>$sub</th><td>$val</td></tr>";
                                            $mark+=$val;
                                        }
                                        $markpercent=($mark/600)*100;
                                        $markpercent=number_format($markpercent,2);
                                        echo "<script>createChart('chart_hse',".json_encode($marks).")</script>";
                                    ?>
                                 
                            </tbody>
                            <tfoot>
                                <tr><th>Total Marks</th><td><?php echo $mark; ?></td></tr>
                                <tr><th>Mark Percent</th><th><?php echo "$markpercent%"; ?></th></tr>
                                <?php  echo "<script>startprog($markpercent,'HSE','circprogress3','hse-details')</script>"; ?>
                            </tfoot>
                 
                    <?php
                        }
                        else
                        {
                            echo "<center><b>No Data Available</b><center>";
                        }
                        }
                        else
                        {
                            echo "<center><b>Some Error Occured</b><center>";
                        }
                        ?>
                    </table>
                    <button class="btn btn-dark" onclick="printSection('hse-details')"> Print </button>
                </div>
                <div id="semester-details">
                <h2>Semester Details</h2>
                    <!-- <table class="table">
                            <thead>
                                <th>Subject</th>
                                <th>Mark</th>
                            </thead>
                            <tbody> -->
                                <?php
                                $qry="SELECT * from sem_marks where SID='$student'";
                                if($res=mysqli_query($conn,$qry))
                                {
                                    if(mysqli_num_rows($res)> 0)
                                    {
                                        $fullmark=0;
                                        $subs=0;
                                        while($result=mysqli_fetch_assoc($res))
                                        {
                                            $sem=$result['Semester'];
                                            $json_marks=json_decode($result['Marks']);
                                            echo "<h3>SEM $sem</h3>";
                                            echo "<table class='table'> <thead><tr><th>Subject</th><th>Mark</th></tr></thead><tbody>";
                                            $temp=0;
                                            foreach($json_marks as $key=>$value)
                                            {
                                                
                                                echo "<tr><th>$key</th><td>$value</td></tr>";
                                                $temp=$temp+$value;
                                                $subs++;

                                            }
                                            $fullmark=$fullmark+$temp;
                                            echo "</tbody><tfoot><tr><th>Total</th><th>$temp</th></tr></tfoot></table>";
                                        }
                                        echo "<table class='table'>
                                                            <tfoot>
                                                            <tr><th>Total</th><th>$fullmark</th></tr>
                                                            <tr><th>Total Percentage</th><th>".($fullmark/$subs)."%</th></tr>
                                                            </tfoot>
                                        </table>";
                                        echo "<script>startprog(".($fullmark/$subs).",'Semester','circprogress4','semester-details')</script>";
                                    ?>
                                 
                            <!-- </tbody>
                            <tfoot>
                                <tr><th>Total Marks</th><td><?php echo $mark; ?></td></tr>
                                <tr><th>Mark Percent</th><th><?php echo "$markpercent%"; ?></th></tr>
                                <?php  echo "<script>startprog($markpercent,'HSE','circprogress3','hse-details')</script>"; ?>
                            </tfoot> -->
                 
                    <?php
                        }
                        else
                        {
                            echo "<center><b>No Data Available</b><center>";
                        }
                        }
                        else
                        {
                            echo "<center><b>Some Error Occured</b><center>";
                        }
                        ?>
                  <button class="btn btn-dark" onclick="printSection('semester-details')"> Print </button>
                </div>
        <div class="request-details" id="request-details">
            <h2>Requests</h2>
            <div class="plus">
                <a href="Messages.php?New" class="btn btn-dark">+ New Request</a>
            </div>
                <?php
          if(isset($_SESSION['student']))
          {
            $student=$_SESSION['student'];
            $qry="Select * from request where SID='$student'  order by CreatedAt DESC limit 2 ";
            if($res=mysqli_query($conn,$qry))
            {
              
                while($result=mysqli_fetch_assoc($res))
                {
                   $rid=$result['Request_ID'];
                    echo "
                    <div class='message' id='$rid'>
                        <h5>$result[SID] | $result[TID]</h5>";
                        if($result['Status']=="Rejected")
                        echo "<strong style='color:red'>$result[Status]</strong>";
                        elseif($result['Status']=="Submitted")
                        echo "<strong style='color:blue'>$result[Status]</strong>";
                        else
                        echo "<strong style='color:green'>$result[Status]</strong>";

                        echo "<label>Reason</label>
                        <p>";
                            if(empty($result['Reason']))
                                echo "No Reason Specified";
                            else
                                echo $result['Reason'];
                        echo "</p>";
                        echo "
                        <div class='tr'>
                        <table>
                            <tr><th>($result[Field_Name]) Field</th></tr>
                            <tr><td>From</td><th>$result[Old_Value]</th></tr>
                            <tr><td>To</td><th> $result[New_Value] </th></tr>
                        </table>
                        </div>
                        <label>Message</label>
                        <p>";
                            if(empty($result['Message']))
                                echo "No Message Specified";
                            else
                                echo $result['Message'];
                        
                        if($result['Status']=="Submitted")
                    
                        echo "
                        <form action='' method=''>
                            <button type='submit' style='width: fit-content;' name='Delete' value='$rid' class='btn btn-danger'>Delete</button>
                        </form>";
                        echo "
                    </div>
                    <br>
                    ";
                }
            } 
        }  
        ?>
                
            <a href="Messages.php">View More</a>
            </div>
            <div id="document-details">
                <h2>Document List</h2>
                <div class="plus">
                    <a href="document.php?NewDoc" class="btn btn-dark">+ New Upload</a>
                </div>
                <div class="doclist">
                    <div class="documents">
                    <?php
                $qry="SELECT * from document where SID='$student' limit 3";
                if($res=mysqli_query($conn,$qry))
                {
                    while($result=mysqli_fetch_assoc($res))
                    {
                        $docname=$result['Document_Name'];
                        $name=pathinfo($docname,PATHINFO_FILENAME);
                        $doctype=$result['Document_Type'];
                        $sid=$result['SID'];
                        $uploadedon=$result['UploadOn'];
                        $uploadon=date('d M Y H:i',strtotime($uploadedon));
                        $fdes=$result['Description'];
                        if(!$fdes)
                            $fdes="No Description";
                        $docpath=$result['Document_Path'];
                        $docsize=$result['Document_Size'];
                        $size=number_format($docsize/(1024),2);
                        $doid=$result['Document_ID'];
                        $docid=base64_encode($doid);
                        echo "<div class='docs'>
                            <h4>$name <em style='color:blue'> - $doctype </em></h4>
                            <em>$size Kb </em>
                            <br>
                            <b>$sid</b>
                            <p>$fdes</p>
                            <b>Uploaded On <br> <em>$uploadon</em></b>
                            </div>
                        ";

                    }
                }
                ?>
                    </div>
                </div>
                <a href="document.php">View More</a>
            </div>
            </div>
        </div>
    </div>
<script>
    const opens=document.getElementById("open");
    const closes=document.getElementById("close");
    const sidebar=document.getElementById("sidebar");
    const containers=document.querySelectorAll("#main-container > div");
    opens.addEventListener("click",(e)=>{
        sidebar.classList.toggle("side");
    })
    closes.addEventListener("click",(e)=>{
        sidebar.classList.toggle("side");
    })
    // containers.forEach(el=>{
    //     el.innerHTML+="<br>";
    //     const btn=document.createElement("button");
    //     btn.classList.add("btn");
    //     btn.classList.add("btn-dark");
    //     btn.innerText="Print";
    //     btn.addEventListener("click",(e)=>{
    //         printSection(el.id);
    //     })
    //     el.appendChild(btn);


    // })
    function showall()
    {
        // containers.forEach(element=>{
        //     element.classList.remove("inactive");
        // })
        // closes.click();
        location.reload();
    }
    function showdiv(val)
    {
        const active=document.getElementById(val);
        containers.forEach(element=>{
            element.classList.add("inactive");
        })
        active.classList.remove("inactive");
        closes.click();
    }
</script>
<script src="../tools/calendar.js"></script>
</body>

<?php
include_once("../tools/toparrow.html");
}
else
{
    echo "<center><h5>Please Login and Come</h5><a href='../Login.php?Loger=Student'>Login Here</a></center>";
}
?>
</html>