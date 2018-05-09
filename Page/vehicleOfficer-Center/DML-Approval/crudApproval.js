$(document).ready(function() {

    $('.approve').click(function(e){
        // e.preventDefault();
        var id = $(this).attr("id");
        console.log(id);
        $.ajax({
            type : 'POST',
            url  : 'DML-Approval/approval.php',
            data: {'id':+id},
            // cache: false,
            // processData: false,
            // contentType: false,
            // async : false,

            beforeSend: function()
            {

            },
            success :  function(data)
            {               
                $('#alert-popup-msg').html(data);
                $('#alert-popup').modal('show');
                // window.location.reload();
            },
            complete : function(){

            },
            error: function (status, errorThrown) {
                //  alert('Error' +errorThrown  );
                $('#alert-popup-msg').html('Error' +errorThrown );
                $('#alert-popup').modal('show');
            }

        });

});
    
});


