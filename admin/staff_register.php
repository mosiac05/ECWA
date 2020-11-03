<?php
	require_once './includes/head.php';
    $dbConfig->unauthorizedRedirect();
    include '../classes/user.php';

    if(isset($_GET['admin_register']))
    {
        // For admin account
        // $is_customer, $is_staff, $is_admin
        $user->insert(1,1);
    }
    else
    {
        // For normal staff account
        // $is_customer, $is_staff, $is_admin
        $user->insert(1,0);

        if(isset($_GET['staff_edit']))
        {
            $redirect_link = 'index.php?staff_single=' . $_GET['staff_edit'];
            $user->update($redirect_link);
            $user_query = $user->getOne($_GET['staff_edit']);

            $user_data = mysqli_fetch_assoc($user_query);

            $id = $user_data['id'];
            $first_name = $user_data['first_name'];
            $last_name = $user_data['last_name'];
            $username = $user_data['username'];
            $email = $user_data['email'];
        }
    }
 ?>

<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
                    <div class="login-brand">
                        <img src="../images/logo1.png" alt="logo" width="100" class="shadow-light img-thumbnail">
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Register <?php if(isset($_GET['admin_register'])){ echo 'New Admin'; } ?></h4>
                        </div>
                        <div class="card-body">
                            <form class="needs-validation" novalidate="" method="POST">
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="frist_name">First Name</label>
                                        <input id="frist_name" type="text" class="form-control" name="first_name" value="<?php echo $first_name ?? ''; ?>" autofocus required="">
                                        <span class="invalid-feedback">What's your first name?</span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="last_name">Last Name</label>
                                        <input id="last_name" type="text" class="form-control" name="last_name" value="<?php echo $last_name ?? ''; ?>" required="">
                                        <span class="invalid-feedback">What's your last name?</span>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="email">Username</label>
                                        <input id="username" type="text" class="form-control" name="username" value="<?php echo $username ?? ''; ?>" required="">
                                        <span class="invalid-feedback">Choose a username!</span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" value="<?php echo $email ?? ''; ?>" required="">
                                        <span class="invalid-feedback">Type your email address...</span>
                                    </div>                                    
                                </div>

                                <?php if (!isset($_GET['staff_edit'])): ?>                                                         
                                <div class="row">
                                    <div class="form-group col-6">
                                        <label for="password" class="d-block">Password</label>
                                        <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" required="">
                                        <div id="pwindicator" class="pwindicator">
                                            <div class="bar"></div>
                                            <div class="label"></div>
                                        </div>
                                        <span class="invalid-feedback">Choose a strong password...</span>
                                    </div>
                                    <div class="form-group col-6">
                                        <label for="password2" class="d-block">Password Confirmation</label>
                                        <input id="password2" type="password" class="form-control" name="confirm_password" required="">
                                        <span class="invalid-feedback">...type it again to confirm</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="agree" class="custom-control-input" id="agree" required="">
                                        <label class="custom-control-label" for="agree">I agree with the terms and conditions</label>
                                        <span class="invalid-feedback">Check this to agree before submit!</span>
                                    </div>
                                </div> 
                                <div class="form-group">
                                    <input type="submit" name="user_insert" value="Register" class="btn btn-primary btn-lg btn-block">
                                </div>
                                <?php else: ?>                                 
                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="<?php echo $id ?? ''; ?>">
                                    <input type="submit" name="user_edit" value="Update" class="btn btn-primary btn-lg btn-block">
                                </div>                 
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; EGCOM 2020
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php 
	require_once './includes/js.php';
 ?>