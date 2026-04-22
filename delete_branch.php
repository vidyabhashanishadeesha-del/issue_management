<?php
include "config.php";

if(isset($_GET['id'])){

    $id = $_GET['id'];

    $sql = "DELETE FROM branches WHERE branch_id='$id'";

    if(mysqli_query($conn, $sql)){
        echo "Deleted Successfully";
        header("Location: view_branch.php"); // redirect back
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>