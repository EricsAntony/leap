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

        <title>LEAP | Notes</title>
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
                  
                            <li><a href="a_viewAssignment.php?sub_id=<?php echo base64_encode($subid) ?>"><i class="zmdi zmdi-assignment"></i><span>Assignments</span></a>
                            </li>
                            <li><a href="a_resources.php?sub_id=<?php echo base64_encode($subid) ?>"><i class="zmdi zmdi-assignment-o"></i><span>Question papers</span></a>
                            </li>
                            <li><a href="a_addmarks.php?sub_id=<?php echo base64_encode($subid)?>"><i class="zmdi zmdi-border-color"></i><span>Internal Marks</a></span></li>

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

        <input type="hidden" id="subid" name="subid" value="<?php echo $subid ?>" />
        <section class="content file_manager">
            <div class="body_scroll">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <h2>Notes</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="a_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item"><a href="viewSubject.php?c_id=<?php echo base64_encode($row['sub_cid']);?>">Subjects</a></li>
                                <li class="breadcrumb-item active">Notes</li>
                            </ul>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                    class="zmdi zmdi-arrow-right" ></i></button>
                            <button class="btn btn-success btn-icon float-right" type="button" id="nupload" data-sub_id="<?php echo $subid?>" data-toggle="modal"
                                data-target="#noteUploadModal"><i
                                    class="zmdi zmdi-upload"></i></button>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="doc">
                                        <div class="row clearfix">
                                            <?php
                                            include "../../php/config.php";
                                            $tid = $_SESSION['tid'];
                                            $query = "select * from notes where n_subid='$subid' order by n_id desc ";
                                            $result = mysqli_query($con, $query);
                                            $count = 1;
                                            while ($row = mysqli_fetch_array($result)) {
                                                ?>
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <div class="card">
                                                        <div class="file">
                                                            <a href="#" data-toggle="modal"
                                data-target="#colorModalDeleteNote" id="delNote" data-n_id="<?php echo $row['n_id'];?>">
                                                                <div class="hover">
                                                                    <button type="button"
                                                                        class="btn btn-icon btn-icon-mini btn-round btn-danger" >
                                                                        <i class="zmdi zmdi-delete"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="icon">
                                                                    <i class="zmdi zmdi-file-text"></i>
                                                                </div>
                                                                <div class="file-name">
                                                                    <p class="m-b-5 text-muted"><a href="#" onclick="window.open('../../php/notes_folder/<?php echo $row['n_fname']; ?>', '_blank', 'fullscreen=yes','targetWindow',width=1100,height=2000); return false;"><?php echo $row['n_name']?></a></p>
                                                                    <small>Date of upload <span class="date text-muted"><?php echo date("d/m/Y", strtotime($row['n_date']));?></span></small>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            </div>
                                            
                                    </div>
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

    <!--Note upload modal-->

    <div class="modal fade" id="noteUploadModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Note upload</h4>
                </div>
                <div class="modal-body">
                    <form id="form_validation" method="POST" enctype="multipart/form-data">
                    <div class="form-group form-float">
                        <input type="hidden" id="n_subid" class="form-control" value=<?php echo $subid; ?>>
                            <input type="file" id="n_file" name="file" accept=".pdf" class="form-control file" onchange="fileValidation()" placeholder="Choose file"
                            required>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" id="upload_note" data-dismiss="modal"
                        class="btn btn-default btn-round waves-effect" disabled>UPLOAD</button>
                    <button type="button" class="btn btn-danger waves-effect" id="closem"
                        data-dismiss="modal">CLOSE</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!--Delete assignment modal-->
    <div class="modal fade" id="colorModalDeleteNote" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content bg-teal">
                <div class="modal-header">
                    <h4 class="title" id="defaultModalLabel">DELETE</h4>
                </div>
                <div class="modal-body text-light">Are you sure that you want to delete the note</div>
                <div class="modal-footer">
                    <input type="hidden" id="ass_id">
                    <button type="button" class="btn btn-link waves-effect text-light" data-dismiss="modal"
                        id="delnoteconfirm">CONFIRM</button>
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
    <script src=../../js/notes.js></script>
    <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
        <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
        <script src="assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->
    <script src="../../js/logout.js"></script>
    <script>
        function fileValidation(){
    var fileInput = document.getElementById('n_file');
    var filePath = fileInput.value;
    var allowedExtensions = /(\.pdf)$/i;
    if(!allowedExtensions.exec(filePath)){
        showNotification("alert-danger", "Please Select pdf file ", "bottom", "right", "", "")
        fileInput.value = '';
        return false;
    }
    else
    document.getElementById('upload_note').disabled=false;
}
        </script> 


    <?php
} else {
    header("Location: ../index.php");
}
?>