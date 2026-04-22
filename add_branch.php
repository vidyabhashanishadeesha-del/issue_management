<?php
include "config.php";

if(isset($_POST['submit'])){

$branch_name = $_POST['branch_name'];
$contact_number = $_POST['contact_number'];
$officer_name = $_POST['officer_name'];

$sql = "INSERT INTO branches (branch_name, contact_number, officer_name)
VALUES ('$branch_name','$contact_number','$officer_name')";

if(mysqli_query($conn,$sql)){
    echo "<div class='success'>Branch Added Successfully</div>";
}else{
    echo "<div class='error'>Error: " . mysqli_error($conn) . "</div>";
}

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Branch</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
            margin: 0;
            padding: 0;
        }

        .container {
            width: 350px;
            margin: 80px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
            transition: 0.3s;
        }

        input[type="text"]:focus {
            border-color: #4facfe;
            outline: none;
            box-shadow: 0 0 5px rgba(79,172,254,0.5);
        }

        input[type="submit"] {
            width: 100%;
            background: #4facfe;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        input[type="submit"]:hover {
            background: #007bff;
        }

        .success {
            background: #d4edda;
            color: #155724;
            padding: 10px;
            margin: 15px auto;
            width: 350px;
            border-radius: 6px;
            text-align: center;
        }

        .error {
            background: #f8d7da;
            color: #721c24;
            padding: 10px;
            margin: 15px auto;
            width: 350px;
            border-radius: 6px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="container">
    <h2>Add Branch</h2>

    <form method="post">

        <label>Branch Name</label>
        <input type="text" name="branch_name" required>

        <label>Contact Number</label>
        <input type="text" name="contact_number" required>

        <label>Officer Name</label>
        <input type="text" name="officer_name" required>

        <input type="submit" name="submit" value="Add Branch">

    </form>
</div>

</body>
</html>