<?php include_once("../Connection/Connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MyStyles.css">
    <link rel="stylesheet" href="../messages.css">
</head>
<body>
    <div class="container-fluid">
        <?php include_once("navbar.php"); ?>
    </div>
    <style>
       
    </style>
    <div class="container py-2">
        <?php include_once("commun.php"); ?>
        <?php
          if(isset($_SESSION['student']))
          {
            $student=$_SESSION['student'];
            $qry="Select * from request where SID='$student' order by CreatedAt DESC";
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
      <?php
      if(isset($_GET['Delete']))
      {
        $deleteid=$_GET['Delete'];
        $qry="DELETE FROM request where Request_ID=$deleteid";
        if(mysqli_query($conn,$qry))
        {
        echo "<script>alert('Deleted Successfully'); </script>";
        echo "<script>
            window.location.href='Messages.php';
        </script>";

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