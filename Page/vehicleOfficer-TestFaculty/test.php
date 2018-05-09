  $('.edit_member').click(function(){
    //get data from edit btn
    var id=$(this).attr('data-id');
    var name=$(this).attr('data-name');
    var user=$(this).attr('data-user');
    var status=$(this).attr('data-status');
    var email=$(this).attr('data-email');
    //set value to modal
    $('#id').val(id);
    $('#name').val(name);
    $('#user').val(user);
    $('#status').val(status);
    $('#email').val(email);
    $('#editData').modal('show');
  });