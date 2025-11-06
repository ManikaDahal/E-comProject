<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>KisanConnect | Why Us</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="images/Logo.png" type="image/x-icon">

    <style>
        body {
            margin: 0;
            font-family: 'Poppins', Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .withus {
            background-color: #f9f9f9;
            padding: 50px 0;
        }

        .su7 {
            text-align: center;
            margin-bottom: 50px;
            color: #2e7d32;
            font-size: 40px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .us-7 {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: stretch;
            gap: 30px;
            padding: 0 30px;
        }

        .content7 {
            flex: 1 1 300px;
            max-width: 320px;
            background-color: #fff;
            border-radius: 12px;
            padding: 25px 20px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .content7:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 128, 0, 0.15);
        }

        .f7 img {
            margin-bottom: 20px;
            height: 90px;
            width: auto;
            border-radius: 8px;
            object-fit: contain;
        }

        .u7 {
            margin: 15px 0;
            font-size: 22px;
            font-weight: bold;
            color: #1b5e20;
        }

        .q7,
        .q77 {
            margin-bottom: 8px;
            font-size: 16px;
            color: #555;
        }

        .q7 i,
        .q77 i {
            color: #00c853;
        }
    </style>
</head>

<body class="withus">
    <?php include 'nav.php'; ?>

    <section class="withus">
        <div id="whyus">
            <h1 class="su7">Why Shop With KisanConnect</h1>

            <div class="us-7">
                <div class="content7">
                    <div class="f7">
                        <img src="picture/p11.jpg" alt="Fast Delivery">
                    </div>
                    <h5 class="u7">Fast Delivery</h5>
                    <p class="q7"><i class="fas fa-truck"></i> We deliver products quickly to your doorstep.</p>
                    <p class="q77">Always available — wherever you are in Nepal.</p>
                </div>

                <div class="content7">
                    <div class="f7">
                        <img src="picture/p9.webp" alt="Free Shipping">
                    </div>
                    <h5 class="u7">Free Shipping</h5>
                    <p class="q7"><i class="fas fa-shipping-fast"></i> Enjoy free delivery on all orders.</p>
                    <p class="q77">No minimum purchase required.</p>
                </div>

                <div class="content7">
                    <div class="f7">
                        <img src="picture/p10.jpg" alt="Best Quality">
                    </div>
                    <h5 class="u7">Best Quality</h5>
                    <p class="q7"><i class="fas fa-leaf"></i> Only trusted and sustainable agri-products.</p>
                    <p class="q77">Guaranteed freshness and reliability.</p>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>
</body>

</html>
