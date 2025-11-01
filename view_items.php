<?php
session_start();
include 'db.php';
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }

$result = $conn->query("SELECT * FROM items");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
/* View Items Page */

body {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    min-height: 100vh;
    margin: 0;
    padding: 0;
}

/* Logout button (top-right) */
.btn-out {
    position: absolute;
    top: 20px;
    right: 30px;
    background: #e74c3c;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 6px;
    cursor: pointer;
    transition:  0.3s ease;
}

.btn-out a {
    text-decoration: none;
    color: white;
    font-weight: 500;
}

.btn-out:hover {
    background: #c0392b;
}

/* Container for the stock table */
.view-container {
    background: #fff;
    max-width: 900px;
    margin: 100px auto 50px;
    padding: 30px 40px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.view-container h2 {
    text-align: center;
    margin-bottom: 25px;
    color: #333;
    font-weight: 600;
}

/* Table styling */
.stock-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 15px;
    text-align: center;
}

.stock-table thead {
    background: #2575fc;
    color: #fff;
}

.stock-table th, .stock-table td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

.stock-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.stock-table tr:hover {
    background-color: #eef4ff;
}

/* Action buttons */
.action-buttons {
    display: flex;
    justify-content: center;
    gap: 10px;
}

.btn-edit, .btn-delete {
    border: none;
    padding: 8px 14px;
    border-radius: 6px;
    color: #fff;
    cursor: pointer;
    font-size: 14px;
    text-decoration: none;
    transition:0.3s ease;
}

.btn-edit {
    background: #f1c40f;
}

.btn-edit:hover {
    background: #d4ac0d;
}

.btn-delete {
    background: #e74c3c;
    border: none;
}

.btn-delete:hover {
    background: #c0392b;
}

/* Back to Dashboard button */
.btn-dash {
    display: block;
    margin: 30px auto 0;
    background: #27ae60;
    color: #fff;
    border: none;
    padding: 12px 30px;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition:  0.3s ease;
}

.btn-dash a {
    text-decoration: none;
    color: white;
    font-weight: 500;
}

.btn-dash:hover {
    background: #1e8449;
}
</style>
</head>
<body>

<button class="btn-out"><a href="logout.php">Logout</a></button>

<div class="view-container">
    <h2>Stock List</h2>

    <table class="stock-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Quantity</th>
                <th>Price ($)</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['id']); ?></td>
                <td><?= htmlspecialchars($row['name']); ?></td>
                <td><?= htmlspecialchars($row['quantity']); ?></td>
                <td><?= htmlspecialchars(number_format($row['price'], 2)); ?></td>
                <td class="action-buttons">
                    <a class="btn-edit" href="edit_item.php?id=<?= $row['id'] ?>">Edit</a>

                    <form action="delete_item.php" method="POST" onsubmit="return confirm('Delete this item?')" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <button class="btn-dash"><a href="dashboard.php">Back to Dashboard</a></button>
</div>

</body></html>
