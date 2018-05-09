$(document).ready(function () {
    var formValidationRules = {
        VehicleID: {
            identifier: 'VehicleID',
            rules: [{
                type: 'empty',
                prompt: 'กรุณาเลือกยานพาหนะ'
            }]
        },
        M_date: {
            identifier: 'M-Date',
            rules: [{
                type: 'empty',
                prompt: 'กรุณาระบุวันที่ซ่อมบำรุง'
            }]
        },
        M_Time: {
            identifier: 'M-Time',
            rules: [{
                type: 'empty',
                prompt: 'กรุณาระบุเวลาซ่อมบำรุง'
            }]
        },
        Description: {
            identifier: 'Description',
            rules: [{
                type: 'empty',
                prompt: 'ระบุรายละเอียดการตรวจซ่อม'
            }]
        }
    }


    $('#formAdd-Booking').submit(function (e) {
        // if( $('#formAdd-M').form('is valid') == false) {
        //             return false ;
        //         }
        var data = $("#formAdd-Booking").serialize();
        e.preventDefault();

        //  alert('submit');
        $.ajax({
            type: 'POST',
            url: 'DML-Booking/insert.php',
            data: data,
            cache: false,
            async: false,

            beforeSend: function () {
                // alert('before');
            },
            success: function (data) {
                // alert('success');
                $('#ModalformAdd-Booking').modal('hide');
                $('#formAdd-Question').form('reset');
                $('#formAdd-Question').form('clear');
                $('#alert-popup-msg').html(data);
                $('#alert-popup').modal('show');
                //    window.location.reload();
            },

            error: function (status, errorThrown) {

                $('#alert-popup-msg').html('Error' + errorThrown);
                $('#alert-popup').modal('show');
            }

        });
    });

    $(".show-link-Booking").click(function () {
        // alert('click');
        var id = $(this).attr("id");
        $('#eform2').load('DML-Booking/showdata-Booking.php?show_id=' + id);
        $('#ModalformShow-Booking').modal('show');
    });
});