// $(document).ready(function() {
  var formValidationRules = {
    question: {
				identifier  : 'question',
				rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกคำถาม'
					},
				]
			}
  }

  $('#formAdd-Question').form({
		fields : formValidationRules,

	});
  $('#formEdit-Question').form({
		fields : formValidationRules,

	});

  // เพิ่มข้อมูล
  $('#formAdd-Question').submit(function (e) {
    if( $('#formAdd-Question').form('is valid') == false) {
				return false ;
			}

      var data = $("#formAdd-Question").serialize();
       e.preventDefault();

      $.ajax({
      type : 'POST',
      url  : 'DML-Question/InsertData.php',
      data: data,
      cache: false,
      async : false,
      global : false,
      processData : false ,

      beforeSend: function()
      {

      },
      success :  function(data)
        {
           $('#ModalformAdd-Question').modal('hide');
           $('#formAdd-Question').form('reset');
           $('#formAdd-Question').form('clear');
           $('#alert-popup-msg').html(data);
           $('#alert-popup').modal('show');
           $("#status").removeClass('green checkmark red remove');
           $("#msgCheck").removeClass('success negative');
           $('#msgCheck').fadeOut();

        },

      error: function (status, errorThrown) {

           $('#alert-popup-msg').html('Error' +errorThrown );
           $('#alert-popup').modal('show');
         }

       });

  });

  // ลบข้อมูล
  $('.delete-link-Question').click(function(){
   var id = $(this).attr("id");
   var del_id = id;
   var parent = $(this).parent("td").parent("tr");
   $('#confirm-popup-msg').html('คุณต้องการลบข้อมูล ' +del_id + 'ใช่หรือไม่ ?');
   $('#confirm-popup').modal('show');
   $('#btnConfirm').click(function(){
     $.post('DML-Question/delete.php', {'del_id':del_id}, function(data)
     {
       if(data =='delete success'){
         $('#confirm-popup').modal('hide');
         parent.fadeOut('slow');
       }
       else{
           $('#alert-popup-msg').html(data);
           $('#alert-popup').modal('show');
       }

     });
   });
   return false;
  });

  // แก้ไขข้อมูล
  $(".edit-link-Question").click(function()
  {

        var id = $(this).attr("id");
        $('#drumFormQ').load('DML-Question/editForm-Question.php?edit_id='+id);
        $('#ModalformEdit-Question').modal('show');

  });
    //  สำหรับแก้ไขข้อมูล
  $('#formEdit-Question').submit(function(e){
              if( $('#formEdit-Question').form('is valid') == false) {
                  return false ;
                }
                      var data = $("#formEdit-Question").serialize();
                      e.preventDefault();
                      $.ajax({
                      type : 'POST',
                      url  : 'DML-Question/edit.php',
                      data: data,
                      cache: false,
                      async : false,

                      beforeSend: function()
                      {

                      },
                      success :  function(data)
                        {

                           $('#ModalformEdit-Question').modal('hide');
                           $('#formEdit-Question').form('reset');
                           $('#formEdit-Question').form('clear');
                           $('#alert-popup-msg').html(data);
                           $('#alert-popup').modal('show');
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


// });
