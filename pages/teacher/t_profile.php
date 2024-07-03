<?php
session_start();
if (isset($_SESSION['teacher'])) {
    include ('../../php/config.php');
    $t_id = $_SESSION['tid'];
    $sql = "SELECT * FROM teacher where t_id = $t_id";
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

<title>LEAP | Profile</title>
<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- Favicon-->
<link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
<!-- Light Gallery Plugin Css -->
<link rel="stylesheet" href="assets/plugins/light-gallery/css/lightgallery.css">
<link rel="stylesheet" href="assets/plugins/fullcalendar/fullcalendar.min.css">
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

<!-- Main Search -->

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
        <a href="t_index.php"><img src="assets/images/logo.svg" width="25" alt="Aero"><span class="m-l-10">LEAP</span></a>
    </div>
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info">
                    <a class="image" href="t_profile.php"><img src="assets/images/profile_av.jpg" alt="User"></a>
                    <div class="detail">
                        <h4><?php echo $_SESSION['tname'];?></h4>
                        <small>Faculty</small>                        
                    </div>
                </div>
            </li>
            <li class="open"><a href="t_classes.php"><i class="zmdi zmdi-face"></i><span>My classes</span></a></li>
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
                    <h2>Profile</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="t_index.php"><i class="zmdi zmdi-home"></i> Home</a></li>
                        <li class="breadcrumb-item active">Profile</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">                
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                    <a href="t_profileedit.php" class="btn btn-info btn-icon float-right"><i class="zmdi zmdi-edit"></i></a>
                </div>
            </div>
        </div> 
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-lg-4 col-md-12">
                    <div class="card mcard_3">
                        <div class="body">
                            <a href="t_profile.php"><img src="assets/images/profile_av.jpg" class="rounded-circle shadow " alt="profile-image"></a>
                            <h4 class="m-t-10"><?php echo $row['t_name']?></h4>                            
                        </div>
                    </div>
                    <div class="card">
                        <div class="body">
                            <small class="text-muted">Email address: </small>
                            <p><?php echo $row['t_email']?></p>
                            <hr>
                            <small class="text-muted">Phone: </small>
                            <p><?php echo $row['t_phn']?></p>
                            <hr>
                            <small class="text-muted">Role: </small>
                            <?php 
                            if($row['t_role'] == 1)
                            {
                                ?>
                                <p>Admin</p>
                                <?php                               
                            }
                            else
                            {
                                ?>
                                <p>Teacher</p>
                                <?php                                 
                            }
                            ?>
                            
                            <hr>
                        </div>
                    </div>                    
                </div>
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="body">
                            <div id="calendar"></div>
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

<script src="assets/plugins/light-gallery/js/lightgallery-all.min.js"></script> <!-- Light Gallery Plugin Js --> 
<script src="assets/bundles/fullcalendarscripts.bundle.js"></script><!--/ calender javascripts --> 

<script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
<script src="assets/js/pages/medias/image-gallery.js"></script>
<script src="assets/js/pages/calendar/calendar.js"></script>
<script src="../../js/logout.js"></script>
</body>
</html>
<?php
} else {
    header("Location: ../../index.php");
}
?>