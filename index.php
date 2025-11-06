<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>KisanConnect+</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="icon" href="images/logo.png" type="image/x-icon">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: linear-gradient(to right, #e8f5e9, #f1f8e9);
      color: #2e7d32;
      overflow-x: hidden;
    }

    section {
      width: 100%;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 60px 20px;
    }

    .container1 {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 40px;
      flex-wrap: wrap;
      max-width: 1200px;
      background: #ffffffcc;
      backdrop-filter: blur(10px);
      border-radius: 25px;
      padding: 50px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
    }

    .container1:hover {
      transform: translateY(-5px);
    }

    .text-content {
      flex: 1;
      min-width: 300px;
      animation: fadeInUp 1s ease;
    }

    .text-content h1 {
      font-size: 3rem;
      color: #1b5e20;
      line-height: 1.2;
      margin-bottom: 15px;
    }

    .text-content h1:nth-child(2) {
      color: #388e3c;
      font-weight: 800;
    }

    .text-content p {
      color: #33691e;
      font-size: 1.05rem;
      margin: 12px 0;
      line-height: 1.7;
    }

    .text-content b {
      color: #1b5e20;
    }

    .btn {
      display: inline-block;
      margin-top: 25px;
      background: linear-gradient(90deg, #43a047, #66bb6a);
      color: white;
      padding: 14px 35px;
      font-size: 1.1rem;
      font-weight: 600;
      border-radius: 50px;
      border: none;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.3s ease;
      box-shadow: 0 4px 10px rgba(76, 175, 80, 0.4);
    }

    .btn:hover {
      background: linear-gradient(90deg, #2e7d32, #388e3c);
      transform: translateY(-3px);
      box-shadow: 0 6px 15px rgba(56, 142, 60, 0.4);
    }

    .image-content {
      flex: 1;
      display: flex;
      justify-content: center;
      animation: fadeInRight 1s ease;
    }

    .image-content img {
      max-width: 100%;
      border-radius: 15px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
      transition: transform 0.4s ease;
    }

    .image-content img:hover {
      transform: scale(1.03);
    }

    /* Animations */
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInRight {
      from {
        opacity: 0;
        transform: translateX(30px);
      }
      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    @media (max-width: 992px) {
      .container1 {
        flex-direction: column;
        text-align: center;
        padding: 40px 25px;
      }

      .text-content h1 {
        font-size: 2.5rem;
      }

      .image-content img {
        margin-top: 25px;
        max-width: 90%;
      }
    }

    @media (max-width: 600px) {
      .text-content h1 {
        font-size: 2rem;
      }

      .btn {
        padding: 12px 25px;
        font-size: 1rem;
      }
    }
  </style>
</head>

<body>
  <?php include 'nav.php'; ?>

  <section>
    <div class="container1">
      <div class="text-content">
        <h1>Welcome To</h1>
        <h1>KisanConnect</h1>
        <p>KisanConnect is Nepal's trusted online marketplace for farmers and agri-enthusiasts.</p>
        <p>We help farmers, suppliers, and buyers connect directly to buy and sell a wide range of farming-related products — from seeds, fertilizers, and tools to modern agricultural equipment.</p>
        <p>Our platform ensures fair prices, reliable delivery, and quality-checked goods that support sustainable agriculture and rural growth across Nepal.</p>
        <p>Join us to grow smarter with real-time market insights, weather updates, and expert farming tips — all in one place.</p>
        <p><b>Developed by:</b> Team AgriVision (Manika Dahal / Anuska Ghimire / Sabina Niraula)</p>
        <a href="products.php" class="btn">🌾 Explore Marketplace</a>
      </div>

      <div class="image-content">
        <img src="picture/homePage.jpg" alt="Farmers working in the field">
      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>
</body>

</html>
