<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BIMS Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .dashboard-container {
            background: #fff;
            width: 400px;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 30px;
        }

        a {
            display: block;
            text-decoration: none;
            background: #667eea;
            color: white;
            padding: 12px;
            border-radius: 8px;
            margin: 10px 0;
            transition: 0.3s;
        }

        a:hover {
            background: #5a67d8;
        }

        .logout-btn {
            background: #e74c3c;
        }

        .logout-btn:hover {
            background: #c0392b;
        }

    </style>
</head>
<body>

<div class="dashboard-container">

    <h2>BIMS Dashboard</h2>

    <a href="add_branch.php">Add Branch</a>
    <a href="view_branches.php">View Branches</a>
    <a href="add_issue.php">Add Issue</a>
    <a href="view_issues.php">View Issues</a>
    <a href="add_users.php">Add Users</a>
    <a href="view_users.php">View Users</a>
    <a href="add issue_categories.php">Add Issue Categories</a>
    <a href="view issue_categories.php">View Issue Categories</a>

    <a href="logout.php" class="logout-btn">Logout</a>

</div>

</body>
</html>