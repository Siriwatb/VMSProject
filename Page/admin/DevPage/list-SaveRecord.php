
<!-- ตารางข้อมูลประเภทยานพาหนะ -->
<div class="TableSaveRecord"> <!-- ตั้งชื่อ class ตามงาน เช่น TableDriver , TableVehicle -->
  <h1 class="ui block header">
    <div class="fontMitr">
      จัดการข้อมูลบันทึกหลังการใช้ยานพาหนะ <!-- ใส่หัวข้อ ของ เพจนั้น  -->
    </div>
  </h1>
      <button class="ui blue button" id="btnAdd-SaveRecord" > <!-- ตั้ง id button  btnAdd-... ตามด้วยชื่องาน เช่น btnAdd-Driver -->
        <i class="plus icon"></i>
        เพิ่มข้อมูล
      </button>
      <div class="ui horizontal divider">
        <h3 class="fontMitr">
          ตารางข้อมูลบันทึกหลังการใช้ยานพาหนะ <!-- ชื่อตาราง เช่น ตารางข้อมูลประเภทยานพาหน -->
        </h3>
      </div>
      <table class="ui celled table" cellspacing="0" width="100%" id="SaveRecord-Table"> <!--  ตั้ง id ตาราง เช่น Driver-Table , Vehicle-Table    -->
        <thead>
          <tr>
            <!-- หัวคอลัมภ์ -->
          <th>เลขที่</th>
          <th>รหัสรายการใช้งาน</th>
          <th>วันที่</th>
          <th>น้ำมันเชื้อเพลิง</th>
          <th>หมายเลขไมล์หลังใช้งาน</th>
          <th>ระยะทางที่ใช้งาน</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../../ConfigDB.php';
              // select ตามงาน
              $stmt = $conn->prepare("SELECT * FROM `save_record`");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <!-- แสดงคอลัมที่ คิวรี่ -->
              <td><?php echo $row['RecNo']; ?></td>
              <td><?php echo $row['ListID']; ?></td>
              <td><?php echo $row['RecDate']; ?></td>
              <td><?php echo $row['Fuel']; ?></td>
              <td><?php echo $row['Odometer_After']; ?></td>
              <td><?php echo $row['Distance']; ?></td>
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

<!-- Modal จัดการข้อมประเภทยานพาหนะ -->
<div class="ui small modal" id="ModalformAdd-SaveRecord"> <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
  <div class="header">จัดการข้อมูลบันทึกหลังการใช้งานยานพาหนะ</div> <!-- หัวข้อ Modal -->
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-SaveRecord" method="post"> <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
          <div class="ui equal width form">

            <div class="fields">
              <div class="required field">
                <label>หมายเลขไมล์ก่อนใช้งาน</label>
                <input type="text" placeholder="xxxxxx" name="TypeName" id="TypeName">
              </div>
              <div class="field">
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>หมายเลขไมล์หลังใช้งาน</label>
                <input type="text" placeholder="xxxxxx" name="TypeName" id="TypeName">
              </div>
              <div class="field">
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>เชื้อเพลิง</label>
                <input type="text" placeholder="xxxxxx" name="TypeName" id="TypeName">
              </div>
              <div class="field">
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>รายละเอียด</label>
                <textarea rows="3" placeholder="xxxxxxx" name="TypeDescription"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui red button" id="btnExit-SaveRecord">
        ยกเลิก
    </div>
    <div class="ui disabled green button" id="btnAddSubmit-SaveRecord" >
        เพิ่มข้อมูล
    </div>
  </div>
</div>

<!-- ฟอร์มแก้ไข  -->
<div class="ui small modal" id="ModalformEdit-SaveRecord">
  <div class="header">จัดการข้อมูลเวลาคนขับยานพาหนะ</div>
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
    <div class="ui red button" id="btnEditExit-SaveRecord">
        ยกเลิก
    </div>
    <div class="ui green button" id="btnEditSubmit-SaveRecord" >
        DriverSchedule
    </div>
  </div>
</div>




<script>
	// $(document).ready(function(){
  var calendarText = {

    days: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
    months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
    monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
    today: 'Today',
    now: 'Now',
    am: 'AM',
    pm: 'PM'

  }

  $('.ui.dropdown').dropdown();
		$('#SaveRecord-Table').DataTable({
      "pageLength": 10,
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
      "bDestroy": true,

		});
    $('.ui.modal').modal({
      closable : false,
      autofocus : false
    });

    $('#btnAdd-SaveRecord').click(function() {
      $('#Date').calendar({
        type:'date',
        text : calendarText,
        constantHeight: false,
        formatter: {
          date: function (date, settings) {
            if (!date) return '';
            var day = date.getDate();
            var month = date.getMonth()+1;
            var year = date.getFullYear();
            return day + '/' + month + '/' + year;
          }
        }
      });
      $('#formAdd-SaveRecord').form('reset');
      $('#formAdd-SaveRecord').form('clear');
      // $("#status").removeClass('green checkmark red remove');
      $('#ModalformAdd-SaveRecord').modal('show');
    });
    //
    $('#btnExit-SaveRecord').click(function() {
      $('#formAdd-SaveRecord').form('reset');
      $('#ModalformAdd-SaveRecord').modal('hide');

    });
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
