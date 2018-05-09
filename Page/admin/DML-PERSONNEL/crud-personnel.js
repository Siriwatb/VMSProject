$(document).ready(function() {

    // function checkAvailabilityPerson() {
    // 	jQuery.ajax({
    // 	url: "DML-PERSONNEL/check_PersonnelID.php",
    // 	data: 'PersonnelID='+$("#PersonnelID").val(),
    // 	type: "POST",
    // 	beforeSend: function(){
    // 		$("#loadingCheck").addClass("loading");
    // 		$("#statusPersonnelID").removeClass('green checkmark red remove');
    // 	},
    // 	success:function(data){
    // 		$("#loadingCheck").removeClass("loading");
    // 		$("#statusPersonnelID").addClass(data);
    // 		if (data=='green checkmark') {
    // 			$("#statusPersonnelID").val(1);
    // 			// $('#btnPersonAdd-Submit').removeClass('disabled')
    // 		}
    // 		else {
    // 			$("#statusPersonnelID").val(0);
    // 			// $('#btnPersonAdd-Submit').addClass('disabled')
    // 		}

    // 	},
    // 	error:function (){}
    // 	});
    // }
    function enableSubmit() {
        if ($("#statusPersonnelID").val() == 1 && $('#statusUserID').val() == 1) {
            $('#btnPersonAdd-Submit').removeClass('disabled');
        }

    }

    var formValidationRules = {
        PersonnelID: {
            identifier: 'PersonnelID',
            rules: [{
                    type: 'empty',
                    prompt: 'กรุณากรอกรหัสบุคลากร'
                },
                {
                    type: 'regExp[/^[a-zA-Z0-9]+$/]',
                    prompt: 'กรุณากรอกรหัสบุคลากรด้วยอักษร A-Z , a-z , 0-9'
                }
            ]
        },
        Fname: {
            identifier: 'Personnel-Fname',
            rules: [{
                    type: 'empty',
                    prompt: 'กรุณากรอกชื่อจริง'
                },
                {
                    type: 'regExp[/^[a-zA-Zก-๙]+$/]',
                    prompt: 'กรุณากรอกข้อมูลด้วยตัวอักษรเท่านั้น'
                }

            ]
        },
        Lname: {
            identifier: 'Personnel-Lname',
            rules: [{
                    type: 'empty',
                    prompt: 'กรุณากรอกนามสกุล'
                },
                {
                    type: 'regExp[/^[a-zA-Zก-๙]+$/]',
                    prompt: 'กรุณากรอกข้อมูลด้วยตัวอักษรเท่านั้น'
                        // /^[u0E01-u0E5B]+$/
                }


            ]
        },
        Position: {
            identifier: 'Personnel-Position',
            rules: [{
                    type: 'empty',
                    prompt: 'กรุณาเลือกตำแหน่ง'
                }

            ]
        },
        department: {
            identifier: 'Personnel-department',
            rules: [{
                    type: 'empty',
                    prompt: 'กรุณาเลือกสังกัด'
                }

            ]
        },
        Telephone_number: {
            identifier: 'Personnel-Tel',
            rules: [{
                    type: 'exactLength[10]',
                    prompt: 'กรุณากรอกหมายเลขติดต่อ {ruleValue} หลัก'
                },
                {
                    type: 'integer',
                    prompt: 'กรุณากรอกเฉพาะตัวเลข'
                }
            ]
        },
        username: {
            identifier: 'username',
            rules: [{
                    type: 'empty',
                    prompt: 'กรุณากรอกชื่อผู้ใช้งาน'
                },
                {
                    type: 'regExp[/^[a-zA-Z0-9_-]+$/]',
                    prompt: 'กรุณาตั้งชื่อผู้ใช้ด้วยอักษร A-Z , a-z , 0-9'
                }

            ]
        }
    }

    $('#formAdd-Person').form({
        fields: formValidationRules,
        inline: true
    });
    $('#formEdit-Person').form({
        fields: formValidationRules,
        inline: true
    })

    /* เพิ่มข้อมูลเจ้าหน้าที่ฝ่ายยานพาหนะ */


    $('#formAdd-Person').submit(function(e) {


        if ($('#formAdd-Person').form('is valid') == false) {
            return;
        }
        if ($('#statusUserID').val() == 0 || $('#statusUserID').val() == "") {

            return;
        }
        if ($("#statusPersonnelID").val() == 0 || $("#statusPersonnelID").val() == "") {
            return;
        }
        var data = $("#formAdd-Person").serialize();
        e.preventDefault();

        $.ajax({
            url: 'DML-PERSONNEL/InsertData.php',
            type: 'POST',
            data: data,


            // beforeSend: function() {

            // }
            // ,
            success: function(data) {
                $('#ModalformAdd-Person').modal('hide');
                $('#formAdd-Person').form('reset');
                $("#statusPersonnelID").removeClass('green checkmark red remove');
                //  $('#alert-popup-msg').html(data);
                //  $('#alert-popup').modal('show');
                //  $('#content-loader').load('list-Personnel.php');
                // $('#Personnel-Table').DataTable().fnReloadAjax();
                window.location.reload();
            },

            error: function(status, errorThrown) {
                $('#alert-popup-msg').html('Error' + errorThrown + '/DML-PERSONNEL/InsertData.php');
                $('#alert-popup').modal('show');
            }

        });





    });




    $(".show-link-person").click(function() {
        // alert('click');
        var id = $(this).attr("id");
        $('#drumForm2').load('DML-PERSONNEL/showdata-Personnel.php?show_id=' + id);
        $('#ModalformShow-Person').modal('show');
    });
    // แก้ไขข้อมูล ตารางข้อมูลเจ้าหน้าที่ยานพาหนะ
    //  สำหรับเรียกข้อมูลขึ้นมาเพื่อแก้ไข
    $(".edit-link-person").click(function() {
        var id = $(this).attr("id");
        $('#drumForm').load('DML-PERSONNEL/editForm-Personnel.php?edit_id=' + id);
        $('#ModalformEdit-Person').modal('show');

    });
    //  สำหรับแก้ไขข้อมูล
    $('#formEdit-Person').submit(function(e) {
        if ($('#formEdit-Person').form('is valid') == false) {

            return false;
        }

        var data = $("#formEdit-Person").serialize();
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'DML-PERSONNEL/edit.php',
            data: data,

            beforeSend: function() {

            },
            success: function(data) {

                $('#ModalformEdit-Person').modal('hide');
                $('#formEdit-Person').form('reset');
                $('#alert-popup-msg').html(data);
                $('#alert-popup').modal('show');
                window.location.reload();
            },
            complete: function() {

            },
            error: function(status, errorThrown) {
                //  alert('Error' +errorThrown  );
                $('#alert-popup-msg').html('Error' + errorThrown);
                $('#alert-popup').modal('show');
            }

        });

    });




    // ลบข้อมูล
    $('.delete-link-person').click(function() {
        var id = $(this).attr("id");
        var del_id = id;
        var parent = $(this).parent("td").parent("tr");
        $('#confirm-popup-msg').html('คุณต้องการลบข้อมูล รหัส ' + del_id + 'ใช่หรือไม่ ?');
        $('#confirm-popup').modal('show');
        $('#btnConfirm').click(function() {
            $.post('DML-PERSONNEL/delete.php', { 'del_id': del_id }, function(data) {
                if (data == 'delete success') {
                    $('#confirm-popup').modal('hide');
                    parent.fadeOut('slow');
                } else {
                    $('#alert-popup-msg').html(data);
                    $('#alert-popup').modal('show');
                }

            });
        });
        return false;
    });
    //
});