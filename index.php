<script language="javascript" type="text/javascript">
window.history.forward();
</script>


<?php
  
  
 include 'connexion.php';
 
if (isset($_POST['pseudo'])&&isset($_POST['pass']))
{
 $pseudo=$_POST['pseudo'];
 $mdp=$_POST['pass'];

 


 $req=$bd->prepare('SELECT * FROM logins WHERE pseudo=:pseudo AND pass=:pass');

 $req->execute(array('pseudo' => $pseudo, 'pass' => $mdp));

 $resultat=$req->fetch();



 if (!$resultat)
{
?>  

<span style="color :red; position:absolute; bottom:70%; left:8%; z-index: 1;font-size:25px; "><?php echo 'Mauvais pseudonyme ou mot de passe !'; ?></span>

<?php
}
else
{


header('location:livres.php');
}

}
?>








<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Bibliothéque</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" href="memorial/css/bootstrap.min.css">
     
      <!-- style css -->
      <link rel="stylesheet" href="memorial/css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="memorial/css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="memorial/images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="memorial/css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
     
   </head>
   


   <!-- body -->
   <body class="main-layout home_page">
      <!-- loader  -->
      <div class="loader_bg">
         <div class="loader"><img src="memorial/images/loading.gif" alt="#" /></div>
      </div>
      <!-- end loader -->
      <!-- header -->
      <header>
         <!-- header inner -->
         
         
         <!-- end header inner -->
      </header>
      <!-- end header -->
      <section class="slider_section">
         <div id="myCarousel" class="carousel slide banner-main" data-ride="carousel">
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img class="first-slide" src="memorial/images/banner.jpg" alt="First slide">
                  <div class="container">
                 
                     <div class="carousel-caption relative">

                    
                  <form  action="index.php" method="POST">
                  <label for="">Pseudonyme :</label> <br>
                  <input type="text" name="pseudo" placeholder="Pseudonyme" style="color:black;" required><br><br>
                  <label for="">Mot de passe :</label> <br>
                  <input type="password" name="pass" placeholder="Mot de passe" style="color:black;" required><br><br>

                  <div class="button_section"> <input class="main_bt" type="submit" value="Connexion" ></input> </div>

                  </form>
   
                        
                        
                        <ul class="locat_icon">
                           <li> <a href="#"><img src="memorial/icon/facebook.png"></a></li>
                           <li> <a href="#"><img src="memorial/icon/Twitter.png"></a></li>
                           <li> <a href="#"><img src="memorial/icon/linkedin.png"></a></li>
                           <li> <a href="#"><img src="memorial/icon/instagram.png"></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="second-slide" src="memorial/images/banner.jpg" alt="Second slide">
                  <div class="container">
                     <div class="carousel-caption relative">

                     
                  <form  action="index.php" method="POST">
                  <label for="">Pseudonyme :</label> <br>
                  <input type="text" name="pseudo" placeholder="Pseudonyme" style="color:black;" required><br><br>
                  <label for="">Mot de passe :</label> <br>
                  <input type="password" name="pass" placeholder="Mot de passe" style="color:black;" required><br><br>

                  <div class="button_section"> <input class="main_bt" type="submit" value="Connexion" ></input> </div>

                  </form>
   
                        
                      
                        <ul class="locat_icon">
                           <li> <a href="#"><img src="memorial/icon/facebook.png"></a></li>
                           <li> <a href="#"><img src="memorial/icon/Twitter.png"></a></li>
                           <li> <a href="#"><img src="memorial/icon/linkedin.png"></a></li>
                           <li> <a href="#"><img src="memorial/icon/instagram.png"></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="third-slide" src="memorial/images/banner.jpg" alt="Third slide">
                  <div class="container">
                     <div class="carousel-caption relative">

                  <form  action="index.php" method="POST">
                  <label for="">Pseudonyme :</label> <br>
                  <input type="text" name="pseudo" placeholder="Pseudonyme" style="color:black;" required><br><br>
                  <label for="">Mot de passe :</label> <br>
                  <input type="password" name="pass" placeholder="Mot de passe" style="color:black;" required><br><br>

                  <div class="button_section"> <input class="main_bt" type="submit" value="Connexion" ></input> </div>

                  </form>
                        
                        
                        <ul class="locat_icon">
                           <li> <a href="#"><img src="memorial/icon/facebook.png"></a></li>
                           <li> <a href="#"><img src="memorial/icon/Twitter.png"></a></li>
                           <li> <a href="#"><img src="memorial/icon/linkedin.png"></a></li>
                           <li> <a href="#"><img src="memorial/icon/instagram.png"></a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
         </div>
      </section>
      <!-- about -->
      
      
      <!-- end about -->
      <!-- Library -->
    
      <!-- end Library -->
      <!--Books -->
      
      <!-- end Books -->
      <!-- Contact -->
     
      <!-- end Contact -->
      <!-- footer -->
      <footer>
        
         <div class="copyright">
            <div class="container">
               <p>Projet fin d'etude 2021-2022 </p>
            </div>
         </div>
      </footer>
      <!-- end footer -->
      <!-- Javascript files-->
      <script src="memorial/js/jquery.min.js"></script>
      <script src="memorial/js/popper.min.js"></script>
      <script src="memorial/js/bootstrap.bundle.min.js"></script>
      <script src="memorial/js/jquery-3.0.0.min.js"></script>
      <script src="memorial/js/plugin.js"></script>
      <!-- sidebar -->
      <script src="memorial/js/jquery.mCustomScrollbar.concat.min.js"></script>
      <script src="memorial/js/custom.js"></script>
   </body>
   
</html>