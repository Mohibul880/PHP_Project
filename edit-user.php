<?php
require_once "functions/functions.php";
get_header();
get_sidebar();

$id = $_GET['e'];
$select = "SELECT * FROM users  NATURAL JOIN roles WHERE user_id = $id";
$q = mysqli_query($conn, $select);
$data = mysqli_fetch_assoc($q);



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
          <div class="col-md-12 ">
              <form method="" action="">
                  <div class="card mb-3">
                    <div class="card-header">
                      <div class="row">
                          <div class="col-md-8 card_title_part">
                              <i class="fab fa-gg-circle"></i>Update User Information
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
                            <input type="text" class="form-control form_control" value="<?php echo $data['user_name']  ?>" id="" name="">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Phone:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control"  value="<?php echo $data['user_phone'] ?>" id="" name="">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Email<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="email" class="form-control form_control"  value="<?php echo $data['user_email'] ?>" id="" name="">
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Username<span class="req_star">*</span>:</label>
                          <div class="col-sm-7">
                            <input type="text" class="form-control form_control"  value="<?php echo $data['user_username'] ?>" id="" name="">
                          </div>
                        </div>
                        
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">User Role<span class="req_star">*</span>:</label>
                          <div class="col-sm-4">
                            <select class="form-control" name="role">
                                    <?php
                                    $selr = "SELECT * FROM roles ORDER BY role_id DESC";
                                    $QR = mysqli_query($conn, $selr);
                                    while($role = mysqli_fetch_assoc($QR)){
                                    ?>
                                        <option <?php if($data['role_id'] == $role['role_id']){ echo "selected"; } ?> value="<?php echo $role['role_id']; ?>">
                                            <?php echo $role['role_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                          </div>
                        </div>
                        <div class="row mb-3">
                          <label class="col-sm-3 col-form-label col_form_label">Photo:</label>
                          <div class="col-sm-4">
                            <input type="file" class="form-control form_control" id="" name="">
                          </div>
                          <div class="col-sm-4">
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

