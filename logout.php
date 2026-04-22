<?php
session_start();

// Destroy session
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .logout-container {
            background: #fff;
            padding: 40px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        p {
            color: #555;
            font-size: 18px;
            margin-bottom: 30px;
        }

        .btn-login {
            padding: 12px 25px;
            background: #667eea;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s ease;
        }

        .btn-login:hover {
            background: #5a67d8;
        }
    </style>
</head>
<body>

<div class="logout-container">
    <h2>👋 You have been logged out!</h2>
    <p>Thank you for using the system. You are now safely logged out.</p>

    <form action="login.php" method="get">
        <button type="submit" class="btn-login">Go to Login Page</button>
    </form>
</div>

</body>
</html>