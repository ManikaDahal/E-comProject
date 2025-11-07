<!-- <?php
$host = "localhost";
$username = "root";
$password = "";
$database = "csit6th";

// Establish database connection
$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    echo "Server database not connected";
} else {
    // Create the signup table if it doesn't exist
    $table = "CREATE TABLE IF NOT EXISTS signup (
        Fullname VARCHAR(100),
        Emailid VARCHAR(100),
        Password VARCHAR(100),
        Role ENUM('admin', 'user')  
    )";

    $check = mysqli_query($conn, $table);

    if (!$check) {
        echo "Table not created: " . mysqli_error($conn);
    }

    // Check if the provided email and password match admin credentials
    $adminEmail = 'sushmitatimalsina@gmail.com';
    $adminPassword = 'Admin@1234';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Check if the provided email and password match admin credentials
        if ($email === $adminEmail && $password === $adminPassword) {
            $role = 'admin';
            $redirect = 'admin_home.php';
        } else {
            $role = 'user';
            $redirect = 'login.php';
        }

        // Insert user data into the signup table
        $insertQuery = "INSERT INTO signup (Fullname, Emailid, Password, Role) VALUES ('$fullname', '$email', '$password', '$role')";
        $insertResult = mysqli_query($conn, $insertQuery);

        if ($insertResult) {
            // Redirect based on role
            header("Location: $redirect");
            exit();
        } else {
            echo "Error inserting data: " . mysqli_error($conn);
        }
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
 -->