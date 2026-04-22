<!DOCTYPE html>
<html>
<head>
<title>Login</title>
<style>
body {
    font-family: Arial;
    background: linear-gradient(to right, #4facfe, #00f2fe);
}
.box {
    width: 300px;
    margin: 120px auto;
    background: white;
    padding: 25px;
    border-radius: 10px;
    text-align: center;
}
input {
    width: 90%;
    padding: 10px;
    margin: 10px;
}
button {
    padding: 10px;
    width: 100%;
    background: blue;
    color: white;
    border: none;
}
</style>
</head>

<body>

<div class="box">
<h2>Login</h2>

<form method="POST">
<input type="text" name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>

<?php
session_start();
$conn = new mysqli("localhost", "root", "", "bims_db");

if($conn->connect_error){
    die("DB Error: " . $conn->connect_error);
}

if(isset($_POST['login'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){
        $user = $result->fetch_assoc();

        // ✅ Support BOTH hashed + plain passwords
        if(password_verify($password, $user['password']) || $password == $user['password']){
            
            $_SESSION['user'] = $user['username'];

            echo "<script>alert('Login Success!');</script>";
            // header("Location: dashboard.php");

        } else {
            echo "<script>alert('Wrong Password!');</script>";
        }

    } else {
        echo "<script>alert('User not found!');</script>";
    }
}
?>

</div>

</body>
</html>