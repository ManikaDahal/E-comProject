<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>footer</title>
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
            justify-content: space-between;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-links ul {
            list-style: none;
            padding: 0;
        }

        .footer-links ul li {
            display: inline;
            margin-right: 20px;
        }

        .footer-links ul li a i {
    font-size: 24px; /* Adjust the font size to make the icons smaller */
    color: #ccc;  /*Change the color of the icons */
}

        .social-media a {
            font-size: 24px;
            margin-right: 10px;
            text-decoration: none;
        }

        .footer-info p {
            margin: 5px 0;
        }

        .copyright {
            margin-top: 20px;
        }

        /* CSS color for the icons */
        /*.footer-links ul li a i {
            color: #ff0000; /* Change this to the desired color */
        }*/

        /* Specific color for each icon */
        /*.footer-links ul li:nth-child(1) a i {
            color: #00ff00; /* Green color for Home icon */
        }*/

        /*.footer-links ul li:nth-child(2) a i {
            color: #0000ff; /* Blue color for Why Us icon */
        }
*/
        /*.footer-links ul li:nth-child(3) a i {
            color: #ffff00; /* Yellow color for Contact Us icon */
        }*/

        /*.footer-links ul li:nth-child(4) a i {
            color: #ff00ff; /* Purple color for About Us icon */
        }*/

        /* Make icons bigger */
        .footer-links ul li a i {
            font-size: 36px; /* Adjust the font size to make the icons bigger */
        }

        #instagram {
            color: #833ab4; /* Instagram's brand color */
        }

        #twiter {
            color: #1da1f2; /* Twitter's brand color */
        }

        #facebook {
            color: #3b5998; /* Facebook's brand color */
        }
    </style>
</head>
<body>
<footer>
    <div class="footer-container">
        <div class="footer-links">
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> </a></li>
                <li><a href="whyus.php"><i class="fas fa-question-circle"></i> </a></li>
                <li><a href="contactus.php"><i class="fas fa-envelope"></i></a></li>
                <li><a href="aboutus.php"><i class="fas fa-info-circle"></i></a></li>
            </ul>
        </div>
        <div class="social-media">
            <a href="https://www.instagram.com/your_instagram_username" target="_blank"><i class="fab fa-instagram" id="instagram"></i></a>
            <a href="https://www.facebook.com/your_facebook_page" target="_blank"><i class="fab fa-facebook-f" id="facebook"></i></a>
            <a href="https://twitter.com/your_twitter_handle" target="_blank"><i class="fab fa-twitter" id="twiter"></i></a>
        </div>
        <div class="footer-info">
            <p>Address: 123 Naya basti, Banepa, Nepal</p>
            <p>Email: <a href="mailto:sushmitatimalsina602@gmail.com">sushmitatimalsina602@gmail.com</a></p>
            <p>Phone: +9779823003466</p>
        </div>
    </div>
    <div class="copyright">
        <p>&copy; aasussi.wordpress.com.</p>
    </div>
</footer>
</body>
</html>
