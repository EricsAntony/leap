$(document).ready(function () {
    $("#submit").click(function () {
        var username = $("#email").val().trim();
        var password = $("#pwd").val().trim();
        console.log(username,password);

        if (username != "" && password != "") {
            $.ajax({
                url: '../php/login.php',
                type: 'post',
                data: { username: username, password: password },
                success: function (response) {
                    var msg = "";
                    console.log(response)
                    if (response == 1) {
                        showNotification("alert-success", "Redirecting to teacher dashbord", "bottom", "right", "", "");
                       window.location = "../pages/admin/a_index.php";
                       

                    } else if (response == 2) {
                        showNotification("alert-success", "Redirecting to student dashbord", "bottom", "right", "", "");
                        window.location = "../pages/student/s_index.php";

                    } 
                    else if (response == 3) {
                        showNotification("alert-success", "Redirecting to admin dashbord", "bottom", "right", "", "");
                        window.location = "../pages/teacher/t_index.php";

                    } 
                    
                    else{
                        showNotification("alert-danger", "Invalid login! Check login credentials", "bottom", "right", "", "");
                    }
                    
                }
            });
        }
    });
});