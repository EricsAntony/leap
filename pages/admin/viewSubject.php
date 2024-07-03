<?php
$con = mysqli_connect("localhost", "root", "", "lms");
session_start();
$c_id = base64_decode($_REQUEST['c_id']);
$q = mysqli_query($con, "SELECT c_name FROM `class` WHERE c_id = '$c_id' ");
$r = mysqli_fetch_assoc($q);
$sql = "SELECT * from `subject` where sub_cid = $c_id";
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
                            class="zmdi zmdi-comment-alt-text "></i></a></li>
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
                    <li class="open"><a href="a_viewQuiz.php?c_id=<?php echo base64_encode($c_id)?>"><i class="zmdi zmdi-puzzle-piece"></i><span>Quizzes</span></a></li>
                    <li class="open"><a href="a_chat.php?c_id=<?php echo base64_encode($c_id)?>"><i class="zmdi zmdi-email-open"></i><span>Discussion Forum</span></a></li>
                    <li class="open"><a href="a_announcement.php?c_id=<?php echo base64_encode($c_id)?>"><i class="zmdi zmdi-email"></i><span>Announcement</span></a></li>
                </ul>
            </div>
        </aside>

        <!-- Right Sidebar -->
        <aside id="rightsidebar" class="right-sidebar">

            <div class="tab-pane right_chat" id="chat">
                <div class="slim_scroll">
                    <?php
                    $q = "SELECT * FROM announcement WHERE an_cid=$c_id and value='1' order by an_id desc";
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
                                                <?php
                                                    $er = mysqli_query($con, "SELECT s_name FROM student WHERE s_id = ".$s['an_sid']);
                                                    $re = mysqli_fetch_assoc($er);
                                                    echo $re['s_name'];
                                                ?>
                                            </span><br>
                                            <?php echo $s['an_topic'] ?>
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
                                <li class="breadcrumb-item"><a href="a_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Subjects</li>
                            </ul>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <a class="btn btn-primary float-right" href="#" data-toggle="modal"
                                data-target="#addSubject">Add a subject</a>
                            <a class="btn btn-success float-right" href="#" data-toggle="modal"
                                data-target="#viewStudents">View students</a>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row clearfix">
                        <?php
                        include "../../php/config.php";
                        $tid = $_SESSION['tid'];
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
                                        <a href="a_notes.php?sub_id=<?php echo base64_encode($sub_id) ?>"> <img
                                                src="assets/images/subject.png" alt="Product" class="img-fluid cp_img" /></a>
                                        <div class="product_details">
                                            <center>
                                                <h6><a href="a_notes.php?sub_id=<?php echo base64_encode($sub_id) ?>">
                                                        <?php echo $sub_name; ?>
                                                    </a></h6>
                                            </center>
                                            <ul class="product_price list-unstyled">
                                                <li class="old_price"></li>
                                            </ul>
                                        </div>
                                        <div class="action">
                                            <a href="#" class="btn btn-info waves-effect" data-toggle="modal"
                                                data-target="#updateSubject" id="updateSubjectButton"
                                                data-id1="<?php echo $row['sub_name'] ?>"
                                                data-id2="<?php echo $row['sub_id'] ?>"><i class="zmdi zmdi-edit"></i></a>
                                            <a href="#" class="btn btn-info waves-effect" data-toggle="modal"
                                                data-target="#delSubject"><i class="zmdi zmdi-delete"></i></a>
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

    <!--Add subject modal-->

    <div class="modal fade" id="addSubject" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Subject</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">
                        <div class="form-group form-float">
                            <input type="text" id="sub_name" class="form-control" placeholder="Subject name" required>
                            <input type="hidden" id="sub_cid" class="form-control" value="<?php echo $c_id; ?>" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirmaddsubject" data-dismiss="modal"
                        class="btn btn-default btn-round waves-effect">ADD</button>
                    <button type="button" class="btn btn-danger waves-effect" id="closem"
                        data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Update subject modal-->

    <div class="modal fade" id="updateSubject" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Update Subject</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation1" method="POST">
                        <div class="form-group form-float">
                            <input type="hidden" id="su_subid">
                            <input type="text" class="form-control" placeholder="Subject name" required id="su_name">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-round waves-effect" id="confirmupdatesubject"
                        data-dismiss="modal">UPDATE</button>
                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Delete assignment modal-->
    <div class="modal fade" id="delSubject" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-teal">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">DELETE</h4>
                </div>
                <div class="modal-body text-light">Are you sure that you want to delete the Subject. All data and files
                    associated with this subject will be removed</div>
                <div class="modal-footer">
                    <input type="hidden" id="sd_subid" value="<?php echo $sub_id; ?>">
                    <button type="button" class="btn btn-link waves-effect text-light" data-dismiss="modal"
                        id="delsubjectconfirm">CONFIRM</button>
                    <button type="button" class="btn btn-link waves-effect text-light" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

    <!--View student modal-->

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
                                    <?php echo $re['s_name'] ?> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp -
                                    <?php echo $re['s_email'] ?>
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

    <!--View announcements modal-->

    <div class="modal fade" id="viewannouncementModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Message</h4>
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


    <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
    <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
    <script src="assets/bundles/libscripts.bundle.js"></script>
    <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- slimscroll, waves Scripts Plugin Js -->
    <script src="assets/bundles/mainscripts.bundle.js"></script>
    <script src="../../js/logout.js"></script>
    <script src="../../js/subject.js"></script>
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