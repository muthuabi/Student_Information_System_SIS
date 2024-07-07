<!DOCTYPE html>
<?php
include_once("../Connection/Connection.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/bootstrap-stack.png" type="image/x-icon">
    <title>Main Index</title>
   
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../MyStyles.css">
    <!-- <link rel="stylesheet" href="Bootstrap4/dist/css/bootstrap.min.css"> -->
    
</head>
<style>
  .jumbotron{
       display: flex;
        align-items: center;
        padding:1rem;
    }
    .jumbotron h2
    {
        font-size: 10vmin;
    }
    .jumbotron .jheading{
        width:max-content;
       
    }
    .jumbotron p{
        text-align: justify;
        width:95%;
    }
    .jumbotron button
    {
        transition: background-color 0.5s;
    }
    .jumbotron button:hover
    {
        background-color: rgb(24, 49, 63);
    }
    .jumbotron h3{
        text-align: right;
    }
</style>
<body>
  <div class="container-fluid  ">
    <?php include_once("navbar.php"); ?>

        <div class="row py-2 d-none" >
            <div class="col-md-12">
                <div class="jumbotron">
                    <div class="inner-jumb">
                        <div class="jheading">
                            
                                <h4>Hey There... I am</h4>
                                <h2 class="webdev">Muthukrishnan M</h2>
                                   <h3>WEB DEVELOPER</h3>
                                
                        </div>
                        <p>Lorem ipsum, dolor sit amet consectetur 
                                adipisicing elit. In quas corrupti numquam 
                                tempora recusandae dicta. Provident velit 
                                nobis pariatur totam consequatur magni 
                                recusandae culpa perspiciatis? Ea numquam 
                                labore a enim eligendi quia recusandae quasi
                                 officia nemo ratione quisquam, et iste
                                  atque nam dolores ab quibusdam maiores 
                                consequuntur reiciendis? Quisquam, modi.
                        </p>
                        <br>
                        <a href="#Contact"><button class="btn btn-primary" >Contact Me</button></a>
                    </div>
                </div>
            </div>
        </div>
        <canvas id="chart">

        </canvas>
  </div>
  <style>
   
  </style>
  <!-- <script src="navcollapse.js"></script> -->
  
  <?php include_once("toparrow.html") ?>
</body>
<script>
 /** @type {CanvasRenderingContext2D} */
//  const canvas=document.getElementById("chart");
//  const ctx=canvas.getContext("2d")
//  ctx.beginPath();
//  ctx.moveTo(0,0);
//  ctx.lineTo(10,10);
//  ctx.strokeStyle='blue';
//  ctx.stroke();
//  ctx.closePath();
</script>
<script src="Bootstrap/Jquery.min.js"></script>
</html>