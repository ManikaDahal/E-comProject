<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "csit6th";

$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) die("Connection failed: " . mysqli_connect_error());

$error = "";

// Handle login form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : "";
    $pass = isset($_POST['password']) ? trim($_POST['password']) : "";

    if ($email === "" || $pass === "") {
        $error = "Please enter both email and password!";
    } else {
        $query = "SELECT * FROM signup WHERE Emailid='$email' AND Password='$pass'";
        $result = mysqli_query($conn, $query);

       if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $row['Fullname'];
    $_SESSION['Emailid'] = $row['Emailid'];

    // ✅ Redirect the proper PHP way
    header("Location: index.php?login=success");
    exit();


        } else {
            $error = "Incorrect email or password!";
        }
    }
}

mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KisanConnect - Login</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to right, #e8f5e9, #f1f8e9);
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 100vh;
    }

    .login-page {
        background: #ffffffcc;
        backdrop-filter: blur(10px);
        padding: 40px 30px;
        border-radius: 15px;
        box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        max-width: 400px;
        width: 100%;
        text-align: center;
        animation: fadeIn 1s ease;
    }

    .login-page h1 {
        color: #2e7d32;
        margin-bottom: 20px;
        font-size: 2rem;
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    form input {
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 1rem;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
        transition: border 0.3s ease, box-shadow 0.3s ease;
    }

    form input:focus {
        border-color: #43a047;
        box-shadow: 0 0 8px rgba(67, 160, 71, 0.3);
        outline: none;
    }

    button {
        padding: 12px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(90deg, #43a047, #66bb6a);
        color: #fff;
        font-size: 1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        font-weight: 600;
    }

    button:hover {
        background: linear-gradient(90deg, #2e7d32, #43a047);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .signup-link {
        margin-top: 15px;
        font-size: 0.9rem;
        color: #555;
    }

    .signup-link a {
        color: #43a047;
        font-weight: 600;
        text-decoration: none;
    }

    .signup-link a:hover {
        text-decoration: underline;
    }

    .error-message {
        color: red;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
</head>
<body>
<section>
<div class="login-page">
    <h1>KisanConnect Login</h1>
    <?php if(isset($error)) echo "<p class='error-message'>$error</p>"; ?>
    <form action="" method="post">
        <input type="text" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit"><i class="fas fa-sign-in-alt"></i> Login</button>
    </form>
    <p class="signup-link">Don't have an account? <a href="signup.php">Sign up</a></p>
</div>
</section>
</body>
</html>
