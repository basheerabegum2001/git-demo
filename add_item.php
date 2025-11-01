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
/* General page layout */
body {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Top bar (Logout button) */
.top-bar {
    position: absolute;
    top: 20px;
    right: 30px;
}

.btn-out {
    background: #e74c3c;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    transition:0.3s ease;
}

.btn-out a {
    text-decoration: none;
    color: white;
    font-weight: 500;
}

.btn-out:hover {
    background: #c0392b;
}

/* Add Item container */
.add-container {
    background: #fff;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    width: 350px;
    text-align: center;
}

.add-container h2 {
    color: #333;
    margin-bottom: 25px;
    font-weight: 600;
}

/* Form styling */
.add-container form {
    display: flex;
    flex-direction: column;
}

.add-container input {
    margin-bottom: 15px;
    padding: 10px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    transition: border-color 0.3s ease;
}

.add-container input:focus {
    border-color: #2575fc;
    outline: none;
}

/* Add Item button */
.btn-add {
    background: #27ae60;
    color: #fff;
    border: none;
    padding: 12px 0;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 5px;
    transition: 0.3s ease;
}

.btn-add:hover {
    background: #1e8449;
}

/* View all stock button */
.btn-vitem {
    background: #3498db;
    color: #fff;
    border: none;
    padding: 10px 25px;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
    margin-top: 20px;
    transition: 0.3s ease;
}

.btn-vitem a {
    text-decoration: none;
    color: white;
    font-weight: 500;
}

.btn-vitem:hover {
    background: #2e86c1;
}
    </style>
</head>
<body>

<div class="top-bar">
    <button class="btn-out"><a href="logout.php">Logout</a></button>
</div>

<div class="add-container">
    <h2>Add New Stock Item</h2>

    <form method="POST" action="">
        <input type="text" name="name" placeholder="Item Name" required>
        <input type="number" name="quantity" placeholder="Quantity" required>
        <input type="number" step="0.01" name="price" placeholder="Price" required>
        <button type="submit" class="btn-add">Add Item</button>
    </form>

    <button class="btn-vitem"><a href="view_items.php">View All Stock</a></button>
</div>

</body></html>





