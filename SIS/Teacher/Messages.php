<?php include_once("../Connection/Connection.php"); ?>
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
    <div class="container-fluid">
        <?php include_once("navbar.php"); ?>
    </div>
    <style>
        .message
        {
            display: flex;
            flex-direction: column;
            border: 1px solid rgb(228, 226, 226);
            padding:0.5rem;
            background-color: rgb(255, 255, 255);
            border-radius: 5px;
            box-shadow: 0px 2px 5px 2px rgb(207, 204, 204);
            /* max-height: 70px; */
            overflow: hidden;
            transition: all 1s;
        }
      
        .message .tr
        {
            min-width: fit-content;
            max-width: 40%;
            display: flex;
            flex-direction: column;
          
        }
        textarea[name='Reason']
        {
            display: none;
            margin:1rem 0rem;
            width: 70%;
        }
        #reason:checked ~ textarea[name='Reason']
        {
            display: block;
        }
        #reason
        {
            text-align: left;
            width: fit-content;
        }
    </style>
    <div class="container py-2">
        <?php //include_once("../tools/commun.html"); 
       
        ?>
        <?php
          if(isset($_SESSION['teacher']))
          {
            $teacher=$_SESSION['teacher'];
            $qry="Select * from request where TID='$teacher' order by CreatedAt DESC";
            if($res=mysqli_query($conn,$qry))
            {
				
			  $check_qry="SELECT TID from request where TID='$teacher' AND Status='Submitted';";
              if($check_res=mysqli_query($conn,$check_qry))
			  {
				$num=mysqli_num_rows($check_res);
				if($num!=0)
				{
				include_once("../tools/Toast.html");
				echo "<script>setToast('&times;','$num')</script>";
				}
			  }
                while($result=mysqli_fetch_assoc($res))
                {
                    $rid=$result['Request_ID'];
                    echo "
                    <div class='message'>
                        <h5>$result[TID] | $result[SID]</h5>";
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

                       
                        echo "<div class='tr'>
                        <table>
                            <tr><th>($result[Field_Name]) Field</th></tr>
                            <tr><td>From</td><th>$result[Old_Value]</th></tr>
                            <tr><td>To</td><th> $result[New_Value] </th></tr>
                        </table>
                        </div>
                        <label>Message</label>
                        <p>";
                            if(empty($result['Message']))
                                echo "No Reason Specified";
                            else
                                echo $result['Message'];
                        echo "</p>"; 
                       if($result['Status']!="Updated")
                       {
                        echo "<form action='' method=''>";
                        echo "
                            <button type='submit' style='width: fit-content;' name='Accept' value='$rid' class='btn btn-secondary'>Accept</button>";
                            echo "
                            <button type='submit' style='width: fit-content;' name='AcceptUpdate' value='$rid' class='btn btn-success'>Accept And Update</button>";
                            if($result['Status']!="Rejected")
                            
                            echo "

                            <button type='submit' style='width: fit-content;' name='Reject' value='$rid' class='btn btn-danger'>Reject</button>
                            <input type='checkbox' id='reason'>Reason?<textarea name='Reason' class='form-control'></textarea>
                            ";
                          
                        echo "</form>";
                       }
                    echo "
                    </div>
                    <br>
                    ";
                   
                }
          
            } 
        }
            
        ?>
        <?php
        if(isset($_GET['Accept']))
        {
          $acceptid=$_GET['Accept'];
        
          $qry="Update request set Status='Accepted' where Request_ID=$acceptid";
          if(mysqli_query($conn,$qry))
          {
          
            if(mysqli_query($conn,$qry))
            {
                echo "<script>alert('Update Accept Sucess')</script>";
                echo "<script>
                    window.location.href='Messages.php'
                </script>";
            }
  
          }
        }
        if(isset($_GET['Reject']))
        {
          $rejectid=$_GET['Reject'];
          $reason=$_GET['Reason'];
          if(empty($reason)) $reason="No Reason Specified";
          $qry="Update request set Status='Rejected',Reason='$reason' where Request_ID=$rejectid";
          if(mysqli_query($conn,$qry))
          {
            
            if(mysqli_query($conn,$qry))
            {
                echo "<script>alert('Accept success')</script>";
                echo "<script>
                    window.location.href='Messages.php'
                </script>";
            }
  
          }
        }
        if(isset($_GET['AcceptUpdate']))
        {
            $rid=$_GET['AcceptUpdate'];
            $flag=0;
            $qry="SELECT * from request where Request_ID=$rid";
            if($res=mysqli_query($conn,$qry))
            {
                $result=mysqli_fetch_assoc($res);
                
            }
            $sid=$result['SID'];
            $field=$result['Field_Name'];
            $old=$result['Old_Value'];
            $new=$result['New_Value'];
            try{
            $qry="UPDATE student inner join residential on student.SID=residential.SID set $field='$new' where student.SID='$sid'";
            if(mysqli_query($conn,$qry))
            {
                //echo "<script>alert('UPDATEd success')</script>";
                $flag=1;
            }
            }
            catch(Exception $e)
            {
                $flag=0;
                echo $e->getMessage();
                echo "<script>alert('Not success')</script>";
                echo "Not Sucess";
            }
            if($flag!=0)
            {
                $qry="Update request set Status='Updated' where Request_ID=$rid";
                if(mysqli_query($conn,$qry))
                {
                
                  if(mysqli_query($conn,$qry))
                  {
                    echo "<script>alert('UPDATE Accept success');
                        
                    </script>";
                  }
                  else
                    {
                        echo "<script>alert('UPDATE Accept Failed');
                        window.location.href='NewStudent.html?Edit=$sid';
                        </script>";  
                    }

                }
            }
        }
        ?>
      
        <!-- <div class='message' >
            <h5>Name</h5>
            <h6>Field</h6>
            <div class="tr">
                <b>From </b><b>To</b>
            </div>
            <p>Lorem, ipsum dolor sit amet consectetur a Lorem, ipsum dolor sit amet consectetur adipisicing elit. In laboriosam ut modi sequi cumque aperiam.</p> 
            <strong>Status</strong>
        </div> -->
    </div>
</body>
</html>