<?php
session_start();
include 'db.php';
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }

$id = $_GET['id'];
$sql = "SELECT * FROM items WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$item = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];

    $sql = "UPDATE items SET name=?, quantity=?, price=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sidi", $name, $quantity, $price, $id);
    $stmt->execute();

    header("Location: view_items.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Stock</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body { text-align: center; font-family: Arial; margin-top: 50px; }
        input[type="text"], input[type="number"] { padding: 8px; width: 200px; margin: 5px; }
        button { padding: 8px 15px; margin: 10px; }
    </style>
</head>
<body>

<h2>✏️ Edit Stock Item</h2>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $item['id']; ?>">
    <input type="text" name="name" value="<?= htmlspecialchars($item['name']); ?>" required><br>
    <input type="number" name="quantity" value="<?= $item['quantity']; ?>" required><br>
    <input type="number" step="0.01" name="price" value="<?= $item['price']; ?>" required><br>
    <button type="submit" name="update">Update</button>
    <a href="view.php"><button type="button">Cancel</button></a>
</form>

</body>
</html>



