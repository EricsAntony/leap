<?php
$con = mysqli_connect("localhost", "root", "", "lms");
session_start();
$date1 = $_POST['date1'];
$date2 = $_POST['date2'];
$batch = $_POST['batch'];
$yoa = $_POST['yoa'];
$sql = "SELECT * from `student`, `att` where at_sid=s_id and s_batch='$batch' and s_yoa='$yoa' and at_date BETWEEN '$date1' AND '$date2'";
$res = mysqli_query($con, $sql);
if (isset($_SESSION['teacher'])) {
    ?>

    <!doctype html>
    <html class="no-js " lang="en">


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

        <title>LEAP | View Attendance</title>
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
                            <h2>Attendances</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="t_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Attendance Sheet</li>
                            </ul>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">

                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <?php
                $t = mysqli_query($con, "SELECT count(DISTINCT at_date) as count FROM `att` WHERE at_date BETWEEN '$date1' AND '$date2'");
                $r = mysqli_fetch_assoc($t);
                ?>
                Number of working days: &nbsp&nbsp
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
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Period 1</th>
                                                <th>Period 2</th>
                                                <th>Period 3</th>
                                                <th>Period 4</th>
                                                <th>Period 5</th>
                                                <th>Period 6</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo date('d/m/y', strtotime($row['at_date'])) ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['s_name'] ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($row['at_p1'] == 0)
                                                            echo 'Absent';
                                                        else
                                                            echo 'Present' ?>
                                                        </td>
                                                        <td>
                                                        <?php if ($row['at_p2'] == 0)
                                                            echo 'Absent';
                                                        else
                                                            echo 'Present' ?>
                                                        </td>
                                                        <td>
                                                        <?php if ($row['at_p3'] == 0)
                                                            echo 'Absent';
                                                        else
                                                            echo 'Present' ?>
                                                        </td>
                                                        <td>
                                                        <?php if ($row['at_p4'] == 0)
                                                            echo 'Absent';
                                                        else
                                                            echo 'Present' ?>
                                                        </td>
                                                        <td>
                                                        <?php if ($row['at_p5'] == 0)
                                                            echo 'Absent';
                                                        else
                                                            echo 'Present' ?>
                                                        </td>
                                                        <td>
                                                        <?php if ($row['at_p6'] == 0)
                                                            echo 'Absent';
                                                        else
                                                            echo 'Present' ?>
                                                        </td>
                                                        <td><a href="javascript:void(0);"
                                                                class="btn btn-default waves-effect waves-float btn-sm waves-red "
                                                                data-toggle="modal" data-target="#changeattendance"
                                                                data-id1="<?php echo $row['at_id']; ?>"
                                                            data-name="<?php echo $row['s_name']; ?>"
                                                            data-p1="<?php echo $row['at_p1']; ?>"
                                                            data-p2="<?php echo $row['at_p2']; ?>"
                                                            data-p3="<?php echo $row['at_p3']; ?>"
                                                            data-p4="<?php echo $row['at_p4']; ?>"
                                                            data-p5="<?php echo $row['at_p5']; ?>"
                                                            data-p6="<?php echo $row['at_p6']; ?>" id="changebtn"><i
                                                                class="zmdi zmdi-refresh"></i></a></td>
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


        <!--Change attendance modal-->

        <div class="modal fade" id="changeattendance" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="largeModalLabel">Change Attendance</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form_validation" method="POST" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <input type="hidden" id="a_id" class="form-control">
                                <input type="text" id="s_name" class="form-control" readonly>
                            </div>
                            <div class="form-group form-float">
                                <p>Period 1</p>
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p1" value="1">Present
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p1" value="0"> Absent
                            </div>
                            <div class="form-group form-float">
                                <p>Period 2</p>
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p2" value="1">Present
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p2" value="0"> Absent
                            </div>
                            <div class="form-group form-float">
                                <p>Period 3</p>
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p3" value="1">Present
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p3" value="0"> Absent
                            </div>
                            <div class="form-group form-float">
                                <p>Period 4</p>
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p4" value="1">Present
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p4" value="0"> Absent
                            </div>
                            <div class="form-group form-float">
                                <p>Period 5</p>
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p5" value="1">Present
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p5" value="0"> Absent
                            </div>
                            <div class="form-group form-float">
                                <p>Period 6</p>
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p6" value="1">Present
                                &nbsp&nbsp&nbsp &nbsp&nbsp&nbsp<input type="radio" name="p6" value="0"> Absent
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="change" data-dismiss="modal"
                            class="btn btn-default btn-round waves-effect">SAVE</button>
                        <button type="button" class="btn btn-danger waves-effect" id="closem"
                            data-dismiss="modal">CLOSE</button>
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
                                <select class="form-control show-tick ms select2" data-placeholder="Select" name="yoa"
                                    id="cal_yoa">
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
                                <input type="date" class="form-control" placeholder="Choose date" name="date1"
                                    id="cal_date1" />
                            </div>

                            <div class="form-group form-float">
                                <input type="date" class="form-control" placeholder="Choose date" name="date2"
                                    id="cal_date2" />
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
        <script src="assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
        <script src="assets/js/pages/ui/notifications.js"></script>
        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <script src="../../js/logout.js"></script>
        <script src="assets/plugins/jquery-inputmask/jquery.inputmask.bundle.js"></script> <!-- Input Mask Plugin Js -->




        <script>
            $(document).on('click', '#changebtn', function () {

                var a_id = $(this).data("id1");
                var name = $(this).data("name");
                var p1 = $(this).data("p1");
                var p2 = $(this).data("p2");
                var p3 = $(this).data("p3");
                var p4 = $(this).data("p4");
                var p5 = $(this).data("p5");
                var p6 = $(this).data("p6");


                document.getElementById("a_id").value = a_id;
                document.getElementById("s_name").value = name;
                if (p1 == "0") {
                    var radio = document.getElementsByName('p1');
                    radio[1].checked = true;
                }
                else {
                    var radio = document.getElementsByName('p1');
                    radio[0].checked = true;
                }

                if (p2 == 0) {
                    var radio1 = document.getElementsByName('p2');
                    radio1[1].checked = true;
                }
                else {
                    var radio1 = document.getElementsByName('p2');
                    radio1[0].checked = true;
                }

                if (p3 == 0) {
                    var radio2 = document.getElementsByName('p3');
                    radio2[1].checked = true;
                }
                else {
                    var radio2 = document.getElementsByName('p3');
                    radio2[0].checked = true;
                }

                if (p4 == 0) {
                    var radio3 = document.getElementsByName('p4');
                    radio3[1].checked = true;
                }
                else {
                    var radio3 = document.getElementsByName('p4');
                    radio3[0].checked = true;
                }

                if (p5 == 0) {
                    var radio4 = document.getElementsByName('p5');
                    radio4[1].checked = true;
                }
                else {
                    var radio4 = document.getElementsByName('p5');
                    radio4[0].checked = true;
                }

                if (p6 == 0) {
                    var radio5 = document.getElementsByName('p6');
                    radio5[1].checked = true;
                }
                else {
                    var radio5 = document.getElementsByName('p6');
                    radio5[0].checked = true;
                }
            });
            //confirm update btn
            $("#change").click(function () {
                var aid = document.getElementById("a_id").value;
                var p = document.getElementsByName("p1");
                var q = document.getElementsByName("p2");
                var r = document.getElementsByName("p3");
                var s = document.getElementsByName("p4");
                var t = document.getElementsByName("p5");
                var u = document.getElementsByName("p6");

                var p1;
                var p2;
                var p3;
                var p4;
                var p5;
                var p6;

                if (p[0].checked) {
                    p1 = p[0].value;
                }
                else {
                    p1 = p[1].value;
                }

                if (q[0].checked) {
                    p2 = q[0].value;
                }
                else {
                    p2 = q[1].value;
                }

                if (r[0].checked) {
                    p3 = r[0].value;
                }
                else {
                    p3 = r[1].value;
                }


                if (s[0].checked) {
                    p4 = s[0].value;
                }
                else {
                    p4 = s[1].value;
                }

                if (t[0].checked) {
                    p5 = t[0].value;
                }
                else {
                    p5 = t[1].value;
                }

                if (u[0].checked) {
                    p6 = u[0].value;
                }
                else {
                    p6 = u[1].value;
                }

                //debugger
                $.ajax({
                    url: '../../php/updateatt.php',
                    data: { aid: aid, p1: p1, p2: p2, p3: p3, p4: p4, p5: p5, p6: p6 },
                    type: 'post',
                    success: function (response) {
                        console.log(response);
                        if (response == 1) {
                            location.reload();

                        }
                        else {
                            showNotification("alert-danger", "Attendance update failed", "bottom", "right", "", "")
                        }

                    }

                });
            });
        </script>


        <script>
            function get() {
                var d1 = document.getElementById('d1').value;
                var d2 = document.getElementById('d2').value;
                document.cookie = "d1 = " + d1
                document.cookie = "d2 = " + d2
                console.log(d1, d2);
            }
        </script>

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