<?php
include "config.php";

// Fetch all users with branch name
$result = mysqli_query($conn, "
    SELECT u.user_id, u.full_name, u.email, u.role, u.created_at, b.branch_name
    FROM users u
    LEFT JOIN branches b ON u.branch_id = b.branch_id
    ORDER BY u.user_id DESC
");

// Delete user if 'delete' is set in URL
if(isset($_GET['delete'])){
    $user_id = $_GET['delete'];
    
    // Delete query
    $delete_sql = "DELETE FROM users WHERE user_id = $user_id";
    
    if(mysqli_query($conn, $delete_sql)){
        $msg = "<div class='success'>✅ User Deleted Successfully</div>";
    } else {
        $msg = "<div class='error'>❌ Error: ".mysqli_error($conn)."</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
    <style>
        body {
            font-family: 'Segoe UI';
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #fff;
            margin-bottom: 30px;
        }

        .table-container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background: #667eea;
            color: #fff;
        }

        table tr:hover {
            background: #f1f1f1;
        }

        .btn-back {
            display: inline-block;
            margin-bottom: 20px;
            padding: 10px 20px;
            background: #667eea;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            transition: 0.3s;
        }

        .btn-back:hover {
            background: #5a67d8;
        }

        .btn-delete {
            padding: 5px 10px;
            background: #ff4444;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
        }

        .btn-delete:hover {
            background: #ff0000;
        }

        .success {
            background: #d4edda;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
        }

        .error {
            background: #f8d7da;
            padding: 10px;
            margin-bottom: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

<h2>👥 View Users</h2>

<?php if(isset($msg)) echo $msg; ?>

<div class="table-container">

    <a href="add_users.php" class="btn-back">⬅ add Users</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Branch</th>
            <th>Created At</th>
            <th>Actions</th> <!-- Added actions column -->
        </tr>

        <?php if(mysqli_num_rows($result) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><?php echo $row['user_id']; ?></td>
                    <td><?php echo $row['full_name']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['role']; ?></td>
                    <td><?php echo $row['branch_name'] ?? 'N/A'; ?></td>
                    <td><?php echo $row['created_at']; ?></td>
                    <td>
                        <!-- Delete button -->
                        <a href="?delete=<?php echo $row['user_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="7" style="text-align:center;">No users found</td>
            </tr>
        <?php endif; ?>

    </table>
</div>

</body>
</html>