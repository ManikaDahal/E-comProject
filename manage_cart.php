<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['Add_To_Cart'])) {
        if (isset($_SESSION['cart'])) {
            $myitems = array_column($_SESSION['cart'], 'Item_Name');
            if (in_array($_POST['Item_Name'], $myitems)) {
                $_SESSION['message'] = "This product is already added to the cart. You can increase the quantity in the cart page.";
            } else {
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array('Item_Name' => $_POST['Item_Name'], 'price' => $_POST['price'], 'Quantity' => 1);
                $_SESSION['message'] = "Item Added";
            }
        } else {
            $_SESSION['cart'][] = array('Item_Name' => $_POST['Item_Name'], 'price' => $_POST['price'], 'Quantity' => 1);
            $_SESSION['message'] = "Item Added";
        }
        header("Location: products.php");
        exit();
    }
    
    if (isset($_POST['Remove_Item'])) {
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($value['Item_Name'] == $_POST['Item_Name']) {
                    unset($_SESSION['cart'][$key]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                }
            }
        }
        $_SESSION['message'] = "Item removed";
        header("Location: cart.php");
        exit();
    }
}
?>