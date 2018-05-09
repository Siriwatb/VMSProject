var formValidationRules =  {
  oldPass: {
      identifier  : 'oldPass',
      rules: [
        {
          type   : 'empty',
          prompt : 'กรุณากรอกรหัสผ่านเก่า'
        },
      ]
    },
  newPass: {
      identifier  : 'newPass',
      rules: [
        {
          type   : 'empty',
          prompt : 'กรุณากรอกรหัสผ่านใหม่'
        }
      ]
    },
  confirmPass: {
      identifier  : 'confirmPass',
      rules: [
        {
          type   : 'empty',
          prompt : 'กรุณายืนยันรหัสผ่านใหม่'
        },
        {
          type   : 'match[newPass]',
          prompt : 'กรุณากรอกรหัสผ่านให้ตรงกัน'
        },
      ]
    }

}

$('#frmChangePass').form({
  keyboardShortcuts : false ,
  fields : formValidationRules,
  inline : true
});

function checkOldPass() {
  if( $('#oldPass').val() == '') {
      return false ;
    }
  jQuery.ajax({
  url: "DML-Password/confirmPass.php",
  data: {id:$("#idPass").val(),oldPass:$('#oldPass').val()} ,
  type: "POST",
  beforeSend: function(){
    $("#loadingCheck2").addClass("loading");
    $("#statusRE").removeClass('green checkmark red remove');
  },
  success:function(data){
    $("#loadingCheck2").removeClass("loading");
    $("#statusRE").addClass(data);
    if (data=='green checkmark') {
      $("#statusRE").val(1);
      $('#dupRE').fadeOut();
    }
    else {
      $("#statusRE").val(0);
      $('#dupRE').fadeIn();
    }

  },
  error:function (){}
  });

}

$('#frmChangePass').submit(function (e) {
  if( $('#frmChangePass').form('is valid') == false) {
      return false ;
    }
     if ($('#statusID').val()==0 || $('#statusRE').val()==0) {
      return false;
    }

     e.preventDefault();
    var form = $('#frmChangePass')[0];
    var formData = new FormData(form);
    $.ajax({
    type : 'POST',
    url  : 'DML-Password/changePass.php',
    data: formData,
    cache: false,
    // processData: false,
    // contentType: false,
    async : false,

    beforeSend: function()
    {

    },
    success :  function(data)
      {

      },

    error: function (status, errorThrown) {
         $('#alert-popup-msg').html('Error' +errorThrown );
         $('#alert-popup').modal('show');
       }

     });
})
