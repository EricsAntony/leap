<?php
$con = mysqli_connect("localhost", "root", "", "lms");
session_start();
$subid = base64_decode($_REQUEST['sub_id']);
$sql = "SELECT * from `subject` where sub_id = $subid";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
if (isset($_SESSION['teacher'])) {
    ?>
    <!doctype html>
    <html class="no-js " lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

        <title>LEAP | Assignments</title>
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
                    <li><a href="t_viewAssignment.php?sub_id=<?php echo base64_encode($subid) ?>"><i
                                class="zmdi zmdi-assignment"></i><span>Assignments</span></a>
                    </li>
                    <li><a href="t_resources.php?sub_id=<?php echo base64_encode($subid) ?>"><i
                                class="zmdi zmdi-assignment-o"></i><span>Question papers</span></a>
                    </li>
                    <li><a href="t_addmarks.php?sub_id=<?php echo base64_encode($subid) ?>"><i
                                class="zmdi zmdi-border-color"></i><span>Internal Marks</a></span></li>

                </ul>
            </div>
        </aside>

        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">
            <ul class="nav nav-tabs sm">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#setting"><i
                            class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#chat"><i
                            class="zmdi zmdi-comments"></i></a></li>
            </ul>
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
                            <h2>
                                <?php echo $row["sub_name"] ?>
                            </h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="t_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>

                                <li class="breadcrumb-item active">Assignments</li>
                            </ul>

                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <button class="btn btn-primary float-right " type="button" href='#' data-toggle="modal"
                                data-target="#largeModalSchedule">Schedule an assignment</button>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table table-hover product_item_list c_table theme-color mb-0">
                                        <thead>
                                            <tr>
                                                <th>Assignment name</th>
                                                <th>Due date</th>
                                                <th data-breakpoints="sm xs">File</th>
                                                <th data-breakpoints="sm xs md">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                include "../../php/config.php";
                                                $query = "select * from assignment where as_subid='$subid' order by as_id desc";
                                                $result = mysqli_query($con, $query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <td><a
                                                            href="t_assignmentPage.php?as_id=<?php echo base64_encode($row['as_id']) ?>&amp;subid=<?php echo base64_encode($subid) ?>">
                                                            <?php echo $row['as_name']; ?>
                                                        </a></td>
                                                    <td>
                                                        <?php echo date("d/m/Y", strtotime($row['as_duedate'])); ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if ($row['as_file'] == "") {

                                                        } else {

                                                            ?>
                                                            <a href="#"
                                                                onclick="window.open('../../php/assignments_folder/<?php echo $row['as_file']; ?>', '_blank', 'fullscreen=yes','targetWindow',width=1100,height=2000); return false;">View
                                                                file </a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-default waves-effect waves-float btn-sm waves-green"
                                                            data-toggle="modal" data-target="#largeModalUpdateAssignment"
                                                            data-id1="<?php echo $row['as_id']; ?>"
                                                            data-id2="<?php echo $row['as_name']; ?>"
                                                            data-id3="<?php echo $row['as_file']; ?>"
                                                            data-id4="<?php echo $row['as_desc']; ?>"
                                                            data-id5="<?php echo $row['as_duedate']; ?>" id="updateassbtn"><i
                                                                class="zmdi zmdi-edit"></i></a>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-default waves-effect waves-float btn-sm waves-red"
                                                            data-toggle="modal" data-target="#colorModalDeleteAssignment"
                                                            data-id1="<?php echo $row['as_id']; ?>" id="delbtn"><i
                                                                class="zmdi zmdi-delete"></i></a>
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
        </section>

        <!-- Jquery DataTable Plugin Js -->
        <script src="assets/bundles/datatablescripts.bundle.js"></script>

        <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
        <!-- Bootstrap Notify Plugin Js -->
        <script src="assets/js/pages/tables/footable.js"></script><!-- Custom Js -->

    </html>

    <!--Schedule an assignment modal-->

    <div class="modal fade" id="largeModalSchedule" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Assignment</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">
                        <div class="form-group form-float">
                            <input type="hidden" id="as_subid" class="form-control" value=<?php echo $subid; ?>>
                            <input type="text" id="as_name" class="form-control" placeholder="Assignment name" required>
                        </div>
                        <div class="form-group form-float">
                            <div class="input-group masked-input">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i></span>
                                </div>
                                <input type="date" class="form-control date" name="ddate"
                                    placeholder="Due date Ex: 30/07/2016" id="as_duedate">
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <input type="file" id="as_file" name="file" class="form-control file" placeholder="Choose file"
                                onchange="fileValidation()" required>
                        </div>
                        <div class="form-group form-float">
                            <textarea id="as_desc" cols="30" rows="5" placeholder="Description"
                                class="form-control no-resize" required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="addassignment" data-dismiss="modal"
                        class="btn btn-default btn-round waves-effect">ASSIGN</button>
                    <button type="button" class="btn btn-danger waves-effect" id="closem"
                        data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Update assignment details modal-->

    <div class="modal fade" id="largeModalUpdateAssignment" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Update Assignment</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation1" method="POST">
                        <div class="form-group form-float">
                            <input type="hidden" id="updt_ass_id">
                            <input type="text" class="form-control" placeholder="Assignment Name" required id="assname">
                        </div>
                        <div class="form-group form-float">
                            <div class="input-group masked-input">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="zmdi zmdi-calendar"></i> &nbspDue Date</span>
                                </div>
                                <input type="date" id="date_picker" class="form-control date">
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <input type="file" id="file_up" name="file_up" class="form-control file"
                                placeholder="Choose file" onchange="fileValidationUp()" required>
                        </div>
                        <div class="form-group form-float">
                            <textarea id="des" cols="30" rows="5" placeholder="Description" class="form-control no-resize"
                                required></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-round waves-effect" id="confirmupdateassignment"
                        data-dismiss="modal">UPDATE</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Delete assignment modal-->
    <div class="modal fade" id="colorModalDeleteAssignment" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-teal">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">DELETE</h4>
                </div>
                <div class="modal-body text-light">Are you sure that you want to delete the assignment</div>
                <div class="modal-footer">
                    <input type="hidden" id="ass_id">
                    <button type="button" class="btn btn-link waves-effect text-light" data-dismiss="modal"
                        id="delassignmentconfirm">CONFIRM</button>
                    <button type="button" class="btn btn-link waves-effect text-light" data-dismiss="modal">CLOSE</button>
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
                    <button type="button" class="btn btn-link waves-effect text-light" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

   
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->
    <script src="assets/bundles/mainscripts.bundle.js"></script>
    <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
<script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
    <script src=../../js/assignment.js></script>
    <script src="../../js/logout.js"></script>
    <script language="javascript">
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;
        $('#as_duedate').attr('min', today);
        $('#date_picker').attr('min', today);
    </script>

    <?php
} else {
    header("Location: ../index.php");
}
?>