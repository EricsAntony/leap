$(document).ready(function () {

  $("#create_class").click(function () {
    var name = $("#c_name").val().trim();
    var yoa = $("#c_yoa").val().trim();
    var batch = $("#c_batch").val();
    var tid = $("#c_tid").val();



    if (name == '' || yoa == '' || batch == '') {
      showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "");
      return false;
    }

    if (name != '' & yoa != '' & batch != '') {
      document.getElementById("loader").style.display='block';
      $.ajax({
        url: '../../php/createClass.php',
        type: 'post',
        data: {yoa: yoa, batch: batch, name: name, tid:tid},
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



$(document).on('click', '#updateClass', function () {
  console.log("Update called");
  var hangoutButton = $("#closem");
  hangoutButton.click();
  var s_id = $("#cu_id").val();
  var sub_name = $("#cu_name").val();
  var sub_yoa = $("#cu_yoa").val();
  var sub_batch = $("#cu_batch").val();


  $.ajax({
      url: "../../php/updateclass.php",
      method: "POST",
      data: { sub_id: s_id, sub_name: sub_name, sub_batch: sub_batch, sub_yoa: sub_yoa, },
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
$(document).on('click', '#updateButton', function () {

  var s_name = $(this).data("id1");
  var sub_yoa = $(this).data("id3");
  var sub_batch = $(this).data("id2");
  var sub_id = $(this).data("id5");


  document.getElementById("cu_name").value = s_name;
  document.getElementById("cu_yoa").value = sub_yoa;
  document.getElementById("cu_batch").value = sub_batch;
  document.getElementById("cu_id").value = sub_id;

});
$(document).on('click', '#subdelbtn', function () {
  console.log($(this).data("id9"));
  var delsub_id = $(this).data("id9");
  document.getElementById("delsub_id").value = delsub_id;

});



$(document).on('click', '#confirmdelsubbtn', function () {

  var hangoutButton = $("#closem");
  hangoutButton.click();
  var s_id = $("#delsub_id").val();

  $.ajax({
      url: "../../php/delClass.php",
      method: "POST",
      data: { sub_id: s_id },
      dataType: "text",
      success: function (data) {
          console.log(data);
          if (data == 1) {
              location.reload();
              showNotification("alert-success", "Subject Deleted", "bottom", "right", "", "");
          }
          else showNotification("alert-error", "Something went wrong", "bottom", "right", "", "")

      }
  });

});