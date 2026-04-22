<?php
include "config.php";

// ADD ISSUE CATEGORIES
if(isset($_POST['submit'])){
    $category_name = $_POST['category_name'] ?? '';
    
    if(!empty($category_name)){
        $sql = "INSERT INTO issue_categories (category_name, created_at) VALUES ('$category_name', NOW())";
        
        if(mysqli_query($conn, $sql)){
            $msg = "<div class='success'>✅ Category Added Successfully</div>";
        } else {
            $msg = "<div class='error'>❌ Error: ".mysqli_error($conn)."</div>";
        }
    } else {
        $msg = "<div class='error'>❌ Category Name cannot be empty</div>";
    }
}

// FETCH existing categories (optional, if you want to display below the form)
$categories = mysqli_query($conn, "SELECT * FROM issue_categories ORDER BY category_id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Issue Categories</title>
    <style>
        body {
            font-family: 'Segoe UI';
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: flex-start;
            padding: 50px 0;
        }

        .container {
            width: 400px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        h2 { text-align: center; margin-bottom: 20px; }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .btn {
            width: 100%;
            padding: 12px;
            background: #667eea;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
        }

        .btn:hover { background: #5a67d8; }

        .success { background: #d4edda; padding: 10px; margin-bottom: 10px; text-align:center; }
        .error { background: #f8d7da; padding: 10px; margin-bottom: 10px; text-align:center; }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background: #667eea;
            color: #fff;
        }

        table tr:hover {
            background: #f1f1f1;
        }
    </style>
</head>
<body>

<div class="container">

    <h2>📂 Add Issue Categories</h2>

    <?php if(isset($msg)) echo $msg; ?>

    <form method="post">
        <input type="text" name="category_name" placeholder="Category Name" required>
        <button type="submit" name="submit" class="btn">Add Category</button>
    </form>

    <!-- Optional: Display existing categories -->
    <?php if(mysqli_num_rows($categories) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Category Name</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($categories)): ?>
                <tr>
                    <td><?php echo $row['category_id']; ?></td>
                    <td><?php echo $row['category_name']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php endif; ?>

</div>

</body>
</html>