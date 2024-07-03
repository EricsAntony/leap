<?php
$con = mysqli_connect("localhost", "root", "", "lms");
session_start();
$q_id = base64_decode($_REQUEST['q_id']);
$sql = "SELECT * from `quiz_questions` where qt_eid = $q_id";
$res = mysqli_query($con, $sql);
if (isset($_SESSION['student'])) {
    ?>
    <!doctype html>
    <html class="no-js " lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <meta name="description" content="Responsive Bootstrap 4 and web Application ui kit.">

        <title>LMS | Quiz</title>
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

        <section class="content" id="main" style=" overflow:auto;">
            <div class="body_scroll">
                <div class="block-header">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-sm-12">
                            <h2>Quiz</h2>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="s_index.php"><i class="zmdi zmdi-home"></i> Home</a>
                                </li>
                                <li class="breadcrumb-item active">Quiz</li>
                            </ul>
                            <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                    class="zmdi zmdi-sort-amount-desc"></i></button>
                                    <br><strong>GENERAL INSTRUCTIONS</strong>
                                    <br>
                                    * The candidate should be in an <strong>isolated environment.</strong><br>
                                    * No person should enter the room or pass near by.<br>
                                    * Complete the quiz and <strong>press the submit button</strong> before the time ends.<br>
                                    * The candidate <strong>should not exit the fullscreen mode</strong> at any cost and may lead to disqualification of the candidate.<br>
                                    * The result will be available on the student dashboard once the teacher publishes the results.<br>
                                    * The candidate can only attempt the quiz <strong>once.</strong>
                                    <br>
                                    <br><strong>SPECIAL INSTRUCTIONS</strong>
                                    <br>
                                    <?php 
                                    $er = mysqli_query($con,"SELECT * FROM quiz WHERE q_id=$q_id");
                                    $re = mysqli_fetch_assoc($er);
                                    echo $re['q_desc'];
                                    ?>
                        </div>
                        <div class="col-lg-5 col-md-6 col-sm-12">
                            <button class="btn btn-primary float-right" id="mybut" onclick="myFunction()"
                                onclick="openFullscreen()">START QUIZ</button>
                            <div class="time" id="navbar">Time left :<span id="timer"></span></div>

                        </div>
                    </div>
                </div>
                <div class="container-fluid" id="attempted">
                    <div class="row clearfix">
                        <div class="col-lg-12">
                            <form action="../../php/result.php" method="post" id="form">
                                <div class="card" id="myDIV">
                                    <?php
                                    @$i = 0;
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        ?>
                                        <div class="body">
                                            <div class="row">
                                                <div class="col-xl-9 col-lg-8 col-md-12">
                                                    <div class="product details">

                                                        <h5 class="price mt-0">
                                                            <?php echo $row['qt_question'] ?>
                                                            <input type="hidden" name="q_id" id="qid" value="<?php echo $q_id ?>">
                                                            <input type="hidden" name="s_id" id="sid" value="<?php $sid = $_SESSION['sid'];
                                                            echo $sid ?>">
                                                        </h5>

                                                        <hr>
                                                        <div class="action">
                                                            <input type="radio" value="<?php echo $row['qt_ans1'] ?>"
                                                                name="answer[<?php echo $row['qt_id'] ?>]" />&nbsp&nbsp<?php echo $row['qt_ans1'] ?><br>
                                                            <input type="radio" value="<?php echo $row['qt_ans2'] ?>"
                                                                name="answer[<?php echo $row['qt_id'] ?>]" />&nbsp&nbsp<?php echo $row['qt_ans2'] ?><br>
                                                            <input type="radio" value="<?php echo $row['qt_ans3'] ?>"
                                                                name="answer[<?php echo $row['qt_id'] ?>]" />&nbsp&nbsp<?php echo $row['qt_ans3'] ?><br>
                                                            <input type="radio" value="<?php echo $row['qt_ans4'] ?>"
                                                                name="answer[<?php echo $row['qt_id'] ?>]" />&nbsp&nbsp<?php echo $row['qt_ans4'] ?><br>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                    <br>
                                    <button class="btn btn-primary" type="button" name="click"
                                        onclick="submit()">Submit</button>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
            </div>
        </section>

        <!--restrics modal-->
        <div class="modal fade" id="restrictModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content bg-red">
                    <div class="modal-header">
                        <h4 class="title" id="defaultModalLabel">Notice</h4>
                    </div>
                    <div class="modal-body text-light">CAUTION! You are out of fullscreen. You will be disqualified</div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect text-light" onclick=enterFullscreen()
                            data-dismiss="modal">CLOSE</button>
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

        <script>
            function myFunction() {
                var x = document.getElementById("myDIV");
                var b = document.getElementById("mybut");
                var x = document.getElementById("myDIV");
                if (x.style.display === "none") {
                    b.style.visibility = 'hidden';
                    x.style.display = "block";
                    startTimer();


                    var elem2 = document.getElementById("main");
                    var elem3 = document.getElementById("restrictModal");
                    if (elem2.requestFullscreen) {

                        elem2.requestFullscreen();
                        document.addEventListener('fullscreenchange', () => {
                            if (document.fullscreenElement) {

                            } else {
                                $('#restrictModal').modal('show');
                            }
                        });
                    } else if (elem2.webkitRequestFullscreen) { /* Safari */

                        elem2.webkitRequestFullscreen();
                        document.addEventListener('fullscreenchange', () => {
                            if (document.fullscreenElement) {

                            } else {
                                alert('Your are out of fullscreen. Press F11 immediately');
                            }
                        });

                    } else if (elem2.msRequestFullscreen) { /* IE11 */

                        elem2.msRequestFullscreen();
                        document.addEventListener('fullscreenchange', () => {
                            if (document.fullscreenElement) {

                            } else {
                                alert('Your are out of fullscreen. Press F11 immediately');
                            }
                        });

                    }


                }
            }


            $('#attempted').on('mouseover', function () {
                var sid = $("#sid").val().trim();
                var qid = $("#qid").val().trim();

                $.ajax({
                    url: '../../php/attempted.php', // <-- point to server-side PHP script 
                    // <-- what to expect back from the PHP script, if anything
                    data: {sid:sid,qid:qid},
                    type: 'post',
                    success: function (response) {
                        console.log(response);

                    }
                });
            });


            function enterFullscreen() {
                var element = document.getElementById("main"); // Get the root element of the document

                if (element.requestFullscreen) {
                    element.requestFullscreen(); // Standard API
                } else if (element.mozRequestFullScreen) {
                    element.mozRequestFullScreen(); // Mozilla-specific API
                } else if (element.webkitRequestFullscreen) {
                    element.webkitRequestFullscreen(); // Webkit-specific API
                } else if (element.msRequestFullscreen) {
                    element.msRequestFullscreen(); // Microsoft-specific API
                }
            }


            window.onload = function () {
                document.getElementById('myDIV').style.display = 'none';
            };
        </script>
        <?php $fetchtime = "SELECT `q_timer` FROM `quiz` WHERE q_id=$q_id";
        $fetched = mysqli_query($con, $fetchtime);
        $time = mysqli_fetch_array($fetched, MYSQLI_ASSOC);
        $settime = $time['q_timer'];
        ?>
        <script type="text/javascript">

            document.getElementById('timer').innerHTML = '<?php echo $settime; ?>';
            //03 + ":" + 00 ;


            function startTimer() {
                var presentTime = document.getElementById('timer').innerHTML;
                var timeArray = presentTime.split(/[:]+/);
                var m = timeArray[0];
                var s = checkSecond((timeArray[1] - 1));
                if (s == 59) { m = m - 1 }
                if (m == 0 && s == 0) { document.getElementById("form").submit(); }
                document.getElementById('timer').innerHTML =
                    m + ":" + s;
                setTimeout(startTimer, 1000);
            }
            function submit() {
                document.getElementById("form").submit();
            }

            function checkSecond(sec) {
                if (sec < 10 && sec >= 0) { sec = "0" + sec }; // add zero in front of numbers < 10
                if (sec < 0) { sec = "59" };
                return sec;
                if (sec == 0 && m == 0) { alert('stop it') };
            }
        </script>

        <html>




        <?php
} else {
    header("Location: ../index.php");
}
?>