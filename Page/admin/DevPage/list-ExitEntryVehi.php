
<!-- ตารางข้อมูลประเภทยานพาหนะ -->
<div class="TableExitEntryVehi"> <!-- ตั้งชื่อ class ตามงาน เช่น TableDriver , TableVehicle -->
  <h1 class="ui block header">
    <div class="fontMitr">
      จัดการข้อมูลเข้า-ออก ยานพาหนะ <!-- ใส่หัวข้อ ของ เพจนั้น  -->
    </div>
  </h1>
      <button class="ui blue button" id="btnAdd-ExitEntryVehi" > <!-- ตั้ง id button  btnAdd-... ตามด้วยชื่องาน เช่น btnAdd-Driver -->
        <i class="plus icon"></i>
        เพิ่มข้อมูล
      </button>
      <div class="ui horizontal divider">
        <h3 class="fontMitr">
          ตารางข้อมูลเข้า-ออก ยานพาหนะ <!-- ชื่อตาราง เช่น ตารางข้อมูลประเภทยานพาหน -->
        </h3>
      </div>
      <table class="ui celled table" cellspacing="0" width="100%" id="ExitEntryVehi-Table"> <!--  ตั้ง id ตาราง เช่น Driver-Table , Vehicle-Table    -->
        <thead>
          <tr>
            <!-- หัวคอลัมภ์ -->
          <th>รหัสการใช้งาน</th>
          <th>วันที่เดินทาง</th>
          <th>เวลาไป</th>
          <th>วันที่กลับ</th>
          <th>เวลากลับ</th>
          <th>ผู้ขอใช้</th>
          <th>สถานที่ไป</th>
          <th>เวลาเข้า</th>
          <th>เวลาออก</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../../ConfigDB.php';
              // select ตามงาน
              $stmt = $conn->prepare("SELECT * FROM `list_using`");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <!-- แสดงคอลัมที่ คิวรี่ -->
              <td><?php echo $row['UsingID']; ?></td>
              <td><?php echo $row['StartDate']; ?></td>
              <td><?php echo $row['StartTime']; ?></td>
              <td><?php echo $row['EndDate']; ?></td>
              <td><?php echo $row['EndTime']; ?></td>
              <td><?php echo $row['PersonnelID']; ?></td>
              <td><?php echo $row['Destination']; ?></td>
              <td><?php echo $row['EntryTime']; ?></td>
              <td><?php echo $row['ExitTime']; ?></td>
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
<div class="ui small modal" id="ModalformAdd-ExitEntryVehi"> <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
  <div class="header">จัดการข้อมูลเข้า-ออก ยานพาหนะ</div> <!-- หัวข้อ Modal -->
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-ExitEntryVehi" method="post"> <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
          <div class="ui equal width form">

            <div class="fields">
              <div class="required field">
                <label>รหัสยานพาหนะ</label>
                <input type="text" placeholder="xxxxxx" name="TypeName" id="TypeName">
              </div>
              <div class="field">
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>หมายเลขทะเบียน</label>
                <input type="text" placeholder="xxxxxx" name="TypeName" id="TypeName">
              </div>
              <div class="field">
              </div>
            </div>
          <div class="fields">
            <div class="field">
                <label> เข้า/ออก </label>
              </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="frequency" checked="checked">
                <label>เข้า</label>
              </div>
            </div>
            <div class="field">
              <div class="ui radio checkbox">
                <input type="radio" name="frequency">
                <label>ออก</label>
              </div>
            </div>
            <div class="field">
            </div>
            <div class="field">
            </div>
            <div class="field">
            </div>
          </div>
            <div class="fields">
              <div class="field">
                <label>วันที่เข้า</label>
                <!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
                <div class="ui calendar" id="Date">
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="xxxxx" name="">
                  </div>
                </div>
              </div>
              <div class="field">
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>วันที่ออก</label>
                <!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
                <div class="ui calendar" id="Date">
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="xxxxx" name="">
                  </div>
                </div>
              </div>
              <div class="field">
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>เวลาเข้า</label>
                <input type="text" placeholder="xxxxxx" name="TypeName" id="TypeName">
              </div>
              <div class="field">
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>เวลาออก</label>
                <input type="text" placeholder="xxxxxx" name="TypeName" id="TypeName">
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
    <div class="ui red button" id="btnExit-ExitEntryVehi">
        ยกเลิก
    </div>
    <div class="ui disabled green button" id="btnAddSubmit-ExitEntryVehi" >
        บันทึกข้อมูล
    </div>
  </div>
</div>

<!-- ฟอร์มแก้ไข  -->
<div class="ui small modal" id="ModalformEdit-ExitEntryVehi">
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
    <div class="ui red button" id="btnEditExit-ExitEntryVehi">
        ยกเลิก
    </div>
    <div class="ui green button" id="btnEditSubmit-ExitEntryVehi" >
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
		$('#ExitEntryVehi-Table').DataTable({
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

    $('#btnAdd-ExitEntryVehi').click(function() {
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
      $('#formAdd-ExitEntryVehi').form('reset');
      $('#formAdd-ExitEntryVehi').form('clear');
      // $("#status").removeClass('green checkmark red remove');
      $('#ModalformAdd-ExitEntryVehi').modal('show');
    });
    //
    $('#btnExit-ExitEntryVehi').click(function() {
      $('#formAdd-ExitEntryVehi').form('reset');
      $('#ModalformAdd-ExitEntryVehi').modal('hide');

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
