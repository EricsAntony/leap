<?php
session_start();
if (isset($_SESSION['student'])) {
    include('../../php/config.php');
    $as_id = base64_decode($_REQUEST['as_id']);
    $subid = base64_decode($_REQUEST['subid']);
    $sid = $_SESSION['sid'];
    $sql = "SELECT * FROM assignment a, subject s where as_id=$as_id and a.as_subid=s.sub_id";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $sql1 = "SELECT * FROM document d where d.d_asid=$as_id and d.d_sid=$sid";
    $r = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_array($r);
    ?>
    <!doctype html>
    <html class="no-js " lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

        <title>LEAP | Assignment Detail</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- Favicon-->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
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

        <section class="content">
            <div class="body_scroll">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <h2>Assignment </h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="s_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Assignment Detail</li>
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
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="body">
                                    <div class="row">
                                        <div class="col-xl-9 col-lg-8 col-md-12">
                                            <div class="product details">
                                                <h3 class="product-title mb-0">
                                                    <?php echo $row['as_name']; ?>
                                                </h3>
                                                <h5 class="price mt-0">Subject: <span class="col-amber">
                                                        <?php echo $row['sub_name']; ?>
                                                    </span></h5>
                                                <hr>
                                                <p class="product-description">
                                                    <?php echo $row['as_desc'] ?>
                                                </p>
                                                <div class="action">
                                                    <?php
                                                    if($row['as_file'] != '')
                                                    {
                                                        ?>
                                                    
                                                    <button class="btn btn-primary waves-effect" type="button"
                                                        onclick="window.open('../../php/assignments_folder/<?php echo $row['as_file']; ?>', '_blank', 'fullscreen=yes','targetWindow',width=1100,height=2000); return false;">View
                                                        doc</button>
                                                        <?php } ?>
                                                    <button class="btn btn-info waves-effect" type="button"
                                                        onclick="window.open('../../php/studentUpload_folder/<?php echo $row1['d_name']; ?>', '_blank', 'fullscreen=yes','targetWindow',width=1100,height=2000); return false;">View
                                                        Uploaded
                                                        doc</button>
                                                    <button class="btn btn-success waves-effect" type="button"
                                                        data-toggle="modal" data-target="#uploadAssignmentModal"
                                                        id="uploadbtn"><i class="zmdi zmdi-upload"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <!--Upload assignment modal-->

        <div class="modal fade" id="uploadAssignmentModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="title" id="largeModalLabel">Upload Assignment</h4>
                    </div>
                    <div class="modal-body">
                        <form id="form_validation" method="POST" enctype="multipart/form-data">
                            <div class="form-group form-float">
                                <input type="hidden" id="as_id" class="form-control" value="<?php echo $row['as_id']; ?>">
                                <input type="hidden" id="as_sid" class="form-control"
                                    value="<?php echo $_SESSION['sid']; ?>">
                            </div>

                            <div class="form-group form-float">
                                <input type="file" id="as_file" name="file" class="form-control file"
                                    placeholder="Choose file" required onchange="fileValidation()">
                            </div>
                            <div class="form-group form-float">
                                <input type="text" id="as_comment" class="form-control"
                                    placeholder="private comment (if any)" required>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" id="uploadAssignment" data-dismiss="modal"
                            class="btn btn-default btn-round waves-effect">UPLOAD</button>
                        <button type="button" class="btn btn-danger waves-effect" id="closem"
                            data-dismiss="modal">CLOSE</button>
                    </div>
                    </form>
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
                        <button type="button" class="btn btn-link waves-effect text-light"
                            data-dismiss="modal">CLOSE</button>
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

            <!-- Jquery Core Js -->
            <script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
            <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

            <script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
            <script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
            <script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
            <script src="../../js/logout.js"></script>
            <script>
                function fileValidation() {
                    var fileInput = document.getElementById('as_file');
                    var filePath = fileInput.value;
                    var allowedExtensions = /(\.pdf)$/i;
                    if (!allowedExtensions.exec(filePath)) {
                        showNotification("alert-danger", "Please Select pdf file ", "bottom", "right", "", "")
                        fileInput.value = '';
                        return false;
                    }
                    else
                        document.getElementById('upload_note').disabled = false;
                }
            </script>
            <script>
                $("#uploadAssignment").click(function () {
                    var assid = $('#as_id').val().trim();
                    var asssid = $('#as_sid').val().trim();
                    var comment = $('#as_comment').val().trim();
                    var file_data = $('#as_file').prop('files')[0];
                    var form_data = new FormData();
                    console.log(comment);
                    form_data.append('file_up', file_data);
                    form_data.append('as_id', assid);
                    form_data.append('as_sid', asssid);
                    form_data.append('as_comment', comment);

                    //debugger
                    $.ajax({
                        url: '../../php/uploadAssignment.php',
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            if (response == 1) {
                                showNotification("alert-success", "Assignment Uploaded", "bottom", "right", "", "")
                                location.reload();

                            }
                            else {
                                showNotification("alert-danger", "Select a file to upload", "bottom", "right", "", "")
                            }

                        }
                    });
                });
            </script>
        </body>

        </html>
        <?php
} else {
    header("Location: ../index.php");
}
?>