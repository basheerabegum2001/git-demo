<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


session_start();
include 'db.php';
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $sql = "INSERT INTO items (name, quantity, price) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sid", $name, $quantity, $price);
    $stmt->execute();

    header("Location: view_items.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Stock Item</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { text-align: center; font-family: Arial; margin-top: 50px; }
        input[type="text"], input[type="number"] { padding: 8px; width: 200px; margin: 5px; }
        button { padding: 8px 15px; margin: 10px; }
    </style>
</head>
<body>
    <div>
       <button type="submit" class="logbtn"><a href="logout.php">Logout</a></button>
    </div>

<h2>Add New Stock Item</h2>

<form method="POST">
    <input type="text" name="name" placeholder="Item Name" required><br>
    <input type="number" name="quantity" placeholder="Quantity" required><br>
    <input type="number" step="0.01" name="price" placeholder="Price" required><br>
    <button type="submit" name="add" style="background:blue">Add Item</button>
</form>

<br>
<a href="view_items.php"> View All Stock</a>

</body>
</html>








