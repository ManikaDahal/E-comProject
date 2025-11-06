<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>About Us</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">
    <style>
        /* Header style */
        .header {
            background-color: #081b29;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }

        /* Body style */
        body {
            background-color: #f0f0f0; /* Light background color */
            font-family: Arial, sans-serif; /* Specify a fallback font */
            margin: 0;
            padding: 0;
        }

        /* About Us section */
        #aboutus {
            padding: 50px 20px;
            text-align: center;
        }

        .slogan {
            font-size: 32px;
            font-weight: bold;
            color: #081b29; /* Dark blue color */
            margin-bottom: 20px;
        }

        .def p {
            font-size: 18px;
            line-height: 1.6;
            color: #333; /* Dark text color */
            margin-bottom: 20px;
        }

        /* Columns layout */
        .colm {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap; /* Allow columns to wrap on smaller screens */
            margin-top: 50px;
        }

        .col2 {
            flex: 1;
            max-width: 300px; /* Limit maximum width of columns */
            margin: 0 10px; /* Add margin between columns */
            background-color: #fff; /* White background */
            padding: 20px;
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow */
            text-align: left; /* Align text to the left */
            transition: transform 0.3s ease-in-out; /* Add smooth transition effect */
        }

        .col2:hover {
            transform: translateY(-5px); /* Move column up on hover */
        }

        .col2 h1 {
            font-size: 24px;
            color: #081b29; /* Dark blue color */
            margin-bottom: 15px;
        }

        .col2 p {
            font-size: 16px;
            color: #555; /* Darker text color */
            margin-bottom: 10px;
        }

        /* Footer style */
        footer {
            background-color: #081b29;
            color: #fff;
            text-align: center;
            padding: 20px 0;
        }

        .footer-social {
            margin-top: 20px;
        }

        .instagram-icon {
            width: 30px;
            height: auto;
            margin: 0 5px;
        }

        /* Responsive styling */
        @media screen and (max-width: 768px) {
            .col2 {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <?php include 'nav.php'; ?>
    </header>

    <section id="aboutus">
        <h2 class="slogan">Welcome to SastoSaman!</h2>
        <div class="def">
            <p>At SastoSaman, we believe in the power of sustainable and affordable shopping. Our platform is dedicated to connecting individuals who want to give pre-loved items a new home with those who are seeking quality goods at great prices.</p>
            <p>We understand the importance of reducing waste and minimizing our environmental footprint. With a commitment to quality and customer satisfaction, we strive to ensure that every transaction on our platform is secure.</p>
            <p>Thank you for choosing SastoSaman — where second-hand shopping meets endless possibilities.</p>
            <h3><b>Happy shopping!</b></h3>
        </div>
        <div class="colm">
            <div class="col2">
                <h1>About Us</h1>
                <p>Author: Sushmita Timalsina</p>
                <p>BCA Student Studying 4th Semester</p>
            </div>
            <div class="col2">
                <h1>Need Help</h1>
                <p>If you need any help, you can contact us.</p>
            </div>
            <div class="col2">
                <h1>Contact</h1>
                <p>Address: Kavre, Panauti</p>
                <p>Phone No: 00-17777</p>
                <p>Mobile No: 00-17777</p>
                <p>Email: sushmitatimalsina602@gmail.com</p>
            </div>
        </div>
    </section>

  
    <?php include 'footer.php'; ?>

</body>

</html>
