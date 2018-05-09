<?php 
include "header.php";
require_once '../../ConfigDB.php';

 ?>

<div class="ui container" id='content-loader'>

   <!-- ตารางข้อมูลประเภทยานพาหนะ -->
<div class="TableVHType">
  <h1 class="ui block header">
    <div class="fontMitr">
      จัดการประเภทยานพาหนะ
    </div>
  </h1>
      <button class="ui blue button" id="btnAdd-VHType" >
        <i class="plus icon"></i>
        เพิ่มข้อมูล
      </button>
      
      <table class="ui celled table" cellspacing="0" width="100%" id="VH-Type-Table">
        <thead>
          <tr>
          <th>รหัสประเภท</th>
          <th>ชื่อประเภท</th>
          <th>รายละเอียด</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT * FROM `vehicle_type`");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <td><?php echo $row['TypeID']; ?></td>
              <td><?php echo $row['Name_Type']; ?></td>
              <td><?php echo $row['Description']; ?></td>
              <td>
                      <a id="<?php echo $row['TypeID']; ?>" class="edit-link-VHType" href="#" title="แก้ไข">
                      <i class="write square icon"></i>
                      </a>
              </td>
              <td>
                      <a id="<?php echo $row['TypeID']; ?>" class="delete-link-VHType" href="#" title="ลบ">
                            <i class="trash icon"></i>
                      </a>
              </td>
            </tr>
              <?php
            }
            ?>
          </tbody>
      </table>

</div>
</div>
<!-- จัดการข้อมประเภทยานพาหนะ -->
<div class="ui small modal" id="ModalformAdd-VHType">
  <div class="header">จัดการข้อมูลประเภทยานพาหนะ</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-VHType" method="post">
          <div class="ui equal width form">

            <div class="fields">
              <div class="required field">
                <label>ชื่อประเภท</label>
                <div class="ui icon input" id="loadingCheck">
                <input type="text" placeholder="กรอกชื่อประเภท" name="TypeName" id="TypeName" onblur="checkAvailabilityTName()">
                <i class="icon" id="status"></i>
                </div>
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>รายละเอียด</label>
                <textarea rows="4" placeholder="ระบุรายละเอียด" name="TypeDescription"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui red button" id="btnExit-VHType">
        ยกเลิก
    </div>
    <div class="ui disabled green button" id="btnAddSubmit-VHType" >
        เพิ่มข้อมูล
    </div>
  </div>
</div>

<!-- ฟอร์มแก้ไข  -->
<div class="ui small modal" id="ModalformEdit-VHType">
  <div class="header">จัดการข้อมูลประเภทยานพาหนะ</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="drumFormVHType">
          <div class="ui equal width form">
            <div class="fields">
              <div class="required field">
                <label>ชื่อประเภท</label>
                <input type="text" placeholder="ทดลอง" >
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>รายละเอียด</label>
                <textarea rows="4" placeholder="ทดลอง" ></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui red button" id="btnEditExit-VHType">
        ยกเลิก
    </div>
    <div class="ui green button" id="btnEditSubmit-VHType" >
        แก้ไขข้อมูล
    </div>
  </div>
</div>




<script>
	// $(document).ready(function(){
		$('#VH-Type-Table').DataTable({
			"bLengthChange": false,
      "language":{
						"lengthMenu": "แสดง _MENU_ ต่อหน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดงหน้า _PAGE_ จากทั้งหมด _PAGES_ หน้า",
            "infoEmpty": "ไม่มีข้อมูล",
            "infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ total ข้อมูล)",
						"search":         "ค้นหา",
						"paginate": {
				        "first":      "หน้าแรก",
				        "last":       "หน้าสุดท้าย",
				        "next":       "ต่อไป",
				        "previous":   "ก่อนหน้า"
				    }
			},
      "bDestroy": true
		});
    $('.ui.modal').modal({
      closable : false,
      autofocus : false
    });

    $('#btnAdd-VHType').click(function() {
      $('#formAdd-VHType').form('reset');
      $("#status").removeClass('green checkmark red remove');
      $('#ModalformAdd-VHType').modal('show');
    });

    $('#btnExit-VHType').click(function() {
      $('#formAdd-VHType').form('reset');
      $('#ModalformAdd-VHType').modal('hide');
      $("#status").removeClass('green checkmark red remove');
    });
    $('#btnEditExit-VHType').click(function(){
      $('#formEdit-VHType').form('reset');
      $('#ModalformEdit-VHType').modal('hide');
    });

    $('#btnAddSubmit-VHType').click(function(){
      $('#formAdd-VHType').form('submit');
    });

    $('#btnEditSubmit-VHType').click(function() {
      $('#formEdit-VHType').form('submit');
    });

	// });
</script>
<script>
function checkAvailabilityTName() {
  jQuery.ajax({
  url: "DML-Vehicle_Type/check_TypeName.php",
  data: 'TypeName='+$("#TypeName").val(),
  type: "POST",
  beforeSend: function(){
    $("#loadingCheck").addClass("loading");
    $("#status").removeClass('green checkmark red remove');
  },
  success:function(data){
    $("#loadingCheck").removeClass("loading");
    $("#status").addClass(data);
    if (data=='green checkmark') {
      $('#btnAddSubmit-VHType').removeClass('disabled')
    }
    else {
      $('#btnAddSubmit-VHType').addClass('disabled')
    }

  },
  error:function (){}
  });
}
</script>
<script src="DML-Vehicle_Type/crud-VHType.js"></script>
