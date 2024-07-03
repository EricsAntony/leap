<?php
$con = mysqli_connect("localhost", "root", "", "lms");
session_start();
$c_id = base64_decode($_REQUEST['c_id']);
$q = mysqli_query($con, "SELECT c_name FROM `class` WHERE c_id = '$c_id' ");
$r = mysqli_fetch_assoc($q);
$sql = "SELECT * from `quiz` where q_cid = $c_id order by q_id desc";
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

        <title>LEAP | Quiz</title>
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
                    <li class="open"><a href="#"><i class="zmdi zmdi-puzzle-piece"></i><span>Quizzes</span></a></li>
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

        <input type="hidden" id="subid" name="subid" value="<?php echo $subid ?>" />
        <section class="content">
            <div class="body_scroll">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <h2><?php echo $r['c_name']?></h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="t_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>

                                <li class="breadcrumb-item active">Quizzes</li>
                            </ul>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <a href="#" class="btn btn-primary float-right" data-toggle="modal" data-target="#resourceModal">Create a quiz</i></a>
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
                                            <th>Title</th>
                                            <th>Time alloted</th>
                                            <th>Action</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($res)) {
                                                ?>
                                                <tr>

                                                    <td><a href="t_questions.php?c_id=<?php echo base64_encode($c_id)?>&amp;q_id=<?php echo base64_encode($row['q_id'])?>" title="view quiz">
                                                            <?php echo $row['q_title'] ?>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['q_timer'] ?>
                                                    </td>
                                                    
                                                    <td><a href="javascript:void(0);"
                                                            class="btn btn-default waves-effect waves-float btn-sm waves-red"
                                                            data-toggle="modal" data-target="#updateQuizModal"
                                                            data-id1="<?php echo $row['q_id']; ?>" 
                                                            data-title="<?php echo $row['q_title']; ?>"
                                                            data-min="<?php $sp = explode(':',$row['q_timer']); echo $sp[0]; ?>"
                                                            data-sec="<?php echo $sp[1]; ?>"
                                                            data-desc="<?php echo $row['q_desc']; ?>"id="editbtn"><i
                                                                class="zmdi zmdi-edit"></i></a>
                                                        <a href="javascript:void(0);"
                                                            class="btn btn-default waves-effect waves-float btn-sm waves-red float"
                                                            data-toggle="modal" data-target="#deleteResource"
                                                            data-id1="<?php echo $row['q_id']; ?>" id="delbtn"><i
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



    <!--Add a quiz modal-->

    <div class="modal fade" id="resourceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Create a quiz</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">
                        <div class="form-group form-float">
                            <input type="hidden" id="q_cid" value=<?php echo $c_id; ?>>
                            <input type="text" class="form-control" placeholder="Title" required id="q_title">
                        </div>
                        <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">                                    
                                        <input type="text" class="form-control" id="q_min" placeholder="min(00)" />                                   
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">                                   
                                        <input type="text" class="form-control" id="q_sec" placeholder="sec(00)" />                                    
                                    </div>
                                </div>
                            </div>
                        <div class="form-group form-float">
                            <textarea rows="10" cols="75" placeholder="Description" id="q_desc" class="form-control"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="addquiz" data-dismiss="modal"
                        class="btn btn-default btn-round waves-effect">CREATE</button>
                    <button type="button" class="btn btn-danger waves-effect" id="closem"
                        data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Update quiz modal-->

    <div class="modal fade" id="updateQuizModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Update quiz</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">
                        <div class="form-group form-float">
                            <input type="hidden" id="qu_id">
                            <input type="text" class="form-control" placeholder="Title" required id="qu_title">
                        </div>
                        <div class="row clearfix">
                                <div class="col-sm-6">
                                    <div class="form-group">                                    
                                        <input type="text" class="form-control" id="qu_min" placeholder="min(00)" />                                   
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">                                   
                                        <input type="text" class="form-control" id="qu_sec" placeholder="sec(00)" />                                    
                                    </div>
                                </div>
                            </div>
                        <div class="form-group form-float">
                            <textarea rows="10" cols="75" placeholder="Description" id="qu_desc" class="form-control"></textarea>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="updatequiz" data-dismiss="modal"
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
                        id="delquizconfirm">CONFIRM</button>
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
    <script src="../../js/quiz.js"></script>
<html>




    <?php
} else {
    header("Location: ../index.php");
}
?>