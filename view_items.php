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
        h2{
            text-align: center;
            font-size: 55px;
            color: maroon;
        }
        .logbtn{
            margin-left: 1330px;
            padding: 8px;
        }
        table {
        border-collapse: collapse;
        width: 90%;
        margin: 30px auto;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        border-radius: 8px;
        overflow: hidden;
        }

        th, td {
        padding: 12px 16px;
        text-align: left;
        }

        th {
        background-color: #007BFF;
        color: white;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        font-size: 14px;
        }

        tr:nth-child(even) {
        background-color: #f9f9f9;
        }

        tr:hover {
        background-color: #f1f7ff;
        }

        td {
        border-bottom: 1px solid #ddd;
        font-size: 15px;
        }

    /* ===== BUTTON STYLING ===== */
    .btn-edit, .btn-delete {
        display: inline-block;
        padding: 6px 12px;
        margin: 8px;
        text-decoration: none;
        color: white;
        border-radius: 4px;
        font-size: 14px;
        transition: background 0.3s;
    }

    .btn-edit {
        background-color: #28a745;
    }

    .btn-edit:hover {
        background-color: #218838;
    }

    .btn-delete {
        background-color: #dc3545;
    }

    .btn-delete:hover {
        background-color: #c82333;
    }
    .logbtn {
        background-color:rgb(255, 0, 0) ;
        margin-left: 1350px;
        padding: 8px;
    }

    .logbtn:hover {
        background-color:rgba(250, 235, 215, 0.89) ;
    }

    /* ===== FORM INLINE FIX ===== */
    td form {
        display: inline;
    }

    body {
        background-color: #f4f6f8;
    }

    h1 {
        text-align: center;
        margin-top: 20px;
        font-weight: 500;
        color: #333;
    }
    .btn-dash {
        background-color:antiquewhite ;
        margin-left: 1250px;
    }

    .btn-dash:hover {
        background-color: white ;
    }

</style>
</head>
<body>

    <button type="submit" class="logbtn"><a href="logout.php">Logout</a></button>

    <h2>Stock List</h2>
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
       <a class="btn-edit" href="edit_item.php?id=<?= $row['id'] ?>">Edit</a>     

       <form action="delete_item.php" method="POST" onsubmit="return confirm('Delete this item?')">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <button type="submit" class="btn-delete">Delete</button>
       </form>    
    </td>
</tr>
<?php endwhile; ?>
</table> 
    <button type="submit"  class="btn-dash" ><a href="dashboard.php">Back to Dashboard</a></button>
</body>
</html>
