<?php 
include "header.php";
require_once '../../ConfigDB.php';

 ?>

<div class="ui container">

    <h1 class="ui block header">
        <div class="fontMitr">
            การจอง-รออนุมัติ
        </div>
    </h1>
    <!-- <button class="ui blue button" id="btnAdd-M">
        <i class="plus icon"></i>
        เพิ่มข้อมูล
    </button> -->
    <!-- <div class="ui hidden divider"></div> -->

    <!-- <div class="ui clearing divider"></div> -->
    <table class="ui celled table" cellspacing="0" width="100%" id="approval-Table">
        <thead>
            <tr>
                <th>รหัสการจอง</th>
                <th>วันที่ทำการจอง</th>                          
                <th>ชื่อผู้จอง</th>
                <th>วันเดินทาง</th>
                <th>รายละเอียด</th>
                <th>เพิ่มเติม</th>
                <th>การอนุมัติ</th>
            </tr>
        </thead>
        <tbody>
        <?php
            //   require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT `UsingID`,`reqDate`,p.`Name` as perName ,`Start Date`,`End Time`,`End Date`,`Start Time`,`NumPeople`,`Destination`,`Appointment`,`Reason` 
                                      FROM `using` as u left outer join Personnel as p On u.PersonnelID= p.PersonnelID 
                                      left outer join officer_vehicles as of on u.`OffBookID`= of.OfficerID   
                                      Where `Approve Status` = 2"); //Where `Approve Status` = 2
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <td><?php echo $row['UsingID']; ?></td>
              <td><?php echo $row['reqDate']; ?></td>
              <td><?php echo $row['perName']; ?></td>
              <td><?php echo $row['Start Date']; ?></td>
              <td><?php echo $row['Reason']; ?></td>
              <td>
                      
                    <a             
                        class="Show_Button show-link-Approval"  title="เพิ่มเติม"      
                        AppDstart="<?php echo $row['Start Date'];?>" 
                        AppDend="<?php echo  $row['End Date'];?>"
                        AppTstart="<?php echo  $row['Start Time'];?>" 
                        AppTend="<?php echo $row['End Time'];?>" 
                        AppRe="<?php echo  $row['Reason'];?>"
                        AppAppoint="<?php echo  $row['Appointment'];?>" 
                        AppNum="<?php echo  $row['NumPeople'];?>" 
                        AppDe="<?php echo  $row['Destination'];?>"
                        OnClick="showCar(<?php echo  $row['UsingID'];?>)"
                        >
                        <i class="search icon"></i>
                    </a>        
              </td>
              <td>
                <div class="ui buttons ">
                    <button class="ui green button approve" id="<?php echo $row['UsingID']; ?>">อนุมัติ</button>
                    <button class="ui red button DenyApp" id="<?php echo $row['UsingID']; ?>">ไม่อนุมัติ</button>                  
                    </div>
                </td>
            </tr>
              <?php
            }
            ?>

        </tbody>
    </table>


</div>
<div class="ui large  modal" id="ModalformShow-Approval">
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
                    <input type="text" placeholder="วันที่เดินทาง"  id="StartDateApp" readonly="" >
                  </div>
                </div>
              </div>
              <div class="required field">
                <label>วันที่กลับ</label>
                <div class="ui calendar" >
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="วันที่กลับ" id="EndDateApp" readonly="" >
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
                    <input type="text" placeholder="เวลาออกเดินทาง" id="StartTimeApp" readonly=""  >
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
                    <input type="text" placeholder="เวลากลับ" id="EndTimeApp" readonly="" >
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
                <textarea rows="4" placeholder="ระบุจุดหมายปลายทาง" id="DestinationApp" readonly=""  ></textarea>
              </div>
              <div class="field">
                <label>จำนวนคน</label>
                <input type="text" placeholder="จำนวนคน" id="NumPeopleApp" readonly=""  >
              </div>

              <!-- <div class="field">
              </div> -->
            </div>
            <div class="fields">

              <div class="required field">
                <label>จุดนัดขึ้นรถ</label>
                <textarea rows="4" placeholder="จุดนัดขึ้นรถ" id="AppointmentApp" readonly="" ></textarea>
              </div>
              <div class="required field">
                <label>จุดประสงค์การเดินทาง</label>
                <textarea rows="4" placeholder="ระบุจุดประสงค์การเดินทาง" id="ReasonApp" readonly=""  ></textarea>
              </div>
            </div>
            <!-- <div class="fields">
              <input type="text" id="arrayCar" name="arrayCar" style="display:none">

            </div> -->
          </div>
          
          <!-- here -->
          <iframe id='fShowdata' name='fShowdata' width="100%" height="250" frameborder=0></iframe> 
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
function showCar(myvar){

var iframeElem = document.getElementById('fShowdata');

// update the element's src:
iframeElem.src = "DML-Booking/showdata.php?uid="+myvar;

// option 2: get a reference to the iframe's window object:
var iframeWindow = window.iframe1Name;

// update the iframe's location:
iframeWindow.location.href = "DML-Booking/showdata.php?uid="+myvar;

}

	$(document).ready(function(){
		$('#approval-Table').DataTable({
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
	});

    $('.Show_Button').click(function () {
        //get data from edit btn
        var uid = $(this).attr('Uid');
        var StartDateApp= $(this).attr('AppDstart');
        var EndDateApp = $(this).attr('AppDend');
        var StartTimeApp = $(this).attr('AppTstart');
        var EndTimeApp = $(this).attr('AppTend');
        var ReasonApp= $(this).attr('AppRe');
        var AppointmentApp = $(this).attr('AppAppoint');
        var NumPeopleApp = $(this).attr('AppNum');
        var DestinationApp = $(this).attr('AppDe');
        //set value to modal
        // $('#VehicleIDShow').val(VehicleIDShow);
        // document.getElementById("PictureShow").src = "../../images/Vehicles-Images/" + PictureShow;
        // $('#PictureShow').val(PictureShow);
        $('#hideUID').val(uid);
        $('#StartDateApp').val(StartDateApp);
        $('#EndDateApp').val(EndDateApp);
        $('#StartTimeApp').val(StartTimeApp);
        $('#EndTimeApp').val(EndTimeApp);
        $('#ReasonApp').val(ReasonApp);
        $('#AppointmentApp').val(AppointmentApp);
        $('#NumPeopleApp').val(NumPeopleApp);
        $('#DestinationApp').val(DestinationApp);

        $('#ModalformShow-Approval').modal('show');
        });
</script>
<script src='DML-Approval/crudApproval.js'></script>