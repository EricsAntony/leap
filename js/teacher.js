$(document).ready(function () {
  $('#dataTables').dataTable();
});


$(document).on('click', '.btn_update', function () {
  var s_id = $(this).data("id1");
  var adm_no = $(this).data("id2");
  var s_name = $(this).data("id3");
  var email = $(this).data("id4");


  document.getElementById("tid").value = s_id;
  document.getElementById("tname").value = adm_no;
  document.getElementById("temail").value = s_name;
  document.getElementById("tphone").value = email;


});

$(document).on('click', '#delbtn', function () {
  var s_id = $(this).data("id1");
  document.getElementById("delid").value = s_id;
});

$(document).on('click', '#adbtn', function () {
  var t_id = $(this).data("tid");
  document.getElementById("t_id").value =  t_id;
});


$(document).ready(function () {
  function fetch_data() {
    $.ajax({
      url: "../../php/getteacherdata.php",
      method: "POST",
      success: function (data) {
        $('#teacherdata').html(data);

      }
    });
  }
  fetch_data();

  $("#delteacherconfirm").click(function () {
    var delid = document.getElementById("delid").value;

    //debugger
    $.ajax({
      url: '../../php/deleteteacher.php',
      type: 'post',
      data: { id: delid },
      success: function (response) {
        fetch_data();
        if (response == 1) {
          showNotification("alert-success", "Teacher details removed", "bottom", "right", "", "")

        }
        else {
          showNotification("alert-danger", "Something went Wrong", "bottom", "right", "", "")
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
      }
    });

  });

  $("#confirmChangeAdmin").click(function () {
    var t_id = document.getElementById("t_id").value;
    var current_tid = document.getElementById("current_tid").value;
    //debugger
    $.ajax({
      url: '../../php/updateadmin.php',
      type: 'post',
      data: { id: t_id, current_tid:current_tid },
      success: function (response) {
        fetch_data();
        console.log(response);

        if (response == 1) {
          document.getElementById('logout').click();

        }
        else {
          showNotification("alert-danger", "Something went Wrong", "bottom", "right", "", "")
        }
      },
      error: function (xhr, ajaxOptions, thrownError) {
        console.log(xhr.status);
        console.log(thrownError);
      }
    });

  });



  $(document).on('click', '#updateteacher', function () {
    var hangoutButton = $("#closem");
    hangoutButton.click();
    var id = document.getElementById("tid").value;
    var name = document.getElementById("tname").value;
    var email = document.getElementById("temail").value;
    var phone = document.getElementById("tphone").value;
    var count = 0;

    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var phoneno = /^\d{10}$/;

    if (name == '' || email == '' || phone == '' ) {
        showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "");
        count = 1
    }

    if (!(/^[A-Za-z\s]+$/.test(name))) {
        showNotification("alert-danger", "Name should contain only alphabets", "bottom", "right", "", "");
        count = 1
    }


    if (!(email.match(validRegex))) {
        showNotification("alert-danger", "Invalid Email!", "bottom", "right", "", "");
        count = 1
    }

    if (!(phone.match(phoneno))) {
        showNotification("alert-danger", "Mobile number should contain 10 digits", "bottom", "right", "", "");
        count = 1
    }
    if (count == 0){
    $.ajax({
      url: "../../php/updateteacher.php",
      method: "POST",
      data: { id: id, name: name, email: email, phone: phone },
      dataType: "text",
      success: function (data) {
        fetch_data();
        console.log(data);
        if (data == 1)
          showNotification("alert-success", "Teacher details updated", "bottom", "right", "", "");
        else showNotification("alert-danger", "Something went wrong", "bottom", "right", "", "")

      }
    });
  }

  });
}); 