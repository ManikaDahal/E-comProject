<?php
session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "csit6th";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the search query is set
if (isset($_GET['query'])) {
    $searchQuery = $conn->real_escape_string($_GET['query']);
    
    // SQL query to search for products
    $sql = "SELECT * FROM products WHERE Item_Name LIKE '%$searchQuery%' OR category LIKE '%$searchQuery%'";
    $result = $conn->query($sql);

    if ($result === false) {
        die("Error fetching products: " . $conn->error);
    }
} else {
    die("Search query is not set.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Sasto Saman</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body { font-family: 'Arial', sans-serif; margin:0; padding:0; background:#f2f2f2; }
        .product-container {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            padding: 20px;
        }
        .product {
            display: flex; flex-direction: column; align-items: center;
            border: 1px solid #ddd; border-radius: 5px;
            padding: 15px; max-width: 200px; height: 400px;
            text-align: center; background-color: whitesmoke;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s, background-color 0.3s;
        }
        .product:hover { background-color: #f5f5f5; transform: translateY(-5px); }
        .product img { max-width: 100%; height: 185px; margin-bottom: 10px; filter: brightness(103%) contrast(93%) saturate(106%) sepia(20%); }
        .product h2 { font-weight: bold; font-size: 16px; margin: 10px 0; }
        .product p.price { font-size: 14px; }
        .product button {
            background-color: #4CAF50; color: white;
            padding: 10px 20px; border: none; border-radius: 5px;
            font-size: 16px; margin-top: 10px; cursor: pointer;
            transition: background-color 0.3s;
        }
        .product button:hover { background-color: #45a049; }
    </style>
</head>
<body>

<?php include 'nav.php'; ?>

<main>
    <section class="product-container" id="search-results">
        <?php if ($result->num_rows > 0) {
            while ($product = $result->fetch_assoc()) { 

                // Check if product has a discount (example: only if discount column exists and >0)
                $original_price = $product['price'];
                $discounted_price = isset($product['discount']) && $product['discount'] > 0
                                    ? $original_price - $product['discount']
                                    : $original_price;
        ?>
                <div class="product" data-category="<?php echo $product['category']; ?>">
                    <form action="manage_cart.php" method="POST">
                        <?php
                        $imagePath = "admin/uploads/" . $product['product_image'];
                        if (file_exists($imagePath)) {
                            echo "<img src='$imagePath' alt='{$product['Item_Name']}'>";
                        } else {
                            echo "<p>Image not found</p>";
                        }
                        ?>
                        <h2><?php echo $product['Item_Name']; ?></h2>
                        <p class="price">
                            <?php if ($discounted_price < $original_price) { ?>
                                <ins>&#x20b9; <?php echo number_format($discounted_price, 2); ?></ins>
                                <del>&#x20b9; <?php echo number_format($original_price, 2); ?></del>
                            <?php } else { ?>
                                &#x20b9; <?php echo number_format($original_price, 2); ?>
                            <?php } ?>
                        </p>
                        <button type="submit" name="Add_To_Cart">Add to Cart</button>
                        <input type="hidden" name="Item_Name" value="<?php echo $product['Item_Name']; ?>">
                        <input type="hidden" name="price" value="<?php echo $discounted_price; ?>">
                    </form>
                </div>
        <?php }
        } else {
            echo "<script>alert('No products found'); window.location.href = 'products.php';</script>";
        } ?>
    </section>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const addToCartButtons = document.querySelectorAll("button[name='Add_To_Cart']");
        addToCartButtons.forEach(button => {
            button.addEventListener("click", function(event) {
                <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
                    event.preventDefault();
                    alert("You need to sign in to add products to the cart.");
                    window.location.href = 'signup.php';
                <?php endif; ?>
            });
        });
    });
</script>

<?php include 'footer.php'; ?>
<?php $conn->close(); ?>
</body>
</html>
