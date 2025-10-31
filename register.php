<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);

    if ($stmt->execute()) {
        echo "Registration successful. <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>
<link rel="stylesheet" href="style.css">
<style>
    /* === Global Styles === */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

/* === Background === */
body {
  background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
}

/* === Registration Container === */
.container {
  background: #fff;
  padding: 50px 40px;
  border-radius: 15px;
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  width: 380px;
  text-align: center;
  animation: fadeIn 0.6s ease-in-out;
}

/* === Heading === */
.container h2 {
  margin-bottom: 25px;
  color: #333;
  font-size: 28px;
  font-weight: 700;
}

/* === Input Group (Floating Labels) === */
.input-group {
  position: relative;
  margin: 25px 0;
}

.input-group input {
  width: 100%;
  padding: 12px 10px;
  border: 2px solid #dcdde1;
  border-radius: 8px;
  font-size: 16px;
  outline: none;
  transition: 0.3s;
  background: #f8f9fa;
}

.input-group label {
  position: absolute;
  top: 12px;
  left: 15px;
  color: #888;
  pointer-events: none;
  transition: 0.3s ease;
}

/* === Floating Label Effect === */
.input-group input:focus + label,
.input-group input:valid + label {
  top: -10px;
  left: 10px;
  font-size: 13px;
  color: #667eea;
  background: #fff;
  padding: 0 5px;
}

/* === Input Focus Styling === */
.input-group input:focus {
  border-color: #667eea;
  box-shadow: 0 0 6px rgba(102, 126, 234, 0.3);
  background: #fff;
}

/* === Button === */
.btn-reg {
  width: 100%;
  background: linear-gradient(135deg, #667eea, #764ba2);
  color: white;
  border: none;
  padding: 12px;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: 0.3s ease;
  margin-top: 10px;
}

.btn-reg:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 15px rgba(118, 75, 162, 0.3);
}

/* === Login Link === */
.login-link {
  margin-top: 20px;
  font-size: 14px;
  color: #555;
}

.login-link a {
  color: #667eea;
  text-decoration: none;
  font-weight: 600;
  transition: 0.3s;
}

.login-link a:hover {
  color: #764ba2;
  text-decoration: underline;
}

/* === Error Message === */
.error {
  color: #d63031;
  margin-top: 10px;
  font-weight: 600;
  background: #ffeaea;
  border-left: 4px solid #d63031;
  padding: 8px;
  border-radius: 5px;
}

/* === Animation === */
@keyframes fadeIn {
  from {
    opacity: 0;
    transform: translateY(-15px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

/* === Responsive Design === */
@media (max-width: 480px) {
  .container {
    width: 90%;
    padding: 40px 25px;
  }

  .container h2 {
    font-size: 24px;
  }
}
</style>
</head>
<body>

<div class="container">
  <h2>Register</h2>

  <form method="POST">
    <div class="input-group">
      <input type="text" name="username" placeholder="Username" required>
    </div>

    <div class="input-group">
      <input type="password" name="password" placeholder="Password" required>
    </div>

    <button type="submit" name="register" class="btn-reg">Register</button>
  </form>

  <p class="login-link">Already have an account? 
    <a href="login.php">Login here</a>
  </p>

  <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
</div>

</body>
</html>



