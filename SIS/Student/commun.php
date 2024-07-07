<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
</head>
<?php
include_once("../Connection/Connection.php"); 
mysqli_report(MYSQLI_REPORT_ERROR);

?>
<style>
    #form-container
    {
      
        display:flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap:1rem;
    }
    .form-container  label
    {
        font-weight: bolder;
    }
    .form-container .form-group
    {
        display: flex;
        flex-direction: column;
        gap:0.5rem;
    }
     form#request_modal 
    {
        top:0;
    
        display: flex;
        flex-direction: column;
        
        box-sizing: border-box;
        background-color: beige;
        padding: 1rem;
        gap:0.5rem;
        border-radius: 15px;
    }

    #request_modal
    {
       
        position: fixed;
        transition: transform 0.2s;
        transform: scale(0);
        height: 100vh;
        overflow-y: scroll;
        width:50%;
    }
    @media screen and (max-width:700px) {
        #request_modal
        {
            width:100%;
          
            height: 100vh;
        }
    }
</style>
<body>
    <div class="container" id="form-container" >
   
    <form action="" id="request_modal" method="post">

       <?php
       if(isset($_GET['New']))
        echo "<style>#request_modal{transform:scale(1)}</style>";
       if(isset($_SESSION['student']))
       {
        $student=$_SESSION['student'];
        ?>
        <h3>Sample Modal</h3>
        <div class="form-group">
            <label for="">SID</label>
            <input type="text" name="SID" class="form-control" readonly value="<?php echo $student; ?>" id="">
        </div>
        <div class="form-group">
            <label for="input-requestteacher">TID</label>
           <select name="TID" id="" class="form-control">
                <?php
                    $qry="SELECT TID from teacherdetails where DID=(SELECT DID from academicdetails where SID='$student')";
                    if($res=mysqli_query($conn,$qry))
                    {
                        while($result=mysqli_fetch_assoc($res))
                        {
                            $tid=$result['TID'];
                            echo "<option value=$tid>$tid</option>";
                        }
                    }
                ?>
            </select>

        </div>
        <div class="form-group">
            <label for="Field_Name">Field Name</label>
            <select  name="Field_Name" class="form-control" id="Field_Name">
            <?php
                $qry="SELECT Name,Dob,Gender,Phone,Email,Taluk,Address,FatherName,MotherName,FPhone,MPhone from student inner join residential on student.SID=residential.SID where student.SID='$student'";
                if($res=mysqli_query($conn,$qry))
                {
                    $result=mysqli_fetch_assoc($res);
                    ?>
                    <script>
                        const jsonar=<?php echo json_encode($result); ?>;
                        console.log(jsonar);
                    </script>
                    <?php
                
                    foreach($result as $key=>$val)
                    {
                        echo "<option value='$key'>$key</option>";
                    }
                }
            ?>
            </select>
        </div>
        <div class="form-group">
            <label for="Old_Value">Old Value</label>
            <input type="text" required name="Old_Value" readonly class="form-control" id="Old_Value">
            <script>
                const field=document.getElementById("Field_Name");
                const old=document.getElementById("Old_Value");
                old.value=jsonar[field.value];
                field.addEventListener("change",(e)=>{
                    old.value=jsonar[field.value];
                })    
                
            </script>
        </div>
        <div class="form-group">
            <label for="input-newvalue">New Value</label>
            <input type="text" required name="New_Value" class="form-control" id="input-newvalue">
        </div>
      
		<div class="form-group">
            <label for="input-message">Message</label>
			<textarea class="form-control" name="Message" id="input-message"></textarea>
        </div>
    <button type="submit" class="btn btn-primary" id="request_submit" name="request_btn">Submit</button>
    <button type="button" class="btn btn-default bg-light" id="request_cancel">Cancel</button>
    <?php
       }
       else
       {
        echo "<center>NO SESSION</center>";
        echo "<button type='button' class='btn btn-default bg-light' id='request_cancel'>Cancel</button>";
       }
    ?>
</form>
    <button class="btn btn-primary btn-block"  id="request">+ Request Now</button>
</div>
<?php 
    if(isset($_POST['request_btn']))
    {
        
        $sid=$_SESSION['student'];
        $fname=$_POST['Field_Name'];
        $ovalue=$_POST['Old_Value'];
        $nvalue=$_POST['New_Value'];
        $stats="Submitted";
		$message=$_POST['Message'];
		if(empty($message)) $message="No Messages Specified";
        $tid=$_POST['TID'];
        $date=date("Y-m-d");
        $qry="INSERT INTO request(SID,Field_Name,Old_Value,New_Value,Request_Date,Status,TID,Message) VALUES('$sid','$fname','$ovalue','$nvalue','$date','$stats','$tid','$message')";
        if(mysqli_query($conn,$qry))
        {
            echo "<script> alert('Request Added')</script>";
            echo "<script>window.location.href='Messages.php' </script>";
        }
        else
        { 
            echo "<script>alert('Request Failed')</script>";
            echo "<script>window.location.href='Messages.php' </script>";
        }
    }
?>

</body>
<script>
function communmodal()
{
    const rate=document.getElementById("request");
    const modal=document.getElementById("request_modal");
    const modalrated=document.getElementById("request_submit");
    const modalcancel=document.getElementById("request_cancel");
    const modaltext=document.getElementById("text");
    const modalopt=document.getElementById("vals");
    const result=document.getElementById("result");
    rate.addEventListener("click",(e)=>{
        modal.style.transform="scale(1)";
    })
    modalcancel.addEventListener("click",(e)=>{
        modal.style.transform="scale(0)";
    })
}
communmodal();
</script>
<script src="history.js"></script>
</html>
