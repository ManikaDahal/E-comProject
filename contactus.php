<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KisanConnect | Contact Us</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">

    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Poppins', Arial, sans-serif;
            margin: 0;
        }

        section {
            padding: 40px 0;
        }

        .co7 {
            text-align: center;
            color: #2e7d32;
            font-size: 40px;
            font-weight: 700;
            margin-bottom: 40px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .contact7 {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: stretch;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 1000px;
            margin: 0 auto;
        }

        .contact7 img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            flex: 1 1 400px;
        }

        .form {
            flex: 1 1 400px;
            padding: 30px;
            background-color: #ffffff;
        }

        .form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #1b5e20;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 5px;
            color: #444;
        }

        .inp,
        .msg {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 15px;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        .inp:focus,
        .msg:focus {
            border-color: #43a047;
            outline: none;
        }

        .msg {
            height: 150px;
            resize: none;
        }

        .btn {
            width: 100%;
            background-color: #43a047;
            color: white;
            padding: 14px 0;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2e7d32;
        }

        @media (max-width: 768px) {
            .contact7 {
                flex-direction: column;
            }

            .contact7 img {
                height: 250px;
            }

            .form {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <?php include 'nav.php'; ?>

    <section>
        <h1 class="co7">Contact Us</h1>
        <div class="contact7">
            <img src="picture/p7.jpg" alt="Contact KisanConnect">

            <div class="form">
                <form>
                    <h2>Get in Touch</h2>
                    <div class="form-group">
                        <label for="name"><i class="fas fa-user"></i> Name:</label>
                        <input type="text" id="name" class="inp" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope"></i> Email:</label>
                        <input type="email" id="email" class="inp" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="phone"><i class="fas fa-phone-alt"></i> Phone No:</label>
                        <input type="tel" id="phone" class="inp" placeholder="Enter your phone number">
                    </div>
                    <div class="form-group">
                        <label for="message"><i class="fas fa-comment-dots"></i> Message:</label>
                        <textarea id="message" class="msg" placeholder="Enter your message"></textarea>
                    </div>
                    <button type="submit" class="btn">Send Message</button>
                </form>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

</html>
