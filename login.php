<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "User not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body{
            margin: 45px;
            font-family: Arial;
        }
        .container{
            padding: 20px;
            width: 300px;
            border: 1px solid black;
        }
        input{
            margin: 8px;
            padding: 5px;
            width: 200px;
        }
        button{
            padding: 8px 5px;
            margin-top: 10px;
        }
        .btn-log {
        display: inline-block;
        padding: 6px 12px;
        margin: 8px;
        text-decoration: none;
        color: white;
        border-radius: 4px;
        font-size: 14px;
        transition: background 0.3s;
        }
        .btn-log {
        background-color: blue;
        }
        .btn-log:hover {
        background-color: blue;
        }

    </style>
</head>
<body>
<h2>Login</h2>
  <div class="container hidden">

<form method="POST" action="">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit" name="login" class="btn-log">Login</button>
</form>

<p>Don't have an account? <a href="register.php">Register</a></p>
</div>

<?php if (isset($error)) echo "<p style='color:red;'>$error</p>"; ?>

</body>
</html>


