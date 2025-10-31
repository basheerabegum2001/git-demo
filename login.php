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
        /* Basic reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body styling */
body {
    font-family: "Poppins", sans-serif;
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Login container */
.login-container {
    background: #fff;
    width: 350px;
    padding: 40px 30px;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
    text-align: center;
}

/* Heading */
.login-container h2 {
    margin-bottom: 25px;
    color: #333;
    font-weight: 600;
}

/* Input group */
.input-group {
    margin-bottom: 20px;
    text-align: left;
}

.input-group label {
    display: block;
    font-size: 14px;
    color: #555;
    margin-bottom: 6px;
}

.input-group input {
    width: 100%;
    padding: 10px;
    border: 1.5px solid #ccc;
    border-radius: 6px;
    font-size: 15px;
    transition: border-color 0.3s ease;
}

.input-group input:focus {
    border-color: #2575fc;
    outline: none;
}

/* Login button */
.btn-log {
    background: #2575fc;
    color: #fff;
    border: none;
    padding: 12px 20px;
    width: 100%;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s ease;
}

.btn-log:hover {
    background: #1a5ed9;
}

/* Error message */
.error {
    color: #d63031;
    margin-top: 15px;
    font-size: 14px;
}

/* Register text */
.register-text {
    margin-top: 20px;
    font-size: 14px;
}

.register-text a {
    color: #2575fc;
    text-decoration: none;
    font-weight: 500;
}

.register-text a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Login</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <form method="POST" action="">
        <div class="input-group">
            <input type="text" name="username" id="username" placeholder="Username" required>
        </div>

        <div class="input-group">
            <input type="password" name="password" id="password" placeholder="Password" required>
        </div>

        <button type="submit" name="login" class="btn-log">Login</button>

        <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>
    </form>

    <p class="register-text">Don't have an account? <a href="register.php">Register</a></p>
</div>

</body>
</html>

