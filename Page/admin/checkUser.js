function checkAvailabilityUserID() {
  if ($('#username').val()=="") {
    return;
  }
  jQuery.ajax({
  url: "check_UserID.php",
  data: 'username='+$("#username").val(),
  type: "POST",
  beforeSend: function(){
    $("#loadingCheck").addClass("loading");
    $("#statusUserID").removeClass('green checkmark red remove');
  },
  success:function(data){
    $("#loadingCheck").removeClass("loading");
    $("#statusUserID").addClass(data);
    if (data=='green checkmark') {
      $('#statusUserID').val(1)
      $('#dupUser').fadeOut();
      // enableSubmit();
      // console.log('username='+$("#username").val());
    }
    else {
      $('#statusUserID').val(0)
      $('#dupUser').fadeIn();
    }

  },
  error:function (){}
  });
}

function checkAvailabilityOFF() {
  jQuery.ajax({
  url: "DML-VHO/check_officerID.php",
  data: 'OfficerID='+$("#OfficerID").val(),
  type: "POST",
  beforeSend: function(){
    $("#loadingCheck").addClass("loading");
    $("#statusOffID").removeClass('green checkmark red remove');     
    // $("#dupOffID").fadeIn();
    
  },
  success:function(data){
    $("#loadingCheck").removeClass("loading");
    $("#statusOffID").addClass(data);
    if (data=='green checkmark') {
      // $('#btnAddVHO-Submit').removeClass('disabled')
      $("#statusOffID").val(1);
      $("#dupOffID").fadeOut();
    }
    else {
      // $('#btnAddVHO-Submit').addClass('disabled')
      $("#statusOffID").val(0);
      $("#dupOffID").fadeIn();
    }

  },
  error:function (){}
  });
}

function clearPerson() {
  $('#formAdd-Person').form('reset');
  $('#formAdd-Person').form('clear');
  $("#statusPersonnelID").removeClass('green checkmark red remove');
  $("#statusUserID").removeClass('green checkmark red remove');
  $('#dupPerID').fadeOut();
  $('#dupUser').fadeOut();
  $("#statusPersonnelID").val('');
  $("#statusUserID").val('');
  // $('#DateExp').calendar('clear');
}

function clearOFF() {
  $('#formAdd-VH').form('reset');
  $('#formAdd-VH').form('clear');
  $("#statusID").removeClass('green checkmark red remove');
  $("#statusRE").removeClass('green checkmark red remove');
  $('#dupID').fadeOut();
  $('#dupRE').fadeOut();
  $("#statusID").val('');
  $("#statusRE").val('');
  $('#DateExp').calendar('clear');
}
