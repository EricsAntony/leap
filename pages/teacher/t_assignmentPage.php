<?php
session_start();
if (isset($_SESSION['teacher'])) {
    $con = mysqli_connect("localhost", "root", "", "lms");
    $ass_id = base64_decode($_REQUEST['as_id']);
    $subid = base64_decode($_REQUEST['subid']);
    $sql = "SELECT * from assignment where as_id = $ass_id";
    $result = mysqli_query($con, $sql);
    $row1 = mysqli_fetch_assoc($result);
    ?>
    <?php

    $query1 = "SELECT * FROM document d, student s, subject sb, assignment a WHERE d.d_asid = $ass_id and d.d_sid=s.s_id and d.d_asid=a.as_id and a.as_subid=sb.sub_id";
    $result2 = mysqli_query($con, $query1);
    $count=mysqli_num_rows($result2);

    ?>
    <!doctype html>
    <html class="no-js " lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

        <title>LEAP | Submitted Assignments</title>
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
                    <li><a href="t_viewAssignment.php?sub_id=<?php echo base64_encode($subid) ?>"><i class="zmdi zmdi-assignment"></i><span>Assignments</span></a>
                            </li>
                            <li><a href="t_resources.php?sub_id=<?php echo base64_encode($subid) ?>"><i class="zmdi zmdi-assignment-o"></i><span>Question papers</span></a>
                            </li>
                            <li><a href="t_addmarks.php?sub_id=<?php echo base64_encode($subid)?>"><i class="zmdi zmdi-border-color"></i><span>Internal Marks</a></span></li>
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
                            <h2>
                                <?php echo $row1['as_name'] ?>
                            </h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="t_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Assignment</li>
                            </ul>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">

                        <?php
                            if ($row1['as_file'] != '') {
                                ?>
                            <a href="#" class="btn btn-primary float-right"
                                onclick="window.open('../../php/assignments_folder/<?php echo $row1['as_file']; ?>', '_blank', 'fullscreen=yes','targetWindow',width=1100,height=2000); return false;">View
                                Doc</a>
                                <?php }
                                ?>

                        </div>
                    </div>
                </div>
                <h2>Description</h2>
                <p>
                    <?php echo $row1['as_desc'] ;
                    ?>

                </p>
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-6 col-sm-6">
                            <div class="card state_w1">
                                <div class="body d-flex justify-content-between">
                                    <div>
                                        <h5>
                                            <?php echo $count;
                                            $question = "SELECT count(*) as total FROM student s, assignment a, class c, subject sb WHERE a.as_id=$ass_id AND a.as_subid=sb.sub_id and sb.sub_cid=c.c_id and c.c_yoa=s.s_yoa and c.c_batch=s.s_batch";
                                            $ans = mysqli_query($con,$question);
                                            $r= mysqli_fetch_assoc($ans);

                                            ?>
                                        </h5>
                                        <span>Total Done</span>
                                    </div>
                                    <div class="sparkline" data-type="bar" data-width="97%" data-height="55px"
                                        data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#FFC107">5,2,3,7,6,4,8,1
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="#" data-toggle="modal" data-target="#notsubmitted">
                            <div class="card state_w1">
                                <div class="body d-flex justify-content-between">
                                    <div>
                                        <h5>
                                            <?php echo $r['total'] - $count; ?>
                                        </h5>
                                        <span>Pending</span>
                                    </div>
                                    <div class="sparkline" data-type="bar" data-width="97%" data-height="55px"
                                        data-bar-Width="3" data-bar-Spacing="5" data-bar-Color="#46b6fe">8,2,6,5,1,4,4,3
                                    </div>
                                </div>
                                </a> 
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">

                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="card project_list">
                                <div class="table-responsive">
                                    <table class="table table-hover c_table">
                                        <thead>
                                            <?php
                                            if (mysqli_num_rows($result2) > 0) {
                                                ?>
                                                <tr>
                                                    <th>Name of student</th>
                                                    <th>Date of submission</th>
                                                    <th>Comment</th>
                                                </tr>
                                                <?php
                                            } else {


                                                ?>
                                                <th colspan="6">OOPS! No assignments were submitted</th>
                                                <?php
                                            }
                                            ?>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <?php
                                                while ($row = mysqli_fetch_array($result2)) {
                                                    ?>

                                                    <td><a href="#"
                                                            onclick="window.open('../../php/studentUpload_folder/<?php echo $row['d_name']; ?>', '_blank', 'fullscreen=yes','targetWindow','width=1100,height=1500'); return false;"><?php
                                                               echo $row['s_name'] ?></a></td>
                                                    </td>
                                                    <td>
                                                        <?php if ($row['d_date'] > $row['as_duedate']) {
                                                            echo '<span class="badge badge-warning">' . date("d/m/Y", strtotime($row['d_date'])) .

                                                                '</span>';

                                                        } else {
                                                            $date = date_create($row["d_date"]);
                                                            echo date_format($date, "d/m/Y");

                                                        } ?>
                                                    </td>
                                                    <td><?php echo $row['d_comment']?></td> 
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

        <!-- not submitted students modal -->
        <div class="modal fade" id="notsubmitted" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Not submitted</h4>
                </div>
                <div class="modal-body">
                    <form  method="POST" enctype="multipart/form-data">
                        <?php
                        $q = "SELECT * from student s, class c, subject sub, assignment a where c.c_yoa=s.s_yoa and c.c_batch=s.s_batch and c.c_id=sub.sub_cid and sub.sub_id = as_subid and a.as_id=$ass_id and s_id not in (select d_sid from document where d_asid=$ass_id)";
                        $r = mysqli_query($con, $q);
                        while ($re = mysqli_fetch_assoc($r)) {
                            ?>
                            <div class="form-group form-float">
                                <p>
                                    <?php echo $re['s_name'] ?>
                                </p>
                            </div>
                            <?php
                        }
                        ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger waves-effect" id="closem"
                        data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>


        <script src="assets/bundles/sparkline.bundle.js"></script>
        <script src="assets/js/pages/charts/sparkline.js"></script>
        <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
        <script src="assets/bundles/libscripts.bundle.js"></script>
        <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
        <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->
        <script src="assets/bundles/mainscripts.bundle.js"></script>


        <script src="assets/bundles/sparkline.bundle.js"></script>
        <script src="assets/js/pages/charts/sparkline.js"></script>

        <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
        <script src="../../js/logout.js"></script>


    </html>
    <?php

} else {
    header("Location: ../index.php");
}
?>