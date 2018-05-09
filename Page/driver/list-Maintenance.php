<?php 
include "header.php";
require_once '../../ConfigDB.php';

 ?>
<div class="ui container">
  <!-- ตารางข้อมูลการตรวจซ่อมบำรุงยานพาหนะ -->
    <div class="TableMaintenance">
      <h1 class="ui block header">
        <div class="fontMitr">
          การตรวจซ่อมบำรุงยานพาหนะ
        </div>
      </h1>
      <button class="ui blue button" id="btnAdd-M" >
        <i class="plus icon"></i>
        เพิ่มข้อมูล
      </button>
      <!-- <div class="ui hidden divider"></div> -->
      
      <!-- <div class="ui clearing divider"></div> -->
      <table class="ui celled table" cellspacing="0" width="100%" id="maintenance-Table">
        <thead>
          <tr>
          <th>รหัสการตรวจซ่อม</th>
          <th>รายละเอียด</th>
          <th>วันที่</th>

          <th>เวลา</th>
          <th>ยานพาหนะทะเบียน</th>
          <th>เจ้าหน้าที่</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT m.MainID , m.DateMain ,m.TimeMain , m.Description , v.Registration , off.Name
                                      FROM maintenance as m JOIN officer_vehicles as off ON m.OfficerID = off.OfficerID
                                                            JOIN vehicle as v ON m.VehicleID = v.VehicleID
                                      WHERE off.Office = :Office");
              $stmt->bindParam(":Office", $_SESSION['Office']);
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <td><?php echo $row['MainID']; ?></td>
              <td><?php echo $row['Description']; ?></td>
              <td><?php echo $row['DateMain']; ?></td>
              <td><?php echo $row['TimeMain']; ?></td>
              <td><?php echo $row['Registration']; ?></td>
              <td><?php echo $row['Name']; ?></td>
              <td>
                      <a id="<?php echo $row['MainID']; ?>" class="edit-link-M" href="#" title="แก้ไข">
                      <i class="write square icon"></i>
                      </a>
              </td>
              <td>
                      <a id="<?php echo $row['MainID']; ?>" class="delete-link-M" href="#" title="ลบ">
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
      <!-- เลือกข้อมูลยานพาหนะที่ต้องการจัดการการซ่อมบำรุง -->
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
                    $stmt2 = $conn->prepare("SELECT `VehicleID`,`Registration`,`Picture` FROM `vehicle` WHERE `Department` = :Office");
                    $stmt2->bindParam(":Office", $_SESSION['Office']);
                    $stmt2->execute();
                    while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
                    {
                  ?>
                  <tr>
                    <td><img class="ui fluid image" src="../../images/Vehicles-Images/<?php echo $row2['Picture']; ?>" ></td>
                    <td><?php echo $row2['VehicleID']; ?></td>
                    <td><?php echo $row2['Registration']; ?></td>
                    <td>

                            <div class="ui green button select-link-VH" id="<?php echo $row2['VehicleID']; ?>">
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


    </div>

    <!-- Modal เพิ่มข้อมูล -->
    <div class="ui small coupled first modal" id="ModalformAdd-M">
  		<div class="header">จัดการข้อมูลการตรวจซ่อมบำรุง</div>
  		<div class="content">
  			<div class="ui grid">
  				<div class="twelve wide column centered grid">
  					<form class="ui form" id="formAdd-M" method="post">
              <div class="ui equal width form">
                <div class="fields">
                  <div class="required field">
                    <label>ยานพาหนะ</label>
                    <div class="ui action input">
                      <input type="text" readonly="" placeholder="เลือกยานพาหนะ" name='VehicleID' id='txtVHID'>
                      <div class="ui button" id='btnSelectVH'>
                        เลือก
                      </div>
                    </div>
                  </div>
                  <div class="field">
                  </div>
                </div>
                <div class="fields">
                  <div class="required field">
                    <label>วันที่ทำการตรวจซ่อมบำรุง</label>
                    <div class="ui calendar" id="Date">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" placeholder="วันที่ตรวจซ่อมบำรุง" name="M-Date" >
                      </div>
                    </div>
                  </div>
                  <div class="required field">
                    <label>เวลา</label>
                    <div class="ui calendar" id="Time">
                      <div class="ui right labeled  input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" placeholder="เวลาตรวจซ่อมบำรุง" name='M-Time' >
                        <div class="ui basic label">
                          น.
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="fields">
                  <div class="required field">
                    <label>รายละเอียดการตรวจซ่อมบำรุง</label>
                    <textarea rows="4" placeholder="ระบุรายละเอียด" name="Description"></textarea>
                  </div>
                </div>
              </div>
  					</form>
  				</div>
  			</div>
  		</div>
  		<div class="actions">
  			<div class="ui reset red deny button" id="btnAddExit-M">
  	        ยกเลิก
  	    </div>
  	    <div class="ui green submit button" id="btnAddSubmit-M" >
  	         เพิ่มข้อมูล
  	    </div>
  		</div>
  	</div>


  <!-- modal แก้ไขข้อมูล  -->
  <div class="ui small coupled modal" id="ModalformEdit-M">
    <div class="header">จัดการข้อมูลการตรวจซ่อมบำรุง</div>
    <div class="content">
      <div class="ui grid">
        <div class="twelve wide column centered grid">
          <form class="ui form" id="drumFormM">
            <div class="ui equal width form">
              <div class="fields">
                <div class="field">
                  <label>ยานพาหนะ</label>
                  <div class="ui action input">
                    <input type="text" readonly="" placeholder="ทดลอง">
                    <div class="ui button">
                      เลือก
                    </div>
                  </div>
                </div>
                <div class="field">
                </div>
              </div>
              <div class="fields">
                <div class="field">
                  <label>วันที่ทำการตรวจซ่อมบำรุง</label>
                  <div class="ui calendar">
                    <div class="ui input left icon">
                      <i class="calendar icon"></i>
                      <input type="text" placeholder="ทดลอง" >
                    </div>
                  </div>
                </div>
                <div class="field">
                  <label>เวลา</label>
                  <div class="ui calendar">
                    <div class="ui right labeled  input left icon">
                      <i class="calendar icon"></i>
                      <input type="text" placeholder="ทดลอง" >
                      <div class="ui basic label">
                        น.
                      </div>
                    </div>
                  </div>
                </div>

              </div>
              <div class="fields">
                <div class="inline field">
                  <label>รายละเอียดการตรวจซ่อมบำรุง</label>
                  <textarea rows="4" placeholder="ทดลอง"></textarea>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="actions">
      <div class="ui reset red deny button" id="btnEditExit-M">
          ยกเลิก
      </div>
      <div class="ui green submit button" id="btnEditSubmit-M" >
           แก้ไขข้อมูล
      </div>
    </div>
  </div>




  <script>
	$(document).ready(function(){


    $('.ui.modal').modal({
      closable : false
    });
    $('#ModalSelectVH').modal({
      autofocus : false,
      closable : false
    });

    var calendarText = {
      days: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
      months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
      monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
      today: 'วันนี้',
      now: 'ปัจจุบัน',
      am: 'AM',
      pm: 'PM'
    }
    $('#SelectVHTable').DataTable({
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
		$('#maintenance-Table').DataTable({
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

    $('#btnAdd-M').click(function() {
      $('#formAdd-M').form('reset');
      $('#formAdd-M').form('clear');
      $('#ModalformAdd-M').modal('show');
      $('#Date').calendar({
        on : 'click',
        type : 'date',
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
      $('#Time').calendar({
        on : 'click',
        type : 'time',
        ampm: false,
        text : calendarText,
        constantHeight: false,

      });
    });
    // $('#ModalSelectVH').modal('attach events', '#ModalformAdd-M #btnSelectVH');
    $('#btnSelectCancel').click(function(){
      $('#ModalSelectVH').modal('hide');
      $('#ModalformAdd-M').modal('show');
    });
    $('#btnSelectVH').on('click',function(){
       $('#ModalSelectVH').modal('show');
       $('#ModalformAdd-M').modal('hide');
    });

    $('#txtVHID')
      .on('click',function(e){
        $('#btnSelectVH',$(e.target).parent()).click();
      });

    $('.ui.green.button.select-link-VH').click(function(){
        var id = $(this).attr("id");
        $('#txtVHID').val(id);
        $('#ModalSelectVH').modal('hide');
        $('#ModalformAdd-M').modal('show');
        // alert('CLICK'+id);
    });

    $('#btnAddSubmit-M').click(function(){
      $('#formAdd-M').form('submit');
    });

	});
	</script>
  <script src='DML-Maintenance/crud-Maintenance.js'></script>
