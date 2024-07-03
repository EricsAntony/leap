<?php
session_start();
if (isset($_SESSION['teacher'])) {
    ?>
    <!doctype html>
    <html class="no-js " lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
        <title>LEAP | student</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/plugins/jvectormap/jquery-jvectormap-2.0.3.min.css" />
        <link rel="stylesheet" href="assets/plugins/charts-c3/plugin.css" />

        <link rel="stylesheet" href="assets/plugins/morrisjs/morris.min.css" />
        <!-- Custom Css -->
        <link rel="stylesheet" href="assets/css/style.min.css">
    </head>

    <body class="theme-blush">

        <!-- Page Loader -->
        <div class="page-loader-wrapper" id="loader">
            <div class="loader">
                <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/loader.svg" width="48" height="48"
                        alt="Aero"></div>
                <p>Please wait...</p>
            </div>
        </div>

        <!-- Overlay For Sidebars -->
        <div class="overlay"></div>


        <!-- Right Icon menu Sidebar -->
        <div class="navbar-right">
            <ul class="navbar-nav">
                <li><a href="javascript:void(0);" class="js-right-sidebar" title="Setting"><i
                            class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
                <li><a href="#" class="mega-menu" title="Log Out" data-toggle="modal" data-target="#colorModal"><i
                            class="zmdi zmdi-power"></i></a></li>
            </ul>
            </ul>
        </div>

        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <div class="navbar-brand">
                <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
                <a href="a_index.php"><img src="assets/images/logo.svg" width="25" alt="Aero"><span
                        class="m-l-10">LEAP</span></a>
            </div>
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info">
                            <a class="image" href="a_profile.php"><img src="assets/images/profile_av.jpg" alt="User"></a>
                            <div class="detail">
                                <h4>
                                    <?php echo $_SESSION['tname']; ?>
                                </h4>
                                <small>Super User</small>
                            </div>
                        </div>
                    </li>
                    <li class="open"><a href="a_teacher.php"><i class="zmdi zmdi-account-add"></i><span>Teacher</span></a>
                    </li>
                    <li class="open"><a href="a_student.php"><i class="zmdi zmdi-accounts-alt"></i><span>Student</span></a>
                    </li>
                    <li class="open"><a href="a_classes.php"><i class="zmdi zmdi-face"></i><span>My classes</span></a></li>
                </ul>
            </div>
        </aside>

        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <div class="tab-content">
                <div class="tab-pane active" id="setting">
                    <div class="slim_scroll">
                        <div class="card">
                            <h6>Theme Option</h6>
                            <div class="light_dark">
                                <div class="radio">
                                    <input type="radio" name="radio1" id="lighttheme" value="light" checked="">
                                    <label for="lighttheme">Light Mode</label>
                                </div>
                                <div class="radio mb-0">
                                    <input type="radio" name="radio1" id="darktheme" value="dark">
                                    <label for="darktheme">Dark Mode</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </aside>


        <section class="content">
            <div class="body_scroll">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <h2>Student Management</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin_dash.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Student organizer</li>
                            </ul>

                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <a class="btn btn-primary float-right" href="a_addviaexcel.php">Upload via Excel</a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <!-- Example Tab -->
                    <div class="row clearfix">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="header">
                                    <h2><strong>STUDENT</strong> ORGANIZER</h2>

                                </div>
                                <div class="body">

                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs p-0 mb-3">
                                        <li class="nav-item"><a class="nav-link active" data-toggle="tab"
                                                href="#home">REGISTER</a></li>
                                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#profile"
                                                id="view">VIEW</a></li>
                                    </ul>
                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane in active" id="home">
                                            <div class="body">
                                                <form id="myform" method="POST">
                                                    <div class="form-group form-float">
                                                        <input type="text" class="form-control" placeholder="Full Name"
                                                            name="name" id="as_name">
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <input type="email" class="form-control" placeholder="Email"
                                                            name="email" id="as_email">
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <input type="text" class="form-control"
                                                            placeholder="Admission Number" name="adm" id="as_adm">
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <input type="text" class="form-control"
                                                            placeholder="year of admission" name="yoa" id="as_yoa">
                                                    </div>
                                                    <div class="form-group form-float">
                                                        <select class="form-control show-tick ms select2"
                                                            data-placeholder="Select" name="batch" id="as_batch">
                                                            <option disabled selected hidden>Batch</option>
                                                            <option>A</option>
                                                            <option>B</option>
                                                            <option>C</option>
                                                        </select>
                                                    </div>
                                                    <button class="btn btn-raised btn-primary waves-effect" type="submit"
                                                        id="register">REGISTER</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="profile">
                                            <div class="row clearfix">

                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="body">
                                                            <div class="table-responsive table-hover table-striped"
                                                                id="live_data">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--Delete student modal-->
        <div class="modal fade" id="delstudentmodel" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-teal">
                    <div class="modal-header">
                        <h4 class="title" id="defaultModalLabel">DELETE</h4>
                    </div>
                    <div class="modal-body text-light">Are you sure that you want to delete the student details</div>
                    <div class="modal-footer">
                        <input type="hidden" id="stid">
                        <button type="button" class="btn btn-link waves-effect text-light" data-dismiss="modal"
                            id="delstudentconfirm">CONFIRM</button>
                        <button type="button" class="btn btn-link waves-effect text-light"
                            data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>

        <!--update student modal-->
        <div class="modal fade" id="defaultModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="defaultModalLabel">Edit Student Details</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form_validation" method="POST" role="form">
                            <div class="form-group form-float">
                                <input type="hidden" class="form-control" id="sid" readonly>
                                <input type="text" class="form-control" id="admno" placeholder="Admisiion Number" required>
                            </div>
                            <div class="form-group form-float">
                                <input type="text" class="form-control" id="sname" placeholder="Name" required>
                            </div>
                            <div class="form-group form-float">
                                <input type="text" class="form-control" placeholder=" Email" id="semail" required>
                            </div>
                            <div class="form-group form-float">
                                <input type="text" class="form-control" placeholder="Batch" id="sbatch" required>
                            </div>
                            <div class="form-group form-float">
                                <input type="text" class="form-control" placeholder="Mobile" id="smob" required>
                            </div>
                            <div class="form-group form-float">
                                <input type="text" class="form-control" placeholder="Year of admission" id="syoa" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" data-dismiss="modal" id="Updatestudent"
                                    class="btn btn-success waves-effect">Update</button>
                                <button type="button" class="btn btn-danger waves-effect" id="closem"
                                    data-dismiss="modal">CLOSE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!--Logout modal-->
        <div class="modal fade" id="colorModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-red">
                    <div class="modal-header">
                        <h4 class="title" id="defaultModalLabel">LOG OUT</h4>
                    </div>
                    <div class="modal-body text-light">Are you sure that you want to exit the current session</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect text-light" id="logout">LOG OUT</button>
                        <button type="button" class="btn btn-link waves-effect text-light"
                            data-dismiss="modal">CLOSE</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
        <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
        <!-- Jquery DataTable Plugin Js -->
        <script src="assets/bundles/datatablescripts.bundle.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

        <script src="assets/js/pages/tables/jquery-datatable.js"></script>

        <script src="assets/js/pages/ui/sweetalert.js"></script>
        <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
        <script src="assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->

        <script src="../../js/regStudent.js"></script>
        <script src="../../js/student.js"></script>
        <script src="../../js/logout.js"></script>
        <script>
            //Check Email Exist
            $(document).ready(function () {
                console.log("hai");
                $("#as_email").focusout(function () {
                    var username = $("#as_email").val().trim();
                    const button1 = document.getElementById("register"); // assuming the button is assigned an id named "button"
                    if (username != "") {
                        $.ajax({
                            url: '../../php/checkemailexist.php',
                            type: 'post',
                            data: { username: username },
                            success: function (response) {
                                var data = JSON.parse(response);
                                if (data.count >= 1) {
                                    showNotification("red", "Email already exists", "bottom", "right", "bg-red", "");
                                    button1.disabled = true;
                                    return false
                                }
                                else {
                                    button1.disabled = false;
                                }
                            }
                        });
                    }
                });
            });
        </script>

    </html>
    <?php
} else {
    header("Location: ../../index.php");
}
?>