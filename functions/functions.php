

<?php
session_start();
require_once "config.php";


function get_header(){
    require_once "includes/header.php";
}

function get_sidebar(){

    require_once "includes/sidebar.php";
}

function get_footer(){
    require_once "includes/footer.php";
}


function loggedID(){
    return !empty($_SESSION['id']) ? true:false;
}
function needlogged(){
    if (!loggedID()) {
        header("Location: login.php");
        exit;
    }
}

?>


