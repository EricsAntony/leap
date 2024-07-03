<?php
session_start();
if (isset($_SESSION['student'])) {
    include ('../../php/config.php');
    $s_id = $_SESSION['sid'];
    $sql = "SELECT * FROM student where s_id = $s_id";
    $result = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($result);
?>

<!doctype html>
<html class="no-js " lang="en">

<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

<title>LEAP | Update profile</title>
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
        <div class="m-t-30"><img class="zmdi-hc-spin" src="assets/images/loader.svg" width="48" height="48" alt="Aero"></div>
        <p>Please wait...</p>
    </div>
</div>

<!-- Overlay For Sidebars -->
<div class="overlay"></div>


<!-- Right Icon menu Sidebar -->
<div class="navbar-right">
    <ul class="navbar-nav">
        <li><a href="javascript:void(0);" class="js-right-sidebar" title="Setting"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        <li><a href="#" class="mega-menu" title="Log Out" data-toggle="modal" data-target="#colorModal"><i class="zmdi zmdi-power"></i></a></li>    </ul>
    </ul>
</div>

<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <div class="navbar-brand">
        <button class="btn-menu ls-toggle-btn" type="button"><i class="zmdi zmdi-menu"></i></button>
        <a href="#"><img src="assets/images/logo.svg" width="25" alt="Aero"><span class="m-l-10">LEAP</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="s_profile.php"><img src="assets/images/profile_av.jpg" alt="User"></a>
                    <div class="detail">
                        <h4><?php echo $_SESSION['sname'];?></h4>
                        <small>Student</small>                        
                    </div>
                </div>
            </li>
            <li class="open"><a href="s_index.php"><i class="zmdi zmdi-account-add"></i><span>My Classes</span></a></li>       
            <li> <a href="javascript:void(0);" class="menu-toggle"><i
                                class="zmdi zmdi-assignment"></i><span>Attendance</span></a>
                        <ul class="ml-menu">
                            <li><a href="s_viewAttendance.php">View attendance</a></li>
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
                    <h2>Profile Edit</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="s_index.php"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item">Profile</li>
                        <li class="breadcrumb-item active">Edit</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="s_profile.php" class="btn btn-info btn-icon float-right"><i class="zmdi zmdi-check"></i></a>
                </div>
            </div>
        </div> 
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        
                    <div class="card">
                        <div class="header">
                            <h2><strong>Account</strong> Settings</h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-12">
                                    <from action = "adminupdate.php" method = "POST">
                                    <div class="form-group">
                                    <input type="hidden" class="form-control" value="<?php echo $row['s_id'];?>" name="sid" id="s_id">
                                        <input type="text" class="form-control" placeholder="Name" value="<?php echo $row['s_name'];?>" id="s_name">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control" placeholder="Email" value="<?php echo $row['s_email'];?>" id="s_email">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Phone" value="<?php echo $row['s_phn'];?>" id="s_phn">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Admission number" value="<?php echo $row['s_admno'];?>" id="s_admno">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Batch" value="<?php echo $row['s_batch'];?>" id="s_batch">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Year of admission" value="<?php echo $row['s_yoa'];?>" id="s_yoa">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Password" value="<?php echo base64_decode($row['s_pass']);?>" id="s_pass">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <input type="submit" class="btn btn-primary" value = "Save changes" name="save" id="update_profile_st">
                                </div>
                                </form>
                            </div>
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
                <button type="button" class="btn btn-link waves-effect text-light" data-dismiss="modal">CLOSE</button>
            </div>
        </div>
    </div>
</div>


<!-- Jquery Core Js --> 
<script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 
<script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="../../js/update_profile.js"></script>
</body><script src="assets/js/pages/ui/notifications.js"></script> <!-- Custom Js -->
<script src="assets/plugins/bootstrap-notify/bootstrap-notify.js"></script> <!-- Bootstrap Notify Plugin Js -->
<script src="assets/plugins/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->
<script src="../../js/logout.js"></script>

</html>
<?php
} else {
    header("Location: ../../index.php");
}
?>