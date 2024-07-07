<!DOCTYPE html>
<?php
include_once("Connection/Connection.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/bootstrap-stack.png" type="image/x-icon">
    <title>SIS - Student Information and Support System</title>
   
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="MyStyles.css">
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
@keyframes anime {
0%{
    opacity:0%;
    transform: translateX(100px);
}
50%{
    opacity: 70%;
    transform: translateX(0px);
}
100%{
    opacity:0%;
    transform: translateX(-100px);
}
    
}
.carousel
{
	display: flex;
	position: relative;
	width: 100%;
    height: 500px;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    
  
    
}
.item{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 100%;
    height: 100%;
    overflow: hidden;
    object-fit: cover;
    animation: anime 2s ease-in;

}

.item h3{
    position: absolute;
    font-size: 100px;
    padding: 1rem;

}
.navs
{
    display: flex;
    justify-content: space-between;
    padding:1rem;
    position: absolute;
    width: 100%;
    z-index: 100;
    
}
.navs span{
    font-size: larger;
    cursor: pointer;
}
.indicators
{
	display: flex;
	gap:1rem;
	position: absolute;
	bottom:1rem;
  
    padding:1rem;
}
.indicators li{
list-style:none;
height: 5px;
background-color: black;
width:10px;
border-radius: 10px;
transition: all 0.5s;
}

    @keyframes anime2 {
        from{
            width:0;
            border-right: 2px black solid;
        }
        to{
            width:100%;
            border-right: 2px black solid;
        }
        
    }
    .webdev{
      overflow: hidden;
      white-space: nowrap;
      font-size: small;
      animation: anime2 2s  steps(100);
      
    }
</style>
<body>
  <div class="container-fluid  ">
    <?php include_once("navbar.php"); ?>
        <div class="row py-2">
            <div class="col-md-12">
              <div class="carousel">
                    <div class="navs">
                        <a id="prev" onclick=changeslidep()>
                            <span> Prev</span>
                        </a>
                        <a  id="next" onclick=changesliden()>
                            <span> Next </span>
                        </a>
                    </div>
                    <div class="indicators">
                        <li class="ind" onclick="changeslide(0)"></li>
                        <li class="ind" onclick="changeslide(1)"></li>
                        <li class="ind" onclick="changeslide(2)"></li>
                    </div>
                   <center> <div class="item" >
                        <a href="img1.png"> <img src="images/bg1.webp" alt="" > </a>
                        <h3 class='webdev'>Welcome to SIS</h3>
                      
                    </div>
                    <div class="item">
                         <a href="img2.png"><img src="images/bg.jpg" alt="" ></a>
						 <h3 class='webdev'>Enjoy the Services</h3>
                      
                    </div>
                    <div class="item">
                           <a href="img1.png"><img src="images/bg1.webp" alt="" ></a>
						   <h3 class='webdev'>Be Grown With US</h3>
                    </div>
                </center>
                </div>
               
                <div class="jumbotron" id="heyuser">
                    <div class="inner-jumb">
                        <div class="jheading">
                    
                                <h4>Hey User!</h4>
                                <h2 class="webdev">Welcome to SIS!</h2>
                                   <!-- <h3>WEB DEVELOPER</h3> -->
                                
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
                        <a href="Login.php"><button class="btn btn-primary" >Registered User</button></a>
                    </div>
                </div>
                <div id="about-us" class="p-2">
                    <h2>About us</h2>
                    <p style="text-align: justify;">
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Id a dolorem saepe cupiditate recusandae quidem, qui, alias possimus fuga vitae natus impedit excepturi repellat quaerat cum beatae suscipit nemo deserunt non ullam? Numquam quae dicta, deserunt provident consequuntur magni, vitae praesentium quisquam culpa velit, aliquid aperiam blanditiis nam corporis eius quos eveniet? Iure nihil, officia adipisci ipsam eum accusantium sed assumenda obcaecati ipsa? Quaerat neque voluptatem reiciendis esse placeat voluptatibus quam, molestias unde officiis hic ullam, animi praesentium soluta et distinctio eos vel incidunt! Eligendi dicta, doloremque itaque explicabo non doloribus soluta ipsa? Nemo saepe sed, placeat fugit voluptas ratione?
                    </p>
                </div>
                <div id="services">
                    <div class="row">
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                           
                        </div>
                        <div class="col-md-4">
                            
                        </div>
                    </div>
                </div>
                <div id="contact-us" class="bg-secondary p-2">
                    <h2>Contact Us</h2>
                    <div class="row">
						
                        <div class="col-md-4">
                           <h3>Owners</h3>
						   <div class="mx-2">
                            <h4>Muthukrishnan</h4>
                            <b>Project Leader</b>
                            <h4>Sukas</h4>
                            <b>Project Member</b>
							</div>
                          
                            
                        </div>
                        <div class="col-md-4">
                            <style>
                                ul > li
                                {
                                    list-style: none;
                                  
                                }
                            </style>
                            <h3>Quick Links</h3>
                            <ul class="list-group px-2">
                                <li><a href="">Home</a></li>
                                <li><a href="">Login</a></li>
                                <li><a href="">About Us</a></li>
                                <li><a href="">Contact</a></li>
                                <li><a href="">Dashboard</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h3>Follow Us</h3>
                            <ul class="list-inline d-flex flex-wrap  gap-3">
                                <li><a href="">WhatsApp</a></li>
                                <li><a href="">Instagram</a></li>
                                <li><a href="">Facebook</a></li>
                            </ul>
                            <label class="lead">Phone</label>
                        
                            <a class="nav-link">+91 90251890045</a>
                            <label class="lead">Email</label>
                            <a class="nav-link">sukas@gmail.com</a>
                        </div>
                    </div>
                    <center>
                        <h4>"In Service of Students" - SIS</h4>
                        <p class="lead">&copy; SIS - All Rights Reserved</p>
                    </center>
                </div>
            </div>
        </div>
      
  </div>
  <style>
   
  </style>
  <!-- <script src="navcollapse.js"></script> -->
  
  <?php include_once("toparrow.html") ?>
</body>
<script>
    const slides= document.querySelectorAll(".carousel .item");
    const ind=document.querySelectorAll(".ind");
    let curindex=0;
    let i;
    function showslides()
    {
       
        for(i=0;i<slides.length;i++)
        {
            slides[i].style.display="none";
            ind[i].style.backgroundColor="black";
        }
        //console.log(curindex);
        if(curindex>=slides.length)
            curindex=0;
        if(curindex<0)
            curindex=slides.length-1;
        slides[curindex].style.display="flex";
        ind[curindex].style.backgroundColor="white";
        curindex++;
        
    
    }
    function changeslidep()
    {
        curindex=(curindex-1)-1;
        showslides();
    }
    function changesliden()
    {
        curindex=(curindex-1)+1;
        showslides();
    }
    function changeslide(n)
    {
        curindex=n;
        showslides();  
    }
    setInterval(showslides,2000);
    window.onload=showslides();
    </script>
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