<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit();
}

// Initialize error message
$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = mysqli_connect("localhost", "root", "", "csit6th");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Make sure the inputs exist before using them
    $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';

    if ($email != '' && $password != '') {
        $query = "SELECT * FROM signup WHERE Emailid = '$email' AND Password = '$password'";
        $result = mysqli_query($conn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $row['Fullname'];
            $_SESSION['email'] = $row['Emailid'];

            // Redirect without alert
            header("Location: index.php");
            exit();
        } else {
            $error = "Incorrect email or password. Please try again.";
        }
    } else {
        $error = "Please fill in both fields.";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - KisanConnect</title>
<link rel="icon" href="images/Logo.png" type="image/x-icon">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<style>
body {
    margin: 0;
    padding: 0;
    font-family: 'Roboto', sans-serif;
    background-image: url('sign.jpg');
    background-size: cover;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
}

.login-page {
    background: rgba(255,255,255,0.95);
    padding: 30px;
    border-radius: 12px;
    max-width: 350px;
    width: 90%;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.login-page h1 {
    text-align: center;
    color: #1a4e6e;
    margin-bottom: 10px;
}

form {
    display: flex;
    flex-direction: column;
}

form input {
    height: 45px;
    margin-bottom: 15px;
    padding: 0 14px;
    border-radius: 8px;
    border: 1px solid #ddd;
}

.login-button {
    background: #2196f3;
    color: white;
    padding: 12px 0;
    font-weight: 600;
    border-radius: 8px;
    border: none;
    cursor: pointer;
}

.login-button:hover {
    background: #1976d2;
}

.signup-link {
    text-align: center;
    margin-top: 15px;
    font-size: 0.9rem;
}

.signup-link a {
    color: #2196f3;
    text-decoration: none;
}

.signup-link a:hover {
    text-decoration: underline;
}

.error-message {
    color: red;
    text-align: center;
    margin-bottom: 10px;
}
</style>
</head>
<body>

<div class="login-page">
    <h1>KisanConnect Login</h1>

    <!-- Display error message -->
    <?php if(!empty($error)) { ?>
        <p class="error-message"><?php echo $error; ?></p>
    <?php } ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" class="login-button">Login</button>
    </form>

    <div class="signup-link">
        <p>Don't have an account? <a href="signup.php">Sign up</a></p>
    </div>
</div>

</body>
</html>
