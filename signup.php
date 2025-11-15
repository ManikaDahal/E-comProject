<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "csit6th";

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $pass = trim($_POST['password']);
    $confirmpass = trim($_POST['confirmpassword']);
    $role = trim($_POST['role']);


    // Validate passwords
    if ($pass !== $confirmpass) {
        echo "<script>alert('Passwords do not match!');</script>";
    } else {
        // Check if email exists
        $stmt = $conn->prepare("SELECT * FROM signup WHERE Emailid = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script>alert('Email already registered!');</script>";
        } else {
            $stmt = $conn->prepare("INSERT INTO signup (Fullname, Emailid, Password , Role) VALUES (?, ?, ?,  ?)");
            $stmt->bind_param("ssss", $fullname, $email, $pass, $role);
            if ($stmt->execute()) {
                // Set session for newly signed-up user
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $fullname;
    $_SESSION['Emailid'] = $email;
                echo "<script>
                        alert('Signup successful!');
                        window.location.href='index.php';
                      </script>";
            } else {
                echo "<script>alert('Error in signup. Please try again.');</script>";
            }
        }
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>KisanConnect - Sign Up</title>
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

    .signup-page {
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

    .signup-page h1 {
        color: #2e7d32;
        margin-bottom: 20px;
        font-size: 2rem;
    }

    .input-bo {
        margin-bottom: 15px;
        text-align: left;
    }

    .input-bo label {
        font-size: 0.9rem;
        margin-bottom: 5px;
        display: block;
        color: #333;
    }

    .input-bo input {
        width: 100%;
        padding: 12px 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 1rem;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
        transition: border 0.3s ease, box-shadow 0.3s ease;
    }

    .input-bo input:focus {
        border-color: #43a047;
        box-shadow: 0 0 8px rgba(67, 160, 71, 0.3);
        outline: none;
    }

    .eye-icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        color: #666;
    }

    .link button {
        width: 100%;
        padding: 12px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(90deg, #43a047, #66bb6a);
        color: #fff;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .link button:hover {
        background: linear-gradient(90deg, #2e7d32, #43a047);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

    .input p {
        text-align: center;
        font-size: 0.9rem;
        color: #555;
    }
    .input-bo select {
    width: 100%;
    padding: 12px 15px;
    border-radius: 8px;
    border: 1px solid #ddd;
    font-size: 1rem;
    box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
    transition: border 0.3s ease, box-shadow 0.3s ease;
    background-color: #fff;
}

.input-bo select:focus {
    border-color: #43a047;
    box-shadow: 0 0 8px rgba(67, 160, 71, 0.3);
    outline: none;
}


    .input a {
        color: #43a047;
        font-weight: 600;
        text-decoration: none;
    }

    .input a:hover {
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

    .password-container {
        position: relative;
    }
</style>
</head>
<body>
<section>
<div class="signup-page">
    <h1>KisanConnect Sign Up</h1>
    <?php if(isset($error)) echo "<p class='error-message'>$error</p>"; ?>
    <form action="" method="post" onsubmit="return validateForm()">
        <div class="input-bo">
            <label for="fullname"><i class="fas fa-user"></i> Full Name</label>
            <input type="text" name="fullname" id="fullname" placeholder="Full Name" required>
        </div>
        <div class="input-bo">
            <label for="email"><i class="fas fa-envelope"></i> Email</label>
            <input type="email" name="email" id="email" placeholder="Email" required>
        </div>
        <div class="input-bo password-container">
            <label for="password"><i class="fas fa-lock"></i> Password</label>
            <input type="password" id="password" name="password" placeholder="Password" required>
            <span class="eye-icon" onclick="togglePassword('password')"><i class="fas fa-eye"></i></span>
        </div>
        <div class="input-bo password-container">
            <label for="confirmPassword"><i class="fas fa-lock"></i> Confirm Password</label>
            <input type="password" id="confirmPassword" name="confirmpassword" placeholder="Confirm Password" required>
            <span class="eye-icon" onclick="togglePassword('confirmPassword')"><i class="fas fa-eye"></i></span>
        </div>
        
    

        <div class="link">
            <button type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
        </div>
        <div class="input">
            <p>Already have an account? <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></p>
        </div>
    </form>
</div>
</section>

<script>
function togglePassword(id) {
    var input = document.getElementById(id);
    var icon = input.nextElementSibling.querySelector('i');
    if(input.type === "password"){ 
        input.type="text"; 
        icon.classList.replace('fa-eye','fa-eye-slash'); 
    } else { 
        input.type="password"; 
        icon.classList.replace('fa-eye-slash','fa-eye'); 
    }
}

function validateForm() {
    var password = document.getElementById("password").value;
    var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;
    if(!pattern.test(password)){ 
        alert("Password must be at least 8 characters with uppercase, lowercase, number, and special character."); 
        return false; 
    }

    var confirmPassword = document.getElementById("confirmPassword").value;
    if(password !== confirmPassword){
        alert("Passwords do not match.");
        return false;
    }

    return true;
}
</script>
</body>
</html>

