<!DOCTYPE html>
<?php

include ('r.php');
session_destroy(); //to force the user to log in again when press  backward to homepage and then forward button .

?>
<html>
    <head>
    
      <link rel="stylesheet" href="style.css" >
      <meta charset="utf-8">
        <title>Misfar</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- font awesome cdn -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined">
        <script src="script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
window.onscroll = () => sampleFunction();

function sampleFunction() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    document.getElementById("samplePara").className = "activeh";
    document.getElementById("show-login").style.display = "block";

  } else {
    document.getElementById("samplePara").className = "";
    document.getElementById("show-login").style.display = "none";

  }
}
</script>
    </head>
    <body>
        
       <!-- header section --> 
       <header id="samplePara">
        
         <div class="logo">
          <img class="logo1" src="images/logo2.png"  > 
         </div>
        
         
         <nav class="navbar">
            <span  id="show-login" class="material-icons-outlined" onclick="show()" style="color:#6C3D8E; cursor: pointer; display: none; font-size: 30px;">
                login
                </span>
         </nav>
       </header>

       <!-- viduo slider-->
           <section class="home" id="home">
               <div class="content">
               <h3>Who we are </h3>
               <p class="pinvid">The place where the perception of attractions in Saudi will be transformed, and the journey of rebranding the country as the middle east's main holiday destination will start.</p>
               </div>  
               <div class="video-container">
                 <video src="images/v1.mp4" id="video-slider" loop autoplay muted></video>
               </div>
           </section>
        <!-- End of viduo slider-->
        <!-- catagories-->

           <section >
            <div class = "title-wrap">
                <span class = "sm-title">know about some places before your travel</span>
                <h2 class = "lg-title">featured places</h2>
            </div> 
            
            <div class="wrapper">   
      
                
               <?php
               $city_id=1;
             echo "<a href=attractions.php?city_id=".$city_id.">"; //<!-------------- link page here--------------------->
                       ?>
           <div class="card">
            
               <div class="imgbox">
            <img  src = "images/ryiadh.jpg" alt = "featured place">
           </div>
           
            <div class="desc">
            <h1>RIYADH</h1>
             <p>Riyadh’s blend of medieval and millennial makes for a beguiling cultural union — one where Arabia’s
                  first roots can be traced, and where its bold future can be envisioned.The city’s fascinating, centuries-old history can be found within its atmospheric souqs
                   ,  and ancient architecture, but it’s also a modern metropolis, with glittering high-rises 
                   and a burgeoning contemporary art scene
             
             </p>
            </div>
            
           </div>
        </a>
        <?php
               $city_id=2;
             echo "<a href=attractions.php?city_id=".$city_id.">"; //<!-------------- link page here--------------------->
                       ?>
           <div class="card">
           <div class="imgbox">
           <img  src = "images/alula.png" alt = "featured place">
           </div>
           <div class="desc">
           <h1 >ALULA</h1>
           <p> AlUlA, is a place of extraordinary natural and human heritage which is home to Saudi Arabia’s first 
              UNESCO World Heritage Site, deep in the desert in the northwestern region of the country, 
              where you can  play out your fantasy of being an intrepid archaeologist for a day.

            </p>
           </div>
        </a>
        <?php
               $city_id=3;
             echo "<a href=attractions.php?city_id=".$city_id.">"; //<!-------------- link page here--------------------->
                       ?>
           </div><div class="card">
            <div class="imgbox">
            <img  src = "images/jeddah.jpg" alt = "featured place">
            </div>
            <div class="desc">
                <h1>JEDDAH</h1>
                <p>The all-year-round warm city of Jeddah, the captivating hub, 
                    invites you to be part of the millions of worldwide visitors from 
                    traders and explorers since ancient times. Jeddah is the birthplace 
                    of worldwide arts and music, and a gathering spot for multi-vibrant cultures,
                    a unique blend that left its mark on Jeddah’s exquisite cuisine of many fine dishes with global tastes

                </p>
                </div>
                </div>
                </a>
                </div>
        </section>

         <!--End of catagoriea-->

           
             <!-- log in -->
                <div class="popup" >
                    <div class="close-btn" onclick="hide();">&times;

                    </div>
                    <form  method="post" action="r.php"  class="form" id="myForm">
                        <h2>Log In </h2>
                        <div  class="form-element" >
                        
                        
                        <input class="form-element" type="text" name="username" placeholder="Username" value="">
                    </div>
                    <div  class="form-element">
                        
                        <input  class="form-element" type="password" name="password" placeholder="Password" value="" >
                    </div>
                    
                    <div  class="form-element">
                        <p id="Error1" style="display: inline;"></p>
                        <input  class="logButton" type="submit" name="Log-in" value="Log-in" onclick="EmpLoginForm();return false;">
                    </div>
                                <div class="form-element">
                        <a  class="sign-up" onclick="shows();">New Account? Sign-up</a>

                    </div>


                        </form>

                    </div>
        <!--Sign up -->
            <div class="popup-signup" >
                <div class="closesignup-btn" onclick="hides();">&times;

                </div>
                <form  method="post"  class="form2" id="myForm2" action="r.php">
                    <h2>Sign-up </h2>
                    <div  class="form-element" >
                    
                        <input class="form-element" type="text" name="name" placeholder="Name" value="">
                    </div>
                    <div  class="form-element" >
                    
                    <input class="form-element" type="text" name="username" placeholder="Username" value="" >
                </div>
                <div  class="form-element" >
                    
                    <input class="form-element" type="text" name="email" placeholder="Email" value="">
                </div>
                <div  class="form-element">
                    
                    <input  class="form-element" type="password" name="password" placeholder="Password" value="">
                </div>
                <div  class="form-element">
                    <div> <?php if (isset($_SESSION['Message'])) { ?>
                        <p id="Error" style="display: inline;"><?php
                            echo $_SESSION['Message'];
                            unset($_SESSION['Message']);
                            ?></p>
                        <?php
                    }
                    ?></div>
                    <p id="Error" style="display: inline;"></p>
                    <input type="submit" name="Sign" value=" Sign-up" onclick="EmpSignupForm(); return false;">

            </div>
                
                
                <div class="form-element">
                    <a class="registerd" onclick="show()">Already registerd ? Log-in </a>

                </div>


                </form>

            </div>
            
         <!--footer-->
        <footer style="margin-top: 40px;">
            
                <img src="images/footer.png" alt="logo">
            
          </div>

      </footer>
          
    </body>
</html>