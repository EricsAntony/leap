<!doctype html>
<html class="no-js " lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>Login - LMS</title>
<!-- Favicon-->
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Custom Css -->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/css/style.min.css">    
<script src="sweetalert.min.js"></script>
</head>

<body class="theme-blush">

<div class="authentication">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-sm-12">
                <form class="card auth_form">
                    <div class="header">
                        <img class="logo" src="assets/images/logo.svg" alt="">
                        <h5>Log in</h5>
                    </div>
                    <div class="body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Email" id="email">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" placeholder="Password" id="pwd">
                            <div class="input-group-append">                                
                                <span class="input-group-text"><a href="forgot-password.php" class="forgot" title="Forgot Password"><i class="zmdi zmdi-lock"></i></a></span>
                            </div>                            
                        </div>
                        <a class="btn btn-primary btn-block waves-effect waves-light" id="submit">SIGN IN</a>                        
                        <div class="signin_with mt-3">
                        <span><a href="signup.php">Sign Up</a></span><br>
                            <a href="https://www.facebook.com/people/MCA-at-Union-Christian-College-Aluva/100021213372204/" class="btn btn-primary btn-icon btn-icon-mini btn-round facebook"><i class="zmdi zmdi-facebook"></i></a>
                            <a href="https://twitter.com/mcaucc?lang=en" class="btn btn-primary btn-icon btn-icon-mini btn-round twitter"><i class="zmdi zmdi-twitter"></i></a>
                        </div>
                    </div>
                </form>
                <div class="copyright text-center">
                    &copy;
                    <script>document.write(new Date().getFullYear())</script>,
                    <span><a href="https://mcaucc.edu.in">Master of computer applications, Union Christian College, Aluva</a></span><br>
                </div>
            </div>
            <div class="col-lg-8 col-sm-12">
                <div class="card">
                    <img src="assets/images/signin.svg" alt="Sign In"/>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="assets/bundles/libscripts.bundle.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
<script src="../js/login.js"></script>
<script src="assets/js/pages/ui/sweetalert.js"></script>
<script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
<script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
<script src="assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->


</body>
</html>