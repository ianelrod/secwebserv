<html>
    <head>
        <title>Home Page</title>
    </head>
    
    <body>
        <a href="login.php">Login Page</a>
        <a href="upload.php">Upload Page</a>
    </body>
</html>

<?php
session_start();
if (!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
  } else {
    $_SESSION['count']++;
  }
?>