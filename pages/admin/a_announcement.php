<?php
$con = mysqli_connect("localhost", "root", "", "lms");
session_start();
$c_id = base64_decode($_REQUEST['c_id']);
$q = mysqli_query($con, "SELECT c_name FROM `class` WHERE c_id = '$c_id' ");
$r = mysqli_fetch_assoc($q);
if (isset($_SESSION['teacher'])) {
    ?>
    <!doctype html>
    <html class="no-js " lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

        <title>LEAP | Announcements</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/plugins/summernote/dist/summernote.css" />
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
                                <li class="breadcrumb-item"><a href="a_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Announcements</li>
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
                                <div class="header">
                                    <h2><strong>Write the announcement</strong> Here</h2>
                                </div>
                                <div class="body">
                                    <div class="inline-editosr" >
                                        <input type="hidden" id="c_id" value="<?php echo $c_id?>">
                                        <input type="text" placeholder="Announcement Title" id="an_topic" class="form-control file">
                                        <br>
                                        <textarea rows="8"cols="50" id="an_desc" class="form-control file" placeholder="Content here..."></textarea>
                                        <br><input type="submit" id="sent" class="btn btn-primary  right_icon_toggle_btn" value="Send">
                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="card project_list">
                                <div class="table-responsive">
                                    <table class="table table-hover c_table">
                                        <thead>
                                            <th>Announcement name</th>
                                            <th>Announcement date</th>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $sql = "SELECT * FROM announcement WHERE an_cid=$c_id and value='0' order by an_id desc";
                                            $res = mysqli_query($con,$sql);
                                            while($row=mysqli_fetch_assoc($res))
                                            {
                                                ?>
                                            <tr>
                                            <td><a href="#" data-toggle="modal"
                                                data-target="#announcementModal" data-an_id="<?php echo $row['an_desc'];?>" id="viewAnnouncement"><?php echo $row['an_topic'];?></a></td>
                                                <td><?php echo date("d/m/Y",strtotime($row['an_date']));?></td>
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
<!-- announcement modal -->
        <div class="modal fade" id="announcementModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Content</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="form-group form-float">
                            <textarea rows="10" cols="85" id="field" class="form-control"readonly></textarea>
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
        <script src="assets/plugins/summernote/dist/summernote.js"></script>
        <script src="../../js/logout.js"></script>
        <script src="../../js/announcement.js"></script>
        <script>
            $(document).on('click', '#viewAnnouncement', function () {

var a_id = $(this).data("an_id");
console.log(a_id)
document.getElementById("field").value = a_id;


});
            </script>

    </body>

    </html>

    <?php
} else {
    header("Location: ../index.php");
}
?>