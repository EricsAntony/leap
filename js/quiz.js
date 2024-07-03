console.log("js callled");
$('#addquiz').on('click', function () {
    console.log("called add ass");
    var cid = $("#q_cid").val().trim();
    var title = $("#q_title").val().trim();
    var min = $("#q_min").val().trim();
    var sec = $("#q_sec").val().trim();
    var desc = $("#q_desc").val().trim();
    var year = /^[0-9]+$/
    if (!year.test(min) || !year.test(sec)) {
        showNotification("alert-danger", "Limit should be in numeric", "bottom", "right", "", "");
        return false;
    }
    console.log(title);
    if (title == '' || min == '' || sec == '' || desc == '') {
        showNotification("alert-error", "All fields are mandatory", "bottom", "right", "", "")
        return false;
    }
    else {
        document.getElementById("loader").style.display='block';
        $.ajax({
            url: '../../php/addquiz.php', // <-- point to server-side PHP script 
            // <-- what to expect back from the PHP script, if anything
            data: { cid: cid, title: title, min: min, sec: sec, desc: desc },
            type: 'post',
            success: function (response) {
                console.log(response);
                if (response == 1) {
                    location.reload();

                }
                else {
                    showNotification("alert-error", "Quiz creation failed", "bottom", "right", "", "")
                }

            }
        });
    }

});


$("#delquizconfirm").click(function () {
    var delid = document.getElementById("ass_id").value;

    //debugger
    $.ajax({
        url: '../../php/delquiz.php',
        type: 'post',
        data: { id: delid },
        success: function (response) {
            console.log(response);

            if (response == 1) {
                location.reload();

            }
            else {
                showNotification("alert-error", "Assignment removal failed", "bottom", "right", "", "")
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });

});


//delete
$(document).on('click', '#delbtn', function () {

    var a_id = $(this).data("id1");
    console.log(a_id);

    document.getElementById("ass_id").value = a_id;


});
//updatebutton click
$(document).on('click', '#editbtn', function () {
    console.log('update called now');
    var q_id = $(this).data("id1");
    var title = $(this).data("title");
    var min = $(this).data("min");
    var sec = $(this).data("sec");
    var desc = $(this).data("desc");

    document.getElementById("qu_id").value = q_id;
    document.getElementById("qu_title").value = title;
    document.getElementById("qu_min").value = min;
    document.getElementById("qu_sec").value = sec;
    document.getElementById("qu_desc").value = desc;

});
//confirm update btn
$("#updatequiz").click(function () {
    var id = document.getElementById("qu_id").value;
    var title = document.getElementById("qu_title").value;
    var min = document.getElementById("qu_min").value;
    var sec = document.getElementById("qu_sec").value;
    var desc = document.getElementById("qu_desc").value;

    var year = /^[0-9]+$/;

    if (!year.test(min)) {
        showNotification("alert-danger", "Limit should be in numeric", "bottom", "right", "", "");
        return false;
    }
    if (!year.test(sec)) {
        showNotification("alert-danger", "Time should be in numeric", "bottom", "right", "", "");
        return false;
    }
   
    if (title == '' || min == '' || sec == '' || desc == '') {
        showNotification("alert-error", "All fields are mandatory", "bottom", "right", "", "");
        return false;
    }
    else {
       
        $.ajax({
            url: '../../php/updatequiz.php',

            data: { id: id, title: title, min: min, sec: sec, desc: desc },
            type: 'post',
            success: function (response) {
                if (response == 1) {
                    location.reload();

                }
                else {
                    showNotification("alert-success", "Updation failed", "bottom", "right", "", "")
                }

            }
        });
    

    }
});