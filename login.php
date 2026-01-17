<?php

require_once "functions/functions.php";

$error = "";

if (isset($_POST['login'])) {

    $input_username = trim($_POST['input_username']);
    $input_password = trim($_POST['input_password']);

    if (empty($input_username)) {
        $error = "Please enter username";
    } elseif (empty($input_password)) {
        $error = "Please enter password";
    } else {

        // single md5 (database matches this)
        $password = md5($input_password);

        $select = "SELECT * FROM users 
                   WHERE user_username='$input_username' 
                   AND user_pass='$password'";

        $q = mysqli_query($conn, $select);

        if ($q && mysqli_num_rows($q) === 1) {

            $data = mysqli_fetch_assoc($q);

            $_SESSION['id']       = $data['user_id'];
            $_SESSION['name']     = $data['user_name'];
            $_SESSION['username'] = $data['user_username'];
            $_SESSION['role']     = $data['role_id']; // ✅ FINAL FIX

            header("Location: index.php");
            exit;

        } else {
            $error = "Invalid Username or Password";
        }
    }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - Login</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

<div class="login-page bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <h3 class="mb-3">Login Now</h3>

                <div class="bg-white shadow rounded">
                    <div class="row">

                        <div class="col-md-7 pe-0">
                            <div class="form-left h-100 py-5 px-5">

                                <?php
                                if (!empty($error)) {
                                    echo "<div class='alert alert-danger'>$error</div>";
                                }
                                ?>

                                <form method="post" class="row g-4">

                                    <div class="col-12">
                                        <label>Username <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                            <input type="text"
                                                   class="form-control"
                                                   name="input_username"
                                                   placeholder="Enter Username"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <div class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                            <input type="password"
                                                   class="form-control"
                                                   name="input_password"
                                                   placeholder="Enter Password"
                                                   required>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <button type="submit"
                                                name="login"
                                                class="btn btn-primary px-4 float-end mt-4">
                                            Login
                                        </button>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="col-md-5 ps-0 d-none d-md-block">
                            <div class="form-right h-100 bg-primary text-white text-center pt-5">
                                <i class="fas fa-user-shield fa-3x mb-3"></i>
                                <h2 class="fs-1">Welcome Back!!!</h2>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
