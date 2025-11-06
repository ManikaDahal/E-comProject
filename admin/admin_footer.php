<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Footer</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <style type="text/css">
        footer {
            width: 100%;
            background-color: #081b29;
            color: #fff;
            padding: 40px 0;
            text-align: center;
        }

        .footer-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links {
            margin-bottom: 20px;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            margin: 0;
        }

        .footer-links ul li {
            margin: 0 15px;
        }

        .footer-links ul li a {
            color: #fff;
            text-decoration: none;
            font-size: 20px;
        }

        .footer-links ul li a i {
            font-size: 36px;
        }

        .social-media {
            margin-bottom: 20px;
        }

        .social-media a {
            font-size: 24px;
            margin: 0 10px;
            color: #fff;
            transition: color 0.3s;
        }

        .social-media a:hover {
            color: #f39c12;
        }

        .footer-info p {
            margin: 5px 0;
        }

        .footer-info a {
            color: #f39c12;
            text-decoration: none;
        }

        .footer-info a:hover {
            text-decoration: underline;
        }

        .footer-info p, .footer-info a {
            font-size: 18px;
        }

        .social-media a#instagram:hover {
            color: #833ab4; /* Instagram's brand color */
        }

        .social-media a#twitter:hover {
            color: #1da1f2; /* Twitter's brand color */
        }

        .social-media a#facebook:hover {
            color: #3b5998; /* Facebook's brand color */
        }

        .footer-container p {
            margin: 10px 0;
            font-size: 16px;
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
        <div class="footer-links">
            <ul>
                <li><a href="admin_home.php"><i class="fas fa-home"></i></a></li>
                
            </ul>
        </div>
        <div class="social-media">
            <a href="https://www.instagram.com/your_instagram_username" target="_blank" id="instagram"><i class="fab fa-instagram"></i></a>
            <a href="https://www.facebook.com/your_facebook_page" target="_blank" id="facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://twitter.com/your_twitter_handle" target="_blank" id="twitter"><i class="fab fa-twitter"></i></a>
        </div>
        <div class="footer-info">
            <p>Address: 123 Naya basti, Banepa, Nepal</p>
            <p>Email: <a href="mailto:sushmitatimalsina602@gmail.com">sushmitatimalsina602@gmail.com</a></p>
            <p>Phone: +9779823003466</p>
        </div>
    </div>
    <div class="copyright">
        <p>&copy; 2024 aasussi.wordpress.com. All Rights Reserved.</p>
    </div>
</footer>
</body>
</html>
