$(document).ready(function () {

    $("#update_profile").click(function () {
      var name = $("#t_name").val().trim();
      var email = $("#t_email").val().trim();
      var mob = $("#t_phn").val().trim();
      var pwd = $("#t_pass").val().trim();
      var id = $("#t_id").val().trim();
  
      var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      var phoneno = /^\d{10}$/;
      var admno = /^\d{4}$/;
      var year = /^[0-9]+$/
  
      if (name == '' || email == '' || mob == '' || pwd == '') {
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
  
      if (!(mob.match(phoneno))) {
        showNotification("alert-danger", "Mobile number should contain 10 digits", "bottom", "right", "", "");
        return false;
      }
  
  
      if (name != '' & email != ''  & mob != '' & pwd != '') {
        $.ajax({
          url: '../../php/update_profile.php',
          type: 'post',
          data: { id:id,email: email, mob: mob, pwd: pwd, name: name },
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

    $("#update_profile_st").click(function () {
      var name = $("#s_name").val().trim();
      var email = $("#s_email").val().trim();
      var mob = $("#s_phn").val().trim();
      var pwd = $("#s_pass").val().trim();
      var id = $("#s_id").val().trim();
      var yoa = $("#s_yoa").val().trim();
      var batch = $("#s_batch").val().trim();
      var adm_no = $("#s_admno").val().trim();

  
      var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
      var phoneno = /^\d{10}$/;
      var admno = /^\d{4}$/;
      var year = /^[0-9]+$/
  
      if (name == '' || email == '' || mob == '' || pwd == '' || adm_no == '') {
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
  
      if (!(mob.match(phoneno))) {
        showNotification("alert-danger", "Mobile number should contain 10 digits", "bottom", "right", "", "");
        return false;
      }
  
  
      if (name != '' & email != ''  & mob != '' & pwd != '' & id != '' & yoa != '' & batch != '' & adm_no != '') {
        $.ajax({
          url: '../../php/update_profile_st.php',
          type: 'post',
          data: { id:id,email: email, mob: mob, pwd: pwd, name: name, batch:batch, yoa:yoa, admno:adm_no},
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