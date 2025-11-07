<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Footer</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <style type="text/css">
        footer {
            background-color: #081b29;
            color: #fff;
            padding: 20px 0;
            text-align: center;
        }

        .footer-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .footer-links ul li {
            margin: 0 15px;
        }

        .footer-links ul li a i {
            font-size: 36px;
            color: #ccc;
            transition: color 0.3s;
        }

        .footer-links ul li a:hover i {
            color: #f39c12;
        }

        .social-media {
            margin-bottom: 20px;
        }

        .social-media a {
            font-size: 24px;
            margin: 0 10px;
            text-decoration: none;
            transition: color 0.3s;
        }

        .social-media a#instagram:hover {
            color: #833ab4;
        }

        .social-media a#twitter:hover {
            color: #1da1f2;
        }

        .social-media a#facebook:hover {
            color: #3b5998;
        }

        .footer-info p {
            margin: 5px 0;
            font-size: 18px;
        }

        .footer-info a {
            color: #f39c12;
            text-decoration: none;
        }

        .footer-info a:hover {
            text-decoration: underline;
        }

        .copyright p {
            font-size: 14px;
            margin-top: 20px;
            color: #ccc;
        }
    </style>
</head>
<body>
<footer>
    <div class="footer-container">
        <!-- Admin navigation icons -->
        <div class="footer-links">
            <ul>
                <li><a href="admin_home.php"><i class="fas fa-home"></i></a></li>
                <li><a href="manage_users.php"><i class="fas fa-users"></i></a></li>
                <li><a href="reports.php"><i class="fas fa-file-alt"></i></a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i></a></li>
            </ul>
        </div>

        <!-- Social media links -->
        <div class="social-media">
            <a href="https://www.instagram.com/your_instagram_username" target="_blank" id="instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://www.facebook.com/your_facebook_page" target="_blank" id="facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/your_twitter_handle" target="_blank" id="twitter"><i class="fab fa-twitter"></i></a>
        </div>

        <!-- Contact info -->
        <div class="footer-info">
            <p>Address: Naya basti, Banepa, Nepal</p>
            <p>Email: <a href="mailto:kissanConnect01@gmail.com">kissanConnect01@gmail.com</a></p>
            <p>Phone: +9779823000006</p>
        </div>
    </div>

    <!-- Copyright -->
    <div class="copyright">
        <p>&copy; 2024 aasussi.wordpress.com. All Rights Reserved.</p>
    </div>
</footer>
</body>
</html>
