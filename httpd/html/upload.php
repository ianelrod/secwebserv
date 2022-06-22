<?php include('header.php'); ?>
<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>File Upload Page</title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	</head>

	<body>
        <div class="d-flex align-items-center justify-content-center">
            <div class="p-2 border"><h1>File Upload Form</h1>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
                <form name="upload" method="POST" enctype="multipart/form-data" action="upload.php">
                    <p>Type some text (if you like):<br><input type="text" id="text" name="textline"></p>
                    <p>Please specify a file, or a set of files:<br><input type="file" id="file" name="myFile" required></p>
                    <div class="pb-2"><input type="submit" name="send"></div>
                </form>
                <?php

                if (isset($_POST['send']) && !empty($_FILES["myFile"])) {
                    $filepath = $_FILES['myFile']['tmp_name'];
                    $fileSize = filesize($filepath);
                    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
                    $filetype = finfo_file($fileinfo, $filepath);

                    if ($fileSize === 0) {
                        echo "<div class=\"alert alert-warning\" role=\"alert\">The file is empty</div>";
                        trigger_error("Upload file empty", E_USER_WARNING);
                        die();
                    }

                    if ($fileSize > 5242880) { // 5 MB (1 byte * 1024 * 1024 * 5 (for 5 MB))
                        echo "<div class=\"alert alert-warning\" role=\"alert\">The file is too large</div>";
                        trigger_error("Upload file too large", E_USER_WARNING);
                        die();
                    }

                    $allowedTypes = ['application/pdf' => 'pdf', 'text/plain' => 'txt'];

                    if (!in_array($filetype, array_keys($allowedTypes))) {
                        echo "<div class=\"alert alert-danger\" role=\"alert\">File not allowed</div>";
                        trigger_error("Upload file not allowed", E_USER_WARNING);
                        die();
                    }

                    $filename = basename($filepath);
                    $extension = $allowedTypes[$filetype];
                    $targetDirectory = session_save_path();
                    $newFilepath = $targetDirectory . "/" . $filename . "." . $extension;

                    if (!copy($filepath, $newFilepath)) {
                        echo "<div class=\"alert alert-danger\" role=\"alert\">Can't move file</div>";
                        trigger_error("Upload file can't be moved", E_USER_WARNING);
                        die();
                    }
                    unlink($filepath);
                    echo "<div class=\"alert alert-success\" role=\"alert\">File uploaded successfully</div>";
                    trigger_error("Upload file success", E_USER_NOTICE);
                } elseif (isset($_POST['send'])) {
                    echo "<div class=\"alert alert-warning\" role=\"alert\">Please select a file</div>";
                    trigger_error("Upload file not selected", E_USER_WARNING);
                }

                ?>
            </div>
        </div>
	</body>

</html>