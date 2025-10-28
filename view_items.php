<?php
session_start();
include 'db.php';
if (!isset($_SESSION['username'])) { header("Location: login.php"); exit(); }

$result = $conn->query("SELECT * FROM items");
?>

<h2>Item List</h2>
<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Actions</th>
</tr>

<?php while($row = $result->fetch_assoc()): ?>
<tr>
    <td><?= $row['id'] ?></td>
    <td><?= $row['name'] ?></td>
    <td><?= $row['quantity'] ?></td>
    <td><?= $row['price'] ?></td>
    <td>
        <a href="edit_item.php?id=<?= $row['id'] ?>">Edit</a> |
        <a href="delete_item.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this item?')">Delete</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="dashboard.php">Back to Dashboard</a>

    <button type="submit" class="logbtn"><a href="logout.php">Logout</a></button>

</body>
</html>
