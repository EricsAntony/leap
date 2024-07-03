<?php
$con = mysqli_connect("localhost", "root", "", "lms");
session_start();
$c_id = base64_decode($_REQUEST['c_id']);
$q_id = base64_decode($_REQUEST['q_id']);
$q = mysqli_query($con, "SELECT c_name FROM `class` WHERE c_id = '$c_id' ");
$r = mysqli_fetch_assoc($q);
$sql = "SELECT * from `quiz_questions` where qt_eid = $q_id order by qt_id desc";
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

        <title>LEAP | Quiz questions</title>
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
                    <li class="open"><a href="t_viewQuiz.php?c_id=<?php echo base64_encode($c_id)?>"><i class="zmdi zmdi-puzzle-piece"></i><span>Quizzes</span></a></li>
                    <li class="open"><a href="t_chat.php?c_id=<?php echo base64_encode($c_id)?>"><i class="zmdi zmdi-email-open"></i><span>Discussion Forum</span></a></li>
                    <li class="open"><a href="t_announcement.php?c_id=<?php echo base64_encode($c_id)?>"><i class="zmdi zmdi-email"></i><span>Announcement</span></a></li>
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
                            <h2><?php echo $r['c_name']?></h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="t_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>

                                <li class="breadcrumb-item active">Quiz Questions</li>
                            </ul>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#resourceModal">Add question</i></a>
                            <a href="t_viewbyrank.php?q_id=<?php echo base64_encode($q_id)?>&amp;c_id=<?php echo base64_encode($c_id)?>" class="btn btn-info float-right">View by rank</i></a>
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
                                            <th>Question</th>
                                            <th>Choice 1</th>
                                            <th>Choice 2</th>
                                            <th>choice 3</th>
                                            <th>Choice 4</th>
                                            <th>Correct Answer</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                ?>
                                                <tr>

                                                    <td><a href="#" title="view question">
                                                            <?php echo $row['qt_question'] ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['qt_ans1'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['qt_ans2'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['qt_ans3'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['qt_ans4'] ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['qt_crct'] ?>
                                                    </td>
                                                    <td><a href="javascript:void(0);"
                                                            class="btn btn-default waves-effect waves-float btn-sm waves-red"
                                                            data-toggle="modal" data-target="#updateQuizModal"
                                                            data-id1="<?php echo $row['qt_id']; ?>" 
                                                            data-question="<?php echo $row['qt_question']; ?>"
                                                            data-ans1="<?php echo $row['qt_ans1']; ?>"
                                                            data-ans2="<?php echo $row['qt_ans2']; ?>"
                                                            data-ans3="<?php echo $row['qt_ans3']; ?>"
                                                            data-ans4="<?php echo $row['qt_ans4']; ?>"
                                                            data-crct="<?php echo $row['qt_crct']; ?>"id="editbtnquestion"><i
                                                                class="zmdi zmdi-edit"></i></a>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-default waves-effect waves-float btn-sm waves-red float"
                                                            data-toggle="modal" data-target="#deleteResource"
                                                            data-id1="<?php echo $row['qt_id']; ?>" id="delbtnquestion"><i
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



    <!--Add a quiz question modal-->

    <div class="modal fade" id="resourceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Add a question</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">
                        <div class="form-group form-float">
                            <input type="hidden" id="qt_cid" value=<?php echo $q_id; ?>>
                            <input type="text" class="form-control" placeholder="Question" required id="qt_question">
                        </div>
                        <div class="form-group form-float">
                            <input type="text" id="qt_ans1" class="form-control" placeholder="Answer 1"
                                required>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" id="qt_ans2" class="form-control" placeholder="Answer 2"
                                required>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" id="qt_ans3" class="form-control" placeholder="Answer 3"
                                required>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" id="qt_ans4" class="form-control" placeholder="Answer 4"
                                required>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" id="qt_crct" class="form-control" placeholder="Correct answer"
                                required>
                        </div>
                        
                </div>
                <div class="modal-footer">
                    <button type="button" id="addquestion" data-dismiss="modal"
                        class="btn btn-default btn-round waves-effect">ADD</button>
                    <button type="button" class="btn btn-danger waves-effect" id="closem"
                        data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Update quiz question modal-->

    <div class="modal fade" id="updateQuizModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Update quiz</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">
                    <div class="form-group form-float">
                            <input type="hidden" id="qtu_id">
                            <input type="text" class="form-control" placeholder="Question" required id="qtu_question">
                        </div>
                        <div class="form-group form-float">
                            <input type="text" id="qtu_ans1" class="form-control" placeholder="Answer 1"
                                required>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" id="qtu_ans2" class="form-control" placeholder="Answer 2"
                                required>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" id="qtu_ans3" class="form-control" placeholder="Answer 3"
                                required>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" id="qtu_ans4" class="form-control" placeholder="Answer 4"
                                required>
                        </div>
                        <div class="form-group form-float">
                            <input type="text" id="qtu_crct" class="form-control" placeholder="Correct answer"
                                required>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="updatequestion" data-dismiss="modal"
                        class="btn btn-default btn-round waves-effect">UPDATE</button>
                    <button type="button" class="btn btn-danger waves-effect" id="closem"
                        data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>


    <!--Delete quiz modal-->
    <div class="modal fade" id="deleteResource" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-teal">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">DELETE</h4>
                </div>
                <div class="modal-body text-light">Are you sure that you want to delete the quiz</div>
                <div class="modal-footer">
                    <input type="hidden" id="ass_id">
                    <button type="button" class="btn btn-link waves-effect text-light" data-dismiss="modal"
                        id="delquestionconfirm">CONFIRM</button>
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

    <!-- Lib Scripts Plugin Js ( jquery.v3.2.1, Bootstrap4 js) -->
    
    <script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
    <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
    <!-- Jquery DataTable Plugin Js -->
    <script src="assets/bundles/datatablescripts.bundle.js"></script>
    <script src="assets/js/pages/tables/jquery-datatable.js"></script>
    <script src="assets/js/pages/ui/sweetalert.js"></script>
    <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
    <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
    <script src="assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->
    <script src="assets/bundles/mainscripts.bundle.js"></script>


    <script src="../../js/logout.js"></script>
    <script src="../../js/question.js"></script>
<html>




    <?php
} else {
    header("Location: ../index.php");
}
?>