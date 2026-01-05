<?php
// ✅ SESSION START ONLY ONCE
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

// ✅ login check
function loggedID(){
    return isset($_SESSION['id']) && !empty($_SESSION['id']);
}

// ✅ redirect if not logged in
function needlogged(){
    if (!loggedID()) {
        header("Location: login.php");
        exit;
    }
}
