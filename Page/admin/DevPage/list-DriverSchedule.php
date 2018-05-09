
<!-- ตารางข้อมูลประเภทยานพาหนะ -->
<div class="TableDriverSchedule"> <!-- ตั้งชื่อ class ตามงาน เช่น TableDriver , TableVehicle -->
  <h1 class="ui block header">
    <div class="fontMitr">
      จัดการข้อมูลเวลาคนขับยานพาหนะ <!-- ใส่หัวข้อ ของ เพจนั้น  -->
    </div>
  </h1>
      <button class="ui blue button" id="btnAdd-DriverSchedule" > <!-- ตั้ง id button  btnAdd-... ตามด้วยชื่องาน เช่น btnAdd-Driver -->
        <i class="plus icon"></i>
        เพิ่มข้อมูล
      </button>
      <div class="ui horizontal divider">
        <h3 class="fontMitr">
          ตารางข้อมูลตารางเวลาคนขับยานพาหนะ <!-- ชื่อตาราง เช่น ตารางข้อมูลประเภทยานพาหน -->
        </h3>
      </div>
      <table class="ui celled table" cellspacing="0" width="100%" id="DriverSchedule-Table"> <!--  ตั้ง id ตาราง เช่น Driver-Table , Vehicle-Table    -->
        <thead>
          <tr>
            <!-- หัวคอลัมภ์ -->
          <th>รหัสรายการใช้งาน</th>
          <th>รหัสเจ้าหน้าที่</th>
          <th>ตำแหน่งขับ</th>
          <th>สถานะรับทราบงาน</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../../ConfigDB.php';
              // select ตามงาน
              $stmt = $conn->prepare("SELECT * FROM `work_schedules`");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <!-- แสดงคอลัมที่ คิวรี่ -->
              <td><?php echo $row['ListID']; ?></td>
              <td><?php echo $row['OfficerID']; ?></td>
              <td><?php echo $row['Position']; ?></td>
              <td><?php echo $row['Status_job']; ?></td>
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
<div class="ui small modal" id="ModalformAdd-DriverSchedule"> <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
  <div class="header">จัดการข้อมูลเวลาคนขับยานพาหนะ</div> <!-- หัวข้อ Modal -->
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-DriverSchedule" method="post"> <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
          <div class="ui equal width form">

            <div class="fields">
              <div class="required field">
                <label>รหัสรายการใช้งาน</label>
                <input type="text" placeholder="xxxxxx" name="TypeName" id="TypeName">
              </div>
              <div class="field">
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>รหัสเจ้าหน้าที่</label>
                <input type="text" placeholder="xxxxxx" name="TypeName" id="TypeName">
              </div>
              <div class="field">
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>ตำแหน่งขับ</label>
                <div class="ui selection dropdown">
                  <input type="hidden" name="gender">
                  <i class="dropdown icon"></i>
                  <div class="default text">ตำแหน่งขับ</div>
                  <div class="menu">
                    <div class="item" data-value="1">พนักงานขับ</div>
                    <div class="item" data-value="2">ผู้ช่วยพนักงานขับ</div>
                  </div>
                </div>
              </div>
              <div class="field">
                </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui red button" id="btnExit-DriverSchedule">
        ยกเลิก
    </div>
    <div class="ui disabled green button" id="btnAddSubmit-DriverSchedule" >
        เพิ่มข้อมูล
    </div>
  </div>
</div>

<!-- ฟอร์มแก้ไข  -->
<div class="ui small modal" id="ModalformEdit-DriverSchedule">
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
    <div class="ui red button" id="btnEditExit-DriverSchedule">
        ยกเลิก
    </div>
    <div class="ui green button" id="btnEditSubmit-DriverSchedule" >
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
		$('#DriverSchedule-Table').DataTable({
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

    $('#btnAdd-DriverSchedule').click(function() {
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
      $('#formAdd-DriverSchedule').form('reset');
      $('#formAdd-DriverSchedule').form('clear');
      // $("#status").removeClass('green checkmark red remove');
      $('#ModalformAdd-DriverSchedule').modal('show');
    });
    //
    $('#btnExit-DriverSchedule').click(function() {
      $('#formAdd-Booking').form('reset');
      $('#ModalformAdd-DriverSchedule').modal('hide');

    });


</script>
