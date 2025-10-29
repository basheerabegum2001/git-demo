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
        .welcome{
            margin: 30px;
            text-align: center; 
            color: purple;
            font-size: 40px;
        }
        .btn-additem, .btn-view {
        display: inline-block;
        padding: 6px 12px;
        margin: 8px;
        text-decoration: none;
        color: white;
        border-radius: 4px;
        font-size: 14px;
        transition: background 0.3s;
        }
        .btn-additem {
        background-color:antiquewhite ;
        }

        .btn-additem:hover {
        background-color:white ;
        }
        .btn-view {
        background-color:antiquewhite ;
        }

        .btn-view:hover {
        background-color:white;
        }
        .logbtn {
        background-color:rgb(255, 0, 0) ;
        margin-left: 1350px;
        padding: 8px;
        }

        .logbtn:hover {
        background-color:rgba(250, 235, 215, 0.89) ;
        }

    </style>
</head>
<body>
    <div>
       <button type="submit" class="logbtn"><a href="logout.php">Logout</a></button>
    </div>

<div class = "welcome">
 <h1 style="margin:80px 30px";>Welcome, <?php echo $_SESSION['username']; ?>!</h1>

<button type="submit" class="btn-additem" style="margin-left:20px";><a href="add_item.php">Add Item</a> </button> 
<button type="submit"  class="btn-view" style="margin-left:40px";><a href="view_items.php">View Items</a>  </button>
</div>

</body>
</html>
