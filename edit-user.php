<?php
require_once "functions/functions.php";
get_header();
get_sidebar();

$id = $_GET['e'];
$select = "SELECT * FROM users NATURAL JOIN roles WHERE user_id = $id";
$q = mysqli_query($conn, $select);
$data = mysqli_fetch_assoc($q);

$imageold = $data['user_photo'];

if (!empty($_POST)) {

    // USER INPUT
    $user_name  = trim($_POST['name']);
    $user_phone = trim($_POST['phone']);
    $user_email = trim($_POST['email']);
    $user_role  = trim($_POST['role']);
    $image      = $_FILES['photo'];

    // IMAGE NAME
    if (!empty($image['name'])) {
        $imageName = $user_name . "_" . time() . "_updated." .
            pathinfo($image['name'], PATHINFO_EXTENSION);
    } else {
        $imageName = $imageold;
    }

    $update = "UPDATE users SET 
        user_name  = '$user_name',
        user_phone = '$user_phone',
        user_email = '$user_email',
        role_id    = '$user_role',
        user_photo = '$imageName'
        WHERE user_id = $id";
}
?>

<div class="col-md-10 content">
    <div class="row">
        <div class="col-md-12 breadcumb_part">
            <div class="bread">
                <ul>
                    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="#"><i class="fas fa-angle-double-right"></i> Dashboard</a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">

            <?php
            if (!empty($_POST)) {
                if (empty($user_name)) {
                    echo "<div class='alert alert-danger'>Name Can Not be Empty!</div>";
                } elseif (empty($user_phone)) {
                    echo "<div class='alert alert-danger'>Phone Can Not be Empty!</div>";
                } elseif (empty($user_email)) {
                    echo "<div class='alert alert-danger'>Email Can Not be Empty!</div>";
                } elseif (empty($user_role)) {
                    echo "<div class='alert alert-danger'>Please Select Role!</div>";
                } else {
                    if (mysqli_query($conn, $update)) {

                        // upload image only if new selected
                        if (!empty($image['name'])) {
                            move_uploaded_file(
                                $image['tmp_name'],
                                "uploads/user/" . $imageName
                            );
                        }

                        $_SESSION['success'] = "Information Update Successfully!";
                        header("Location: all-user.php");
                        exit();
                    } else {
                        echo "<div class='alert alert-danger'>Something Went Wrong!</div>";
                    }
                }
            }
            ?>

            <form method="POST" enctype="multipart/form-data">
                <div class="card mb-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-8 card_title_part">
                                <i class="fab fa-gg-circle"></i> Update User Information
                            </div>
                            <div class="col-md-4 card_button_part">
                                <a href="all-user.php" class="btn btn-sm btn-dark">
                                    <i class="fas fa-th"></i> All User
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Name<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control"
                                       name="name"
                                       value="<?php echo $data['user_name']; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Phone</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control"
                                       name="phone"
                                       value="<?php echo $data['user_phone']; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Email<span class="req_star">*</span></label>
                            <div class="col-sm-7">
                                <input type="email" class="form-control"
                                       name="email"
                                       value="<?php echo $data['user_email']; ?>">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Username</label>
                            <div class="col-sm-7">
                                <input type="text" class="form-control"
                                       value="<?php echo $data['user_username']; ?>"
                                       disabled>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">User Role<span class="req_star">*</span></label>
                            <div class="col-sm-4">
                                <select class="form-control" name="role">
                                    <?php
                                    $selr = "SELECT * FROM roles ORDER BY role_id DESC";
                                    $QR = mysqli_query($conn, $selr);
                                    while ($role = mysqli_fetch_assoc($QR)) {
                                    ?>
                                        <option value="<?php echo $role['role_id']; ?>"
                                            <?php if ($data['role_id'] == $role['role_id']) echo "selected"; ?>>
                                            <?php echo $role['role_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- PHOTO -->
                        <div class="row mb-3">
                            <label class="col-sm-3 col-form-label">Photo</label>

                            <div class="col-sm-4">
                                <input type="file"
                                       class="form-control"
                                       id="photo"
                                       name="photo"
                                       accept="image/*">
                            </div>

                            <div class="col-sm-4">
                                <img id="preview"
                                     src="uploads/user/<?php echo !empty($data['user_photo']) ? $data['user_photo'] : 'default.jpg'; ?>"
                                     width="70" height="70"
                                     style="border-radius:50%; object-fit:cover; border:1px solid #ccc;">
                            </div>
                        </div>

                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-sm btn-dark">UPDATE</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

<?php 
get_footer(); 

?>

