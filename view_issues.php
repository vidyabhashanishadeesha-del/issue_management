<?php
include "config.php";
$result = mysqli_query($conn, "SELECT * FROM issues ORDER BY reported_date DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Issues</title>

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
            margin-bottom: 20px;
        }

        .container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }

        .card {
            background: #fff;
            border-radius: 15px;
            padding: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .title {
            font-size: 18px;
            font-weight: bold;
            color: #333;
        }

        .desc {
            font-size: 14px;
            color: #555;
            margin: 10px 0;
        }

        .meta {
            font-size: 12px;
            color: #888;
        }

        img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            margin-top: 10px;
        }

        .priority {
            padding: 5px 10px;
            border-radius: 20px;
            color: #fff;
            font-size: 12px;
            display: inline-block;
            margin-top: 5px;
        }

        .Low { background: #28a745; }
        .Medium { background: #ffc107; color:#000; }
        .High { background: #dc3545; }
    </style>
</head>

<body>

<h2>📋 All Issues</h2>

<div class="container">

<?php while($row = mysqli_fetch_assoc($result)) { ?>

    <div class="card">

        <div class="title"><?php echo $row['issue_title']; ?></div>

        <div class="desc"><?php echo $row['issue_description']; ?></div>

        <div class="meta">
            Branch ID: <?php echo $row['branch_id']; ?><br>
            Date: <?php echo $row['reported_date']; ?>
        </div>

        <div class="priority <?php echo $row['priority']; ?>">
            <?php echo $row['priority']; ?>
        </div>

        <?php if(!empty($row['image'])) { ?>
            <img src="<?php echo $row['image']; ?>">
        <?php } ?>

    </div>

<?php } ?>

</div>

</body>
</html>