<html>

<head>

<title>image upload</title>

</head>

<body>

<form action=# method="post" enctype="multipart/form-data">

<input type="file" name="fileupload">

<input type="submit" name="submit" value="upload file">

</form>

</body>

</html>

<?php

$filename=$_FILES["fileupload"]["name"]; $tempname=$_FILES["fileupload"]["tmp_name"];

$folder = "picture/".$filename;

echo $filename;

echo $tempname;

move_uploaded_file($tempname, $folder);
?>