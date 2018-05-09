$(document).ready(function() {

var formValidationRules ={
    username: {
      identifier  : 'username',
      rules: [
        {
          type   : 'empty',
          prompt : 'กรุณากรอกชื่อผู้ใช้'
        }

      ]
    },
    password: {
      identifier  : 'password',
      rules: [
        {
          type   : 'empty',
          prompt : 'กรุณากรอกรหัสผ่าน'
        }
      ]
    }
}

$('#login-form').form({
  fields : formValidationRules,
  keyboardShortcuts : false
});

  $('#login-form').submit(function(e) {
    // alert("submit");


    if ($('#login-form').form('is valid') == false) {
      // alert("Form FALSE");
      $('#msgBox').fadeOut(1000);
      $('#msgBox').addClass('hidden');
      return false;
    }
  if ($('#username').val() > "" && $('#password').val() > "" ) {
        // alert("Form TRUE");
        $('#loadingBox').fadeIn()
        $('#loadingBox').html('<i class="notched circle loading icon"></i><label class="fontMitr">กำลังเข้าสู่ระบบ .. </label>');
        var data = $('#login-form').serialize();
        e.preventDefault();
        $.ajax({
          type : 'POST',
          url : 'checklogin.php',
          data : data,

          beforeSend : function() {
            // alert("beforeSend");
            $('#loadingBox').fadeOut(500);
          },
          success : function(data) {

            if (data=='admin') {
              $('#msgBox').fadeIn(2000);
              $('#msgBox').removeClass('hidden');
              $('#msgBox').addClass('success');
              $('#msgBox').html('<label class="fontMitr">เข้าสู่ระบบสำเร็จ</label>');
              setTimeout('window.location.href = "Page/admin";',1000);
            }
            else if (data == 'security') {
              $('#msgBox').fadeIn(2000);
              $('#msgBox').removeClass('hidden');
              $('#msgBox').addClass('success');
              $('#msgBox').html('<label class="fontMitr">เข้าสู่ระบบสำเร็จ</label>');
              setTimeout(' window.location.href = "Page/securityOfficer";',1000);
            }
            else if (data == 'Personnel') {
              $('#msgBox').fadeIn(2000)
              $('#msgBox').removeClass('hidden');
              $('#msgBox').addClass('success');
              $('#msgBox').html('<label class="fontMitr">เข้าสู่ระบบสำเร็จ</label>');
              setTimeout(' window.location.href = "Page/user";',1000);
            }
            else if (data =='VehicleOfficerCenter') {
              $('#msgBox').fadeIn();
              $('#msgBox').removeClass('hidden');
              $('#msgBox').addClass('success');
              $('#msgBox').html('<label class="fontMitr">เข้าสู่ระบบสำเร็จ</label>');
              setTimeout(' window.location.href = "Page/vehicleOfficer-Center";',1000);
            }
            else if (data == 'Driver') {
              $('#msgBox').fadeIn(2000);
              $('#msgBox').removeClass('hidden');
              $('#msgBox').addClass('success');
              $('#msgBox').html('<label class="fontMitr">เข้าสู่ระบบสำเร็จ</label>');

              setTimeout('window.location.href = "Page/driver";',1000);
            }
            else if (data == 'VehicleOfficerFac') {
              $('#msgBox').fadeIn(2000);
              $('#msgBox').removeClass('hidden');
              $('#msgBox').addClass('success');
              $('#msgBox').html('<label class="fontMitr">เข้าสู่ระบบสำเร็จ</label>');

              setTimeout('window.location.href = "Page/vehicleOfficer-Faculty";',1000);
            }
            else {
              $('#msgBox').fadeIn(2000);
              // $('#msgBox').removeClass('hidden');
              $('#msgBox').addClass('negative');
              $('#msgBox').html('<label class="fontMitr">'+data+'</label>');
              // alert("ELSE");
            }

          },
          complete: function() {
            // alert("complete");
            // $("#loadingBox").fadeOut(1000);
          }

      });
    }
  });
});
