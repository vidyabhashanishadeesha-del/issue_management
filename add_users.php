<?php
include "config.php";

// ADD USER
if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'] ?? '';
    $user_name = $_POST['user_name'] ?? '';
    
    // <<< Remove password_hash >>>
    $password = $_POST['password'] ?? '';
    
    $role = $_POST['role'] ?? '';
    $branch_id = $_POST['branch_id'] ?? '';

    $sql = "INSERT INTO users (full_name, user_name, password, role, branch_id, created_at)
            VALUES ('$full_name','$user_name','$password','$role','$branch_id', NOW())";

    if(mysqli_query($conn,$sql)){
        $msg = "<div class='success'>✅ User Added Successfully</div>";
    } else {
        $msg = "<div class='error'>❌ Error: ".mysqli_error($conn)."</div>";
    }
}

// FETCH BRANCHES for dropdown
$branches = mysqli_query($conn, "SELECT * FROM branches");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <style>
        body {
            font-family: 'Segoe UI';
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        h2 { text-align: center; margin-bottom: 20px; }
        input, select {
            width: 100%; padding: 10px; margin: 10px 0; border-radius: 8px;
            border: 1px solid #ccc;
        }

        .btn {
            width: 100%; padding: 12px; background: #667eea;
            color: #fff; border: none; border-radius: 8px; cursor: pointer;
        }

        .btn:hover { background: #5a67d8; }

        .success { background: #d4edda; padding: 10px; margin-bottom: 10px; text-align:center; }
        .error { background: #f8d7da; padding: 10px; margin-bottom: 10px; text-align:center; }
    </style>
</head>

<body>

<div class="container">

    <h2>👤 Add User</h2>

    <?php if(isset($msg)) echo $msg; ?>

    <form method="post">
        <input type="text" name="full_name" placeholder="Full Name" required>
        <input type="text" name="user_name" placeholder="User Name" required>
        <input type="text" name="password" placeholder="Password" required> <!-- plain text -->

        <select name="role" required>
            <option value="">Select Role</option>
            <option>Admin</option>
            <option>User</option>
            <option>Officer</option>
        </select>

        <select name="branch_id" required>
            <option value="">Select Branch</option>
            <?php while($row = mysqli_fetch_assoc($branches)) {
                echo "<option value='".$row['branch_id']."'>".$row['branch_name']."</option>";
            } ?>
        </select>

        <button type="submit" name="submit" class="btn">Add User</button>
    </form>

</div>

</body>
</html>