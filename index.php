<?php
require_once "functions/functions.php";
needlogged(); // ✅ ONLY HERE
get_header();
get_sidebar();
?>


<div class="col-md-10 content">
    <div class="row">
        <div class="col-md-12 breadcumb_part">
            <div class="bread">
                <ul>
                    <li>
                        <a href="index.php">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fas fa-angle-double-right"></i> Dashboard
                        </a>
                    </li>                             
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 welcome_part">
            <p>
                <span>Welcome To</span>
                <?php echo htmlspecialchars($_SESSION['name']); ?>
            </p>
        </div>
    </div>
</div>

<?php
get_footer();
?>
