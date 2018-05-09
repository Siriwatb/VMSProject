
<!-- ตารางข้อมูลประเภทยานพาหนะ -->
<div class=" "> <!-- ตั้งชื่อ class ตามงาน เช่น TableDriver , TableVehicle -->
  <h1 class="ui block header">
    <div class="fontMitr">
      <!-- ใส่หัวข้อ ของ เพจนั้น  -->
    </div>
  </h1>
      <button class="ui blue button" id="btnAdd-" > <!-- ตั้ง id button  btnAdd-... ตามด้วยชื่องาน เช่น btnAdd-Driver -->
        <i class="plus icon"></i>
        เพิ่มข้อมูล
      </button>
      <div class="ui horizontal divider">
        <h3 class="fontMitr">
          <!-- ชื่อตาราง เช่น ตารางข้อมูลประเภทยานพาหน -->
        </h3>
      </div>
      <table class="ui celled table" cellspacing="0" width="100%" id=""> <!--  ตั้ง id ตาราง เช่น Driver-Table , Vehicle-Table    -->
        <thead>
          <tr>
            <!-- หัวคอลัมภ์ -->
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
              // select ตามงาน
              $stmt = $conn->prepare("SELECT * FROM `vehicle_type`");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <!-- แสดงคอลัมที่ คิวรี่ -->
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
<!-- จัดการข้อมประเภทยานพาหนะ -->
<div class="ui small modal" id="ModalformAdd-Name"> <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
  <div class="header"></div> <!-- หัวข้อ Modal -->
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-Name" method="post"> <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
          <div class="ui equal width form">

            <div class="fields">
              <div class="required field">
                <label>text Input</label>
                <input type="text" placeholder="xxxxxx" name="TypeName" id="TypeName">
              </div>

            </div>
            <div class="fields">
              <div class="field">
                <label>text Area</label>
                <textarea rows="4" placeholder="xxxxxxx" name="TypeDescription"></textarea>
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
<div class="ui small modal" id="ModalformEdit-Name">
  <div class="header">หัวข้อ</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="drumFormVHType">
          <div class="ui equal width form">
            <div class="fields">
              <div class="required field">
                <label>textInput</label>
                <input type="text" placeholder="ทดลอง" >
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>textarea</label>
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

    // $('#btnAdd-VHType').click(function() {
    //   $('#formAdd-VHType').form('reset');
    //   $("#status").removeClass('green checkmark red remove');
    //   $('#ModalformAdd-VHType').modal('show');
    // });
    //
    // $('#btnExit-VHType').click(function() {
    //   $('#formAdd-VHType').form('reset');
    //   $('#ModalformAdd-VHType').modal('hide');
    //   $("#status").removeClass('green checkmark red remove');
    // });
    // $('#btnEditExit-VHType').click(function(){
    //   $('#formEdit-VHType').form('reset');
    //   $('#ModalformEdit-VHType').modal('hide');
    // });
    //
    // $('#btnAddSubmit-VHType').click(function(){
    //   $('#formAdd-VHType').form('submit');
    // });
    //
    // $('#btnEditSubmit-VHType').click(function() {
    //   $('#formEdit-VHType').form('submit');
    // });

	// });
</script>
<!-- <script>
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
<script src="DML-Vehicle_Type/crud-VHType.js"></script> -->
