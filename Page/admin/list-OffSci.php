<?php 
include "header.php";
require_once '../../ConfigDB.php';

// $stmt = $conn->prepare("SELECT * FROM Personnel WHERE PersonnelID=:uid");
// $stmt->execute(array(":uid"=>$_SESSION['user_session']));
// $row=$stmt->fetch(PDO::FETCH_ASSOC);


  



 ?>
<!-- ตารางข้อมูลพนักงานขับยานพาหนะ -->

<div class="ui container" id='content-loader'>
<div class="TableVHO">
  <h1 class="ui block header">
    <div class="fontMitr">
      ข้อมูลเจ้าหน้าที่ฝ่ายยานพาหนะ คณะวิทยาศาสตร์
    </div>
  </h1>
  <button class="ui blue button" id="btnAdd-VHO" >
    <i class="plus icon"></i>
    เพิ่มข้อมูล
  </button>
  <!-- <div class="ui hidden divider"></div> -->
  <!-- <div class="ui horizontal divider">
    <h3 class="fontMitr"> -->
      <!-- ตารางข้อมูลเจ้าหน้าที่ฝ่ายยานพาหนะ  -->
       <!-- <?php //echo $office ?> -->
    <!-- </h3> -->
    
  </div>

      <table class="ui celled table" cellspacing="0" width="100%" id="VHO-Table">
        <thead>
          <tr>
          <th>รหัสเจ้าหน้าที่</th>
          <th>ชื่อ - นามสกุล</th>
          <th>ตำแหน่ง</th>
          <th>สังกัด</th>
          <th>เพิ่มเติม</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
          </thead>
          <tbody>
            <?php
              require_once '../../ConfigDB.php';
              // $UserID = $_POST['username'];
              // $Office = $_POST['office'];
              $tblVehOff = $conn->prepare("SELECT `OfficerID`, ov.`Name` as name, `Position`, fac.Name as faculty FROM `officer_vehicles` as ov join faculty as fac ON ov.office = fac.ID where office=1 "); 
              //  WHERE Office = :office
              // $tblVehOff->bindParam(":office",$office);
              $tblVehOff->execute();
              while($row=$tblVehOff->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <td><?php echo $row['OfficerID']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <td><?php echo $row['Position']; ?></td>
              <td><?php echo $row['faculty']; ?></td>
              <td>
                <a id="<?php echo $row['OfficerID']; ?>" class="show-link-VHO" href="#" title="แสดงข้อมูล">
                <i class="search icon"></i>
                </a>
              </td>
              <td>
                      <a id="<?php echo $row['OfficerID']; ?>" class="edit-link-vho" href="#" title="แก้ไข">
                      <i class="write square icon"></i>
                      </a>
              </td>
              <td>
                      <a id="<?php echo $row['OfficerID']; ?>" class="delete-link-vho" href="#" title="ลบ">
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

<div class="ui small modal" id="ModalformAdd-VHO">
  <div class="header">ข้อมูลเจ้าหน้าทีฝ่ายยานพาหนะ</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-VHO" >
          <div class="ui equal width form">
            <div class="two fields">
              <div class="required field">
                <label>รหัสเจ้าหน้าที่</label>
                <div class="ui icon input" id="loadingCheck">
                  <input type="text" placeholder="รหัสเจ้าหน้าที่" id="OfficerID" name="OfficerID" onblur="checkAvailabilityOFF()" >
                  <i class="icon" id="statusOffID"></i>
                </div>
                <div class="ui red pointing basic label " id='dupOffID'>
                  <i class="remove icon"></i>รหัสเจ้าหน้าที่นี้มีในระบบแล้ว
                </div>

              </div>
              <div class="inline field">

              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>ชื่อ</label>
                <input type="text" placeholder="ชื่อ" name="VHO-Fname" id="VHO-Fname" >
              </div>
              <div class="required field">
                <label>นามสกุล</label>
                <input type="text" placeholder="นามสกุล" name="VHO-Lname" id="VHO-Lname" >
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>ตำแหน่ง</label>
                <div class="ui dropdown selection">
                  <input type="hidden" name="VHO-Position" id="VHO-Position" required>
                  <div class="default text">เลือกตำแหน่ง</div>
                  <i class="dropdown icon"></i>
                  <div class="menu">
                    <div class="item" data-value="เจ้าหน้าที่ฝ่ายยานพาหนะ">เจ้าหน้าที่ฝ่ายยานพาหนะ</div>
                    <div class="item" data-value="พนักงานขับยานพาหนะ">พนักงานขับยานพาหนะ</div>
                  </div>
                </div>
              </div>
              <div class="required field">
                <label>สังกัด</label>
                <div class="ui dropdown selection">
                  <input type="hidden" name="VHO-office" id="VHO-office">
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
            </div>
            <div class="fields">
              <div class="twelve wide field">
                <label>ที่อยู่</label>
                <textarea rows="3" placeholder="ระบุที่อยู่" name="VHO-Address"></textarea>
              </div>
            </div>
            <div class="two fields">
              <div class="required field">
                <label>หมายเลขโทรศัพท์ ติดต่อ</label>
                <input type="text" placeholder="หมายเลขโทรศัพท์" name="VHO-Tel">
              </div>
              <div class="field">
              </div>
            </div>
            <div class="two fields">
              <div class="required field">
                <label>ชื่อผู้ใช้เข้าสู่ระบบ</label>
                <div class="ui icon input" id="loadingCheck">
                  <input type="text" placeholder="ชื่อผู้ใช้เข้าสู่ระบบ" id="username" name="username" onblur="checkAvailabilityUserID()" >
                  <i class="icon" id="statusUserID"></i>
                </div>
                <div class="ui red pointing basic label " id='dupUser'>
                  <i class="remove icon"></i>ชื่อผู้ใช้ซ้ำในระบบ
                </div>
              </div>
              <div class="field">
              </div>
            </div>
          </div>

      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui reset red deny button" id="btnExit-VHO">
      <div class="fontKanit">
        ยกเลิก
      </div>
    </div>

        </form>
    <div class="ui green submit button" id="btnAddVHO-Submit" >
        <div class="fontKanit">
          เพิ่มข้อมูล
        </div>
    </div>
  </div>
</div>


<!-- ฟอร์ม "แก้ไข" ข้อมูลเจ้าหน้าที่ฝ่ายยานพาหนะ -->
<div class="ui small modal" id="ModalformEdit-VHO">
  <div class="header">ข้อมูลเจ้าหน้าทีฝ่ายยานพาหนะ</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid" >
        <!-- ไว้สำหรับจองพื้นที่ไว้ load ฟอร์มแก้ไขจากไฟล์ editForm.php  -->
        <div id="eform">
          <form class="ui form" >
            <div class="ui equal width form">
              <div class="two fields">
                <div class="required field">
                  <label>รหัสเจ้าหน้าที่</label>
                  <div class="ui icon input" id="loadingCheck">
                    <input disabled type="text" placeholder="รหัสเจ้าหน้าที่" >
                    <i class="icon" ></i>
                  </div>

                </div>
                <div class="inline field">

                </div>
              </div>
              <div class="fields">
                <div class="required field">
                  <label>ชื่อ</label>
                  <input type="text" placeholder="ชื่อ" >
                </div>
                <div class="required field">
                  <label>นามสกุล</label>
                  <input type="text" placeholder="นามสกุล">
                </div>
              </div>
              <div class="fields">
                <div class="required field">
                  <label>ตำแหน่ง</label>
                  <div class="ui dropdown selection">
                    <input type="hidden" >
                    <div class="default text">เลือกตำแหน่ง</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                      <div class="item" data-value="เจ้าหน้าที่ฝ่ายยานพาหนะ">เจ้าหน้าที่ฝ่ายยานพาหนะ</div>
                      <div class="item" data-value="พนักงานขับยานพาหนะ">พนักงานขับยานพาหนะ</div>
                    </div>
                  </div>
                </div>
                <div class="required field">
                  <label>สังกัด</label>
                  <div class="ui dropdown selection">
                    <input type="hidden" >
                    <div class="default text">เลือกสังกัด</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                      <div class="item" data-value="คณะครุศาสตร์">คณะครุศาสตร์</div>
                      <div class="item" data-value="คณะมนุษยศาสตร์และสังคมศาสตร์">คณะมนุษยศาสตร์และสังคมศาสตร์</div>
                      <div class="item" data-value="คณะวิทยาศาสตร์">คณะวิทยาศาสตร์</div>
                      <div class="item" data-value="คณะวิทยาการจัดการ">คณะวิทยาการจัดการ</div>
                      <div class="item" data-value="คณะเทคโนโลยี">คณะเทคโนโลยี</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="fields">
                <div class="twelve wide field">
                  <label>ที่อยู่</label>
                  <textarea rows="3" placeholder="ระบุที่อยู่" ></textarea>
                </div>
              </div>
              <div class="two fields">
                <div class="required field">
                  <label>หมายเลขโทรศัพท์ ติดต่อ</label>
                  <input type="text" placeholder="หมายเลขโทรศัพท์" >
                </div>
                <div class="field">
                </div>
              </div>
              <div class="two fields">
                <div class="required field">
                  <label>ชื่อผู้ใช้เข้าสู่ระบบ</label>
                  <input type="text" placeholder="ชื่อผู้ใช้เข้าสู่ระบบ" >
                </div>
                <div class="field">
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui reset red deny button" id="btnExit-VHO">
      <div class="fontKanit">
        ยกเลิก
      </div>
    </div>
    <div class="ui green button" id="btnEditVHO-Submit" >
        <div class="fontKanit">
          บันทึกข้อมูล
        </div>
    </div>
  </div>
</div>

<div class="ui small modal" id="ModalformShow-VHO">
  <div class="header">ข้อมูลเจ้าหน้าทีฝ่ายยานพาหนะ</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid" >
        <!-- ไว้สำหรับจองพื้นที่ไว้ load ฟอร์มแก้ไขจากไฟล์ editForm.php  -->
        <div id="eform2">
          <form class="ui form" >
            <div class="ui equal width form">
              <div class="two fields">
                <div class="required field">
                  <label>รหัสเจ้าหน้าที่</label>
                  <div class="ui icon input" id="loadingCheck">
                    <input disabled type="text" placeholder="รหัสเจ้าหน้าที่" >
                    <i class="icon" ></i>
                  </div>

                </div>
                <div class="inline field">

                </div>
              </div>
              <div class="fields">
                <div class="required field">
                  <label>ชื่อ</label>
                  <input type="text" placeholder="ชื่อ" >
                </div>
                <div class="required field">
                  <label>นามสกุล</label>
                  <input type="text" placeholder="นามสกุล">
                </div>
              </div>
              <div class="fields">
                <div class="required field">
                  <label>ตำแหน่ง</label>
                  <div class="ui dropdown selection">
                    <input type="hidden" >
                    <div class="default text">เลือกตำแหน่ง</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                      <div class="item" data-value="เจ้าหน้าที่ฝ่ายยานพาหนะ">เจ้าหน้าที่ฝ่ายยานพาหนะ</div>
                      <div class="item" data-value="พนักงานขับยานพาหนะ">พนักงานขับยานพาหนะ</div>
                    </div>
                  </div>
                </div>
                <div class="required field">
                  <label>สังกัด</label>
                  <div class="ui dropdown selection">
                    <input type="hidden" >
                    <div class="default text">เลือกสังกัด</div>
                    <i class="dropdown icon"></i>
                    <div class="menu">
                      <div class="item" data-value="คณะครุศาสตร์">คณะครุศาสตร์</div>
                      <div class="item" data-value="คณะมนุษยศาสตร์และสังคมศาสตร์">คณะมนุษยศาสตร์และสังคมศาสตร์</div>
                      <div class="item" data-value="คณะวิทยาศาสตร์">คณะวิทยาศาสตร์</div>
                      <div class="item" data-value="คณะวิทยาการจัดการ">คณะวิทยาการจัดการ</div>
                      <div class="item" data-value="คณะเทคโนโลยี">คณะเทคโนโลยี</div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="fields">
                <div class="twelve wide field">
                  <label>ที่อยู่</label>
                  <textarea rows="3" placeholder="ระบุที่อยู่" ></textarea>
                </div>
              </div>
              <div class="two fields">
                <div class="required field">
                  <label>หมายเลขโทรศัพท์ ติดต่อ</label>
                  <input type="text" placeholder="หมายเลขโทรศัพท์" >
                </div>
                <div class="field">
                </div>
              </div>
              <div class="two fields">
                <div class="required field">
                  <label>ชื่อผู้ใช้เข้าสู่ระบบ</label>
                  <input type="text" placeholder="ชื่อผู้ใช้เข้าสู่ระบบ" >
                </div>
                <div class="field">
                </div>
              </div>
            </div>
          </form>
        </div>
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
	$(document).ready(function(){
		$('#VHO-Table').DataTable({
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
    $("#dupOffID").fadeOut();
    $('#btnAdd-VHO').click(function() {
			$('#ModalformAdd-VHO').modal('show');
		});
    $('.ui.modal').modal({
    closable : false
     });
		$('.ui.dropdown').dropdown();
		$('.form').form({
      keyboardShortcuts : false
    });
		$('#btnAddVHO-Submit').click(function(){
			$('#formAdd-VHO').form('submit');
			});
		$('#btnExit-VHO').click(function(){
			$('#formAdd-VHO').form('reset');
			$("#statusOffID").removeClass('green checkmark red remove');
    });
    
    // function checkAvailabilityOFF() {
    //   jQuery.ajax({
    //   url: "DML-VHO/check_officerID.php",
    //   data: 'OfficerID='+$("#OfficerID").val(),
    //   type: "POST",
    //   beforeSend: function(){
    //     $("#loadingCheck").addClass("loading");
    //     $("#statusOffID").removeClass('green checkmark red remove');     
    //     $("#dupOffID").fadeIn();
        
    //   },
    //   success:function(data){
    //     $("#loadingCheck").removeClass("loading");
    //     $("#statusOffID").addClass(data);
    //     if (data=='green checkmark') {
    //       // $('#btnAddVHO-Submit').removeClass('disabled')
    //       $("#statusOffID").val(1);
    //       $("#dupOffID").fadeOut();
    //     }
    //     else {
    //       // $('#btnAddVHO-Submit').addClass('disabled')
    //       $("#statusOffID").val(0);
    //       $("#dupOffID").fadeIn();
    //     }

    //   },
    //   error:function (){}
    //   });
	  // }


	});
</script>
<script src="DML-VHO/crud-VHO.js"></script>
