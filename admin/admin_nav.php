<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Username display and login/logout button
$userButton = '';
$loginButton = '';

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $username = htmlspecialchars($_SESSION['username']); // safe output

    $userButton = "
        <div class='user-display'>
            <i class='fas fa-user-circle'></i>
            <span>$username</span>
        </div>
    ";

    $loginButton = "
        <form action='admin_logout.php' method='post' onsubmit='return confirmLogout();'>
            <button type='submit' class='logout-btn'>Logout</button>
        </form>
    ";
} else {
    $loginButton = "
        <form action='admin_login.php' method='post'>
            <button type='submit' class='login-btn'>Login</button>
        </form>
    ";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .header {
            background-color: #081b29;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
        }

        .logo span {
            color:#00c853;
        }

        nav ul {
            list-style: none;
            display: flex;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #00c853;
        }

        .nav-items-right {
            display: flex;
            align-items: center;
        }

        .nav-item {
            margin-left: 15px;
        }

        .nav-item a {
            color: #fff;
            font-size: 20px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .nav-item a:hover {
            color: #00c853;
        }

        .user-display {
            display: flex;
            align-items: center;
            gap: 8px;
            background-color: #00c853;
            color: white;
            padding: 6px 12px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 14px;
            margin-left: 10px;
        }

        .logout-btn,
        .login-btn {
            background: transparent;
            border: 2px solid #00c853;
            color: #00c853;
            padding: 6px 12px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            margin-left: 10px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover,
        .login-btn:hover {
            background-color:#00c853;
            color: white;
        }
    </style>
</head>

<body>
    <div class="header">
        <nav>
            <h2 class="logo">Kisan<span>Connect</span></h2>
            <ul>
                <li><a href="admin_home.php">Home</a></li>
                <li><a href="admin_manage.php">Admin</a></li>
                <li><a href="admin_dashboard.php">Products</a></li>
                <li><a href="admin_order.php">Orders</a></li>
            </ul>

            <div class="nav-items-right">
                <!-- Dynamic Username -->
                <?php echo $userButton; ?>
                <!-- Login/Logout -->
                <?php echo $loginButton; ?>
            </div>
        </nav>
    </div>

    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to logout?");
        }
    </script>
</body>

</html>
