<?php include('header.php'); ?>
<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Login Page</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	</head>

    <body>
        <div class="d-flex align-items-center justify-content-center">
            <div class="p-2 border"><h1>Login Form</h1>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
                <form name="login" method="POST" enctype="multipart/form-data" action="login.php">
                    <p>Username: <br><input type="text" placeholder="Enter Username" name="username" required></p>
                    <p>Password: <br><input type="password" placeholder="Enter Password" name="password" required></p>
                    <div class="pb-2"><input type="submit" name="login"></div>
                </form>
                <?php

                $host = "db";
                $port = "5432";
                $dbname = "postgres";
                $db_user = "postgres";
                $db_pass = "S63^oXgRT!d&tQ";
                $connection_string = "host={$host} port={$port} dbname={$dbname} user={$db_user} password={$db_pass}";
                $dbconn = pg_connect($connection_string);

                if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {

                    $username = filter_input(INPUT_POST, trim('username'), FILTER_SANITIZE_SPECIAL_CHARS);
                    $password = filter_input(INPUT_POST, trim('password'), FILTER_DEFAULT);
                    $sql = "SELECT * FROM users WHERE username='" . pg_escape_string($username) . "' AND password=crypt('" . pg_escape_string($password) . "', password)";
                    $data = pg_query($dbconn, $sql);
                    $login_check = pg_num_rows($data);

                    if ($login_check > 0) {
                        echo "<div class=\"alert alert-success\" role=\"alert\">Login successful</div>";
                        $_SESSION['USER'] = htmlspecialchars($username);
                        trigger_error("Login succeeded for user " . $username, E_USER_NOTICE);
                    } else {
                        echo "<div class=\"alert alert-danger\" role=\"alert\">Invalid credentials</div>";
                        trigger_error("Login failed for user " . $username, E_USER_WARNING);
                    }

                } elseif (isset($_POST['login'])) {
                    echo "<div class=\"alert alert-warning\" role=\"alert\">Field(s) cannot be left blank</div>";
                    trigger_error("Login field(s) left blank", E_USER_WARNING);
                }

                ?>
            </div>
        </div>
    </body>

</html>
