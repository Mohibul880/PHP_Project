<?php
require_once "functions/functions.php";
needlogged();

$id = $_GET['d'];

$delete = "DELETE FROM users WHERE user_id = $id";

$q=mysqli_query($conn,$delete);

if($q){
    header("Location: all-user.php");
     $_SESSION['success'] = "User Deleted Successfully!";
}

?>