$(document).ready(function () {
    $("#confirmaddsubject").click(function () {
      var name = $("#sub_name").val().trim(); 
      var cid = $("#sub_cid").val().trim();
  
      if (name == '') {
        showNotification("alert-danger", "Name cannot be null", "bottom", "right", "", "");
        return false;
      }
  
      if (name != '') {
        document.getElementById("loader").style.display='block';      
        $.ajax({
          url: '../../php/createSubject.php',
          type: 'post',
          data: {name: name,cid:cid},
          success: function (response) {
            console.log(response);
  
            if (response == 1) {
              location.reload();
            }
            else {
              showerror("Sorry", "Something Wrong", "error", "#");
            }
          },
          error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr.status);
            console.log(thrownError);
          }
        });
      }
      else {
        showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "");
      }
  
    });
  });
  
  
  
  $(document).on('click', '#confirmupdatesubject', function () {
    var hangoutButton = $("#closem");
    hangoutButton.click();
    var s_id = $("#su_subid").val();
    var sub_name = $("#su_name").val();
  
  
    $.ajax({
        url: "../../php/updatesubject.php",
        method: "POST",
        data: { sub_id: s_id, sub_name: sub_name, },
        dataType: "text",
        success: function (data) {
            console.log(data);
            if (data == 1) {
              location.reload();
            }
            else showNotification("alert-error", "Something went wrong", "bottom", "right", "", "")
  
        }
    });
  
  });
  $(document).on('click', '#updateSubjectButton', function () {
  
    var s_name = $(this).data("id1");
    var sub_id = $(this).data("id2");
  
    document.getElementById("su_name").value = s_name;
    document.getElementById("su_subid").value = sub_id;
  
  });
  $(document).on('click', '#subdelbtn', function () {
    console.log($(this).data("id9"));
    var delsub_id = $(this).data("id9");
    document.getElementById("delsub_id").value = delsub_id;
  
  });
  
  
  
  $(document).on('click', '#delsubjectconfirm', function () {
  
    var hangoutButton = $("#closem");
    hangoutButton.click();
    var s_id = $("#sd_subid").val();
  
    $.ajax({
        url: "../../php/delSubject.php",
        method: "POST",
        data: { sub_id: s_id },
        dataType: "text",
        success: function (data) {
            console.log(data);
            if (data == 1) {
                location.reload();
            }
            else showNotification("alert-error", "Something went wrong", "bottom", "right", "", "")
  
        }
    });
  
  });