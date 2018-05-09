<?php 
include "header.php";
include_once '../../ConfigDB.php';

function set_session($id){
  $_SESSION['usingID'] = $id;
  echo'<script> alert("ลองสัส")</script>';

}
?>
<script src='DML-Booking/crudBooking.js'></script>
<div class="ui container">
  <!-- ตารางข้อมูลพนักงานขับยานพาหนะ -->
  
    <h1 class="ui block header">
      <div class="fontMitr">
        จองยานพาหนะ
      </div>
    </h1>
    <button class="ui blue button" id="btnAdd-BookingVH">
      <i class="plus icon"></i>
      จองยานพาหนะ
    </button>
    <!-- <div class="ui hidden divider"></div> -->

    <table class="ui celled table" cellspacing="0" width="100%" id="Booking-Table">
      <thead>
        <tr>
          <th>รหัสการจอง</th>
          <th>วัน - เวลาไป</th>
          <th>วัน - เวลากลับ</th>
          <th>ชื่อผู้จอง</th>
          <th>สถานะการอนุมัติ</th>
          <th>เพิ่มเติม</th>
          <th>ลบ</th>
        </tr>
      </thead>
      <tbody>
        <?php
              require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT `UsingID`,`Destination`,p.Name as namePer,fac.Name,`Start Date`,`Appointment`,`End Date`,`Start Time`,`End Time`,`Approve Date`,`Reason`,`NumPeople`,`Controller` ,CONCAT(DATE_FORMAT(`Start Date`,'%d/%c/%Y'),' - ', TIME_FORMAT(`Start Time`,'%H:%i'))AS SdateStime, CONCAT(DATE_FORMAT(`End Date`,'%d/%c/%Y'), ' - ', TIME_FORMAT(`End Time`,'%H:%i')) AS EdateEtime, `Approve Status`
                                      FROM `using` as u left join personnel as p on u.PersonnelID = p.PersonnelID 
                                      join faculty as fac on p.Department = fac.ID 
                                      where u.PersonnelID= :PersonnelID ");
              $stmt->bindParam(":PersonnelID", $_SESSION['user_session']);
              $stmt->execute();
              $uid ;
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
            {
            ?>
          <tr>
            <td>
              <?php echo $row['UsingID']; ?>
            </td>
            <td>
              <?php echo $row['SdateStime']; ?>
            </td>
            <td>
              <?php echo $row['EdateEtime']; ?>
            </td>
            <td>
              <?php echo $row['namePer']; ?>
            </td>
            <td>
              <?php 
              $ap = $row['Approve Status']; 
              if ($ap==0) {
                echo "<a class='ui red label'>ไม่อนุมัติ</a>";
              }elseif ($ap==1) {
                echo "<a class='ui green label'>อนุมัติ</a>";
              }elseif ($ap==2) {  
                echo "<a class='ui yellow label'>รอการอนุมัติ</a>";
              }
              
              ?>
            </td>

            <td>
            <a             
                class="Show_Button show-link-Booking"  title="แสดงข้อมูล"      
                BookingDstart="<?php echo $row['Start Date'];?>" 
                BookingDend="<?php echo  $row['End Date'];?>"
                BookingTstart="<?php echo  $row['Start Time'];?>" 
                BookingTend="<?php echo $row['End Time'];?>" 
                BookingRe="<?php echo  $row['Reason'];?>"
                BookingApp="<?php echo  $row['Appointment'];?>" 
                BookingNum="<?php echo  $row['NumPeople'];?>" 
                BookingDe="<?php echo  $row['Destination'];?>"
                OnClick="showCar(<?php echo  $row['UsingID'];?>)"
                >
                <i class="search icon"></i>
              </a>     
            </td>
            <td>
              <a id="<?php echo $row['UsingID']; ?>" class="delete-link-M" href="#" title="ลบ">
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

<div class="ui large coupled first modal" id="ModalformAdd-BookingVH">
  <div class="header">จองยานพาหนะ</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-BookingVH" method="post">
          <div class="ui equal width form">
            <div class="fields">
              <div class="required field">
                <label>วันที่เดินทาง</label>
                <div class="ui calendar" id="DateStart">
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="วันที่เดินทาง" name="StartDate" id="StartDate">
                  </div>
                </div>
              </div>
              <div class="required field">
                <label>วันที่กลับ</label>
                <div class="ui calendar" id="DateEnd">
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="วันที่กลับ" name="EndDate" id="EndDate">
                  </div>
                </div>
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>เวลาออกเดินทาง</label>
                <div class="ui calendar" id="STime">
                  <div class="ui right labeled  input left icon">
                    <i class="time icon"></i>
                    <input type="text" placeholder="เวลาออกเดินทาง" name='StartTime' id="StartTime">
                    <div class="ui basic label">
                      น.
                    </div>
                  </div>
                </div>
              </div>
              <div class="required field">
                <label>เวลากลับ</label>
                <div class="ui calendar" id="ETime">
                  <div class="ui right labeled  input left icon">
                    <i class="time icon"></i>
                    <input type="text" placeholder="เวลากลับ" name='EndTime' id="EndTime">
                    <div class="ui basic label">
                      น.
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>จุดหมายปลายทาง</label>
                <textarea rows="4" placeholder="ระบุจุดหมายปลายทาง" name="destination" id="destination"></textarea>
              </div>
              <div class="field">
                <label>จำนวนที่นั่ง</label>
                <input type="text" placeholder="จำนวนที่นั่ง" name="numSeat" id="numSeat">
              </div>

              <!-- <div class="field">
              </div> -->
            </div>
            <div class="fields">

              <div class="required field">
                <label>จุดนัดขึ้นรถ</label>
                <textarea rows="4" placeholder="จุดนัดขึ้นรถ" name="appointment" id="appointment"></textarea>
              </div>
              <div class="required field">
                <label>จุดประสงค์การเดินทาง</label>
                <textarea rows="4" placeholder="ระบุจุดประสงค์การเดินทาง" name="reason" id="reason"></textarea>
              </div>
            </div>
            <!-- <div class="fields">
              <div class="required field">
                <label>จุดนัดขึ้นรถ</label>
                <textarea rows="3" placeholder="จุดนัดขึ้นรถ" id="appointment" ></textarea>
              </div>
            </div> -->
            <div class="fields">
              <input type="text" id="arrayCar" name="arrayCar" style="display:none">

            </div>
          </div>
          <div class="ui basic button" id="btnSelectVH">
            <i class="plus icon"></i>
            เลือกยานพาหนะ
          </div>
          <table class="ui celled table" cellspacing="0" width="100%" id="BookingVH">
            <thead>
              <tr>
                <th>รหัสยานพาหนะ</th>
                <th>หมายเลขทะเบียน</th>
                <th>ประเภท</th>
                <th>สังกัด</th>
                <th>ลบ</th>
              </tr>
            </thead>
            <tbody id="setCAR">

            </tbody>
          </table>
        </form>
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui reset red deny button" id="btnExit-VHO">
      ยกเลิก
    </div>
    <div class="ui green submit button" id="btnAddVHO-Submit">
      บันทึกการจอง
    </div>
  </div>
</div>

<div class="ui small modal" id='ModalSelectVH'>
  <div class="header">เลือกยานพาหนะ</div>
  <div class="content">
    <table class="ui celled table" cellspacing="0" width="100%" id="SelectVHTable">
      <thead>
        <tr>
          <th>รูปภาพ</th>
          <th>รหัสยานพาหนะ</th>
          <th>เลขทะเบียน</th>
          <th>เลือก</th>
        </tr>
      </thead>
      <tbody>
        <?php
                    require_once '../../ConfigDB.php';
                    $stmt2 = $conn->prepare("SELECT `VehicleID`,`Registration`,`Picture`,vt.Name_Type nametype,fc.Name nameFc FROM `vehicle` v JOIN vehicle_type vt on v.`TypeID` = vt.TypeID JOIN faculty fc on v.`Department` = fc.ID ");
                    $stmt2->bindParam(":Office", $_SESSION['Office']);
                    $stmt2->execute();
                    while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                  ?>
          <tr>
            <td>
              <img class="ui small image" src="../../images/Vehicles-Images/<?php echo $row2['Picture']; ?>">
            </td>
            <td>
              <?php echo $row2['VehicleID']; ?>
            </td>
            <td>
              <?php echo $row2['Registration']; ?>
            </td>
            <td>

              <div class="ui green button select-link-VH" onclick="setCar('<?php echo $row2['VehicleID']; ?>','<?php echo $row2['Registration']; ?>','<?php echo $row2['nametype']; ?>','<?php echo $row2['nameFc']; ?>')"
                id="<?php echo $row2['VehicleID']; ?>">
                เลือก
              </div>
              <!-- </a> -->
            </td>
          </tr>
          <?php
                  }
                  ?>
      </tbody>
    </table>
  </div>
  <div class="actions">
    <div class="ui reset red deny button" id="btnSelectCancel">
      ยกเลิก
    </div>
  </div>
</div>

<div class="ui large  modal" id="ModalformShow-BookingPersonnel">
  <div class="header">จองยานพาหนะ</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-Booking" method="post">
          <div class="ui equal width form">
            <div class="fields">
              <div class="required field">
                <label>วันที่เดินทาง</label>
                <div class="ui calendar" >
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="วันที่เดินทาง"  id="StartDateShow" readonly=""> 
                  </div>
                </div>
              </div>
              <div class="required field">
                <label>วันที่กลับ</label>
                <div class="ui calendar" >
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="วันที่กลับ" id="EndDateShow" readonly="">
                  </div>
                </div>
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>เวลาออกเดินทาง</label>
                <div class="ui calendar" >
                  <div class="ui right labeled  input left icon">
                    <i class="time icon"></i>
                    <input type="text" placeholder="เวลาออกเดินทาง" id="StartTimeShow" readonly="" >
                    <div class="ui basic label">
                      น.
                    </div>
                  </div>
                </div>
              </div>
              <div class="required field">
                <label>เวลากลับ</label>
                <div class="ui calendar" >
                  <div class="ui right labeled  input left icon">
                    <i class="time icon"></i>
                    <input type="text" placeholder="เวลากลับ" id="EndTimeShow" readonly="">
                    <div class="ui basic label">
                      น.
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>จุดหมายปลายทาง</label>
                <textarea rows="4" placeholder="ระบุจุดหมายปลายทาง" id="DestinationShow" readonly="" ></textarea>
              </div>
              <div class="field">
                <label>จำนวนคน</label>
                <input type="text" placeholder="จำนวนคน" id="NumPeopleShow" readonly="">
              </div>

              <!-- <div class="field">
              </div> -->
            </div>
            <div class="fields">

              <div class="required field">
                <label>จุดนัดขึ้นรถ</label>
                <textarea rows="4" placeholder="จุดนัดขึ้นรถ" id="AppointmentShow" readonly=""></textarea>
              </div>
              <div class="required field">
                <label>จุดประสงค์การเดินทาง</label>
                <textarea rows="4" placeholder="ระบุจุดประสงค์การเดินทาง" id="ReasonShow" readonly="" ></textarea>
              </div>
            </div>
            <!-- <div class="fields">
              <input type="text" id="arrayCar" name="arrayCar" style="display:none">

            </div> -->
          </div>
          
          <!-- here -->
          <iframe id='fShowdata' name='fShowdata' src="DML-Booking/showdata.php?uid=21" width="100%" height="250" frameborder=0></iframe> 
        </form>
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui reset red deny button" id="btnExit-VHO">
      ปิด
    </div>
    
  </div>
</div>


<script>
  var calendarText = {

    days: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
    months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม',
      'กันยายน',
      'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
    ],
    monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.',
      'พ.ย.', 'ธ.ค.'
    ],
    today: 'Today',
    now: 'Now',
    am: 'AM',
    pm: 'PM'

  }
        $('.Show_Button').click(function () {

      //get data from edit btn
      var uid = $(this).attr('Uid');
      var StartDateShow = $(this).attr('BookingDstart');
      var EndDateShow = $(this).attr('BookingDend');
      var StartTimeShow = $(this).attr('BookingTstart');
      var EndTimeShow = $(this).attr('BookingTend');
      var ReasonShow= $(this).attr('BookingRe');
      var AppointmentShow = $(this).attr('BookingApp');
      var NumPeopleShow = $(this).attr('BookingNum');
      var DestinationShow = $(this).attr('BookingDe');
      //set value to modal
      // $('#VehicleIDShow').val(VehicleIDShow);
      // document.getElementById("PictureShow").src = "../../images/Vehicles-Images/" + PictureShow;
      // $('#PictureShow').val(PictureShow);
      $('#hideUID').val(uid);
      $('#StartDateShow').val(StartDateShow);
      $('#EndDateShow').val(EndDateShow);
      $('#StartTimeShow').val(StartTimeShow);
      $('#EndTimeShow').val(EndTimeShow);
      $('#ReasonShow').val(ReasonShow);
      $('#AppointmentShow').val(AppointmentShow);
      $('#NumPeopleShow').val(NumPeopleShow);
      $('#DestinationShow').val(DestinationShow);

      $('#ModalformShow-BookingPersonnel').modal('show');
      });
  $(document).ready(function () {
    $('.coupled.modal').modal({
      allowMultiple: false
    });
    // attach events to buttons
    $('.second.modal').modal('attach events', '.first.modal .button');
    // show first now

    $('#Booking-Table').DataTable({
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
      "bDestroy": true
    });
    $('#BookingVH').DataTable({
      "language": {
        "lengthMenu": "แสดง _MENU_ ต่อหน้า",
        "zeroRecords": "ไม่มีข้อมูล",
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
      paging: false,
      searching: false,
      info: false
    });


    $('#btnAdd-BookingVH').click(function () {

      $('#ModalformAdd-BookingVH').modal('show');
      $('#DateStart').calendar({
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
        endCalendar: $('#DateEnd')
      });
      $('#DateEnd').calendar({
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
        startCalendar: $('#DateStart')
      });
      $('#STime').calendar({
        ampm: false,
        type: 'time'
      });
      $('#ETime').calendar({
        ampm: false,
        type: 'time'
      });


    });
    $('#btnAddVHO-Submit').click(function () {
      $('#formAdd-BookingVH').form('submit');
    });



    $('#btnSelectVH').click(function () {
      $('#ModalSelectVH').modal('show');
    });


  });
  var str = '';
  var idCar = [];

  function setCar(id, name, type, NameFc) {
    $(".odd").remove();
    str = $('#setCAR').html();
    str += '<tr id="' + id + '"><td>' + id + '</td><td>' + name + '</td><td>' + type + '</td><td>' + NameFc +
      '</td><td><div class="ui red button" onclick="delCar(\'' + id + '\')">ลบ</div></td></tr>';
    $('#setCAR').html(str);

    $('#ModalSelectVH').modal('toggle');
    $('#ModalformAdd-BookingVH').modal('show');

    var x = document.getElementById("BookingVH").rows.length
    idCar.push(id);
    strArray = ""
    for (i = 0; i < x - 1; i++) {
      strArray += "'" + idCar[i] + "',";
    }
    strArray = strArray.substring(0, strArray.length - 1);
    $('#arrayCar').val(strArray);


  }

  function delCar(id) {
    $("#" + id).remove();
    var x = document.getElementById("BookingVH").rows.length
    idCar.pop(id);
    strArray = "";
    for (i = 0; i < x - 1; i++) {
      strArray += "'" + idCar[i] + "',";
    }
    strArray = strArray.substring(0, strArray.length - 1);
    $('#arrayCar').val(strArray);
  }
</script>