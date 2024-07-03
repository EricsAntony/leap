<?php
$con = mysqli_connect("localhost", "root", "", "lms");
session_start();
$subid = base64_decode($_REQUEST['sub_id']);
$sql = "SELECT * from `resources` where r_subid = $subid order by r_id desc";
$res = mysqli_query($con, $sql);
if (isset($_SESSION['student'])) {
    ?>
    <!doctype html>
    <html class="no-js " lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

        <title>LEAP | Question Bank</title>
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

                    <li class="open"><a href="s_index.php"><i class="zmdi zmdi-face"></i><span>My classes</span></a></li>

                    <li><a href="s_viewAssignment.php?sub_id=<?php echo base64_encode($subid) ?>"><i
                                class="zmdi zmdi-assignment"></i><span>Assignments</span></a></li>
                    <li><a href="s_resources.php?sub_id=<?php echo base64_encode($subid) ?>"><i
                                class="zmdi zmdi-assignment-o"></i><span>Question papers</span></a></li>
                    <li><a href="#" data-toggle="modal" data-target="#internalModal"><i
                                class="zmdi zmdi-border-color"></i><span>View internal mark</span></a></li>


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

        <input type="hidden" id="subid" name="subid" value="<?php echo $subid ?>" />
        <section class="content">
            <div class="body_scroll">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <h2>Resources</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="s_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item"><a
                                        href="s_notes.php?sub_id=<?php echo base64_encode($subid); ?>"> Notes</a>
                                </li>
                                <li class="breadcrumb-item active">Resources</li>
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
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="card project_list">
                                <div class="table-responsive">
                                    <table class="table table-hover c_table">
                                        <thead>

                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                ?>
                                                <tr>

                                                    <td><a href="#" title="Open document"
                                                            onclick="window.open('../../php/resources_folder/<?php echo $row['r_file']; ?>', '_blank', 'fullscreen=yes','targetWindow',width=1100,height=2000); return false;"><?php echo $row['r_name'] ?></a>
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
        </section>

        <!-- Jquery DataTable Plugin Js -->
        <script src="assets/bundles/datatablescripts.bundle.js"></script>

        <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <!-- Bootstrap Notify Plugin Js -->
        <script src="assets/js/pages/tables/footable.js"></script><!-- Custom Js -->

    </html>

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
                    <button type="button" class="btn btn-link waves-effect text-light" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

    <!--View Internal mark modal-->

    <div class="modal fade" id="internalModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Internal Marks</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">
                        <div class="form-group form-float">
                            <?php
                            $sid = $_SESSION['sid'];
                            $y = mysqli_query($con, "SELECT * FROM internal WHERE i_subid=$subid and i_sid=$sid");
                            $row = mysqli_fetch_assoc($y);
                            ?>
                            <p>First Internal</p><input type="text" id="r_subid" class="form-control"
                                value="<?php if (isset($row['i_first']))
                                    echo $row['i_first'] ?>" readonly><br>
                                <p>Second Internal</p><input type="text" id="r_name" class="form-control"
                                    value="<?php if (isset($row['i_second']))
                                    echo $row['i_second'] ?>" readonly>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger waves-effect" id="closem"
                            data-dismiss="modal">CLOSE</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
        <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
        <script src="assets/bundles/libscripts.bundle.js"></script>
        <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
        <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->
        <script src="assets/bundles/mainscripts.bundle.js"></script>
        <script src="../../js/logout.js"></script>
        <script src="assets/bundles/sparkline.bundle.js"></script>
        <script src="assets/js/pages/charts/sparkline.js"></script>
        <script src=../../js/resources.js></script>
        <script src="../../js/logout.js"></script>


    <?php
} else {
    header("Location: ../index.php");
}
?>