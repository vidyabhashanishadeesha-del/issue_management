<?php
session_start();
include "config.php";

// 🔥 Use existing user ID from DB (change if needed)
$_SESSION['user_id'] = 4; 
$reported_by = $_SESSION['user_id'];

if(isset($_POST['submit'])){

    $issue_title = $_POST['issue_title'] ?? '';
    $description = $_POST['description'] ?? '';
    $branch_id = $_POST['branch_id'] ?? '';
    $priority = $_POST['priority'] ?? '';

    // 🔴 VALIDATION
    if(empty($issue_title) || empty($description) || empty($branch_id) || empty($priority)){
        $msg = "<div class='error'>❌ සියලු fields fill කරන්න</div>";
    } else {

        // Image upload
        $image_name = $_FILES['issue_image']['name'] ?? '';
        $tmp_name = $_FILES['issue_image']['tmp_name'] ?? '';

        if(!empty($image_name)){
            $upload_path = "uploads/" . time() . "_" . $image_name;
            move_uploaded_file($tmp_name, $upload_path);
        } else {
            $upload_path = "";
        }

        // 🔥 INSERT QUERY
        $sql = "INSERT INTO issues 
        (issue_title, issue_description, branch_id, priority, reported_by, image, reported_date)
        VALUES 
        ('$issue_title','$description','$branch_id','$priority','$reported_by','$upload_path', NOW())";

        if(mysqli_query($conn,$sql)){
            $msg = "<div class='success'>✅ Issue Added Successfully</div>";
        }else{
            $msg = "<div class='error'>❌ Error: " . mysqli_error($conn) . "</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Issue</title>

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
            width: 420px;
            background: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
        }

        input, textarea, select {
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

<div class="container">

    <h2>🛠 Add Issue</h2>

    <?php if(isset($msg)) echo $msg; ?>

    <form method="post" enctype="multipart/form-data">

        <input type="text" name="issue_title" placeholder="Issue Title" required>

        <textarea name="description" placeholder="Description" required></textarea>

        <select name="branch_id" required>
            <option value="">Select Branch</option>
            <?php
            $branches = mysqli_query($conn, "SELECT * FROM branches");
            while($row = mysqli_fetch_assoc($branches)){
                echo "<option value='".$row['branch_id']."'>".$row['branch_name']."</option>";
            }
            ?>
        </select>

        <select name="priority" required>
            <option value="">Select Priority</option>
            <option>Low</option>
            <option>Medium</option>
            <option>High</option>
        </select>

        <input type="file" name="issue_image">

        <button type="submit" name="submit" class="btn">Add Issue</button>

    </form>

</div>

</body>
</html>