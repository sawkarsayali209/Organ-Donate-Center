<!doctype html>
<html>
    <head>
        <meta charset="utf-8";
              <meta name="viewport" content="width=device-width,initial-scale=1.0"><!-- comment -->
        <title>Home page</title>

        <link rel="stylesheet" type="text/css" href="style.css" >
       
              </head>
              <body>


                  <?php
                  include "header.php";
                  ?>
                  <a href="index.php"
                                    </a>                                          

                      		<div class='toggle-btn'onclick="toggleSidebar()">
                       
        <div class="sidenav"id="sidenav">
            <a href="index.php">Home</a><!-- comment -->
            
                        <a href="about.php">About us</a><!-- comment -->
           &nbsp &nbsp  <a href="dashboard.php">Dashboard</a><!-- comment -->
            <a href="faq.php">FAQ</a><!-- comment -->
            <a href="contact.php">contact us</a><!-- comment -->
            <a href="logout.php">Logout</a><!-- comment -->
        <div class="toggle-btn" onclick="toggleNav()">
            <div class="bar"></div>
                        <div class="bar"></div>
            <div class="bar"></div>
            <a href="index.php"></a>
       </div>
        <script src="nav.js"></script>
  

      </header>

<div class="bottom-image-container">

    <img src="image/2.png" alt="Image Description" class="bottom-image">
</div>


    <div class="form"></div>
<p>&nbsp;</p>                         


                  <?php
                 echo $_SESSION['email'];
       ?>


                   
     <footer><p>&copy;2024 Donate Life ! The Gift Organ Donation is the greatest gift of all!!</footer>
                             
</body>
</html> 


