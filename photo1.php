<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "bca4th"; // Name of the database
$conn = mysqli_connect($host, $username, $password, $database); // Connect to the database

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} else {
    echo "Server connected<br>";
}

if (isset($_POST["submit"])) {
    $uploadOk = 1; // Initialize $uploadOk at the beginning
    
    // Check if file is uploaded without errors
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] == 0) {
        $filename = basename($_FILES["fileToUpload"]["name"]); // Get the file name
        $tempname = $_FILES["fileToUpload"]["tmp_name"]; // Get the temporary file name
        $folder = "uploads/" . $filename; // Create the full path for the file
        $fileSize = $_FILES["fileToUpload"]["size"]; // Get the file size
        $maxFileSizeMB = 5; // Maximum file size in MB
        $maxFileSize = $maxFileSizeMB * 1024 * 1024; // Convert MB to bytes

        // Check if file is an actual image
        $check = getimagesize($tempname);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".<br>";
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }

        // Check file size
        if ($fileSize > $maxFileSize) {
            echo "Sorry, your file is too large. Maximum size allowed is $maxFileSizeMB MB.<br>";
            $uploadOk = 0;
        }

        // If everything is ok, try to upload file
        if ($uploadOk == 1) {
            // Ensure the target directory exists
            if (!is_dir("uploads")) {
                mkdir("uploads", 0777, true); // Create the directory if it doesn't exist
            }

            // Move the uploaded file to the desired folder
            if (move_uploaded_file($tempname, $folder)) {
                echo "The file " . htmlspecialchars($filename) . " has been uploaded.<br>";

                // Read the content of the file
                $file_content = file_get_contents($folder);

                // Prepare the SQL statement to insert the image data into the database
                $sql = "INSERT INTO images (filename, filedata) VALUES (?, ?)";
                $stmt = mysqli_prepare($conn, $sql);

                // Bind parameters and execute the statement
                mysqli_stmt_bind_param($stmt, "ss", $filename, $file_content);
                if (mysqli_stmt_execute($stmt)) {
                    echo "File data inserted into the database successfully.<br>";
                } else {
                    echo "Error inserting file data into the database.<br>";
                }

                // Close statement
                mysqli_stmt_close($stmt);
            } else {
                echo "Error moving file.<br>";
            }
        } else {
            echo "Sorry, your file was not uploaded.<br>";
        }
    } else {
        echo "Error uploading image.<br>";
        $uploadOk = 0; // Ensure $uploadOk is set in case of an error
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Upload</title>
</head>
<body>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>
</body>
</html>
