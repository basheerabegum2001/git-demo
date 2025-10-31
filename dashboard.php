<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <style>
/* Dashboard Page Styling */

/* Top bar */
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
    transition: 0.3s ease;
}

.btn-out a {
    text-decoration: none;
    color: white;
    font-weight: 500;
}

.btn-out:hover {
    background: #c0392b;
}

/* Welcome section */
.welcome {
    text-align: center;
    margin-top: 150px;
    color: #333;
}

.welcome h1 {
    font-size: 28px;
    font-weight: 600;
    margin-bottom: 50px;
}

/* Button group */
.btn-group {
    display: flex;
    justify-content: center;
    gap: 30px;
}

/* Add Item & View Item buttons */
.btn-additem,
.btn-view {
    border: none;
    padding: 12px 30px;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    transition: transform 0.2s ease, 0.3s ease;
}

.btn-additem {
    background: #27ae60;
    color: white;
}

.btn-view {
    background: #3498db;
    color: white;
}

.btn-additem:hover {
    background: #1e8449;
    transform: scale(1.05);
}

.btn-view:hover {
    background: #2e86c1;
    transform: scale(1.05);
}

.btn-additem a,
.btn-view a {
    text-decoration: none;
    color: white;
    font-weight: 500;
}
    </style>
</head>
<body>

<div class="top-bar">
    <button class="btn-out"><a href="logout.php">Logout</a></button>
</div>

<div class="welcome">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>

    <div class="btn-group">
        <button class="btn-additem"><a href="add_item.php">Add Item</a></button> 
        <button class="btn-view"><a href="view_items.php">View Items</a></button>
    </div>
</div>

</body></html>
