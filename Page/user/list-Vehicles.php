<?php 
include "header.php";
require_once '../../ConfigDB.php';

 ?>

<div class="ui container" id='content-loader'>

  <!-- ตารางข้อมูลยานพาหนะ -->
  <div class="TableVH">
    <h1 class="ui block header">
      <div class="fontMitr">
        ข้อมูลยานพาหนะ
      </div>
    </h1>
    <!-- <button class="ui blue button" id="btnAdd-VH">
      <i class="plus icon"></i>
      เพิ่มข้อมูล
    </button> -->

    <table class="ui celled table" cellspacing="0" width="100%" id="VH-Table">
      <thead>
        <tr>
          <th>รหัสยานพาหนะ</th>
          <th>เลขทะเบียน</th>
          <th>ประเภทรถ</th>
          <th>สังกัด</th>
          <th>สถานะ</th>
          <th>รายละเอียด</th>
          
        </tr>
      </thead>
      <tbody>
        <?php
              require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT VehicleID,Brand,Picture ,Registration, Odometer,`Num of seats`,`Date insurance expires` ,`Vehicle status`,Name_Type,VH.TypeID as tID ,Department,f.Name as faculty FROM  vehicle as VH join vehicle_type as TY  on VH.TypeID = TY.TypeID join faculty as f on VH.Department = f.ID");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
          <tr>
            <!-- <td><img class="ui small image" src="../../images/Vehicles-Images/<?php echo $row['Picture']; ?>" ></td> -->
            <td>
              <?php echo $row['VehicleID']; ?>
            </td>
            <td>
              <?php echo $row['Registration']; ?>
            </td>
            <td>
              <?php echo $row['Name_Type']; ?>
            </td>
            <td>
              <?php echo $row['faculty']; ?>
            </td>
            <td>
              <?php if ($row['Vehicle status']==0) {
                          echo "พร้อมใช้งาน";
                      }elseif ($row['Vehicle status']==1) {
                          echo "ไม่พร้อมใช้งาน";
                      }
                ?>
            </td>
            <td>
              <a class="Show_Button show-link-VH" title="แสดงข้อมูล" 
                data-id="<?php echo $row['VehicleID'];?>" 
                data-Pic="<?php echo  $row['Picture'];?>"
                data-Re="<?php echo  $row['Registration'];?>" 
                data-Br="<?php echo $row['Brand'];?>" 
                data-Ty="<?php echo  $row['Name_Type'];?>"
                data-Od="<?php echo  $row['Odometer'];?>" 
                data-Num="<?php echo  $row['Num of seats'];?>" 
                data-Fu="<?php echo  $row['faculty'];?>"
                data-Date="<?php echo  $row['Date insurance expires'];?>">
                <i class="write square icon"></i>
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
                  <input type="text" placeholder="ยี่ห้อ" id="Brand" name="Brand">
                </div>
              </div>
              <div class="fields">
                <div class="required field">
                  <label>ประเภทยานพาหนะ</label>
                  <div class="ui dropdown selection">
                    <input type="hidden" name="TypeID" id="TypeID">
                    <div class="default text">เลือกประเภท</div>
                    <i class="dropdown icon"></i>
                    <div class="menu" id="ajaxLoadType">
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
                    <input type="hidden" name='Department'>
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
      <div class="ui green submit button" id="btnAddSubmit-VH">
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
          <form class="ui form" id="formEdit-VH">
            <div class="ui equal width form">
              <div class="fields">
                <div class="field">
                  <label>รหัสยานพาหนะ</label>
                  <input readonly="" type="text" placeholder="รหัสยานพาหนะ" name="VehicleIDEdit" id="VehicleIDEdit" value="<?php echo $row['VehicleID']; ?>">
                </div>
                <div class="field">
                </div>
              </div>
              <div class="fields">
                <div class="field">
                  <label>หมายเลขทะเบียน</label>
                  <div class="ui icon input" id="loadingCheckEdit">
                    <input type="text" placeholder="หมายเลขทะเบียน" name="RegistrationEdit" id='RegistrationEdit' onblur="checkAvailabilityRegis()">
                    <i class="icon" id="statusEditRE"></i>
                  </div>
                  <div class="ui red pointing basic label " id='dupEditRE'>
                    <i class="remove icon"></i>ทะเบียนนี้มีในระบบแล้ว
                  </div>
                </div>
                <div class="field">
                  <label>ยี่ห้อ</label>
                  <input type="text" placeholder="ยี่ห้อ" id="EditBrand" name="EditBrand" >
                </div>
              </div>
              <div class="fields">
                <div class="required field">
                  <label>ประเภทยานพาหนะ</label>
                  <div class="ui dropdown selection" id="EditDropdown">
                    <input type="hidden" name="EditType" id="EditType" >
                    <div class="default text">เลือกประเภท</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                      <?php
                          require_once '../../ConfigDB.php';
                          $item = '';
                          $stmt2 = $conn->prepare("SELECT * FROM `vehicle_type");
                          $stmt3 = $conn->prepare("SELECT * FROM `vehicle_type");
                          $stmt2->execute();
                          $stmt3->execute();
                            $row3=$stmt3->fetch(PDO::FETCH_ASSOC);
                          if ($row3==0) {
                            echo '<div class="disabled item">ไม่มีข้อมูล</div>';
                          }
                          else {
                            while($row2=$stmt2->fetch(PDO::FETCH_ASSOC))
                            {
                              echo '<div class="item"  data-value='.$row2['TypeID'].'>'.$row2['Name_Type'].'</div>';
                            }
                        }?>
                    </div>
                  </div>
                </div>
                <div class="field">
                  <label>จำนวนที่นั่ง</label>
                  <input type="number" placeholder="ระบุจำนวนที่นั่ง" id="EditNum" name="EditNum" >
                </div>
              </div>
              <div class="fields">
                <div class="field">
                  <label>หมายเลขระยะทางเริ่มต้น</label>
                  <input type="number" placeholder="ระยะทางเริ่มต้น" id="EditOdo" name="EditOdo">
                </div>
                <!-- <?php
				// แปลงวันที่
				$dateInsuranceEX = $row['Date insurance expires'];
				$date = date_create_from_format('Y-m-d',$dateInsuranceEX );
				$dateInsurance = date_format($date,'j/m/Y');
				 ?> -->
                  <div class="field">
                    <label>วันที่หมดประกัน</label>
                    <!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
                    <div class="ui calendar" id="DateExp">
                      <div class="ui input left icon">
                        <i class="calendar icon"></i>
                        <input type="text" placeholder="วันที่หมดประกัน" id="EditDate" name="EditDate" >
                      </div>
                    </div>
                  </div>
              </div>
              <div class="fields">
                <div class="required field">
                  <label>สังกัด</label>
                  <div class="ui dropdown selection" id="EditFucDropdown">
                    <input type="hidden" id="EditFuc" name='EditFuc'>
                    <div class="default text">เลือกสังกัด</div>
                    <i class="dropdown icon"></i>
                    <div class="menu" >
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
                  <div class="ui fluid action input" id='EditImage'>
                    <input type="text" name="vh-showpath" readonly id='vh-showpathEdit'>
                    <input type="file" name="Vehicle_image" id='Vehicle_imageEdit' accept="image/*">
                    <div class="ui icon button" id='btnEditImage'>
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
      <div class="ui reset red deny button" id="btnEditExit-VH">

        ยกเลิก

      </div>
      <div class="ui green submit button" id="btnEditSubmit-VH">

        แก้ไขข้อมูล

      </div>
    </div>
  </div>


  <!-- Show -->
  <div class="ui small modal" id="ModalformShow-VH">
    <div class="header">จัดการข้อมูลยานพาหนะ</div>
    <div class="content">
      <div class="ui grid">
        <div class="twelve wide column centered grid">
          <form class="ui form" id="formShow-VH">
            <div class="ui equal width form">
              <div class "fields">
                <div class "field">
                  <img class="ui centered small image center" id="PictureShow" src="../../images/Vehicles-Images/">
                </div>
              </div>
              <div class="fields">
                <div class="field">
                  <label>รหัสยานพาหนะ</label>
                  <input readonly="" type="text" placeholder="รหัสยานพาหนะ" name="VehicleID" id="VehicleIDShow">
                </div>
                <div class="field">
                  <div class="field">
                    <label>หมายเลขทะเบียน</label>
                    <input type="text" placeholder="หมายเลขทะเบียน" readonly="" id="RegistrationShow">
                  </div>
                </div>
              </div>
              <div class="fields">
                <div class="field">
                  <label>ยี่ห้อ</label>
                  <input type="text" placeholder="ยี่ห้อ" readonly="" id="BrandShow">
                </div>
                <div class="field">
                  <label>ประเภทยานพาหนะ</label>
                  <input type="text" placeholder="ประเภทรถ" readonly="" id="Name_TypeShow">
                </div>
              </div>
              <div class="fields">
                <div class="field">
                  <label>หมายเลขระยะทางเริ่มต้น</label>
                  <input type="number" placeholder="ระยะทางเริ่มต้น" readonly="" id="OdometerShow">
                </div>
                <div class="field">
                  <label>จำนวนที่นั่ง</label>
                  <input type="number" placeholder="ระบุจำนวนที่นั่ง" readonly="" id="NumofseatShow">
                </div>
              </div>
              <div class="fields">
                <!-- <?php
				// แปลงวันที่
				$dateInsuranceEX = $row['Date insurance expires'];
				$date = date_create_from_format('Y-m-d',$dateInsuranceEX );
				$dateInsurance = date_format($date,'j/m/Y');
				 ?> -->
                <div class="field">
                  <label>วันที่หมดประกัน</label>
                  <!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
                  <div class="ui calendar" id="DateExp">
                    <div class="ui input left icon">
                      <i class="calendar icon"></i>
                      <input type="text" placeholder="วันที่หมดประกัน" readonly="" id="DateInsuranceExpShow" name="DateInsuranceExp">
                    </div>
                  </div>
                </div>
                <div class="required field">
                  <label>สังกัด</label>
                  <input type="text" placeholder="สังกัด" id="facultyShow" readonly="">
                </div>
              </div>
              <!-- <div class="field">
					<label>รูปภาพ</label>
					<div class="ui fluid action input">
						<input type="text" readonly>
						<input type="file" name="Vehicle_image" accept="image/*">
						<div class="ui icon button">
							<i class="attach icon"></i>
						</div>
					</div>
				</div> -->

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
      months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน',
        'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
      ],
      monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
      today: 'Today',
      now: 'Now',
      am: 'AM',
      pm: 'PM'

    }
    $('.Show_Button').click(function () {
      //get data from edit btn
      var VehicleIDShow = $(this).attr('data-id');
      var PictureShow = $(this).attr('data-Pic');
      var RegistrationShow = $(this).attr('data-Re');
      var BrandShow = $(this).attr('data-Br');
      var Name_TypeShow = $(this).attr('data-Ty');
      var OdometerShow = $(this).attr('data-Od');
      var NumofseatShow = $(this).attr('data-Num');
      var DateInsuranceExpShow = $(this).attr('data-Date');
      var facultyShow = $(this).attr('data-Fu');
      //set value to modal
      $('#VehicleIDShow').val(VehicleIDShow);
      document.getElementById("PictureShow").src = "../../images/Vehicles-Images/" + PictureShow;
      // $('#PictureShow').val(PictureShow);
      $('#RegistrationShow').val(RegistrationShow);
      $('#BrandShow').val(BrandShow);
      $('#Name_TypeShow').val(Name_TypeShow);
      $('#OdometerShow').val(OdometerShow);
      $('#NumofseatShow').val(NumofseatShow);
      $('#DateInsuranceExpShow').val(DateInsuranceExpShow);
      $('#facultyShow').val(facultyShow);
      $('#ModalformShow-VH').modal('show');
    });

    $('.edit_Button').click(function () {
      //get data from edit btn
      var VehicleIDEdit = $(this).attr('data-Eid');
      document.getElementById("EditImage").src = "../../images/Vehicles-Images/" + EditImage;
      var RegistrationEdit = $(this).attr('data-Regist');
      var EditBrand = $(this).attr('data-Brand');
      var EditType = $(this).attr('data-Type');
      var EditOdo = $(this).attr('data-Odometer');
      var EditNum = $(this).attr('data-NumSeat');
      var EditDate = $(this).attr('data-Date');
      var EditFuc = $(this).attr('data-Fuc');
      //set value to modal
      $('#VehicleIDEdit').val(VehicleIDEdit);
      $('#EditImage').val(EditImage);
      $('#RegistrationEdit').val(RegistrationEdit);
      $('#EditBrand').val(EditBrand);
      $('#EditDropdown').dropdown('set selected',EditType);
      $('#EditOdo').val(EditOdo);
      $('#EditNum').val(EditNum);
      $('#EditDate').val(EditDate);
      $('#EditFucDropdown').dropdown('set selected',EditFuc);
      $('#ModalformEdit-VH').modal('show');
    });

    $('#btnEditSubmit-VH').click(function () {
      $('#formEdit-VH').form('submit');
    });

    $('#VH-Table').DataTable({
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
      "fnDrawCallback": function (oSettings) {
        $.getScript("DML-Vehicle/crud-VH.js", function (data, textStatus, jqxhr) {
          // console.log( data ); // Data returned
          // console.log( textStatus ); // Success
          // console.log( jqxhr.status ); // 200
          console.log("Load was performed.");
        });
      }
    });





    $('.ui.dropdown').dropdown();
    $('.ui.modal').modal({
      closable: false,
      autofocus: false
    });
    $('#btnAdd-VH').click(function () {

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
        }
      });
    });
    $('#btnAddExit-VH').click(function () {

      clearForm();
    });
    $('#btnAddSubmit-VH').click(function () {
      $('#formAdd-VH').form('submit');
    });

    // });
  </script>

  <script>
    $('#vh-showpath,#btnAddImage').click(function (e) {
      e.stopImmediatePropagation();
      console.log('triggered');
      $('#Vehicle_image').click();
      $('#Vehicle_image').on('change', function () {
        var filename = $('#Vehicle_image').val().replace(/C:\\fakepath\\/i, '')
        $('#vh-showpath').val(filename);
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
      if ($('#VehicleID').val() == '') {
        return false;
      }
      var stat = false;
      jQuery.ajax({
        url: "DML-Vehicle/check_VHID.php",
        data: 'VehicleID=' + $("#VehicleID").val(),
        type: "POST",
        beforeSend: function () {
          $("#loadingCheck1").addClass("loading");
          $("#statusID").removeClass('green checkmark red remove');
        },
        success: function (data) {
          $("#loadingCheck1").removeClass("loading");
          $("#statusID").addClass(data);
          if (data == 'green checkmark') {
            $("#statusID").val(1);
            $('#dupID').fadeOut();
          } else {
            $("#statusID").val(0);
            $('#dupID').fadeIn();
          }
        },
        error: function () {}
      });

    }





    function checkAvailabilityRegis() {
      if ($('#Registration').val() == '') {
        return false;
      }
      jQuery.ajax({
        url: "DML-Vehicle/check_Regis.php",
        data: 'Registration=' + $("#Registration").val(),
        type: "POST",
        beforeSend: function () {
          $("#loadingCheck2").addClass("loading");
          $("#statusRE").removeClass('green checkmark red remove');
        },
        success: function (data) {
          $("#loadingCheck2").removeClass("loading");
          $("#statusRE").addClass(data);
          if (data == 'green checkmark') {
            $("#statusRE").val(1);
            $('#dupRE').fadeOut();
          } else {
            $("#statusRE").val(0);
            $('#dupRE').fadeIn();
          }

        },
        error: function () {}
      });

    }
  </script>
  <script src="DML-Vehicle/crud-VH.js"></script>