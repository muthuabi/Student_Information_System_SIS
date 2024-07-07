<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
</head>
<body>
 <?php 
   // mysqli_report(MYSQLI_REPORT_ERROR);
    include_once("../Connection/connection.php");
    ?>
    <div class="container">
        <form action="" method="post" class="col-md-12">
            <h2>Notices</h2>
            <div class="form-group">
                <label for="">Notice Form</label>
                <input ype="text" name="Notice_Form" id="" class="form-control">
     </div>
     <div class="form-group">
        <label for=""> Notice To</label>
        <select name="Notice_To" id="" class="form-control">
            <option value="all"> All </option>
            <option value="student">All Students</option>
            <option value="teacher">All Teachers</option>
    </select>
     </div>
     <div class="form-group">
        <label for="">Notice</label>
        <textarea name="Notice" id="" class="form-control"><textarea>
     </div>
     <div class="form-group">
        <label for="">Link</label>
        <input type="url" name="Notice_Link" id="" class="form-control">
     </div>
     <br>
     <button class="btn btn-primary" name="Submit" style="width:100%"> Put Notice</button>
</form>
<?php
if(isset($_POST['Submit']))
{
    print_r($_POST);
    $form=$_POST['Notice_Form'];
    $to=$_POST['Notice_To'];
    $notice=$_POST['Notice'];
    $link=$_POST['Notice_Link'];
    if(empty($link))
    $link="No Links";
    $qry="INSERT INTO notice (Notice_From,Notice_To,Notice,Notice_Link)VALUES('$from','$to','$notice','$link')";
    if(mysqli_query($conn,$qry))
    {
        echo "Notice Added";
    }
}
?>
</div>
</body>

<body>
    <?php
    function view_notice($who='all')
    {
        echo "<div class='container'><div class='notices' style='display:flex;flex-direction:column;gap:1rem;padding:0.5rem'>";
        global $conn;
        $qry="SELECT * from notice where Notice_To='$who'";
        if($res=mysqli_query($conn,$qry))
        {
            if(mysqli_num_rows($res)>0)
            {
                while($result=mysqli_fetch_assoc($res))
                {
                    $form=$result['Notice_Form'];
                    $to=$result['Notice_To'];
                    $notice=$result['Notice'];
                    $link=$result['Notice_Link'];
                    $date=$result['CreatedOn'];
                    $date=date('d M Y,h:iA',strtotime($date));
                    echo "<div class='notice' style='width:100%;background-color:wheat;padding:0.5rem;border-radius:5px;box-shadow:2px 2px 5px 1px gray'><p style='text-align:justify;margin-bottom:0.3rem'>$notice</p>";
                    if(!empty($link))
                     echo "<a href='$link'>Notice Link </a> <br>";
                    echo "<b>-$form</b> <br> <b><em>$date</em></b><div>";
                }
            }
            else{
                echo '<center><b>No Notices</b></center>';
            }
        }
        echo "</div> </div>";
    }
    view_notice('student');
    ?>
    </body>
</html>



