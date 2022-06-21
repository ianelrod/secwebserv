<html>
    <head>
        <title>File Upload Page</title>
    </head>
    
    <body>
        <h1>File Upload Form</h1>
        <form name="upload" method="POST" enctype="multipart/form-data" action="upload.php">
            <p>Type some text (if you like):<br><input type="text" id="text" name="textline"></p>
            <p>Please specify a file, or a set of files:<br><input type="file" id="file" name="myFile"></p>
            <div><input type="submit" value="Send"></div>
        </form>
    </body>
</html>

<?php

if (!isset($_FILES["myFile"])) {
   die("There is no file to upload.");
}

$filepath = $_FILES['myFile']['tmp_name'];
$fileSize = filesize($filepath);
$fileinfo = finfo_open(FILEINFO_MIME_TYPE);
$filetype = finfo_file($fileinfo, $filepath);

if ($fileSize === 0) {
   die("The file is empty.");
}

if ($fileSize > 5242880) { // 5 MB (1 byte * 1024 * 1024 * 5 (for 5 MB))
   die("The file is too large");
}

$allowedTypes = [
   'application/pdf' => 'pdf',
   'text/plain' => 'txt'
];

if(!in_array($filetype, array_keys($allowedTypes))) {
   die("File not allowed.");
}

$filename = basename($filepath); // I'm using the original name here, but you can also change the name of the file here
$extension = $allowedTypes[$filetype];
$targetDirectory = session_save_path(); // __DIR__ is the directory of the current PHP file

$newFilepath = $targetDirectory . "/" . $filename . "." . $extension;
   
if (!copy($filepath, $newFilepath )) { // Copy the file, returns false if failed
   die("Can't move file.");
}
unlink($filepath); // Delete the temp file

echo "File uploaded successfully :)";

?>