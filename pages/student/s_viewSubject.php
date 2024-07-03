<?php
$con = mysqli_connect("localhost", "root", "", "lms");
session_start();
$c_id = base64_decode($_REQUEST['c_id']);
$q = mysqli_query($con, "SELECT c_name FROM `class` WHERE c_id = '$c_id' ");
$r = mysqli_fetch_assoc($q);
$sid = $_SESSION['sid'];
$sql = "SELECT * from `subject` where sub_cid = $c_id";
$res = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($res);
if (isset($_SESSION['student'])) {
    ?>
    <!doctype html>
    <html class="no-js " lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

        <title>LEAP | Subjects</title>
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
                            class="zmdi zmdi-comments zmdi-hc"></i></a></li>
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
                    <li class="open"><a href="s_index.php"><i class="zmdi zmdi-account-add"></i><span>My Classes</span></a>
                    </li>
                    <li class="open"><a href="#" data-toggle="modal" data-target="#toTeacherModal"><i class="zmdi zmdi-email"></i><span>Write to teacher</span></a>
                    </li>
                    <li class="open"><a href="s_viewQuiz.php?c_id=<?php echo base64_encode($c_id)?>"><i class="zmdi zmdi-puzzle-piece"></i><span>Quizzes</span></a>
                    <li class="open"><a href="s_chat.php?c_id=<?php echo base64_encode($c_id) ?>"><i
                                class="zmdi zmdi-email-open"></i><span>Discussion Forum</span></a></li>
                </li>
                </ul>
            </div>
        </aside>

        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">

            <div class="tab-pane right_chat" id="chat">
                <div class="slim_scroll">
                    <?php
                    $q = "SELECT * FROM announcement WHERE an_cid=$c_id and value='0' order by an_id desc";
                    $w = mysqli_query($con, $q);
                    while ($s = mysqli_fetch_assoc($w)) {
                        ?>
                        <div class="card">
                            <ul class="list-unstyled">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#viewannouncementModal"
                                    id="viewAnBtn" data-an_id="<?php echo $s['an_desc'] ?>">
                                    <div class="media">
                                    <img class="media-object " src="assets/images/message.png" alt="">
                                        <div class="media-body">
                                            <span class="name">
                                                <?php echo $s['an_topic'] ?>
                                            </span><br>
                                            <span class="message">
                                                <?php echo date("d/m/Y", strtotime($s['an_date'])); ?>
                                            </span>
                                            
                                        </div>
                                    </div>
                                </a>

                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>

        </aside>

        <input type="hidden" id="subid" name="subid" value="<?php echo $subid ?>" />
        <section class="content">
            <div class="body_scroll">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <h2><?php echo $r['c_name']?></h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="s_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Subjects</li>
                            </ul>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <a class="btn btn-success float-right" href="#" data-toggle="modal"
                                data-target="#viewStudents">View classmates</a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row clearfix">
                        <?php
                        include "../../php/config.php";
                        $tid = $_SESSION['sid'];
                        $query = "select * from subject where sub_cid='$c_id' order by sub_id desc ";
                        $result = mysqli_query($con, $query);
                        $count = 1;
                        while ($row = mysqli_fetch_array($result)) {
                            $sub_name = $row['sub_name'];
                            $sub_id = $row['sub_id'];
                            ?>
                            <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                                <div class="card">
                                    <div class="body product_item">
                                        <a href="s_notes.php?sub_id=<?php echo base64_encode($sub_id) ?>"><img
                                                src="assets/images/subject.png" alt="Product" class="img-fluid cp_img" /></a>
                                        <div class="product_details">
                                            <center>
                                                <h6><a href="s_notes.php?sub_id=<?php echo base64_encode($sub_id) ?>">
                                                        <?php echo $sub_name; ?>
                                                    </a></h6>
                                            </center>
                                            <ul class="product_price list-unstyled">
                                                <li class="old_price"></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
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

    <!--View classmates modal-->

    <div class="modal fade" id="viewStudents" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Students in classroom</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">
                        <?php
                        $q = "SELECT * FROM student s, class c WHERE s.s_batch=c.c_batch and s.s_yoa=c.c_yoa and c.c_id=$c_id";
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

    <!--View announcements modal-->

    <div class="modal fade" id="viewannouncementModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Announcement</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">

                        <div class="form-group form-float">
                            <textarea rows="10" cols="85" id="an_field" class="form-control" readonly></textarea>

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

      <!--Student sent message modal-->

      <div class="modal fade" id="toTeacherModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Send Message</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">
                        <div class="form-group form-float">
                            <input type="hidden" id="s_cid" value="<?php echo $c_id?>">
                            <input type="hidden" id="s_sid" value="<?php echo $sid?>">
                            <input type="text" class="form-control" placeholder="Subject of the message" id="s_title" required><br>
                            <textarea rows="10" cols="85" id="message" class="form-control" placeholder="Content here..."required></textarea>

                        </div>
                </div>
                <div class="modal-footer">
                <input type="submit" type="button" id="s_sendmessage" data-dismiss="modal"
                            class="btn btn-default btn-round waves-effect" value="SEND">
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
    <script src="../../js/message.js"></script>
    <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script>
    <script>
        $(document).on('click', '#viewAnBtn', function () {

            var a_id = $(this).data("an_id");
            document.getElementById("an_field").value = a_id;


        });
    </script>

    <?php
} else {
    header("Location: ../index.php");
}
?>