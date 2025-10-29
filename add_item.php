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
        body { text-align: center; font-family: Arial; font-size: 35px;}
        input[type="text"], input[type="number"] { padding: 10px; width: 200px; margin: 5px; }
        button { padding: 8px 20px; margin: 10px;}
        .btn-add {
        display: inline-block;
        padding: 6px 12px;
        margin: 8px;
        text-decoration: none;
        color: white;
        border-radius: 4px;
        font-size: 14px;
        transition: background 0.3s;
        }
        .btn-add {
        background-color: blue;
        }

        .btn-add:hover {
        background-color: blue;
        }
        .logbtn {
        background-color:rgb(255, 0, 0);
        margin-left: 1300px;
        }
        .logbtn:hover {
        background-color:rgba(250, 235, 215, 0.89) ;
        }
        .btn-vitem {
        background-color:antiquewhite ;
        }
        .btn-vitem:hover {
        background-color:white ;
        }

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
    <button type="submit" class="btn-add">Add Item</button>
</form>

<br>
<button type="submit" class="btn-vitem"><a href="view_items.php"> View All Stock</a></button>

</body>
</html>





