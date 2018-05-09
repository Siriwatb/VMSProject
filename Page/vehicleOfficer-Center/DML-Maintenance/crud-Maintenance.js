$(document).ready(function() {
  var formValidationRules = {
    VehicleID: {
				identifier  : 'VehicleID',
				rules: [
					{
						type   : 'empty',
						prompt : 'กรุณาเลือกยานพาหนะ'
					}
				]
			},
    M_date :{
        identifier : 'M-Date',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาระบุวันที่ซ่อมบำรุง'
          }
        ]
    },
    M_Time :{
        identifier : 'M-Time',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาระบุเวลาซ่อมบำรุง'
          }
        ]
    },
    Description :{
        identifier : 'Description',
        rules:[
          {
            type : 'empty',
            prompt :'ระบุรายละเอียดการตรวจซ่อม'
          }
        ]
    }
  }

  $('#formAdd-M').form({
		fields : formValidationRules,
		inline : true
	});
  $('#formEdit-M').form({
		fields : formValidationRules,
		inline : true
	});


  // เพิ่มข้อมูล
  $('#formAdd-M').submit(function (e) {
    if( $('#formAdd-M').form('is valid') == false) {
				return false ;
			}
      var data = $("#formAdd-M").serialize();
       e.preventDefault();
      //  alert('submit');
      $.ajax({
      type : 'POST',
      url  : 'DML-Maintenance/insertData.php',
      data: data,
      cache: false,
      // processData: false,
      // contentType: false,
      async : false,

      beforeSend: function()
      {
        // alert('beforeSend');
      },
      success :  function(data)
        {
          // alert('success');
           $('#ModalformAdd-M').modal('hide');
           $('#formAdd-M').form('reset');
           $('#formAdd-M').form('clear');
           $('#alert-popup-msg').html(data);
           $('#alert-popup').modal('show');
           window.location.reload();

        },

      error: function (status, errorThrown) {

           $('#alert-popup-msg').html('Error' +errorThrown );
           $('#alert-popup').modal('show');
         }

       });
  });

  // ลบข้อมูล
  $('.delete-link-M').click(function(){
   var id = $(this).attr("id");
   var del_id = id;
   var parent = $(this).parent("td").parent("tr");
   $('#confirm-popup-msg').html('คุณต้องการลบข้อมูล ' +del_id + 'ใช่หรือไม่ ?');
   $('#confirm-popup').modal('show');
   $('#btnConfirm').click(function(){
     $.post('DML-Maintenance/delete.php', {'del_id':del_id}, function(data)
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
  $(".edit-link-M").click(function()
  {

        var id = $(this).attr("id");
        $('#drumFormM').load('DML-Maintenance/editForm-M.php?edit_id='+id);


        $('#ModalformEdit-M').modal('show');



  });
    //  สำหรับแก้ไขข้อมูล
  $('#formEdit-M').submit(function(e){
              if( $('#formEdit-M').form('is valid') == false) {
                  return false ;
                }
                      var data = $("#formEdit-M").serialize();
                      e.preventDefault();
                      $.ajax({
                      type : 'POST',
                      url  : 'DML-Maintenance/edit.php',
                      data: data,
                      cache: false,
                      async : false,

                      beforeSend: function()
                      {

                      },
                      success :  function(data)
                        {

                           $('#ModalformEdit-M').modal('hide');
                           $('#formEdit-M').form('reset');
                           $('#formEdit-M').form('clear');
                           $('#alert-popup-msg').html(data);
                           $('#alert-popup').modal('show');
                           window.location.reload();
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
