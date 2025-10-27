<?php
include 'db.php';

if (isset($_POST['add_item'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $quantity = (int) $_POST['quantity'];
    $price = (float) $_POST['price'];

    $query = "INSERT INTO items (name, quantity, price) VALUES ('$name', '$quantity', '$price')";
    mysqli_query($conn, $query);
}

// After insert, redirect to view page
header("Location: view_items.php");
exit();
?>
