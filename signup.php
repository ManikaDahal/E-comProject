<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <title>Signup Website</title>
     
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
            background-image: url('sign.jpg');
            background-size: cover;
            background-repeat: no-repeat;
        }

        section {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* viewport height */
        }

        .login {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 6px 20px rgba(0, 0, 0, 0.5);
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            position: relative;
        }

        .login h1 {
            margin-bottom: 20px;
            text-align: center;
            color: #333;
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

        .input-bo {
            margin-bottom: 15px;
        }

        .input-bo label {
            font-size: 16px;
            color: #333;
            display: block;
            margin-bottom: 5px;
        }

        .input-bo input {
            width: 90%;
            padding: 10px;
            border: 1px solid #aaa;
            border-radius: 5px;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.1);
            transition: border-color 0.3s ease;
        }

        .input-bo input:focus {
            border-color: #497ef2;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }

        .link button {
            width: 100%;
            padding: 10px;
            background-color: #497ef2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .link button:hover {
            background-color: #386fc9;
        }

        .input p {
            text-align: center;
            font-size: 14px;
        }

        .input a {
            color: #497ef2;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .input a:hover {
            color: #386fc9;
        }

        #password-validation {
            color: red;
            font-size: 12px;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
<section id="checkout-section" class="checkout-section">
    <div class="log-cont">
        <form action="insert.php" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
            <div class="login">
                <h1>Sign Up</h1>
                <button class="close-button" type="button" onclick="closeCheckout()">&times;</button>

                <div class="input-bo">
                    <label for="fullname"><i class="fas fa-user"></i> Full Name</label>
                    <input type="text" name="fullname" id="fullname" placeholder="Full Name" required>
                </div>
                <div class="input-bo">
                    <label for="email"><i class="fas fa-envelope"></i> Email</label>
                    <input type="email" name="email" id="email" placeholder="Email" required>
                </div>
                <div class="input-bo">
                    <label for="password"><i class="fas fa-lock"></i> Password</label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password" placeholder="Password" required>
                        <span class="eye-icon" onclick="togglePassword('password')"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="input-bo">
                    <label for="confirmPassword"><i class="fas fa-lock"></i> Confirm Password</label>
                    <div style="position: relative;">
                        <input type="password" id="confirmPassword" name="confirmpassword" placeholder="Confirm Password" required>
                        <span class="eye-icon" onclick="togglePassword('confirmPassword')"><i class="fas fa-eye"></i></span>
                    </div>
                </div>
                <div class="link">
                    <button type="submit" onclick="validateForm(); savePassword();"><i class="fas fa-user-plus"></i> Sign Up</button>
                </div>
                <span id="password-validation"></span>
                <div class="input">
                    <p>Already have an account? <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a></p>
                </div>
            </div>
        </form>
    </div>
</section>

<script>
    function validateForm() {
        var password = document.getElementById("password").value;
        var pattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!pattern.test(password)) {
            document.getElementById("password-validation").innerHTML =alert( "Password must contain at least 8 characters, including at least one uppercase letter, one lowercase letter, one digit, and one special character.");
            return false;
        }

        document.getElementById("password-validation").innerHTML = "";
        return true;
    }

    function savePassword() {
        var rememberMeCheckbox = document.getElementById("rememberMe");
        var passwordInput = document.getElementById("password");

        if (rememberMeCheckbox && rememberMeCheckbox.checked) {
            localStorage.setItem("rememberedPassword", passwordInput.value);
        } else {
            localStorage.removeItem("rememberedPassword");
        }
    }

    function loadSavedPassword() {
        var rememberedPassword = localStorage.getItem("rememberedPassword");
        var passwordInput = document.getElementById("password");

        if (rememberedPassword) {
            passwordInput.value = rememberedPassword;
            document.getElementById("rememberMe").checked = true;
        }
    }

    window.onload = loadSavedPassword;

    function togglePassword(inputId) {
    var input = document.getElementById(inputId);
    var eyeIcon = input.nextElementSibling.querySelector('i');

    if (input.type === 'password') {
        input.type = 'text';
        eyeIcon.classList.add('fa-eye');
        eyeIcon.classList.remove('fa-eye-slash');
    } else {
        input.type = 'password';
        eyeIcon.classList.add('fa-eye-slash');
        eyeIcon.classList.remove('fa-eye');
    }
}



    function closeCheckout() {
        window.location.href = "index.php";
    }
</script>
</body>
</html>
