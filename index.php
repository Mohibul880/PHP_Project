<?php
require_once "functions/functions.php";
get_header();
get_sidebar();
needlogged();
 ?>
 
                <div class="col-md-10 content">
                    <div class="row">
                        <div class="col-md-12 breadcumb_part">
                            <div class="bread">
                                <ul>
                                    <li><a href=""><i class="fas fa-home"></i>Home</a></li>
                                    <li><a href=""><i class="fas fa-angle-double-right"></i>Dashboard</a></li>                             
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 welcome_part">
                            <p><span>Welcome TO</span> <?php echo $_SESSION['name']; ?></p>
                        </div>
                    </div>
                </div>
           
    
    <?php

  get_footer();


    ?>