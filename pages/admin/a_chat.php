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

        <title>LEAP | Discussion Forum</title>
        <link rel="icon" href="favicon.ico" type="image/x-icon">
        <!-- Favicon-->
        <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
        <!-- JQuery DataTable Css -->
        <link rel="stylesheet" href="assets/plugins/jquery-datatable/dataTables.bootstrap4.min.css">
        <!-- Custom Css -->
        <link rel="stylesheet" href="assets/css/style.min.css">
        <style>
            .txt {
                color: #3ae809;
            }

            .txt1 {
                color: #e80932;
            }
        </style>
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
                                <small>Admin</small>
                            </div>
                        </div>
                    </li>
                    </li>
                    <li class="open"><a href="a_teacher.php"><i class="zmdi zmdi-account-add"></i><span>Teacher</span></a>
                    </li>
                    <li class="open"><a href="a_student.php"><i class="zmdi zmdi-accounts-alt"></i><span>Student</span></a>
                    </li>
                    <li class="open"><a href="a_classes.php"><i class="zmdi zmdi-face"></i><span>My classes</span></a></li>
                    <li class="open"><a href="a_viewQuiz.php?c_id=<?php echo base64_encode($c_id) ?>"><i
                                class="zmdi zmdi-puzzle-piece"></i><span>Quizzes</span></a></li>
                    <li class="open"><a href="a_chat.php?c_id=<?php echo base64_encode($c_id) ?>"><i
                                class="zmdi zmdi-email-open"></i><span>Discussion Forum</span></a></li>
                    <li class="open"><a href="a_announcement.php?c_id=<?php echo base64_encode($c_id) ?>"><i
                                class="zmdi zmdi-email"></i><span>Announcement</span></a></li>


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
                                <li class="breadcrumb-item"><a
                                        href="viewSubject.php?c_id=<?php echo base64_encode($c_id) ?>">Subjects</a>
                                </li>
                                <li class="breadcrumb-item active">Chat</li>
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
                <div class="container-fluid" style="background-color: #fff;">
                    <input type="hidden" id="cid" value="<?php echo $c_id ?>">
                    <input type="hidden" id="sid" value="<?php echo $sid ?>">
                    <div class=" clearfix">
                        <div class="col-lg-12">
                            <div class="cardfd">
                                <div class="chat_window body check-box asas" id="check-box"
                                    style="height: 500px;overflow: auto; ">
                                    <ul class="chat-history" id="parentElement">

                                    </ul>
                                </div><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!--Logout Modal -->
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

        <script src="assets/bundles/libscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->
        <script src="assets/bundles/vendorscripts.bundle.js"></script> <!-- Lib Scripts Plugin Js -->

        <script src="assets/bundles/mainscripts.bundle.js"></script><!-- Custom Js -->
        <script src="../../js/logout.js"></script>
        <script>
            var rowCount = 0;

            $(document).ready(function () {
                // Function to fetch data
                var rowCount = 0;
                function remove() {
                    var containerDiv = document.getElementById('parentElement');

                    while (containerDiv.firstChild) {
                        containerDiv.removeChild(containerDiv.firstChild);
                    }
                }

                function scrollToBottom() {
                    ch = document.getElementById('check-box');
                    ch.scrollTop = ch.scrollHeight;

                }

                function fetchData() {

                    var data = {
                        cid: document.getElementById('cid').value
                    }
                    // Create a single div element to hold the data
                    var containerDiv = document.getElementById('parentElement');
                    var userid = document.getElementById('sid').value;

                    var params = new URLSearchParams(data).toString();
                    // Make an HTTP request to fetch the data
                    fetch('../../php/fetch_data.php?' + params)

                        .then(response => response.json())
                        .then(data => {

                            if (data.length > rowCount) {
                                rowCount = data.length;
                                remove();
                                // Process each row of data
                                data.forEach(row => {

                                    if (userid == row.s_id) {
                                        // Create elements to display the row data
                                        var rowli = document.createElement('li');
                                        var div = document.createElement('div');
                                        var nameSpan = document.createElement('span');
                                        var timeSpan = document.createElement('span');
                                        var mdiv = document.createElement('div');

                                        var date = new Date(row.m_date);
                                        var formattedDatetime = date.toLocaleString();
                                        //class names
                                        rowli.className = 'clearfix';
                                        div.className = 'status online message-data text-right';
                                        nameSpan.className = 'name';
                                        timeSpan.className = 'time';
                                        mdiv.className = 'message other-message float-right';

                                        // Assign the row data to the created elements
                                        timeSpan.textContent = formattedDatetime;
                                        nameSpan.textContent = row.s_name;
                                        mdiv.textContent = row.m_msg;

                                        // Append the row data elements to the row div
                                        rowli.appendChild(div);
                                        div.appendChild(nameSpan);
                                        div.appendChild(timeSpan);
                                        rowli.appendChild(mdiv);

                                        // Append the row div to the container div
                                        containerDiv.appendChild(rowli);
                                        scrollToBottom();

                                    }
                                    else {

                                        var rowli = document.createElement('li');
                                        var div = document.createElement('div');
                                        var nameSpan = document.createElement('span');
                                        var timeSpan = document.createElement('span');
                                        var mdiv = document.createElement('div');
                                        var date = new Date(row.m_date);
                                        var formattedDatetime = date.toLocaleString();
                                        //class names
                                        rowli.className = 'clearfix';
                                        div.className = 'status online message-data text-left';
                                        nameSpan.className = 'name';
                                        timeSpan.className = 'time';
                                        mdiv.className = 'message other-message float-left';

                                        // Assign the row data to the created elements
                                        timeSpan.textContent = formattedDatetime;
                                        nameSpan.textContent = row.s_name;
                                        mdiv.textContent = row.m_msg;

                                        // Append the row data elements to the row div
                                        rowli.appendChild(div);
                                        div.appendChild(nameSpan);
                                        div.appendChild(timeSpan);
                                        rowli.appendChild(mdiv);

                                        // Append the row div to the container div
                                        containerDiv.appendChild(rowli);
                                        scrollToBottom();

                                    }

                                });

                            }

                            // Add the container div to the DOM

                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });

                }
                fetchData();

                setInterval(fetchData, 500);

            });
        </script>
        <script>

        </script>
    </body>

    </html>


    <?php
} else {
    header("Location: ../index.php");
}
?>