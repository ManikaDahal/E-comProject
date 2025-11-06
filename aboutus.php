<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>About Us | KisanConnect</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="icon" href="images/Logo.png" type="image/x-icon">

  <style>
    body {
      background-color: #f5f5f5;
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #0a3d2e;
      color: #fff;
      padding: 10px 0;
      text-align: center;
    }

    #aboutus {
      padding: 50px 20px;
      text-align: center;
    }

    .slogan {
      font-size: 32px;
      font-weight: bold;
      color: #0a3d2e;
      margin-bottom: 20px;
    }

    .def p {
      font-size: 18px;
      line-height: 1.6;
      color: #333;
      margin-bottom: 20px;
    }

    .colm {
      display: flex;
      justify-content: space-around;
      flex-wrap: wrap;
      margin-top: 50px;
    }

    .col2 {
      flex: 1;
      max-width: 300px;
      margin: 10px;
      background-color: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      text-align: left;
      transition: transform 0.3s ease;
    }

    .col2:hover {
      transform: translateY(-5px);
    }

    .col2 h1 {
      font-size: 24px;
      color: #0a3d2e;
      margin-bottom: 15px;
    }

    .col2 p {
      font-size: 16px;
      color: #555;
      margin-bottom: 10px;
    }

    footer {
      background-color: #0a3d2e;
      color: #fff;
      text-align: center;
      padding: 20px 0;
    }

    @media screen and (max-width: 768px) {
      .col2 {
        margin-bottom: 20px;
      }
    }
  </style>
</head>

<body>
  <header>
    <?php include 'nav.php'; ?>
  </header>

  <section id="aboutus">
    <h2 class="slogan">Welcome to KisanConnect!</h2>

    <div class="def">
      <p>KisanConnect is your trusted online marketplace for all farming needs — from seeds and fertilizers to tools, equipment, and expert advice.</p>
      <p>Our mission is to empower farmers across Nepal by making agricultural products easily accessible, affordable, and reliable.</p>
      <p>We also connect local suppliers, buyers, and agricultural experts to promote sustainable and smart farming practices.</p>
      <h3><b>Together, let's grow the future of agriculture!</b></h3>
    </div>

    <div class="colm">
      <div class="col2">
        <h1>About Us</h1>
        <p><b>Developed by:</b> Team AgriVision</p>
        <p>Members: Manika Dahal, Anuska Ghimire, Sabina Niraula</p>
        <p>Bsc.CSIT Students, 6th Semester</p>
      </div>

      <div class="col2">
        <h1>Our Services</h1>
        <p>🌾 Quality seeds, tools & equipment</p>
        <p>🚚 Fast delivery across Nepal</p>
        <p>💬 Expert farming guidance</p>
      </div>

      <div class="col2">
        <h1>Contact</h1>
        <p>Address: Nayabasti, Banepa</p>
        <p>Phone: +977-9823000006</p>
        <p>Email: kisanConnect01@.com</p>
      </div>
    </div>
  </section>

  <?php include 'footer.php'; ?>
</body>

</html>
