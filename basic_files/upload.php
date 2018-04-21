<?php 

if(isset($_POST['submit'])) {
echo "<pre>";

print_r($_FILES['file_upload']);

echo "<pre>";

$upload_errors = array(

    UPLOAD_ERR_OK => "There is no error",
    UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filesize directive in php.ini",
    UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.",
    UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded.",
    UPLOAD_ERR_NO_FILE => "No file was uploaded.",
    UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder.",
    UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk.",
    UPLOAD_ERR_EXTENSION => "A PHP extension stopped the file upload."
);

$error = $_FILES['file_upload']['error'];

$message = $upload_errors[$error];
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <h2>
        <?php 
        if(!empty($upload_errors)) {
            echo $message;
        }
        ?>
        </h2>

        <input type="file" name="file_upload"><br>

        <input type="submit" name="submit">
        
    </form>
</body>
</html>