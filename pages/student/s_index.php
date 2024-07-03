<?php
session_start();
if (isset($_SESSION['student'])) {
    ?>
    <!doctype html>
    <html class="no-js " lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">
        <title>LEAP </title>
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
                <a href="s_index.php"><img src="assets/images/logo.svg" width="25" alt="Aero"><span
                        class="m-l-10">LEAP</span></a>
            </div>
            <div class="menu">
                <ul class="list">
                    <li>
                        <div class="user-info">
                            <a class="image" href="s_profile.php"><img src="assets/images/profile_av.jpg" alt="User"></a>
                            <div class="detail">
                                <h4>
                                    <?php echo $_SESSION['sname']; ?>
                                </h4>
                                <small>Student</small>
                            </div>
                        </div>
                    </li>
                    <li class="open"><a href="#"><i class="zmdi zmdi-account-add"></i><span>My Classes</span></a></li>
                    <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-assignment"></i><span>Attendance</span></a>
                        <ul class="ml-menu">
                            <li><a href="s_viewAttendance.php">View attendance</a></li>
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

        <!-- Main Content -->

        <section class="content">
            <div class="body_scroll">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <h2>Classes</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="admin_dash.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Classes</li>
                            </ul>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                    class="zmdi zmdi-arrow-right"></i></button>

                        </div>
                    </div>
                </div>
                <span id="here">
                    <?php
                    include "../../php/config.php";
                    $sid = $_SESSION['sid'];
                    $query = "select * from class c, student s, teacher t where c.c_tid=t.t_id and c.c_batch=s.s_batch and c.c_yoa=s.s_yoa and s.s_id=$sid order by c.c_id desc";
                    $result = mysqli_query($con, $query);
                    $count = 1;
                    while ($row = mysqli_fetch_array($result)) {
                        $c_name = $row['c_name'];
                        $c_batch = $row['c_batch'];
                        $c_yoa = $row['c_yoa'];
                        $c_id = $row['c_id'];
                        ?>
                        <!-- Basic Examples -->
                        <div class="container-fluid">
                            <div class="row clearfix">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="body">
                                            <div class="row">

                                                <div class="col-xl-9 col-lg-8 col-md-12">
                                                    <div class="product details">
                                                        <h3 class="product-title mb-0">
                                                            <?php echo $c_name ?>
                                                        </h3>
                                                        <hr>
                                                        <p class="product-description">
                                                            <?php echo $row['t_name'] ?>
                                                        </p>

                                                        <div class="action">
                                                            <a class="btn btn-primary waves-effect"
                                                                href="s_viewSubject.php?c_id=<?php echo base64_encode($c_id) ?>">ENTER
                                                                CLASSROOM</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php
                    } ?>
        </section>

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



        <!--calculate attendance detail modal-->

        <div class="modal fade" id="calattdetail" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="largeModalLabel">Select class, batch and dates</h4>
                    </div>
                    <div class="modal-body">
                        <form id="calattform" method="POST" action="s_calculateatt.php">
                            <div class="form-group form-float">
                               <input type="hidden" value="<?php echo $sid;?>" name="sid"/>
                            </div>

                            <div class="form-group form-float">
                                <input type="date" class="form-control" placeholder="Choose date" name="date1" />
                            </div>

                            <div class="form-group form-float">
                                <input type="date" class="form-control" placeholder="Choose date" name="date2" />
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-round waves-effect" data-dismiss="modal"
                            onclick="document.getElementById('calattform').submit()">SELECT</button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <script src="assets/bundles/libscripts.bundle.js"></script>
        <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
        <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->

        <script src="assets/bundles/jvectormap.bundle.js"></script> <!-- JVectorMap Plugin Js -->
        <script src="assets/bundles/sparkline.bundle.js"></script> <!-- Sparkline Plugin Js -->
        <script src="assets/bundles/c3.bundle.js"></script>

        <script src="assets/bundles/mainscripts.bundle.js"></script>
        <script src="assets/js/pages/index.js"></script>
        <script src="../../js/logout.js"></script>

    </html>
    <?php
} else {
    header("Location: ../index.php");
}
?>