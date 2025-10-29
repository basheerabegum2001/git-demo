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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        body { text-align: center; font-family: Arial; margin-top: 120px; }
        input[type="text"], input[type="number"] { padding: 8px; width: 200px; margin: 7px; }
        button { padding: 8px 15px; margin: 10px;} h2{font-size:35px; color: crimson;} 
        .btn-update, .btn-cancel {
        display: inline-block;
        padding: 6px 12px;
        margin: 8px;
        text-decoration: none;
        color: white;
        border-radius: 4px;
        font-size: 14px;
        transition: background 0.3s;
        }
        .btn-update {
        background-color: #28a745;
        }

        .btn-update:hover {
        background-color: #218838;
        }

        .btn-cancel {
        background-color: #dc3545;
        }

        .btn-cancel:hover {
        background-color: #c82333;
        }
    </style>
</head>
<body>
    <h2><b>✏️ Edit Stock Item</b></h2>

<form method="POST" action="">
    <input type="hidden" name="id" value="<?= $item['id']; ?>">
    <input type="text" name="name" value="<?= htmlspecialchars($item['name']); ?>" required><br>
    <input type="number" name="quantity" value="<?= $item['quantity']; ?>" required><br>
    <input type="number" step="0.01" name="price" value="<?= $item['price']; ?>" required><br>
    <button type="submit" class="btn-update">Update</button>
    <a href="view_items.php"><button type="button" class="btn-cancel">Cancel</button></a>
</form>


</body>
</html>


