<?php 
require_once "functions/functions.php";
get_header();
get_sidebar();


$message = "";

if(!empty($_POST)){

    // User Inputs
    $user_name     = trim($_POST['name']);
    $user_phone    = trim($_POST['phone']);
    $user_email    = trim($_POST['email']);
    $user_username = trim($_POST['user_username']);
    $user_pass  = md5(trim($_POST['pass']));
    $user_cpass = md5(trim($_POST['cpass']));
    $user_role    = trim( $_POST['role']);

    // VALIDATION
    if(empty($user_name)){
        $message = "<div class='alert alert-danger'>Please enter your Name.</div>";
    }
    elseif(empty($user_phone)){
        $message = "<div class='alert alert-danger'>Please enter your Phone.</div>";
    }
    elseif(empty($user_email)){
        $message = "<div class='alert alert-danger'>Please enter your Email.</div>";
    }
    elseif(empty($user_username)){
        $message = "<div class='alert alert-danger'>Please enter your Username.</div>";
    }
    elseif(empty($user_pass)){
        $message = "<div class='alert alert-danger'>Please enter your Password.</div>";
    }
    elseif($user_pass != $user_cpass){
        $message = "<div class='alert alert-danger'>Password & Confirm Password do not match!</div>";
    }
    else{
        // Encrypt password
        $enc_pass = password_hash($user_pass, PASSWORD_DEFAULT);

        // INSERT Query
        $insert = "INSERT INTO users (user_name, user_phone, user_email, user_username, user_pass, role_id)
                   VALUES ('$user_name', '$user_phone', '$user_email', '$user_username', '$user_pass', '$user_role')";

        if(mysqli_query($conn, $insert)){
            
           $_SESSION['success'] = "User Register Successfull!";
            header("Location: all-user.php");

            exit();
        }else{
            $message = "<div class='alert alert-danger'>Database Error: ".mysqli_error($conn)."</div>";
        }
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
            <form method="post" action="">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8 card_title_part">
                                <i class="fab fa-gg-circle"></i>User Registration
                            </div>  
                            <div class="col-md-4 card_button_part">
                                <a href="all-user.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All User</a>
                            </div>  
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Name<span class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form_control" name="name" value="<?php echo isset($user_name) ? $user_name : ''; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form_control" name="phone" value="<?php echo isset($user_phone) ? $user_phone : ''; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control form_control" name="email" value="<?php echo isset($user_email) ? $user_email : ''; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Username<span class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control form_control" name="user_username" value="<?php echo isset($user_username) ? $user_username : ''; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Password<span class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control form_control" name="pass">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">Confirm Password<span class="req_star">*</span>:</label>
                            <div class="col-sm-7">
                                <input type="password" class="form-control form_control" name="cpass">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">
                                User Role <span class="req_star">*</span>:
                            </label>
                            <div class="col-sm-4">
                                <select class="form-control form_control" name="role">
                                    <?php
                                    $selr = "SELECT * FROM roles ORDER BY role_Id DESC ";
                                    $QR = mysqli_query($conn,$selr);
                                    while($role = mysqli_fetch_assoc($QR)){
                                    ?>
                                    <option value="<?php echo $role['role_id'] ?>"><?php echo $role['role_name'] ?></option>
                                    <?PHP
                                    }
                                    ?>
                                   
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label col_form_label">
                                Photo:
                            </label>
                            <div class="col-sm-4">
                                <input type="file" class="form-control form_control" name="">
                            </div>
                        </div>


                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-dark">REGISTRATION</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php get_footer(); 
?>
