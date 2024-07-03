$("#publish").click(function () {
    var qid = $(this).data("q_id");

    //debugger
    $.ajax({
        url: '../../php/publish.php',
        type: 'post',
        data: { qid: qid },
        success: function (response) {
            console.log(response);

            if (response == 1) {
                showNotification("alert-success", "Result published", "bottom", "right", "", "")

            }
            else {
                showNotification("alert-error", "Result not failed", "bottom", "right", "", "")
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
        }
    });

});