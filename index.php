
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Home</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  <link rel="icon" href="images/Logo.png" type="image/x-icon">
  <style type="text/css">
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Roboto', sans-serif;
    }

    body {
      background: linear-gradient(to right, #f0f4f7, #d9e2ec);
      color: #333;
    }

    section {
      width: 100%;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 50px 20px;
      background-color: #f7f2e4;
    }

    .container1 {
      max-width: 1200px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 20px;
      flex-wrap: wrap;
      padding: 20px;
      background: rgba(255, 255, 255, 0.9);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      border-radius: 20px;
      text-align: center;
    }

    .container1 h1 {
      font-size: 2.5rem;
      color: #333;
    }

    .container1 p {
      color: #555;
      font-size: 1rem;
      margin: 10px 0;
    }

    .container1 img {
      max-width: 100%;
      border-radius: 10px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    button {
      border: none;
      background-color: #007bff;
      color: white;
      padding: 10px 20px;
      font-size: 1.2rem;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease;
      margin-top: 20px;
    }

    button:hover {
      background-color: #0056b3;
      transform: translateY(-2px);
    }

    button a {
      color: white;
      text-decoration: none;
    }

    @media (max-width: 768px) {
      .container1 {
        flex-direction: column;
      }

      .container1 img {
        margin-top: 20px;
      }
    }
  </style>
</head>

<body>
  <?php include 'nav.php'; ?>
  <div>
        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
            <!-- <span>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</span> -->
           <!--  <a href="logout.php">Logout</a> -->
        <?php else: ?>
           <!--  <a href="login.php">Login</a> -->
        <?php endif; ?>
    </div>
</div>

  <section>
    <div class="container1">
      <div class="text-content">
        <h1>Welcome To Our</h1>
        <h1>Online Shop</h1>
        <p>Our shop is an ecommerce platform where we sell products all over Nepal through fast shipping.</p>
        <p>We are trusted and verified by the Nepal government, making us a popular ecommerce site all over Nepal.</p>
        <p>The owner of this shop is Miss. Sushmita Timalsina/Susmita Mahat.</p>
        <button class="btn"><a href="products.php">Explore Products</a></button>
      </div>
      <img src="picture/p1.jpg" alt="Slider Image">
    </div>
  </section>
  <?php include 'footer.php'; ?>
</body>

</html>
