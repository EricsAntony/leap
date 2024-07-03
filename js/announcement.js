$('#sent').on('click', function() {
    console.log("called add ass");       
    var c_id =  $("#c_id").val().trim();
    var topic = $("#an_topic").val().trim(); 
    var des = $("#an_desc").val().trim();
    console.log
    $.ajax({
        url: '../../php/announcement.php', // <-- point to server-side PHP script 
          // <-- what to expect back from the PHP script, if anything
        type:'POST',
        data: {c_id:c_id,topic:topic,des:des},                         
        type: 'post',
        success: function(response){
        console.log(response);
                if (response == 1) {
                  location.reload();
        
                }
                else {
                  showNotification("alert-error", "Error in sending message", "bottom", "right", "", "")
                }
              
        }
     });
});
