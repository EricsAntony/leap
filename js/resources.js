console.log("js callled");
  $('#addresource').on('click', function() {
    var file_data = $('#r_file').prop('files')[0];   
    var form_data = new FormData();     
    var sid =  $("#r_subid").val().trim();
    var topic = $("#r_name").val().trim();
    form_data.append('r_file', file_data);
    form_data.append('r_name', topic);
    form_data.append('r_subid', sid);

    if(topic == "")
    {
        showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "")
        return false;
    }
                              
    $.ajax({
        url: '../../php/addresources.php',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(response){
                if (response == 1) {
                  location.reload();
                }
                else if(response == 3)
                {
                    showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "")
                }
                else {
                  showNotification("alert-danger", "Document upload failed", "bottom", "right", "", "")
                }
              
        }
     });
});


  $("#delassignmentconfirm").click(function () {
    var delid = document.getElementById("ass_id").value;

    //debugger
    $.ajax({
      url: '../../php/delresource.php',
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