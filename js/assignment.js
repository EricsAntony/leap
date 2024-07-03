  $('#addassignment').on('click', function() {
    console.log("called add ass");
    var file_data = $('#as_file').prop('files')[0];   
    var form_data = new FormData();     
    var sid =  $("#as_subid").val().trim();
    var topic = $("#as_name").val().trim();
    var ddate = $("#as_duedate").val().trim(); 
    var des = $("#as_desc").val().trim();
    form_data.append('as_file', file_data);
    form_data.append('as_name', topic);
    form_data.append('as_subid', sid);
    form_data.append('as_duedate', ddate);
    form_data.append('as_desc', des);
    if(topic != '' || ddate != '')
    {
    document.getElementById("loader").style.display='block';                       
    $.ajax({
      
        url: '../../php/addassignment.php', // <-- point to server-side PHP script 
          // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(response){
        console.log(response);
                if (response == 1) {
                  location.reload();
        
                }
                else {
                  showNotification("alert-error", "Assignment scheduling failed", "bottom", "right", "", "")
                }
              
        }
     });
    }
    else
    {
      showNotification("alert-danger", "Title & due date are mandatory", "bottom", "right", "", "")
    }

     });


  $("#delassignmentconfirm").click(function () {
    var delid = document.getElementById("ass_id").value;

    //debugger
    $.ajax({
      url: '../../php/delassignment.php',
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
  $(document).on('click', '#updateassbtn', function () {

    var a_id = $(this).data("id1");
    var assname = $(this).data("id2");
    var assduedate = $(this).data("id5");
    var t_doc = $(this).data("id3");
    var t_des = $(this).data("id4");

    document.getElementById("updt_ass_id").value = a_id;
    document.getElementById("assname").value = assname;
    document.getElementById("date_picker").value = assduedate;
    document.getElementById("des").value = t_des;

  });
  //confirm update btn
  $("#confirmupdateassignment").click(function () {
    var assid = document.getElementById("updt_ass_id").value;
    var assname = document.getElementById("assname").value;
    var assduedate = document.getElementById("date_picker").value;
    var des = document.getElementById("des").value;

    var file_data = $('#file_up').prop('files')[0];   
    var form_data = new FormData();     

    form_data.append('file_up', file_data);
    form_data.append('topic', assname);
    form_data.append('assid', assid);
    form_data.append('ddate', assduedate);
    form_data.append('description', des);
    //debugger
    $.ajax({
      url: '../../php/updateassignment.php', 
      cache: false,
      contentType: false,
      processData: false,
      data: form_data,                         
      type: 'post',
      success: function(response){     
              if (response == 1) {
                showNotification("alert-success", "Assignment updated", "bottom", "right", "", "")
      
              }
              else {
                showNotification("alert-success", "Assignment updated", "bottom", "right", "", "")
              }
            
      }
   });
  });