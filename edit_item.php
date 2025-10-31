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
/* ===========================
   Edit Stock Item Page
=========================== */

body {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Edit form container */
.edit-container {
    background: #fff;
    padding: 40px 35px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    width: 350px;
    text-align: center;
}

.edit-container h2 {
    margin-bottom: 25px;
    color: #333;
    font-weight: 600;
    font-size: 22px;
}

/* Input styling */
.edit-container input {
    display: block;
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    transition: border-color 0.3s ease;
}

.edit-container input:focus {
    border-color: #2575fc;
    outline: none;
}

/* Button group */
.btn-group-edit {
    display: flex;
    justify-content: center;
    gap: 15px;
}

/* Update button */
.btn-update {
    background: #27ae60;
    color: #fff;
    border: none;
    padding: 10px 25px;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
    transition: 0.3s ease, transform 0.2s ease;
}

.btn-update:hover {
    background: #1e8449;
    transform: scale(1.05);
}

/* Cancel button */
.btn-cancel {
    background: #e74c3c;
    color: #fff;
    border: none;
    padding: 10px 25px;
    border-radius: 6px;
    font-size: 15px;
    cursor: pointer;
    text-decoration: none;
    transition:  0.3s ease, transform 0.2s ease;
}

.btn-cancel:hover {
    background: #c0392b;
    transform: scale(1.05);
}
    </style>
</head>
<body>

<div class="edit-container">
    <h2>✏️ Edit Stock Item</h2>

    <form method="POST" action="">
        <input type="hidden" name="id" value="<?= $item['id']; ?>">

        <input type="text" name="name" value="<?= htmlspecialchars($item['name']); ?>" placeholder="Item Name" required>
        <input type="number" name="quantity" value="<?= $item['quantity']; ?>" placeholder="Quantity" required>
        <input type="number" step="0.01" name="price" value="<?= $item['price']; ?>" placeholder="Price" required>

        <div class="btn-group-edit">
            <button type="submit" class="btn-update">Update</button>
            <a href="view_items.php" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>


