<?php 
include "header.php";
include_once '../../ConfigDB.php';

//$stmt = $conn->prepare("SELECT * FROM Personnel WHERE PersonnelID=:uid");
//$stmt->execute(array(":uid"=>$_SESSION['user_session']));
//$row=$stmt->fetch(PDO::FETCH_ASSOC);

?>

<script src="DML-PERSONNEL/crud-personnel.js"></script>
<!-- ตารางข้อมูลพนักงานขับยานพาหนะ -->
<div class="ui container" id='content-loader'>
<div class="TablePersonnel">
  <h1 class="ui block header">
    <div class="fontMitr">
      ข้อมูลบุคลากร
    </div>
  </h1>
  <button class="ui blue button" id="btnAdd-Person" >
    <i class="plus icon"></i>
    เพิ่มข้อมูล
  </button>
  <div class="ui divider"></div>
  <!-- <div class="ui horizontal divider">
    <h3 class="fontMitr">
      ตารางข้อมูลบุคลากร 
    </h3>
  </div> -->

      <table class="ui celled table" cellspacing="0" width="100%" id="Personnel-Table">
        <thead>
          <tr>
          <th>รหัสบุคลากร</th>
          <th>ชื่อ - นามสกุล</th>
          <!-- <th>ชื่อผู้ใช้สำหรับใช้เข้าระบบ</th> -->
          <!-- <th>ที่อยู่</th> -->
          <th>ตำแหน่ง</th>
          <th>สังกัด</th>
          <!-- <th>หมายเลขโทรศัพท์</th> -->
          <th>เพิ่มเติม</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
          </thead>
          <tbody>
            <?php
              require_once '../../ConfigDB.php';

              $tblVehOff = $conn->prepare("SELECT `PersonnelID`, P.`Name` as name, `Position`, fac.Name as faculty FROM `personnel` as P join faculty as fac ON P.Department = fac.ID WHERE Position != 'ผู้ดูแลระบบ' ");
              $tblVehOff->execute();
              while($row=$tblVehOff->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <td><?php echo $row['PersonnelID']; ?></td>
              <td><?php echo $row['name']; ?></td>
              <!-- <td><?php //echo $row['Username']; ?></td> -->
              <!-- <td><?php //echo $row['Address']; ?></td> -->
              <td><?php echo $row['Position']; ?></td>
              <td><?php echo $row['faculty']; ?></td>
              <!-- <td><?php //echo $row['Telephone number']; ?></td> -->
              <td>
                <a id="<?php echo $row['PersonnelID']; ?>" class="show-link-person" href="#" title="แสดงข้อมูล">
                <i class="search icon"></i>
                </a>
              </td>
              <td>
                      <a id="<?php echo $row['PersonnelID']; ?>" class="edit-link-person" href="#" title="แก้ไข">
                      <i class="write square icon"></i>
                      </a>
              </td>
              <td>
                      <a id="<?php echo $row['PersonnelID']; ?>" class="delete-link-person" href="#" title="ลบ">
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

<!-- // ฟอร์มเพิ่มข้อมูล -->
<div class="ui small modal" id="ModalformAdd-Person">
  <div class="header">ข้อมูลบุคลากร</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-Person">
          <div class="ui equal width form">
            <div class="two fields">
              <div class="required field">
                <label>รหัสบุคลากร</label>
                <div class="ui icon input" id="loadingCheck">
                  <input type="text" placeholder="รหัสบุคลากร" id="PersonnelID" name="PersonnelID" onblur="checkAvailabilityPerson()" >
                  <i class="icon" id="statusPersonnelID"></i>
                </div>
                <div class="ui red pointing basic label " id='dupPerID'>
                  <i class="remove icon"></i>รหัสบุคลากรนี้มีในระบบแล้ว
                </div>
              </div>
              <div class="field">
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>ชื่อ</label>
                <input type="text" placeholder="ชื่อ" name='Personnel-Fname'>
              </div>
              <div class="required field">
                <label>นามสกุล</label>
                <input type="text" placeholder="นามสกุล" name='Personnel-Lname'>
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>ตำแหน่ง</label>
                <input type="text" placeholder="ระบุตำแหน่ง" name="Personnel-Position">
              </div>
              <div class="required field">
                <label>สังกัด</label>
                <div class="ui dropdown selection">
                  <input type="hidden" name="Personnel-department">
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
                <textarea rows="3" placeholder="ระบุที่อยู่" name="Personnel-Address"></textarea>
              </div>
            </div>
            <div class="two fields">
              <div class="required field">
                <label>หมายเลขโทรศัพท์ ติดต่อ</label>
                <input type="text" placeholder="หมายเลขโทรศัพท์" name="Personnel-Tel">
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
        </form>
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui reset red deny button" id="btnPerson-Exit">
      <div class="fontKanit">
        ยกเลิก
      </div>
    </div>
    <div class="ui green button" id="btnPersonAdd-Submit">
        <div class="fontKanit">
          เพิ่มข้อมูล
        </div>
    </div>
  </div>
</div>


<!-- ฟอร์ม 'แก้ไข' ข้อมูลบุคลากรที่ขอใช้ยานพาหนะ -->
<div class="ui small modal" id="ModalformEdit-Person">
  <div class="header">ข้อมูลบุคลากร</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="drumForm">
          <div class="ui equal width form">
            <div class="two fields">
              <div class="required field">
                <label>รหัสเจ้าหน้าที่</label>
                  <input readonly="" type="text" placeholder="รหัสเจ้าหน้าที่">
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
                <input type="text" placeholder="นามสกุล" >
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>ตำแหน่ง</label>
                  <input type="text" >
              </div>

              <div class="required field">
                <label>สังกัด</label>
                <div class="ui dropdown selection">
                  <input type="hidden" >
                  <div class="default text">เลือกสังกัด</div>
                  <i class="dropdown icon"></i>
                  <div class="menu">
                    <div class="item" data-value="ส่วนกลาง">ส่วนกลาง</div>
                    <div class="item" data-value="คณะครุศาสตร์" >คณะครุศาสตร์</div>
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
                <input type="text" placeholder="ชื่อผู้ใช้เข้าสู่ระบบ">
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
    <div class="ui reset red deny button" id="btnPerson-Exit">
      <div class="fontKanit">
        ยกเลิก
      </div>
    </div>
    <div class="ui green button" id="btnPersonEdit-Submit">
        <div class="fontKanit">
          แก้ไขข้อมูล
        </div>
    </div>
  </div>
</div>

<div class="ui small modal" id="ModalformShow-Person">
  <div class="header">ข้อมูลบุคลากร</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="drumForm2">
          <div class="ui equal width form">
            <div class="two fields">
              <div class="required field">
                <label>รหัสเจ้าหน้าที่</label>
                  <input readonly="" type="text" placeholder="รหัสเจ้าหน้าที่">
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
                <input type="text" placeholder="นามสกุล" >
              </div>
            </div>
            <div class="fields">
              <div class="required field">
                <label>ตำแหน่ง</label>
                  <input type="text" >
              </div>

              <div class="required field">
                <label>สังกัด</label>
                <div class="ui dropdown selection">
                  <input type="hidden" >
                  <div class="default text">เลือกสังกัด</div>
                  <i class="dropdown icon"></i>
                  <div class="menu">
                    <div class="item" data-value="ส่วนกลาง">ส่วนกลาง</div>
                    <div class="item" data-value="คณะครุศาสตร์" >คณะครุศาสตร์</div>
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
                <input type="text" placeholder="ชื่อผู้ใช้เข้าสู่ระบบ">
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
    <div class="ui reset red deny button" id="btnShowPerson-Exit">
      <div class="fontKanit">
        ปิด
      </div>
    </div>
  </div>
</div>

<script>
	$(document).ready(function(){
    clearPerson();
		$('#Personnel-Table').DataTable({
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
      "bLengthChange": false
		});
	});
  $('.ui.modal').modal({
    closable : false

  });
  $('.ui.dropdown').dropdown();
  $('#btnAdd-Person').click(function() {
    $('#ModalformAdd-Person').modal('show');
  });
  $('#btnPersonAdd-Submit').click(function(){
    $('#formAdd-Person').form('submit');
  });


  $('#btnPerson-Exit').click(function(){
    $('#formAdd-Person').form('reset');
    $("#statusPersonnelID").removeClass('green checkmark red remove');
    $("#statusUserID").removeClass('green checkmark red remove');
    clearPerson();

  });

  function checkAvailabilityPerson() {
    if ($('#PersonnelID').val()=="") {
      $("#loadingCheck").removeClass("loading");
      $("#statusPersonnelID").removeClass('green checkmark red remove');
      $("#dupPerID").fadeOut();
    return;
  }
		jQuery.ajax({
		url: "DML-PERSONNEL/check_PersonnelID.php",
		data: 'PersonnelID='+$("#PersonnelID").val(),
		type: "POST",
		beforeSend: function(){
			$("#loadingCheck").addClass("loading");
      $("#statusPersonnelID").removeClass('green checkmark red remove');
      $("#dupPerID").fadeIn();
		},
		success:function(data){
			$("#loadingCheck").removeClass("loading");
			$("#statusPersonnelID").addClass(data);
			if (data=='green checkmark') {
        $("#statusPersonnelID").val(1);
        $("#dupPerID").fadeOut();
        // $('#btnPersonAdd-Submit').removeClass('disabled')
        // enableSubmit();
			}
			else {
        $("#statusPersonnelID").val(0);
        $("#dupPerID").fadeIn();
        // document.getElementById("statusPersonnelID2").innerHTML="  รหัสนี้มีผู้ใช้งานแล้ว";
        // document.getElementById("PersonnelID").innerHTML="";
				// $('#btnPersonAdd-Submit').addClass('disabled')
			}

		},
		error:function (){}
		});
	}
</script>

