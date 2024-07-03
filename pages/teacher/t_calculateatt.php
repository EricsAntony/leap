<?php
$con = mysqli_connect("localhost", "root", "", "lms");
session_start();
$batch = $_POST['batch'];
$yoa = $_POST['yoa'];
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];

$sql = "SELECT * from `student` where s_batch='$batch' and s_yoa='$yoa'";
$res = mysqli_query($con, $sql);

$t = mysqli_query($con, "SELECT count(DISTINCT at_date) as count FROM `att` WHERE at_date BETWEEN '$date1' AND '$date2'");
$r = mysqli_fetch_assoc($t);
$total = $r['count'];
if (isset($_SESSION['teacher'])) {
    ?>

    <!doctype html>
    <html class="no-js " lang="en">


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

        <title>LEAP | Calculate Attendance</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- Favicon-->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
        <!-- JQuery DataTable Css -->
        <link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
        <!-- Custom Css -->
        <link rel="stylesheet" href="assets/css/style.min.css">
    </head>

    <body class="theme-blush">

        <!-- Page Loader -->
        <div class="page-loader-wrapper">
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
        </div>

        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <div class="navbar-brand">
                <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
                <a href="t_index.php"><img src="assets/images/logo.svg" width="25" alt="Aero"><span
                        class="m-l-10">LEAP</span></a>
            </div>
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info">
                            <a class="image" href="t_profile.php"><img src="assets/images/profile_av.jpg" alt="User"></a>
                            <div class="detail">
                                <h4>
                                    <?php echo $_SESSION['tname']; ?>
                                </h4>
                                <small>Faculty</small>
                            </div>
                        </div>
                    </li>

                    <li class="open"><a href="t_classes.php"><i class="zmdi zmdi-face"></i><span>My classes</span></a></li>
                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-assignment"></i><span>Attendance</span></a>
                        <ul class="ml-menu">
                            <li><a href="#" data-toggle="modal" data-target="#attdetail">Mark attendance</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#viewattdetail">View attendance</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#calattdetail">Calculate</a></li>
                        </ul>
                    </li>
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
                            <h2>Attendance Percentage</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="t_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Attendance Percentage</li>
                            </ul>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>

                    </div>
                </div>
            </div>

            <div class="container-fluid">
                Number of working days: &nbsp
                <?php echo $r['count'] ?>
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" id="mainTable">
                            <div class="header">
                                <h2><strong>ALL</strong> Attendance </h2>
                            </div>
                            <div class="body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Percentage</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $row['s_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        $q = mysqli_query($con, "SELECT * FROM `att` WHERE `at_date` BETWEEN '$date1' AND '$date2' AND at_sid=" . $row['s_id']);
                                                        $present = 1;
                                                        $number = 0;
                                                        while ($t = mysqli_fetch_assoc($q)) {
                                                            $present = 1;
                                                            if ($t['at_p1'] == 0 || $t['at_p2'] == 0 || $t['at_p3'] == 0) {
                                                                $present -= 0.5;
                                                            }
                                                            if ($t['at_p4'] == 0 || $t['at_p5'] == 0 || $t['at_p6'] == 0) {
                                                                $present -= 0.5;
                                                            }


                                                            if ($present == 1) {
                                                                $number++;
                                                            } else if ($present == 0.5) {
                                                                $number += 0.5;
                                                            }



                                                        }
                                                        if ($total != 0) {
                                                            $perc = ($number / $total) * 100;
                                                            echo $perc . "%";
                                                        } else {
                                                            echo "Number of working days is 0";
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>

        
        <!-- attendance detail modal-->

        <div class="modal fade" id="attdetail" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="largeModalLabel">Select class & batch</h4>
                    </div>
                    <div class="modal-body">
                        <form id="attform" method="POST" action="t_markattendance.php">
                            <div class="form-group form-float">
                                <?php
                                $q = "SELECT DISTINCT s_yoa from student";
                                $r = mysqli_query($con, $q);
                                ?>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="yoa"
                                    id="m_yoa">
                                    <option disabled selected hidden>Year of admission</option>
                                    <?php
                                    while ($roww = mysqli_fetch_assoc($r)) {
                                        ?>
                                        <option>
                                            <?php echo $roww['s_yoa']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group form-float">
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="batch"
                                    id="m_batch">
                                    <option disabled selected hidden>Batch</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                            </div>

                            <div class="form-group form-float">
                                <input type="date" class="form-control" placeholder="Choose date" name="date" id="m_date" />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-round waves-effect" data-dismiss="modal"
                            onclick="sub()">SELECT</button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--View attendance detail modal-->

        <div class="modal fade" id="viewattdetail" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="largeModalLabel">Select class, batch and dates</h4>
                    </div>
                    <div class="modal-body">
                        <form id="viewattform" method="POST" action="t_viewattendanceBD.php">
                            <div class="form-group form-float">
                                <?php
                                $q = "SELECT DISTINCT s_yoa from student";
                                $r = mysqli_query($con, $q);
                                ?>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="yoa"
                                    id="v_yoa">
                                    <option disabled selected hidden>Year of admission</option>
                                    <?php
                                    while ($roww = mysqli_fetch_assoc($r)) {
                                        ?>
                                        <option>
                                            <?php echo $roww['s_yoa']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group form-float">
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="batch"
                                    id="v_batch">
                                    <option disabled selected hidden>Batch</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                            </div>

                            <div class="form-group form-float">
                                <input type="date" class="form-control" placeholder="Choose date" name="date1"
                                    id="v_date1" />
                            </div>

                            <div class="form-group form-float">
                                <input type="date" class="form-control" placeholder="Choose date" name="date2"
                                    id="v_date2" />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-round waves-effect" data-dismiss="modal"
                            onclick="v_sub()">SELECT</button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <!--calculate attendance detail modal-->

        <div class="modal fade" id="calattdetail" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="largeModalLabel">Select class, batch and dates</h4>
                    </div>
                    <div class="modal-body">
                        <form id="calattform" method="POST" action="t_calculateatt.php">
                            <div class="form-group form-float">
                                <?php
                                $q = "SELECT DISTINCT s_yoa from student";
                                $r = mysqli_query($con, $q);
                                ?>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="yoa" id="cal_yoa">
                                    <option disabled selected hidden>Year of admission</option>
                                    <?php
                                    while ($roww = mysqli_fetch_assoc($r)) {
                                        ?>
                                        <option>
                                            <?php echo $roww['s_yoa']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group form-float">
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="batch"
                                    id="cal_batch">
                                    <option disabled selected hidden>Batch</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                            </div>

                            <div class="form-group form-float">
                                <input type="date" class="form-control" placeholder="Choose date" name="date1" id="cal_date1"/>
                            </div>

                            <div class="form-group form-float">
                                <input type="date" class="form-control" placeholder="Choose date" name="date2" id="cal_date2"/>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-round waves-effect" data-dismiss="modal"
                            onclick="cal_sub()">SELECT</button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


         <!-- log out modal-->
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



        <!-- Jquery Core Js -->
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

        <script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
        <script src="assets/js/pages/tables/jquery-datatable.js"></script>
        <script src="assets/js/pages/forms/advanced-form-elements.js"></script>
        <script src="assets/js/pages/ui/notifications.js"></script>
        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="../../js/logout.js"></script>
        <script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->

        <script>
            function sub() {
                var yoa = document.getElementById('m_yoa').value;
                var batch = document.getElementById('m_batch').value;
                var date = document.getElementById('m_date').value;
                if (yoa != '' && batch != '' && date != '') {
                    document.getElementById('attform').submit();
                }
                else {
                    showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "");
                }
            }
        </script>

        <!-- view attendance validation -->
        <script>
            function v_sub() {
                var yoa = document.getElementById('v_yoa').value;
                var batch = document.getElementById('v_batch').value;
                var date1 = document.getElementById('v_date1').value;
                var date2 = document.getElementById('v_date2').value;

                if (yoa != '' && batch != '' && date1 != '' && date2 != '') {
                    document.getElementById('viewattform').submit();
                }
                else {
                    showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "");
                }
            }
        </script>

        <!-- calulate attendance validation -->
        <script>
            function cal_sub() {
                var yoa = document.getElementById('cal_yoa').value;
                var batch = document.getElementById('cal_batch').value;
                var date1 = document.getElementById('cal_date1').value;
                var date2 = document.getElementById('cal_date2').value;

                if (yoa != '' && batch != '' && date1 != '' && date2 != '') {
                    document.getElementById('calattform').submit();
                }
                else {
                    showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "");
                }
            }
        </script>

    </body>

    </html>
    <?php
} else {
    header("Location: ../index.php");
}
?>