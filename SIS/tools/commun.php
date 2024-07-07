<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
</head>
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
        width:25rem;
        height: max-content;
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
    }
</style>
<body>
    <div class="container" id="form-container" >
   
    <form action="" id="request_modal" method="post">
        <h3>Sample Modal</h3>
        <div class="form-group">
            <label for="input-fieldname">Field Name</label>
            <input type="text" required name="Field_Name" class="form-control" id="input-fieldname">
            <!-- <select name="Field_Name" id="input-fieldname" class="form-control">
            </select> -->
        </div>
        <div class="form-group">
            <label for="input-newvalue">Old Value</label>
            <input type="text" required name="Old_Value" class="form-control" id="input-newvalue">
        </div>
        <div class="form-group">
            <label for="input-newvalue">New Value</label>
            <input type="text" required name="New_Value" class="form-control" id="input-newvalue">
        </div>
        <div class="form-group">
            <label for="input-requestteacher">Teacher ID</label>
            <input type="text" required maxlength="10" class="form-control" name="TID" id="input-requestteacher">
        </div>
		<div class="form-group">
            <label for="input-message">Message</label>
			<textarea class="form-control" name="Message" id="input-message"></textarea>
        </div>
    <button type="submit" class="btn btn-primary" id="request_submit" name="request_btn">Submit</button>
    <button type="button" class="btn btn-default bg-light" id="request_cancel">Cancel</button>
    </form>
    <button class="btn btn-primary btn-block"  id="request">Request Now</button>
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
        echo "Submitted";
        $qry="INSERT INTO request(SID,Field_Name,Old_Value,New_Value,Status,TID,Message) VALUES('$sid','$fname','$ovalue','$nvalue','$stats','$tid','$message')";
        if(mysqli_query($conn,$qry))
        {
            echo "Request Added";
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