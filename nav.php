<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if the user is already logged in and retrieve the username
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
        <form action='logout.php' method='post' onsubmit='return confirmLogout();'>
            <button type='submit' class='logout-btn'>Logout</button>
        </form>
    ";
} else {
    $loginButton = "
        <form action='login.php' method='post'>
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
    <title>KisanConnect - Home</title>
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
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .logo {
            color: #fff;
            font-size: 24px;
            font-weight: bold;
            margin: 0;
        }

        .logo span {
            color: #00c853;
        }

        nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
        }

        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }

        nav ul li {
            margin-right: 20px;
        }

        nav ul li:last-child {
            margin-right: 0;
        }

        nav ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
            transition: color 0.3s;
        }

        nav ul li a:hover {
            color: #00c853;
        }

        .search-container {
            display: flex;
            align-items: center;
        }

        .search-container input[type="text"] {
            padding: 8px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            outline: none;
        }

        .search-container button {
            padding: 8px;
            background-color: #00c853;
            border: none;
            cursor: pointer;
            color: #fff;
            font-size: 16px;
            border-radius: 5px;
            margin-left: 5px;
        }

        .nav-items-right {
            display: flex;
            align-items: center;
        }

        .nav-item {
            margin-left: 20px;
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

        .login-section button {
            cursor: pointer;
            background: #00c853;
            padding: 10px 20px;
            font-size: 16px;
            text-align: center;
            font-weight: 600;
            transition: 0.2s ease;
            border-radius: 5px;
            color: white;
            border: none;
            outline: none;
        }

        .login-section button:hover {
            background: #00c853;
        }

        /* 🟢 Elegant Username Display */
        .user-display {
            display: flex;
            align-items: center;
            gap: 8px;
            background-color: #00c853;
            color: white;
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: 600;
            font-size: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
            transition: background 0.3s, transform 0.2s;
            margin-left: 15px;
            margin-right: 10px;
        }

        .user-display:hover {
            background-color: #00b14f;
            transform: translateY(-2px);
        }

        .user-display i {
            font-size: 18px;
        }

        .logout-btn,
        .login-btn {
            background: transparent;
            border: 2px solid #00c853;
            color: #00c853;
            padding: 8px 15px;
            border-radius: 25px;
            font-weight: 600;
            cursor: pointer;
            margin-left: 10px;
            transition: all 0.3s ease;
        }

        .logout-btn:hover,
        .login-btn:hover {
            background-color: #00c853;
            color: white;
        }

        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 20px;
            margin-top: 20px;
        }

        .product {
            box-sizing: border-box;
            margin: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            border: 1px solid #ddd;
            padding: 15px;
            max-width: 200px;
            height: 400px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            background-color: whitesmoke;
        }

        .product:hover {
            background-color: #f5f5f5;
            transform: translateY(-5px);
            transition: background-color 0.3s, transform 0.3s;
        }

        .product button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
            margin-top: 10px;
            transition: background-color 0.3s;
        }

        .product button:hover {
            background-color: #45a049;
        }

        .product img {
            max-width: 100%;
            height: 185px;
            margin-bottom: 10px;
            filter: brightness(103%) contrast(93%) saturate(106%) sepia(20%);
        }

        .product h2 {
            font-weight: bold;
            font-size: 16px;
            margin: 10px 0;
        }

        .product p.price {
            font-size: 14px;
        }

        .section {
            width: 100%;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <nav>
            <h2 class="logo">Kisan<span>Connect</span></h2>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="whyus.php">Why Us</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
                <li><a href="aboutus.php">About Us</a></li>
            </ul>
            <div class="search-container">
                <form id="searchForm" action="search.php" method="GET">
                    <input type="text" placeholder="Search.." name="query" id="searchInput">
                    <button type="button" id="searchButton"><i class="fa fa-search" aria-hidden="true"></i></button>
                </form>

                <!-- 🟢 Username shown right after search bar -->
                <?php echo $userButton; ?>
            </div>

            <div class="nav-items-right">
                <div class="login-section">
                    <?php echo $loginButton; ?>
                </div>
                <div class="nav-item">
                    <a href="cart.php"><i class="fas fa-shopping-cart fa-lg" aria-hidden="true"></i></a>
                </div>
                <div class="nav-item">
                    <a href="products.php"><i class="fas fa-shopping-bag fa-lg" aria-hidden="true"></i></a>
                </div>
            </div>
        </nav>
    </div>
    <script>
        // Search button functionality
        var searchButton = document.getElementById("searchButton");
        searchButton.addEventListener("click", function() {
            document.getElementById("searchForm").submit();
        });

        function confirmLogout() {
            if (confirm("Are you sure you want to logout?")) {
                window.location.href = "logout.php";
            }
            return false;
        }
    </script>
</body>

</html>
