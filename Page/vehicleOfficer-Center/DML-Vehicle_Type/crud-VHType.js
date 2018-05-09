// $(document).ready(function() {
  var formValidationRules = {
    TypeName: {
				identifier  : 'TypeName',
				rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกชื่อประเภทยานพาหนะ'
					},
				]
			}
  }

  $('#formAdd-VHType').form({
		fields : formValidationRules,
		inline : true
	});
  $('#formEdit-VHType').form({
		fields : formValidationRules,
		inline : true
	});

  // เพิ่มข้อมูล
  $('#formAdd-VHType').submit(function () {
    if( $('#formAdd-VHType').form('is valid') == false) {
				return false ;
			}
      var data = $("#formAdd-VHType").serialize();
      // e.preventDefault();

      $.ajax({
      type : 'POST',
      url  : 'DML-Vehicle_Type/InsertData.php',
      data: data,
      cache: false,
      async : false,
      // global : false,
      // processData : false ,

      beforeSend: function()
      {

      },
      success :  function(data)
        {
           $('#ModalformAdd-VHType').modal('hide');
           $('#formAdd-VHType').form('reset');
           $('#formAdd-VHType').form('clear');
          //  $('#alert-popup-msg').html(data);
          //  $('#alert-popup').modal('show');
          //  $("#status").removeClass('green checkmark red remove');
           window.location.reload();

        },

      error: function (status, errorThrown) {

           $('#alert-popup-msg').html('Error' +errorThrown );
           $('#alert-popup').modal('show');
         }

       });
  });

  // ลบข้อมูล
  $('.delete-link-VHType').click(function(){
   var id = $(this).attr("id");
   var del_id = id;
   var parent = $(this).parent("td").parent("tr");
   $('#confirm-popup-msg').html('คุณต้องการลบข้อมูล ' +del_id + 'ใช่หรือไม่ ?');
   $('#confirm-popup').modal('show');
   $('#btnConfirm').click(function(){
     $.post('DML-Vehicle_Type/delete.php', {'del_id':del_id}, function(data)
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
  $(".edit-link-VHType").click(function()
  {

        var id = $(this).attr("id");
        $('#drumFormVHType').load('DML-Vehicle_Type/editForm-VHType.php?edit_id='+id);
        $('#ModalformEdit-VHType').modal('show');

  });
    //  สำหรับแก้ไขข้อมูล
  $('#formEdit-VHType').submit(function(e){
              if( $('#formEdit-VHType').form('is valid') == false) {
                  return false ;
                }
                      var data = $("#formEdit-VHType").serialize();
                      e.preventDefault();
                      $.ajax({
                      type : 'POST',
                      url  : 'DML-Vehicle_Type/edit.php',
                      data: data,
                      // cache: false,
                      // async : false,

                      beforeSend: function()
                      {

                      },
                      success :  function(data)
                        {

                           $('#ModalformEdit-VHType').modal('hide');
                           $('#formEdit-VHType').form('reset');
                           $('#formEdit-VHType').form('clear');
                           $('#alert-popup-msg').html(data);
                           $('#alert-popup').modal('show');
                           $('#btnAlertOk').on('click',function(){
                            window.location.reload();
                           });
                           
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
