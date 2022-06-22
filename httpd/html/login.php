<html>
    <head>
        <title>Login Page</title>
    </head>
    
    <body>
        <h1>Login Form</h1>
        <form name="login" method="POST" enctype="multipart/form-data" action="login.php">
            <div class="container">
                <label>Username: </label>
                <input type="text" placeholder="Enter Username" name="username" required>
                <label>Password: </label>
                <input type="password" placeholder="Enter Password" name="password" required>
                <button type="submit" name="login">Login</button>
            </div>
        </form>
    </body>
</html>

<?php

$host = "db";
$port = "5432";
$dbname = "postgres";
$db_user = "postgres";
$db_pass = "S63^oXgRT!d&tQ"; 
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$db_user} password={$db_pass}";
$dbconn = pg_connect($connection_string);

if(isset($_POST['login'])&&!empty($_POST['username'])&&!empty($_POST['password'])){
    
    $sql = "SELECT * FROM users WHERE username='".pg_escape_string($_POST['username'])."' AND password=crypt('".$_POST['password']."', password)";
    $data = pg_query($dbconn,$sql); 
    $login_check = pg_num_rows($data);
    if($login_check > 0){ 
        
        echo "Login Successful";    
    }else{
        
        echo "Invalid Credentials";
    }
}

?>