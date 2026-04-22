<?php
include "config.php";

// Fetch all issue categories
$categories = mysqli_query($conn, "SELECT * FROM issue_categories ORDER BY category_id DESC");

// Handle delete request
if(isset($_GET['delete'])){
    $category_id = $_GET['delete'];

    $delete_sql = "DELETE FROM issue_categories WHERE category_id = $category_id";
    if(mysqli_query($conn, $delete_sql)){
        $msg = "<div class='success'>✅ Category Deleted Successfully</div>";
        // Refresh categories after deletion
        $categories = mysqli_query($conn, "SELECT * FROM issue_categories ORDER BY category_id DESC");
    } else {
        $msg = "<div class='error'>❌ Error: ".mysqli_error($conn)."</div>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Issue Categories</title>
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

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        .btn-back, .btn-delete {
            display: inline-block;
            padding: 8px 15px;
            border-radius: 8px;
            text-decoration: none;
            color: #fff;
            transition: 0.3s;
        }

        .btn-back {
            background: #667eea;
            margin-bottom: 20px;
        }
        .btn-back:hover {
            background: #5a67d8;
        }

        .btn-delete {
            background: #ff4444;
        }
        .btn-delete:hover {
            background: #ff0000;
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

        .success, .error {
            text-align: center;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 8px;
        }

        .success {
            background: #d4edda;
        }

        .error {
            background: #f8d7da;
        }
    </style>
</head>
<body>

<h2>📂 View Issue Categories</h2>

<div class="container">

    <?php if(isset($msg)) echo $msg; ?>

    <a href="add issue_categories.php" class="btn-back">⬅ add issue_Categories</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>

        <?php if(mysqli_num_rows($categories) > 0): ?>
            <?php while($row = mysqli_fetch_assoc($categories)): ?>
                <tr>
                    <td><?php echo $row['category_id']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                    <td><?php echo isset($row['created_at']) ? $row['created_at'] : 'N/A'; ?></td>
                    <td>
                        <a href="?delete=<?php echo $row['category_id']; ?>" class="btn-delete" onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="4" style="text-align:center;">No categories found</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>
</html>