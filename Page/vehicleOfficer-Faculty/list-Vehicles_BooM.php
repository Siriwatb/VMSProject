<?php 
include "header.php";
require_once '../../ConfigDB.php';

 ?>

<div class="ui container" id='content-loader'>

  <!-- ตารางข้อมูลยานพาหนะ -->
    <div class="TableVH">
      <h1 class="ui block header">
        <div class="fontMitr">
          จัดการยานพาหนะ
        </div>
      </h1>
      <button class="ui blue button" id="btnAdd-VH" >
        <i class="plus icon"></i>
        เพิ่มข้อมูล
      </button>
      
      <table class="ui celled table" cellspacing="0" width="100%" id="VH-Table">
        <thead>
          <tr>
          <th>รหัสยานพาหนะ</th>
          <th>เลขทะเบียน</th> 
          <th>ประเภทรถ</th>
          <th>ยี่ห้อ</th>
          <th>สถานะ</th>
          <th>รายละเอียด</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT VehicleID,Registration,Brand,`Vehicle status`,Name_Type FROM vehicle as VH join vehicle_type as TY on VH.TypeID = TY.TypeID");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <!-- <td><img class="ui small image" src="../../images/Vehicles-Images/<?php echo $row['Picture']; ?>" ></td> -->
              <td><?php echo $row['VehicleID']; ?></td>
              <td><?php echo $row['Registration']; ?></td>
              <td><?php echo $row['Name_Type']; ?></td> 
              <td><?php echo $row['Brand']; ?></td>
              <td>
                <?php if ($row['Vehicle status']==0) {
                          echo "พร้อมใช้งาน";
                      }elseif ($row['Vehicle status']==1) {
                          echo "ไม่พร้อมใช้งาน";
                      }
                ?>
              </td>
              <td>
                      <a id="<?php echo $row['VehicleID']; ?>" class="show-link-VH" href="#" title="แสดงข้อมูล">
                      <i class="write square icon"></i>
                      </a>
              </td>
              <td>
                      <a id="<?php echo $row['VehicleID']; ?>" class="edit-link-VH" href="#" title="แก้ไข">
                      <i class="write square icon"></i>
                      </a>
              </td>
              <td>
                      <a id="<?php echo $row['VehicleID']; ?>" class="delete-link-VH" href="#" title="ลบ">
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

    <!-- เพิ่มข้อมูลยานพาหนะ -->
    <div class="ui small modal" id="ModalformAdd-VH">
      <div class="header">จัดการข้อมูลยานพาหนะ</div>
      <div class="content">
        <div class="ui grid">
          <div class="twelve wide column centered grid">
            <form class="ui form" id="formAdd-VH" method="post">
              <div class="ui equal width form">
                <div class="fields">
                  <div class="required field">
                    <label>รหัสยานพาหนะ</label>
                    <div class="ui icon input" id="loadingCheck1">
                      <input type="text" placeholder="รหัสยานพาหนะ" name="VehicleID" id='VehicleID' onblur="checkAvailabilityVHID()">

                      <i class="icon" id="statusID"></i>
                    </div>
                    <div class="ui pointing red basic label " id='dupID'>
                      <i class="remove icon"></i> รหัสยานพาหนะ ซ้ำ
                    </div>
                  </div>
                  <div class="field">
                  </div>
                </div>
                <div class="fields">
                  <div class="required field">
                    <label>หมายเลขทะเบียน</label>
                    <div class="ui icon input" id="loadingCheck2">
                      <input type="text" placeholder="หมายเลขทะเบียน" name="Registration" id='Registration' onblur="checkAvailabilityRegis()">
                      <i class="icon" id="statusRE"></i>
                    </div>
                    <div class="ui red pointing basic label " id='dupRE'>
                      <i class="remove icon"></i>ทะเบียนนี้มีในระบบแล้ว
                    </div>
                  </div>
                  <div class="field">
                    <label>ยี่ห้อ</label>
                    <input type="text" placeholder="ยี่ห้อ" name="Brand">
                  </div>
                </div>
                <div class="fields">
                  <div class="required field">
                    <label>ประเภทยานพาหนะ</label>
                    <div class="ui dropdown selection">
                      <input type="hidden" name="TypeID">
                      <div class="default text">เลือกประเภท</div>
                      <i class="dropdown icon"></i>
                       <div class="menu" id="ajaxLoadType" > 
                        <?php
                          require_once '../../ConfigDB.php';                                          
                          $stmt2 = $conn->prepare("SELECT * FROM `vehicle_type");
                          // $stmt3 = $conn->prepare("SELECT * FROM `vehicle_type");
                          $stmt2->execute();
                          // $stmt3->execute();
                            
                            // if ($stmt2->fetch(PDO::FETCH_ASSOC)==0) {
                            //   echo '<div class="disabled item">ไม่มีข้อมูล</div>';
                            // }
                            
                            while($row3=$stmt2->fetch(PDO::FETCH_ASSOC))
                            {                             
                                echo '<div class="item"  data-value='.$row3['TypeID'].'>'.$row3['Name_Type'].'</div>';                    
                            }
                            ?> 
                      </div>
                    </div>
                  </div>
                  <div class="required field">
                    <label>จำนวนที่นั่ง</label>
                    <input type="number" placeholder="ระบุจำนวนที่นั่ง" name="Num_of_seats">
                  </div>
                </div>
                  <div class="fields">
                    <div class="required field">
                      <label>หมายเลขระยะทางเริ่มต้น</label>
                      <input type="number" placeholder="ระยะทางเริ่มต้น" name="Odometer">
                    </div>
                    <div class="required field">
                      <label>วันที่หมดประกัน</label>
                      <!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
                      <div class="ui calendar" id="DateExp">
                        <div class="ui input left icon">
                          <i class="calendar icon"></i>
                          <input type="text" placeholder="วันที่หมดประกัน" name="DateInsuranceExp">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="fields">
                    <div class="required field">
    									<label>สังกัด</label>
    									<div class="ui dropdown selection">
    										<input type="hidden" name='Department' >
    										<div class="default text">เลือกสังกัด</div>
    										<i class="dropdown icon"></i>
    										<div class="menu">
                          <div class="item" data-value="6">ส่วนกลาง</div>
    											<div class="item" data-value="4">คณะครุศาสตร์</div>
    											<div class="item" data-value="2">คณะมนุษยศาสตร์และสังคมศาสตร์</div>
    											<div class="item" data-value="1">คณะวิทยาศาสตร์</div>
    											<div class="item" data-value="3">คณะวิทยาการจัดการ</div>
    											<div class="item" data-value="5">คณะเทคโนโลยี</div>
    										</div>
    									</div>
    								</div>
                    <div class="field">
                      <label>รูปภาพ</label>
                      <div class="ui fluid action input" id='addImage'>
                        <input type="text" name="vh-showpath" readonly id='vh-showpath'>
                        <input type="file" name="Vehicle_image" id='Vehicle_image' accept="image/*">
                        <div class="ui icon button" id='btnAddImage'>
                          <i class="attach icon"></i>
                        </div>
                      </div>
    								</div>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="actions">
        <div class="ui reset red deny button" id="btnAddExit-VH">
          ยกเลิก
        </div>
        <div class="ui green submit button" id="btnAddSubmit-VH" >
          เพิ่มข้อมูล
        </div>
      </div>
    </div>


    <!-- แก้ไขข้อมูล -->
    <div class="ui small modal" id="ModalformEdit-VH">
      <div class="header">จัดการข้อมูลยานพาหนะ</div>
      <div class="content">
        <div class="ui grid">
          <div class="twelve wide column centered grid">
            <form class="ui form" id="drumFormVH" >
              <div class="ui equal width form">
                <div class="fields">
                  <div class="field">
                    <label>รหัสยานพาหนะ</label>
                    <input type="text" placeholder="ทดลอง">
                  </div>
                  <div class="field">
                  </div>
                </div>
                <div class="fields">
                  <div class="field">
                    <label>หมายเลขทะเบียน</label>
                    <input type="text" placeholder="ทดลอง">
                  </div>
                  <div class="field">
                    <label>ยี่ห้อ</label>
                    <input type="text" placeholder="ทดลอง">
                  </div>
                </div>
                <div class="fields">
                  <div class="required field">
                    <label>ประเภทยานพาหนะ</label>
                    <div class="ui dropdown selection">
                      <input type="hidden">
                      <div class="default text">เลือกประเภท</div>
                      <i class="dropdown icon"></i>
                      <div class="menu">
                          <div class="disabled item">ไม่มีข้อมูล</div>
                      </div>
                    </div>
                  </div>
                  <div class="field">
                    <label>จำนวนที่นั่ง</label>
                    <input type="number" placeholder="ทดลอง">
                  </div>
                </div>
                  <div class="fields">
                    <div class="field">
                      <label>หมายเลขระยะทางเริ่มต้น</label>
                      <input type="number" placeholder="ทดลอง">
                    </div>
                    <div class="field">
                      <label>วันที่หมดประกัน</label>
                      <!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
                      <div class="ui calendar" >
                        <div class="ui input left icon">
                          <i class="calendar icon"></i>
                          <input type="text" placeholder="ทดลอง" >
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="actions">
        <div class="ui reset red deny button" id="btnEditExit-VH">

            ยกเลิก

        </div>
        <div class="ui green submit button" id="btnEditSubmit-VH" >

              แก้ไขข้อมูล

        </div>
      </div>
    </div>
</div>

 <!-- Show -->
 <div class="ui small modal" id="ModalformShow-VH">
      <div class="header">จัดการข้อมูลยานพาหนะ</div>
      <div class="content">
        <div class="ui grid">
          <div class="twelve wide column centered grid">
            <form class="ui form" id="showVH" >
              <div class="ui equal width form">
                <div class="fields">
                  <div class="field">
                    <label>รหัสยานพาหนะ</label>
                    <input type="text" placeholder="ทดลอง">
                  </div>
                  <div class="field">
                  </div>
                </div>
                <div class="fields">
                  <div class="field">
                    <label>หมายเลขทะเบียน</label>
                    <input type="text" placeholder="ทดลอง">
                  </div>
                  <div class="field">
                    <label>ยี่ห้อ</label>
                    <input type="text" placeholder="ทดลอง">
                  </div>
                </div>
                <div class="fields">
                  <div class="required field">
                    <label>ประเภทยานพาหนะ</label>
                    <div class="ui dropdown selection">
                      <input type="hidden">
                      <div class="default text">เลือกประเภท</div>
                      <i class="dropdown icon"></i>
                      <div class="menu">
                          <div class="disabled item">ไม่มีข้อมูล</div>
                      </div>
                    </div>
                  </div>
                  <div class="field">
                    <label>จำนวนที่นั่ง</label>
                    <input type="number" placeholder="ทดลอง">
                  </div>
                </div>
                  <div class="fields">
                    <div class="field">
                      <label>หมายเลขระยะทางเริ่มต้น</label>
                      <input type="number" placeholder="ทดลอง">
                    </div>
                    <div class="field">
                      <label>วันที่หมดประกัน</label>
                      <!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
                      <div class="ui calendar" >
                        <div class="ui input left icon">
                          <i class="calendar icon"></i>
                          <input type="text" placeholder="ทดลอง" >
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    <div class="actions">
      <div class="ui reset red deny button" id="btnExit-VHO">
         <div class="fontKanit">
          ปิด
        </div>
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

    $('#btnEditSubmit-VH').click(function(){
    	$('#formEdit-VH').form('submit');
    });

		$('#VH-Table').DataTable({
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
      "fnDrawCallback": function( oSettings ) {
        $.getScript( "DML-Vehicle/crud-VH.js", function( data, textStatus, jqxhr ) {
          // console.log( data ); // Data returned
          // console.log( textStatus ); // Success
          // console.log( jqxhr.status ); // 200
          console.log( "Load was performed." );
        });
    }
		});





    $('.ui.dropdown').dropdown();
    $('.ui.modal').modal({
      closable : false,
      autofocus : false
    });
    $('#btnAdd-VH').click(function() {

      // jQuery.ajax({
      // url: "typeSelector.php",
      // type: "POST",
      // beforeSend:function(){

      // },
      // success:function(data){
      //   $("#ajaxLoadType").html(data);
      // },
      // error:function (){}
      // });



      clearForm();
      $('#ModalformAdd-VH').modal('show');
      $('#DateExp').calendar({
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
    });
    $('#btnAddExit-VH').click(function(){

      clearForm();
    });
    $('#btnAddSubmit-VH').click(function(){
      $('#formAdd-VH').form('submit');
    });

// });

</script>

<script >
  $('#vh-showpath,#btnAddImage').click(function(e){
    e.stopImmediatePropagation();
    console.log('triggered');
   $('#Vehicle_image').click();
   $('#Vehicle_image').on('change',function(){
     var filename = $('#Vehicle_image').val().replace(/C:\\fakepath\\/i, '')
     $('#vh-showpath').val(filename) ;
   });
  });
</script>

<script>
function clearForm() {
  $('#formAdd-VH').form('reset');
  $('#formAdd-VH').form('clear');
  $("#statusID").removeClass('green checkmark red remove');
  $("#statusRE").removeClass('green checkmark red remove');
  $('#dupID').fadeOut();
  $('#dupRE').fadeOut();
  $("#statusID").val('');
  $("#statusRE").val('');
  $('#DateExp').calendar('clear');
}
  function checkAvailabilityVHID() {
    if( $('#VehicleID').val() == '') {
        return false ;
      }
      var stat = false;
    jQuery.ajax({
    url: "DML-Vehicle/check_VHID.php",
    data: 'VehicleID='+$("#VehicleID").val(),
    type: "POST",
    beforeSend:function(){
      $("#loadingCheck1").addClass("loading");
      $("#statusID").removeClass('green checkmark red remove');
    },
    success:function(data){
      $("#loadingCheck1").removeClass("loading");
      $("#statusID").addClass(data);
      if (data=='green checkmark') {
        $("#statusID").val(1);
        $('#dupID').fadeOut();
      }
      else {
        $("#statusID").val(0);
        $('#dupID').fadeIn();
      }
    },
    error:function (){}
    });

  }





  function checkAvailabilityRegis() {
    if( $('#Registration').val() == '') {
        return false ;
      }
    jQuery.ajax({
    url: "DML-Vehicle/check_Regis.php",
    data: 'Registration='+$("#Registration").val(),
    type: "POST",
    beforeSend: function(){
      $("#loadingCheck2").addClass("loading");
      $("#statusRE").removeClass('green checkmark red remove');
    },
    success:function(data){
      $("#loadingCheck2").removeClass("loading");
      $("#statusRE").addClass(data);
      if (data=='green checkmark') {
        $("#statusRE").val(1);
        $('#dupRE').fadeOut();
      }
      else {
        $("#statusRE").val(0);
        $('#dupRE').fadeIn();
      }

    },
    error:function (){}
    });

  }
</script>
<script src="DML-Vehicle/crud-VH.js"></script>
