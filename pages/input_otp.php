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

    <title>LEAP | Enter OTP</title>
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
                            <h5>ENTER OTP</h5>
                            <span>Enter your six digit OTP here</span>
                        </div>
                        <div class="body">
                            <div class="input-group mb-3">
                                <input type="hidden" id="sess" value="<?php if (isset($_SESSION['otp']))
                                    echo $_SESSION['otp'] ?>">
                                    <input type="text" class="form-control" placeholder="Enter OTP" id="otp">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="zmdi zmdi-email"></i></span>
                                    </div>
                                </div>
                                <input type="button" id="otp_submit"
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
            $('#otp_submit').on('click', function () {
                var otp = $("#otp").val().trim();
                var sess = $("#sess").val().trim();

                var phoneno = /^\d{6}$/;
                console.log(sess);
                
                    if (otp != '') {
                        if (!(phoneno.test(otp))) {

                            showNotification("alert-danger", "Enter a six digit OTP", "bottom", "right", "", "");
                            return false;
                        }
                        else
                        {
                            if(otp == sess)
                            {
                                window.location.href="newpassword.php";
                            }
                            else
                            {
                                showNotification("alert-danger", "Invalid OTP", "bottom", "right", "", "");
                                return false;
                            }
                        }
                    }
                    else {
                        showNotification("alert-danger", "Enter the OTP", "bottom", "right", "", "")
                    }
                
            });

        </script>
    </body>


    </html>