<?php
session_start();
?>
<!doctype html>
<html class="no-js " lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>LEAP | Enter new password</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Custom Css -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
</head>

<body class="theme-blush">


    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <form class="card auth_form">
                        <div class="header">
                            <img class="logo" src="assets/images/logo.svg" alt="">
                            <h5>NEW PASSWORD</h5>
                            <span>Enter your password</span>
                        </div>
                        <div class="body">
                            <div class="input-group mb-3">
                                <input type="hidden" id="email" value="<?php if (isset($_SESSION['email']))
                                    echo $_SESSION['email'] ?>">
                                    <input type="password" class="form-control" placeholder="Enter password" id="pass"
                                        onchange="isStrongPassword()">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                    </div>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="password" class="form-control" placeholder="Confirm password" id="cpass">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                    </div>
                                </div>
                                <input type="button" id="pass_submit"
                                    class="btn btn-primary btn-block waves-effect waves-light" value="SUBMIT">
                                <div class="signin_with mt-3">
                                    <a href="index.php" class="link">Log IN</a>
                                </div>
                            </div>
                        </form>
                        <div class="copyright text-center">
                            &copy;
                            <script>document.write(new Date().getFullYear())</script>,
                            <span><a href="https://mcaucc.edu.in">Master of computer applications, Union Christian College,
                                    Aluva</a></span><br>
                        </div>
                    </div>
                    <div class="col-lg-8 col-sm-12">
                        <div class="card">
                            <img src="assets/images/signin.svg" alt="Forgot Password" />
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jquery Core Js -->
        <script src="assets/bundles/libscripts.bundle.js"></script>
        <script src="assets/bundles/vendorscripts.bundle.js"></script>
        <script src="assets/js/pages/ui/notifications.js"></script>
        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="assets/bundles/mainscripts.bundle.js"></script>
        <script>
            var pass = document.getElementById('pass').value;
            var cpass = document.getElementById('cpass').value;


            function isStrongPassword() {
                password = document.getElementById('pass').value;
                const hasMinimumLength = /.{8,}/.test(password);
                const hasUppercase = /[A-Z]/.test(password);
                const hasLowercase = /[a-z]/.test(password);
                const hasNumber = /\d/.test(password);
                const hasSpecialCharacter = /[!@#$%^&*()\-_=+{}[\]|;:'",.<>?`~]/.test(password);
                if (
                    hasMinimumLength &&
                    hasUppercase &&
                    hasLowercase &&
                    hasNumber &&
                    hasSpecialCharacter
                ) {
                    document.getElementById('pass_submit').disabled = false;
                    return true;
                }
                else {
                    document.getElementById('pass_submit').disabled = true;
                    showNotification("alert-danger", "WEAK password! Password should contain an Uppercase, lowercase, numbers, special characters, and minimum 8 characters", "bottom", "right", "", "");
                    return false;
                }
            }
            $('#cpass').on('focusout', function () {
                var pass = $("#pass").val().trim();
                var cpass = $("#cpass").val().trim();

                if(pass!=cpass)
                {
                    document.getElementById('pass_submit').disabled = true;
                    showNotification("alert-danger", "Password does not match", "bottom", "right", "", "");
                    
                }
                else
                {
                    document.getElementById('pass_submit').disabled = false;
                    
                }
            });

        </script>
        <script>
            $('#pass_submit').on('click', function () {

                var pass = $("#pass").val().trim();
                var email = $("#email").val().trim();
                if (pass != '') {
                    $.ajax({

                        url: '../php/updatepass.php',
                        data: { email: email, pass: pass },
                        type: 'post',
                        
                        success: function (response) {
                            if (response == 1) {
                                showNotification("alert-success", "Password updated! You will be redirected to log in page.", "bottom", "right", "", "")
                                function afterTimeoutFunction() {
                                    window.location.href = "index.php";
                                }
                                const timeoutId = setTimeout(afterTimeoutFunction, 3000);
                            }
                            if (response == 0) {
                                showNotification("alert-danger", "Failed to update password", "bottom", "right", "", "")
                            }

                        }
                    });
                }
                else {
                    showNotification("alert-danger", "Enter a password", "bottom", "right", "", "")
                }


            });

        </script>
    </body>

    </html>