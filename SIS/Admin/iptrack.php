<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MyStyles.css">
</head>
<?php 
    require_once("../Connection/Connection.php");
	include_once("navbar.php");
 ?>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <label for="date">Select Date</label>
                <input type="date" name="Date" value="<?php if(isset($_POST['Date'])) echo $_POST['Date']; ?>" id="date" class="form-control">
            </div>
            <button type="submit" name="find_ip"  class="btn btn-dark w-100">Find</button>
        </form>
        <?php
         if(isset($_POST['find_ip']))
         {
            $file=file_get_contents("ipvisits.json");
            $arr=(array) json_decode($file);
            $date=$_POST['Date'];
            if(@$val=$arr[$date])
            {
            $a=array_keys((array)$val);

            echo "<form><ul class='list-group '>";
            for($i=0;$i<count($a);$i++)
            {
              echo "<li class='list-group-item d-flex justify-content-center'><span>$a[$i]</span> <button class='btn btn-primary' name='ip' value='".base64_encode($a[$i])."'> Search </button>";
            }
            echo "</ul></form>";
            }
        }
        ?>
        <?php
        if(isset($_GET['ip']))
        {
            $ip=base64_decode($_GET['ip']);
            echo "<table class='table'>";
            $response=@file_get_contents("https://ipinfo.io/".$ip."/geo");
            if($response==false)
            {
                echo "<b>Error in Fetching Data</b>";
            }
            $ipdetails=(array)json_decode($response);
            foreach($ipdetails as $key=>$val)
            {
                echo "<tr><th>$key</th><td>$val</td></tr>";
            }
            echo "</table>";
           // $loc=explode(",",$ipdetails['loc']);
		   $loc=$ipdetails['loc'];
		   echo $loc;
            //echo $loc[0];
            //echo $loc[1];
           echo "<iframe src='https://maps.google.com/maps?q=$loc;&hl=es;z=14&amp;output=embed' width='600' height='450' style='border:0;' allowfullscreen='' loading='lazy' referrerpolicy='no-referrer-when-downgrade'></iframe>";
        } 
        ?>
    </div>
</body>
</html>