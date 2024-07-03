<!doctype html>
<html class="no-js " lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

    <title>LARA - Sign Up</title>
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
                    <form class="card auth_form" id="sup" method="post" onkeyup="return checkInp()">
                        <div class="header">
                            <img class="logo" src="assets/images/logo.svg" alt="">
                            <h5>Sign Up</h5>
                            <span>Student</span>
                        </div>
                        <div class="body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Email" id="email" name="email">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Name" readonly id="name">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Admission No" readonly id="admno">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-assignment-account"></i></span>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Year of admission" readonly
                                    id="yoa">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-calendar-alt"></i></span>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Mobile" required id="mob"
                                    name="mob">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="ti-mobile"></i></span>
                                </div>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" class="form-control" placeholder="Password" required name="pwd"
                                    id="pwd" onchange="isStrongPassword()">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-lock"></i></span>
                                </div>
                            </div>
                            <input type="buttton" class="btn btn-primary btn-block waves-effect waves-light"
                                value="SIGN UP" id="sbtn">

                            <div class="signin_with mt-3">
                                <a class="link" href="index.php">You already have a registered?</a>
                            </div>
                        </div>
                    </form>
                    <div class="copyright text-center">
                        &copy;
                        <script>
                            document.write(new Date().getFullYear())
                        </script>,
                        <span><a href="https://mcaucc.edu.in">Master of computer applications, Union Christian College,
                                Aluva</a></span><br>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <img src="assets/images/signup.svg" alt="Sign Up" />
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Jquery Core Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
    <script src="../js/register.js"></script>
    <script src="../js/updatestudent.js"></script>
    <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
    <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
    <script src="assets/js/pages/ui/sweetalert.js"></script>
    <script src="assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->


    <!--Validation-->

    <script>
        function checkInp() {
            var x = document.forms["sup"]["mob"].value;
            if (isNaN(x)) {
                showNotification("alert-danger", "Mobile number can't be an alphabet", "bottom", "right", "", "");
                document.getElementById('sbtn').disabled=true;
            }
            else
            {
                document.getElementById('sbtn').disabled=false;
            }

        }

        function isStrongPassword() {
            var password = document.forms["sup"]["pwd"].value;
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
            )
            {
                document.getElementById('sbtn').disabled=false;
            }
            else
            {
                document.getElementById('sbtn').disabled=true;
                showNotification("alert-danger", "WEAK password! Password should contain an Uppercase, lowercase, numbers, special characters, and minimum 8 characters", "bottom", "right", "", "");
            }
        }

    </script>
</body>


</html>