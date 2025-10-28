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
</head>
<body>
    <div>
       <button type="submit" class="logbtn"><a href="logout.php">Logout</a></button>
    </div>

<div style="text-align:center";>
 <h1 style="margin:80px 30px";>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

<button type="submit" style="margin-left:20px";><a href="add_item.php">Add Item</a> </button> 
<button type="submit"  style="margin-left:40px";><a href="view_items.php">View Items</a>  </button>
</div>

</body>
</html>
