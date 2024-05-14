<!DoCTYPE html>
<html>
    <head>
        <meta    charset="utf-8"><!-- comment -->
              <meta name="viewport" content="width=device-width,initial-scale=1.0"><!-- comment -->
              <title>LOgout</title>
              <script>

                  window.onload=function(){

                  
                    alert("Thanks to Visiting");
                      window.location.href="login.php"
                  }
              
                  </script>
                  
    </head>
    <body>
        <?php
        session_start();

        session_destroy();
        ?>
    </body>
</html>