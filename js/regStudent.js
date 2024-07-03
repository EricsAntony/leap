$(document).ready(function () {

  $("#register").click(function () {
    var name = $("#as_name").val().trim();
    var email = $("#as_email").val().trim();
    var adm = $("#as_adm").val().trim();
    var yoa = $("#as_yoa").val().trim();
    var batch = $("#as_batch").val();

    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var phoneno = /^\d{10}$/;
    var admno = /^\d{4}$/;
    var year = /^[0-9]+$/

    if (name == '' || email == '' || adm == '' || yoa == '' || batch == '') {
      showNotification("alert-danger", "All fields are mandatory", "bottom", "right", "", "");
      return false;
    }

    if (!name?.match(/^[A-Za-z\s]*$/)) {
      showNotification("alert-danger", "Name should contain only alphabets", "bottom", "right", "", "");
      return false;
    }


    if (!(email.match(validRegex))) {
      showNotification("alert-danger", "Invalid Email!", "bottom", "right", "", "");
      return false;
    }

    if (!(adm.match(admno))) {
      showNotification("alert-danger", "Admission number should contain 4 digits", "bottom", "right", "", "");
      return false;
    }

      if (!year.test(yoa)) {
        showNotification("alert-danger", "Year of admission should be in numeric", "bottom", "right", "", "");
        return false;
      }

      if (yoa.length != 4) {
        showNotification("alert-danger", "Year of admission should contain 4 digits", "bottom", "right", "", "");
        return false;
      }
      var current_year = new Date().getFullYear();
      if ((yoa < 2020) || (yoa > current_year)) {
        showNotification("alert-danger", "Year of admission should be between 2020 and the current year", "bottom", "right", "", "");
        return false;
      }


    if (name != '' & email != '' & adm != '' &  yoa != '' & batch != '') {
      document.getElementById("loader").style.display='block';
      $.ajax({
        url: '../../php/regStudentPro.php',
        type: 'post',
        data: { email: email, yoa: yoa, batch: batch, name: name, adm: adm },
        success: function (response) {

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