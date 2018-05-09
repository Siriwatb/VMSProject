$(document).ready(function() {

  var formValidationRules = {
    VehicleID: {
				identifier  : 'VehicleID',
				rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกรหัสยานพาหนะ'
					}
				]
			},
    Registration :{
        identifier : 'Registration',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณากรอกหมายเลขทะเบียน'
          }
        ]
    },
    Brand :{
        identifier : 'Brand',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาระบุยี่ห้อ'
          }
        ]
    },
    TypeID :{
        identifier : 'TypeID',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาเลือกประเภทยานพาหนะ'
          }
        ]
    },
    Num_of_seats :{
        identifier : 'Num_of_seats',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาระบุจำนวนที่นั่ง'
          }
        ]
    },
    Odometer :{
        identifier : 'Odometer',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณากรอกระยะทางเริ่มต้น'
          }
        ]
    },
    DateInsuranceExp:{
        identifier : 'DateInsuranceExp',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาระบุวันหมดอายุประกัน'
          }
        ]
    },
    vhshowpath:{
        identifier : 'vh-showpath',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาเพิ่มรูปภาพยานพาหนะ'
          }
        ]
    },
    Department:{
        identifier : 'Department',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาเลือกสังกัดของยานพาหนะ'
          }
        ]
    }
  }
  var formValidationRules2 = {
    VehicleID: {
				identifier  : 'VehicleID',
				rules: [
					{
						type   : 'empty',
						prompt : 'กรุณากรอกรหัสยานพาหนะ'
					}
				]
			},
    Registration :{
        identifier : 'Registration',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณากรอกหมายเลขทะเบียน'
          }
        ]
    },
    Brand :{
        identifier : 'Brand',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาระบุยี่ห้อ'
          }
        ]
    },
    TypeID :{
        identifier : 'TypeID',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาเลือกประเภทยานพาหนะ'
          }
        ]
    },
    Num_of_seats :{
        identifier : 'Num_of_seats',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาระบุจำนวนที่นั่ง'
          }
        ]
    },
    Odometer :{
        identifier : 'Odometer',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณากรอกระยะทางเริ่มต้น'
          }
        ]
    },
    DateInsuranceExp:{
        identifier : 'DateInsuranceExp',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาระบุวันหมดอายุประกัน'
          }
        ]
    },
    // vhshowpath:{
    //     identifier : 'vh-showpath',
    //     rules:[
    //       {
    //         type : 'empty',
    //         prompt :'กรุณาเพิ่มรูปภาพยานพาหนะ'
    //       }
    //     ]
    // },
    Department:{
        identifier : 'Department',
        rules:[
          {
            type : 'empty',
            prompt :'กรุณาเลือกสังกัดของยานพาหนะ'
          }
        ]
    }
  }
  $('#formAdd-VH').form({
		fields : formValidationRules,
		inline : true
	});
  $('#formEdit-VH').form({
		fields : formValidationRules2,
		inline : true
	});

  // เพิ่มข้อมูล
  $('#formAdd-VH').submit(function (e) {
    if( $('#formAdd-VH').form('is valid') == false) {
				return false ;
			}
       if ($('#statusID').val()==0 || $('#statusRE').val()==0) {
        return false;
      }
      // $('#dupID').fadeOut();
      // $('#dupRE').fadeOut();
       e.preventDefault();
      var form = $('#formAdd-VH')[0];
      var formData = new FormData(form);

      $.ajax({
      type : 'POST',
      url  : 'DML-Vehicle/InsertData.php?files',
      data: formData,
      cache: false,
      processData: false,
      contentType: false,
      async : false,

      beforeSend: function()
      {

      },
      success :  function(data)
        {
           $('#ModalformAdd-VH').modal('hide');
           $('#formAdd-VH').form('reset');
           $('#formAdd-VH').form('clear');
           $('#alert-popup-msg').html(data);
           $('#alert-popup').modal('show');
          //  window.location.reload();

        },

      error: function (status, errorThrown) {

           $('#alert-popup-msg').html('Error' +errorThrown );
           $('#alert-popup').modal('show');
         }

       });
  });

  // ลบข้อมูล
  $('.delete-link-VH').click(function(){
   var id = $(this).attr("id");
   var del_id = id;
   var parent = $(this).parent("td").parent("tr");
   $('#confirm-popup-msg').html('คุณต้องการลบข้อมูล ' +del_id + 'ใช่หรือไม่ ?');
   $('#confirm-popup').modal('show');
   $('#btnConfirm').click(function(){
     $.post('DML-Vehicle/delete.php', {'del_id':del_id}, function(data)
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
  var calendarText = {

    days: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
    months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
    monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
    today: 'Today',
    now: 'Now',
    am: 'AM',
    pm: 'PM'

  }

  $(".show-link-VH").click(function()
	{
			// alert('click');
					var id = $(this).attr("id");
					$('#showVH').load('DML-Vehicle/ShowData-Vehi.php?show_id='+id);
					$('#ModalformShow-VH').modal('show');
  });
  
  // แก้ไขข้อมูล
  $(".edit-link-VH").click(function()
  {



        var id = $(this).attr("id");
        $('#drumFormVH').load('DML-Vehicle/editForm-VH.php?edit_id='+id);
        $('#DateExp').calendar({
                type:'date',
                text : calendarText,
                constantHeight: false
              });

        checkAvailabilityRegis();
        $('#ModalformEdit-VH').modal('show');



  });
    //  สำหรับแก้ไขข้อมูล
  $('#formEdit-VH').submit(function(e){
              if( $('#formEdit-VH').form('is valid') == false) {
                  return false ;
                }
                if ($('#statusEditRE').val()==0) {
                 return false;
               }
                      // var data = $("#formEdit-VH").serialize();
                      e.preventDefault();
                      var form = $('#formEdit-VH')[0];
                      var formData = new FormData(form);


                      $.ajax({
                      type : 'POST',
                      url  : 'DML-Vehicle/edit.php',
                      data: formData,
                      cache: false,
                      processData: false,
                      contentType: false,
                      async : false,

                      beforeSend: function()
                      {

                      },
                      success :  function(data)
                        {

                           $('#ModalformEdit-VH').modal('hide');
                           $('#formEdit-VH').form('reset');
                           $('#formEdit-VH').form('clear');
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
