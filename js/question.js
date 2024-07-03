$('#addquestion').on('click', function () {
    var cid = $("#qt_cid").val().trim();
    var question = $("#qt_question").val().trim();
    var ans1 = $("#qt_ans1").val();
    var ans2 = $("#qt_ans2").val().trim();
    var ans3 = $("#qt_ans3").val().trim();
    var ans4 = $("#qt_ans4").val().trim();
    var crct = $("#qt_crct").val().trim();
   

   
    if(crct == ans1 || crct == ans2 || crct == ans3 || crct == ans4)
    {

    
    if (question == '' || ans1 == '' || ans2 == '' || ans3 == '' || ans4 == '' || crct == '') {
        showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "")
        return false;
    }
    else {
        $.ajax({
            url: '../../php/addquestion.php', // <-- point to server-side PHP script 
            // <-- what to expect back from the PHP script, if anything
            data: { cid: cid, question:question, ans1:ans1, ans2:ans2, ans3:ans3, ans4:ans4, crct:crct },
            type: 'post',
            success: function (response) {
                console.log(response);
                if (response == 1) {
                    location.reload();

                }
                else {
                    showNotification("alert-danger", "Adding question failed", "bottom", "right", "", "")
                }

            }
        });
    }
}
else
{
    showNotification("alert-danger", "Correct answer should be any of the given four answers", "bottom", "right", "", "");
    return false;
}

});


$("#delquestionconfirm").click(function () {
    var delid = document.getElementById("ass_id").value;

    //debugger
    $.ajax({
        url: '../../php/delquestion.php',
        type: 'post',
        data: { id: delid },
        success: function (response) {
            console.log(response);

            if (response == 1) {
                location.reload();

            }
            else {
                showNotification("alert-danger", "Question deletion failed", "bottom", "right", "", "")
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });

});


//delete
$(document).on('click', '#delbtnquestion', function () {

    var a_id = $(this).data("id1");
    console.log(a_id);

    document.getElementById("ass_id").value = a_id;


});
//updatebutton click
$(document).on('click', '#editbtnquestion', function () {
    console.log('update called now');
    var q_id = $(this).data("id1");
    var question = $(this).data("question");
    var ans1 = $(this).data("ans1");
    var ans2 = $(this).data("ans2");
    var ans3 = $(this).data("ans3");
    var ans4 = $(this).data("ans4");
    var crct = $(this).data("crct");

    document.getElementById("qtu_id").value = q_id;
    document.getElementById("qtu_question").value = question;
    document.getElementById("qtu_ans1").value = ans1;
    document.getElementById("qtu_ans2").value = ans2;
    document.getElementById("qtu_ans3").value = ans3;
    document.getElementById("qtu_ans4").value = ans4;
    document.getElementById("qtu_crct").value = crct;

});
//confirm update btn
$("#updatequestion").click(function () {
    var id = document.getElementById("qtu_id").value;
    var question = document.getElementById("qtu_question").value;
    var ans1 = document.getElementById("qtu_ans1").value;
    var ans2 = document.getElementById("qtu_ans2").value;
    var ans3 = document.getElementById("qtu_ans3").value;
    var ans4 = document.getElementById("qtu_ans4").value;
    var crct = document.getElementById("qtu_crct").value;

   
    if(crct == ans1 || crct == ans2 || crct == ans3 || crct == ans4)
    {
    if (question == '' || ans1 == '' || ans2 == '' || ans3 == '' || ans4 == '' || crct == '') {
        showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "")
        return false;
    }
    else {
        
        //debugger
        $.ajax({
            url: '../../php/updatequestion.php',

            data: { id: id, question:question, ans1:ans1, ans2:ans2, ans3:ans3, ans4:ans4, crct:crct  },
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
}
else
{
    showNotification("alert-danger", "Correct answer should be any of the given four answers", "bottom", "right", "", "");
    return false;
}
});