<?php
require_once "functions/functions.php";
get_header();
get_sidebar();

$message = "";

if(!empty($_POST)){

    // USER INPUT
    $user_name     = trim($_POST['name']);
    $user_phone    = trim($_POST['phone']);
    $user_email    = trim($_POST['email']);
    $user_username = trim($_POST['user_username']);
    $user_pass     = trim($_POST['pass']);
    $user_cpass    = trim($_POST['cpass']);
    $user_role     = trim($_POST['role']);

    // PHOTO
    $image = $_FILES['photo'];

    if(!empty($user_name)){

        if(!empty($user_phone)){

            if(!empty($user_email)){

                if(!empty($user_username)){

                    if(!empty($user_pass)){

                        if(!empty($user_cpass)){

                            if($user_pass === $user_cpass){

                                // PASSWORD ENCRYPT
                                $enc_pass = md5($user_pass);

                                // IMAGE NAME
                                if(!empty($image['name'])){
                                    $imageName = $user_name . time() . "_" . rand(10000000,999999999) . "." .
                                                 pathinfo($image['name'], PATHINFO_EXTENSION);
                                }else{
                                    $imageName = "";
                                }

                                // INSERT QUERY
                                $insert = "INSERT INTO users (user_name, user_phone, user_email, user_username, user_pass, role_id,user_photo) 
                                VALUES ('$user_name', '$user_phone', '$user_email', '$user_username', '$enc_pass', '$user_role', '$imageName')";

                                if(mysqli_query($conn, $insert)){

                                    if(!empty($image['name'])){
                                        move_uploaded_file($image['tmp_name'], "uploads/user/".$imageName);
                                    }

                                    $_SESSION['success'] = "User Register Successfully!";
                                    header("Location: all-user.php");
                                    exit();

                                }else{
                                    $message = "<div class='alert alert-danger'>Database Error! Please try again.</div>";
                                }

                            }else{
                                $message = "<div class='alert alert-danger'>Password & Confirm Password did not match!</div>";
                            }

                        }else{
                            $message = "<div class='alert alert-danger'>Please enter Confirm Password.</div>";
                        }

                    }else{
                        $message = "<div class='alert alert-danger'>Please enter Password.</div>";
                    }

                }else{
                    $message = "<div class='alert alert-danger'>Please enter Username.</div>";
                }

            }else{
                $message = "<div class='alert alert-danger'>Please enter Email.</div>";
            }

        }else{
            $message = "<div class='alert alert-danger'>Please enter Phone.</div>";
        }

    }else{
        $message = "<div class='alert alert-danger'>Please enter Name.</div>";
    }
}
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

    <!-- SHOW MESSAGE -->
    <?php echo $message; ?>

    <div class="row">
        <div class="col-md-12">
            <form method="post" action="" enctype="multipart/form-data">
                <div class="card mb-3">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8 card_title_part">
                                <i class="fab fa-gg-circle"></i>User Registration
                            </div>
                            <div class="col-md-4 card_button_part">
                                <a href="all-user.php" class="btn btn-sm btn-dark">
                                    <i class="fas fa-th"></i>All User
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Name *</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="name"
                                value="<?php echo isset($user_name) ? $user_name : ''; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Phone *</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="phone"
                                value="<?php echo isset($user_phone) ? $user_phone : ''; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Email *</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control" name="email"
                                value="<?php echo isset($user_email) ? $user_email : ''; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Username *</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" name="user_username"
                                value="<?php echo isset($user_username) ? $user_username : ''; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Password *</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="pass">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Confirm Password *</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control" name="cpass">
                            </div>
                        </div>

                    <!-- roal part -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">User Role *</label>
                            <div class="col-sm-4">
                                <select class="form-control" name="role">
                                    <?php
                                    $selr = "SELECT * FROM roles ORDER BY role_id DESC";
                                    $QR = mysqli_query($conn, $selr);
                                    while($role = mysqli_fetch_assoc($QR)){
                                    ?>
                                        <option value="<?php echo $role['role_id']; ?>">
                                            <?php echo $role['role_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- PHOTO (FIXED, FORMAT SAME) -->
                        <div class="row mb-3"> 
                            <label class="col-sm-3 col-form-label col_form_label">Photo: *</label> 
                            <div class="col-sm-4"> 
                                <input type="file" class="form-control form_control" name="photo"> 
                            </div> 
                        </div>

                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-dark">
                            REGISTRATION
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); ?>
