<?php 
		// include '../classes/auth.php';
		$auth->login();
		// if(isset($_POST['login_btn']))
		// {
		// 	echo "<script>alert('Only DOC, DOCX, PDF, TXT, CSV, XLSX, JPG, JPEG, PNG files are allowed!')</script>";
		// }
 ?>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">

            	<?php
            		if(isset($_SESSION['messages'])){
	            		$messages = $dbConfig->displayMessage();
	            		$i = 0;
                       while ($i < count($messages)) {
                           $words = explode('|', $messages[$i]);
                        
                     ?>
                    <div class="col-12 alert <?=$words[1] ?> alert-dismissible show fade" role="alert">
                        <div class="alert-body">
                          <button class="close" data-dismiss="alert"><span>&times;</span></button>
                          <?=$words[0]; ?>
                      </div>
                    </div>
                <?php 
	           		$i += 1;
            		}
            	}
            	 ?>
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                         <img src="../images/logo1.png" alt="logo" width="100" class="shadow-light img-thumbnail">
                    </div>
                    <div class="card card-primary">
                        <div class="card-header">
                            <h4>Login</h4>
                        </div>
                        <div class="card-body">
                            <form  action="#" class="needs-validation" novalidate="" method="post">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                    <div class="invalid-feedback">
                                        Please fill in your email
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="d-block">
                                        <label for="password" class="control-label">Password</label>
                                        <div class="float-right">
                                            <a href="auth-forgot-password.html" class="text-small">
                                            Forgot Password?
                                            </a>
                                        </div>
                                    </div>
                                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                    <div class="invalid-feedback">
                                        please fill in your password
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember-me">
                                        <label class="custom-control-label" for="remember-me">Remember Me</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<input type="submit" name="login_btn" value="Login" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                   <!--  <button type="submit" class="btn btn-primary btn-lg btn-block" name="login_btn" tabindex="4">
                                    Login
                                    </button> -->
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="simple-footer">
                        Copyright &copy; CodiePie 2020 | Developed by Mosiac
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>