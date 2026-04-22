<?php
include "config.php";

$result = mysqli_query($conn, "SELECT * FROM branches");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Branches</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #667eea, #764ba2);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 60px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th {
            background: #667eea;
            color: white;
            padding: 12px;
            text-align: left;
        }

        table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        table tr:hover {
            background: #f5f5f5;
        }

        .delete-btn {
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 14px;
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        .delete-btn:hover {
            background: #c0392b;
        }

        .top-bar {
            text-align: right;
            margin-bottom: 15px;
        }

        .add-btn {
            background: #2ecc71;
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 6px;
            transition: 0.3s;
        }

        .add-btn:hover {
            background: #27ae60;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Branch List</h2>

    <div class="top-bar">
        <a href="add_branch.php" class="add-btn">+ Add Branch</a>
    </div>

    <table>
        <tr> 
            <th>Branch Name</th>
            <th>Contact</th>
            <th>Officer</th>
            <th>Action</th>
        </tr>

        <?php while($row = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?php echo $row['branch_name']; ?></td>
            <td><?php echo $row['contact_number']; ?></td>
            <td><?php echo $row['officer_name']; ?></td>

            <td>
                <form method="GET" action="delete_branch.php" onsubmit="return confirm('Are you sure?');">
                    <input type="hidden" name="id" value="<?php echo $row['branch_id']; ?>"> 
                    <input type="submit" value="Delete" class="delete-btn">
                </form>
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>