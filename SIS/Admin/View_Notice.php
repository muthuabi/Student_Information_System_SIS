<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Document</title>
    <link rel='stylesheet' href='../Bootstrap/css/bootstrap.min.css'>
	<link rel='stylesheet' href='../MyStyles.css' />
</head>
<?php require_once('../Connection/Connection.php'); 
include_once("navbar.php");
?>
<body>
    <div class="container mt-2">
        <style>
          
        </style>
        <form action="" id="filter-form" method="get">
            <div class="form-group">
                <label for="input-all">All</label>
                <input type="radio" name="Filter" style="display:none" checked value="all" id="input-all"
                >
                <label for="input-student">Student</label>
                <input type="radio" name="Filter" value="student" style="display:none" id="input-student" 
                >
				<label for="input-teacher">Teacher</label>
                <input type="radio" name="Filter" value="teacher" style="display:none" id="input-teacher" 
                >
            </div>
        </form>
        <script>
            const vars=document.querySelectorAll(" #filter-form .form-group label");
            const forms=document.getElementById("filter-form");
            vars.forEach(element=>{
                element.addEventListener("click",(e)=>{
                    
                    setTimeout(()=>{forms.submit();},500);
                })
            })
         
        </script>
    <?php 
    function view_notice($who='all')
    {
    echo "<div class='container'>
        <div class='notices' style='display: flex;flex-direction:column;gap:1rem;padding:0.5rem' >";
                global $conn;
                $qry="SELECT * from notice where Notice_To='$who'";
                if($res=mysqli_query($conn,$qry))
                { 
                    if(mysqli_num_rows($res)>0)
                    {
                        while($result=mysqli_fetch_assoc($res))
                        {
                            $from=$result['Notice_From'];
                            $to=$result['Notice_To'];
                            $notice=$result['Notice'];
                            $link=$result['Notice_Link'];
                            $date=$result['CreatedOn'];
                            $date=date('d M Y, h:i A',strtotime($date));

             echo "
            <div class='notice' style='width:100%;background-color:wheat;padding:0.5rem;border-radius:5px;box-shadow:2px 2px 5px 1px gray'>
                <p style='text-align: justify;margin-bottom:0.3rem'>$notice</p>
                
                    ";
                    if(!empty($link))
                     echo "<a href='$link'>Notice Link</a> <br>";
                    echo "
                    <b >- $from</b>
                    <br>
                <b><em>$date</em></b>
            </div>";
           

                       }
                    }
                    else
                    {
                        echo '<center><b>No Notices</b></center>';
                    }
                }

         
            
       echo " </div>
    </div>";
        }
    
    if(isset($_GET['Filter']) && !empty($_GET['Filter']))
    {
        $fil=$_GET['Filter'];
        view_notice($fil);
    }
    else
    {
       echo "<script>window.location.href='View_Notice.php?Filter=all'</script>";
    }
    
    ?>
    </div>
</body>
</html>