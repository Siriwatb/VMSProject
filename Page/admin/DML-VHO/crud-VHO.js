$(document).ready(function () {



	var formValidationRules = {
		OfficerID: {
			identifier: 'OfficerID',
			rules: [{
					type: 'empty',
					prompt: 'กรุณากรอกรหัสเจ้าหน้าที่'
				},
				{
					type: 'regExp[/^[a-zA-Z0-9]+$/]',
					prompt: 'กรุณาตั้งรหัสเจ้าหน้าที่ด้วยอักษร A-Z , a-z , 0-9'
				}
			]
		},
		Fname: {
			identifier: 'VHO-Fname',
			rules: [{
					type: 'empty',
					prompt: 'กรุณากรอกชื่อจริง'
				},
				{
					type: 'regExp[/^[ก-๙a-zA-Z]+$/]',
					prompt: 'กรุณากรอกข้อมูลด้วยอักษรภาษาไทย'
				}

			]
		},
		Lname: {
			identifier: 'VHO-Lname',
			rules: [{
					type: 'empty',
					prompt: 'กรุณากรอกนามสกุล'
				},
				{
					type: 'regExp[/^[ก-๙a-zA-Z]+$/]',
					prompt: 'กรุณากรอกข้อมูลด้วยอักษรภาษาไทย'
					// /^[u0E01-u0E5B]+$/
				}


			]
		},
		Position: {
			identifier: 'VHO-Position',
			rules: [{
					type: 'empty',
					prompt: 'กรุณาเลือกตำแหน่ง'
				}

			]
		},
		office: {
			identifier: 'VHO-office',
			rules: [{
					type: 'empty',
					prompt: 'กรุณาเลือกสังกัด'
				}

			]
		},
		Telephone_number: {
			identifier: 'VHO-Tel',
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



	$('#formAdd-VHO').form({
		fields: formValidationRules,
		inline: true
	});
	$('#formEdit-VHO').form({
		fields: formValidationRules,
		inline: true
	})
	/* เพิ่มข้อมูลเจ้าหน้าที่ฝ่ายยานพาหนะ */


	$('#formAdd-VHO').submit(function (e) {


		if ($('#formAdd-VHO').form('is valid') == false) {

			return false;
		}
		var data = $("#formAdd-VHO").serialize();
		e.preventDefault();

		$.ajax({
			type: 'POST',
			url: 'DML-VHO/InsertData.php',
			data: data,


			beforeSend: function () {

			},
			success: function (data) {
				$('#ModalformAdd-VHO').modal('hide');
				$('#formAdd-VHO').form('reset');
				$("#statusOffID").removeClass('green checkmark red remove');
				//  $('#alert-popup-msg').html(data);
				//  $('#alert-popup').modal('show');
				window.location.reload();

			},

			error: function (status, errorThrown) {

				$('#alert-popup-msg').html('Error' + errorThrown);
				$('#alert-popup').modal('show');
			}

		});

	});



	$(".show-link-VHO").click(function () {
		// alert('click');
		var id = $(this).attr("id");
		$('#eform2').load('DML-VHO/showdata-VHO.php?show_id=' + id);
		$('#ModalformShow-VHO').modal('show');
	});

	// แก้ไขข้อมูล ตารางข้อมูลเจ้าหน้าที่ยานพาหนะ
	//  สำหรับเรียกข้อมูลขึ้นมาเพื่อแก้ไข
	$(".edit-link-vho").click(function () {

		var id = $(this).attr("id");
		$('#eform').load('DML-VHO/editForm-VHO.php?edit_id=' + id);
		$('#ModalformEdit-VHO').modal('show');

	});
	//  สำหรับแก้ไขข้อมูล
	$('#formEdit-VHO').submit(function (e) {
		if ($('#formEdit-VHO').form('is valid') == false) {

			return false;
		}

		var data = $("#formEdit-VHO").serialize();
		e.preventDefault();
		$.ajax({
			type: 'POST',
			url: 'DML-VHO/edit.php',
			data: data,

			beforeSend: function () {

			},
			success: function (data) {

				$('#ModalformEdit-VHO').modal('hide');
				$('#formEdit-VHO').form('reset');
				$('#alert-popup-msg').html(data);
				$('#alert-popup').modal('show');
				window.location.reload();
			},
			complete: function () {

			},
			error: function (status, errorThrown) {
				//  alert('Error' +errorThrown  );
				$('#alert-popup-msg').html('Error' + errorThrown);
				$('#alert-popup').modal('show');
			}

		});

	});





	// ลบข้อมูล
	$('.delete-link-vho').click(function () {
		var id = $(this).attr("id");
		var del_id = id;
		var parent = $(this).parent("td").parent("tr");
		$('#confirm-popup-msg').html('คุณต้องการลบข้อมูลเจ้าหน้าที่ รหัส ' + del_id + 'ใช่หรือไม่ ?');
		$('#confirm-popup').modal('show');
		$('#btnConfirm').click(function () {
			$.post('DML-VHO/delete.php', {
				'del_id': del_id
			}, function (data) {
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





	//  $('#btnLoad-Center').click(function(){
	// 	var data = 'office='+$("#btnLoad-Center").attr("name");
	// 	// e.preventDefault();
	// 	jQuery.ajax({
	// 		url  : "list-VHO.php" ,
	// 		// datatype : 'html',
	// 		data : data,
	// 		type : "POST" ,					 
	// 		success: function(response){
	// 				  console.log(data);

	// 			},
	// 		error: function(){

	// 			}
	// 	});


	// });
});