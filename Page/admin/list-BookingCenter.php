<?php 
include "header.php";


//$stmt = $conn->prepare("SELECT * FROM Personnel WHERE PersonnelID=:uid");
//$stmt->execute(array(":uid"=>$_SESSION['user_session']));
//$row=$stmt->fetch(PDO::FETCH_ASSOC);

?>

<!-- ตารางข้อมูลประเภทยานพาหนะ -->
<div class="ui container" id='content-loader'>
  <div class="TableBookingCenter">
    <!-- ตั้งชื่อ class ตามงาน เช่น TableDriver , TableVehicle -->
    <h1 class="ui block header">
      <div class="fontMitr">
        จัดการข้อมูลการจองยานพาหนะส่วนกลาง
        <!-- ใส่หัวข้อ ของ เพจนั้น  -->
      </div>
    </h1>
    <button class="ui blue button" id="btnAdd-BookingCenter">
      <!-- ตั้ง id button  btnAdd-... ตามด้วยชื่องาน เช่น btnAdd-Driver -->
      <i class="plus icon"></i>
      เพิ่มข้อมูล
    </button>
    
    <table class="ui celled table" cellspacing="0" width="100%" id="BookingCenter-Table">
      <!--  ตั้ง id ตาราง เช่น Driver-Table , Vehicle-Table    -->
      <thead>
        <tr>
          <!-- หัวคอลัมภ์ -->
          <th>รหัสการใช้งาน</th>
          <th>วันที่เดินทาง</th>
          <th>เวลาไป</th>
          <th>วันที่กลับ</th>
          <th>เวลากลับ</th>
          <th>จุดหมาย</th>
          <th>สถานะการอนุมัติ</th>
          <th>สถานะการใช้งาน</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
        </tr>
      </thead>
      <tbody>
        <?php
              require_once '../../ConfigDB.php';
              // select ตามงาน
              $stmt = $conn->prepare("SELECT * FROM `using`");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
          <tr>
            <!-- แสดงคอลัมที่ คิวรี่ -->
            <td>
              <?php echo $row['UsingID']; ?>
            </td>
            <td>
              <?php echo $row['StartDate']; ?>
            </td>
            <td>
              <?php echo $row['StartTime']; ?>
            </td>
            <td>
              <?php echo $row['EndDate']; ?>
            </td>
            <td>
              <?php echo $row['EndTime']; ?>
            </td>
            <td>
              <?php echo $row['Destination']; ?>
            </td>
            <td>
              <?php echo $row['Approve_Status']; ?>
            </td>
            <td>
              <?php echo $row['Using_Status']; ?>
            </td>
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

<!-- Modal จัดการข้อมประเภทยานพาหนะ -->
<div class="ui small modal" id="ModalformAdd-BookingCenter">
  <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
  <div class="header">จัดการข้อมูลการจองยานพาหนะส่วนกลาง</div>
  <!-- หัวข้อ Modal -->
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-BookingCenter" method="post">
          <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
          <div class="ui equal width form">

            <div class="fields">
              <div class="required field">
                <label>เวลาออกเดินทาง</label>
                <div class="ui calendar" id='st'>
                <input type="text" placeholder="เวลาออกเดินทาง" name="startTime" id="startTime" >
                </div>
              </div>
              <div class="required field">
                <label>เวลากลับ</label>
                <div class="ui calendar" id='nt'>
                <input type="text" placeholder="เวลากลับ" name="endTime" id="endTime">
              </div>
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>วันที่ไป</label>
                <!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
                <div class="ui calendar" id="startDate">
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="วันที่ไป" name="stDate" id="stDate">
                  </div>
                </div>
              </div>
              <div class="field">
                <label>วันที่กลับ</label>
                <!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
                <div class="ui calendar" id="EndDate">
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="วันที่กลับ" name="enDate" id="enDate">
                  </div>
                </div>
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>จำนวนคน</label>
                <input type="number" placeholder="จำนวนคน" name="NumPeople" id="NumPeople">
              </div>
              <div class="field">
                <label>จุดหมายปลายทาง</label>
                <input type="text" placeholder="จุดหมายปลายทาง" name="Destination" id="Destination">
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>จุดประสงค์การเดินทาง</label>
                <textarea rows="3" placeholder="จุดประสงค์การเดินทาง" name="Reason" id="Reason"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui red button" id="btnExit-BookingCenter">
      ยกเลิก
    </div>
    <div class="ui  green button" id="btnAddSubmit-BookingCenter">
      เพิ่มข้อมูล
    </div>
  </div>
</div>

<!-- ฟอร์มแก้ไข  -->
<div class="ui small modal" id="ModalformEdit-BookingCenter">
  <div class="header">จัดการข้อมูลการจอง</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="drumFormVHType">
          <div class="ui equal width form">
            <div class="fields">
              <div class="required field">
                <label>textInput</label>
                <input type="text" placeholder="ทดลอง">
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>textarea</label>
                <textarea rows="4" placeholder="ทดลอง"></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui red button" id="btnEditExit-BookingCenter">
      ยกเลิก
    </div>
    <div class="ui green button" id="btnEditSubmit-BookingCenter">
      Booking
    </div>
  </div>
</div>




<script>
  // $(document).ready(function(){
  var calendarText = {

    days: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
    months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน',
      'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
    ],
    monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
    today: 'Today',
    now: 'Now',
    am: 'AM',
    pm: 'PM'

  }

  $('.ui.dropdown').dropdown();
  $('#BookingCenter-Table').DataTable({
    "pageLength": 10,
    "bLengthChange": false,
    "language": {
      "lengthMenu": "แสดง _MENU_ ต่อหน้า",
      "zeroRecords": "ไม่พบข้อมูล",
      "info": "แสดงหน้า _PAGE_ จากทั้งหมด _PAGES_ หน้า",
      "infoEmpty": "ไม่มีข้อมูล",
      "infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ total ข้อมูล)",
      "search": "ค้นหา",
      "paginate": {
        "first": "หน้าแรก",
        "last": "หน้าสุดท้าย",
        "next": "ต่อไป",
        "previous": "ก่อนหน้า"
      }
    },
    "bDestroy": true,

  });
  $('.ui.modal').modal({
    closable: false,
    autofocus: false
  });

  $('#btnAdd-BookingCenter').click(function () {
    $('#startDate').calendar({
      type: 'date',
      text: calendarText,
      constantHeight: false,
      formatter: {
        date: function (date, settings) {
          if (!date) return '';
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          return day + '/' + month + '/' + year;
        }
      },
      endCalendar: $('#EndDate')
    });
    $('#EndDate').calendar({
      type: 'date',
      text: calendarText,
      constantHeight: false,
      formatter: {
        date: function (date, settings) {
          if (!date) return '';
          var day = date.getDate();
          var month = date.getMonth() + 1;
          var year = date.getFullYear();
          return day + '/' + month + '/' + year;
        }      
      },
      startCalendar:$('#startDate')
    });
    $('#st').calendar({
      type:'time',
      ampm: false
    });
    $('#nt').calendar({
      type:'time',
      ampm: false
    });
    $('#formAdd-BookingCenter').form('reset');
    $('#formAdd-BookingCenter').form('clear');
    // $("#status").removeClass('green checkmark red remove');
    $('#ModalformAdd-BookingCenter').modal('show');
  });
  //
  $('#btnExit-BookingCenter').click(function () {
    $('#formAdd-BookingCenter').form('reset');
    $('#ModalformAdd-BookingCenter').modal('hide');

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