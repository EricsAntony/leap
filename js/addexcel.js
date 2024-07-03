$(document).ready(function (e) {
    $("#exelform").on('submit', function (e) {

        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '../../php/addviaexcelpro.php',
            data: new FormData(this),

            contentType: false,
            cache: false,
            processData: false,
            success: function (response) {

                if (response == 1) {

                    showNotification("alert-success", "Details uploaded", "bottom", "right", "", "")
                    document.getElementById("sub").disabled = true;
                    $("#file").val('');


                } else if (response == 2) {

                    
                    showNotification("alert-danger", "Please choose a file", "bottom", "right", "", "")
                } else {
                    console.log(response)
                    showNotification("alert-danger", "Something wrong", "bottom", "right", "", "")
                }
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr.status);
                console.log(thrownError);
            }

        });
    });
});