<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php");
    exit();
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $host = "localhost";
    $username = "root";
    $password = ""; 
    $database = "bca4th";

    $conn = mysqli_connect($host, $username, $password, $database);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM signup WHERE Emailid = '$email' AND Password = '$password'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['loggedin'] = true; 
        $_SESSION['username'] = $row['Fullname']; 
        $_SESSION['email'] = $row['Emailid']; // Store email in session

        echo '<script>alert("Login successful."); window.location.href = "index.php";</script>'; 
        exit(); 
    } else {
        echo '<script>alert("Incorrect email or password. Please retry."); window.location.href = "login.php";</script>';
        exit();
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
<style>
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
            background-image: url('sign.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-page {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 12px;
            padding: 30px;
            max-width: 350px;
            width: 90%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: box-shadow 0.3s ease, transform 0.3s ease;
        }

        .login-page:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            transform: translateY(-10px);
        }

        .login-page h1 {
            font-size: 2rem;
            color: #1a4e6e;
            margin-bottom: 10px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        form input {
            height: 45px;
            width: 100%;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            font-size: 1rem;
            padding: 0 14px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        form input:focus {
            outline: none;
            border-color: #2980b9;
            box-shadow: 0 0 8px rgba(41, 128, 185, 0.2);
        }

        .login-button {
            cursor: pointer;
            background: #2196f3;
            padding: 12px 0;
            color: white;
            font-size: 1rem;
            font-weight: 600;
            transition: background 0.3s ease, box-shadow 0.3s ease;
            border-radius: 8px;
            width: 100%;
            margin-top: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .login-button:hover {
            background: #1976d2;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .signup-link {
            margin-top: 15px;
            text-align: center;
            font-size: 0.9rem;
            color: #555;
        }

        .signup-link a {
            color: #2980b9;
            text-decoration: none;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .close-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px;
            color: #333;
        }

        #message {
            display: none;
            color: red;
            font-size: 0.9rem;
            text-align: center;
            margin-top: 10px;
        }

        /* Keyframe animation for form inputs */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        form input, .login-button {
            animation: fadeIn 0.8s ease both;
        }
    </style>
</head>
<body>
<section id="checkout-section" class="checkout-section">
    <div class="login-page">
        <button class="close-button" onclick="closeCheckout()">&times;</button>
        <h1>Sasto Saman</h1>
          <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
            <h2>LOGIN</h2>
            <input type="text" name="email" id="contactInput" placeholder="Email or phone number" required>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <button type="submit" class="login-button">Login</button>
            <div id="message">I am Sushmita</div>
        </form>
        <div class="signup-link">
            <p>Don't have an account? <a href="signup.php">Sign up</a></p>
        </div>
    </div>
</section>

<script type="text/javascript">
    function validateEmail(email) {
        var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }

    function validateForm() {
        var emailInput = document.getElementById("contactInput").value;
        var passwordInput = document.getElementById("password").value;
        var passwordRegex = /(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/;

        if (!validateEmail(emailInput)) {
            alert("Invalid email address.");
            return false;
        }

        if (!passwordRegex.test(passwordInput)) {
            alert("Password must contain at least 8 characters, including at least one letter and one number.");
            return false;
        }

        return true;
    }

    function closeCheckout() {
        window.location.href = "index.php";
    }

    function showMessage(message) {
        var messageElement = document.getElementById("message");
        messageElement.innerHTML = message;
        messageElement.style.display = "block";
    }
</script>
</body>
</html>
