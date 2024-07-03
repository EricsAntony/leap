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

        <title>LEAP | Classes</title>
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
        <div class="page-loader-wrapper" id="loader">
            <div class="loader">
                <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/loader.svg" width="48" height="48"
                        alt="Aero"></div>
                <p>Relax..! We setting up things for you...</p>
            </div>
        </div>

        <div class="overlay"></div>

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
                            <a class="btn btn-primary float-right" href="#" data-toggle="modal"
                                data-target="#createClassModal">Create a class</a>
                        </div>
                    </div>
                </div>
                <span id="here">
                    <?php
                    include "../../php/config.php";
                    $tid = $_SESSION['tid'];
                    $query = "select * from class where c_tid='$tid' order by c_id desc ";
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
                                                        <h5 class="price mt-0">
                                                            <?php echo $c_batch ?>&nbsp Batch&nbsp
                                                            <?php echo $c_yoa ?>&nbsp Admission <span class="col-amber"></span>
                                                        </h5>
                                                        <hr>
                                                        <p class="product-description">

                                                        </p>

                                                        <div class="action">
                                                            <a class="btn btn-primary waves-effect"
                                                                href="viewSubject.php?c_id=<?php echo base64_encode($c_id) ?>">ENTER</a>

                                                            <button class="btn btn-info waves-effect" type="button"
                                                                id="updateButton" data-toggle="modal"
                                                                data-target="#updateClassModal"
                                                                data-id1="<?php echo $row['c_name'] ?>"
                                                                data-id5="<?php echo $row['c_id'] ?>"
                                                                data-id2="<?php echo $row['c_batch'] ?>"
                                                                data-id3="<?php echo $row['c_yoa'] ?>"><i
                                                                    class="zmdi zmdi-edit"></i></button>
                                                            <button class="btn btn-info waves-effect" type="button"
                                                                data-toggle="modal" data-id9="<?php echo $row['c_id'] ?>"
                                                                id="subdelbtn" data-target="#openmodeldelsub"><i
                                                                    class="zmdi zmdi-delete"></i></button>
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


        <!--create class modal-->

        <div class="modal fade" id="createClassModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="largeModalLabel">Create class</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form_validation1" method="POST">
                            <div class="form-group form-float">
                                <input type="hidden" class="form-control" id="c_tid" value="<?php echo $tid; ?>">
                                <input type="text" class="form-control" placeholder="Class Name" id="c_name" required>
                            </div>
                            <div class="form-group form-float">
                                <?php
                                $q = "SELECT DISTINCT s_yoa from student";
                                $r = mysqli_query($con, $q);
                                ?>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" id="c_yoa">
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
                                    id="c_batch">
                                    <option disabled selected hidden>Batch</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-round waves-effect" id="create_class"
                            data-dismiss="modal">Create</button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>



        <!-- attendance detail modal-->

        <div class="modal fade" id="attdetail" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="largeModalLabel">Select class & batch</h4>
                    </div>
                    <div class="modal-body">
                        <form id="attform" method="POST" action="a_markattendance.php">
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
                        <form id="viewattform" method="POST" action="a_viewattendanceBD.php">
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
                        <form id="calattform" method="POST" action="a_calculateatt.php">
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





        <!--class update modal -->
        <div class="modal fade" id="updateClassModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="largeModalLabel">Update class</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form_validation1" method="POST">
                            <div class="form-group form-float">
                                <input type="hidden" class="form-control" id="cu_id" value="<?php echo $c_id; ?>">
                                <input type="text" class="form-control" placeholder="Class Name" id="cu_name" required>
                            </div>
                            <div class="form-group form-float">
                                <?php
                                $q = "SELECT DISTINCT s_yoa from student";
                                $r = mysqli_query($con, $q);
                                ?>
                                <select class="form-control show-tick ms select2" data-placeholder="Select" id="cu_yoa">
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
                                    id="cu_batch">
                                    <option disabled selected hidden>Batch</option>
                                    <option>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-round waves-effect" id="updateClass"
                            data-dismiss="modal">Update</button>
                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--Delete modal-->
        <div class="modal fade" id="openmodeldelsub" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-teal">
                    <div class="modal-header">
                        <input type="hidden" id="delsub_id" value=<?php echo $c_id; ?> />
                        <h4 class="title" id="defaultModalLabel">DELETE</h4>
                    </div>
                    <div class="modal-body text-light">Are you sure that you want to delete the classroom</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect text-light" id="confirmdelsubbtn"
                            data-dismiss="modal">CONFIRM</button>
                        <button type="button" class="btn btn-link waves-effect text-light"
                            data-dismiss="modal">CLOSE</button>
                    </div>
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


        <!-- Jquery DataTable Plugin Js -->
        <script src="assets/bundles/datatablescripts.bundle.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/buttons.colVis.min.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/buttons.flash.min.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/buttons.html5.min.js"></script>
        <script src="assets/plugins/jquery-datatable/buttons/buttons.print.min.js"></script>

        <script src="assets/js/pages/tables/jquery-datatable.js"></script>
        <script src="assets/bundles/libscripts.bundle.js"></script>
        <script src="assets/bundles/vendorscripts.bundle.js"></script>
        <script src="assets/bundles/mainscripts.bundle.js"></script>
        <script src="assets/js/pages/ui/notifications.js"></script>
        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="../../js/logout.js"></script>
        <script src="../../js/class.js"></script>
        <!-- mark attendance validation -->
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