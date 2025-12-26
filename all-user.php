<?php
require_once "functions/functions.php";
get_header();
get_sidebar();
?>

<div class="col-md-10 content">
    <div class="row">
        <div class="col-md-12 breadcumb_part">
            <div class="bread">
                <ul>
                    <li><a href=""><i class="fas fa-home"></i> Home</a></li>
                    <li><a href=""><i class="fas fa-angle-double-right"></i> Dashboard</a></li>
                </ul>
            </div>
        </div>
    </div>

    <?php
    if (isset($_SESSION['success'])) {
        echo "<div class='alert alert-success'>" . $_SESSION['success'] . "</div>";
        unset($_SESSION['success']);
    }
    ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-3">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8 card_title_part">
                            <i class="fab fa-gg-circle"></i> All User Information
                        </div>
                        <div class="col-md-4 card_button_part text-end">
                            <a href="add-user.php" class="btn btn-sm btn-dark">
                                <i class="fas fa-plus-circle"></i> Add User
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table id="userTable" class="table table-bordered table-striped table-hover custom_table">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Photo</th>
                                <th>Role</th>
                                <th>Manage</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            $select = "SELECT * FROM users NATURAL JOIN roles ORDER BY User_Id DESC";
                            $q = mysqli_query($conn, $select);

                            if ($q && mysqli_num_rows($q) > 0) {
                                while ($data = mysqli_fetch_assoc($q)) {
                            ?>
                                    <tr>
                                        <td><?php echo $data['user_name']; ?></td>
                                        <td><?php echo $data['user_phone']; ?></td>
                                        <td><?php echo $data['user_email']; ?></td>
                                        <td><?php echo $data['user_username']; ?></td>

                                        <!-- USER PHOTO -->
                                        <td>
                                            <?php if (!empty($data['user_photo'])) { ?>
                                                <img height="60" width="60"
                                                    style="border-radius:50%; object-fit:cover;"
                                                    src="uploads/user/<?php echo $data['user_photo']; ?>"
                                                    alt="User Photo">
                                            <?php } else { ?>
                                                <img height="60" width="60"
                                                    style="border-radius:50%; object-fit:cover;"
                                                    src="uploads/defualt/defualt.jpg"
                                                    alt="No Photo">
                                            <?php } ?>
                                        </td>


                                <td><?php echo $data['role_name']; ?></td>

                                <!-- MANAGE BUTTON  -->
                                <td>
                                    <div class="btn-group btn_group_manage" role="group">
                                        <button type="button"
                                                class="btn btn-sm btn-dark dropdown-toggle"
                                                data-bs-toggle="dropdown">
                                            Manage
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="view-user.php?v=<?php echo $data['User_Id']; ?>">
                                                    View
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item"
                                                    href="edit-user.php?e=<?php echo $data['User_Id']; ?>">
                                                    Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item bg-danger text-light"
                                                    href="delete-user.php?d=<?php echo $data['User_Id']; ?>"
                                                    onclick="return confirm('Are you sure?')">
                                                    Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo '<tr><td colspan="7" class="text-center">No users found</td></tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <div class="card-footer">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-sm btn-dark">Print</button>
                <button type="button" class="btn btn-sm btn-secondary">PDF</button>
                <button type="button" class="btn btn-sm btn-dark">Excel</button>
            </div>
        </div>

    </div>
</div>
</div>
</div>

<?php get_footer(); ?>
