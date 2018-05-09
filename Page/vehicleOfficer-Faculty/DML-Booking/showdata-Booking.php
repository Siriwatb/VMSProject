<?php
include_once '../../../ConfigDB.php';

if($_GET['show_id'])
{
	$id = $_GET['show_id'];
	$stmt=$conn->prepare("SELECT `UsingID`,`Appointment`,`Approve Date`,`NumPeople`,`Reason`,`Using Status`,`Destination` FROM `using` where UsingID = :id");
	$stmt->execute(array(':id'=>$id));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

	
}

?>
<form class="ui form" id="ModalformShow-Booking" method="post">
          <div class="ui equal width form">
            <div class="fields">
              <div class="required field">
                <label>วันที่เดินทาง</label>
                <div class="ui calendar" >
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="วันที่เดินทาง" >
                  </div>
                </div>
              </div>
              <div class="required field">
                <label>วันที่กลับ</label>
                <div class="ui calendar" >
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="วันที่กลับ" >
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
                    <input type="text" placeholder="เวลาออกเดินทาง" >
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
                    <input type="text" placeholder="เวลากลับ" >
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
                <textarea rows="4" placeholder="ระบุจุดหมายปลายทาง" ></textarea>
              </div>
              <div class="field">
                <label>จำนวนที่นั่ง</label>
                <input type="text" placeholder="จำนวนที่นั่ง" >
              </div>

              <!-- <div class="field">
              </div> -->
            </div>
            <div class="fields">

              <div class="required field">
                <label>จุดนัดขึ้นรถ</label>
                <textarea rows="4" placeholder="จุดนัดขึ้นรถ" ></textarea>
              </div>
              <div class="required field">
                <label>จุดประสงค์การเดินทาง</label>
                <textarea rows="4" placeholder="ระบุจุดประสงค์การเดินทาง" ></textarea>
              </div>
            </div>
            <!-- <div class="fields">
              <input type="text" id="arrayCar" name="arrayCar" style="display:none">

            </div> -->
          </div>
          <div class="ui basic button" id="btnSelect">
            <i class="plus icon"></i>
            เลือกยานพาหนะ
          </div>
          <table class="ui celled table" cellspacing="0" width="100%" id="Booking">
            <thead>
              <tr>
                <th>รหัสยานพาหนะ</th>
                <th>หมายเลขทะเบียน</th>
                <th>ประเภท</th>
                <th>สังกัด</th>
                <th>ลบ</th>
              </tr>
            </thead>
            <tbody>


            </tbody>
          </table>
        </form>

	



	<script>
		$(document).ready(function () {

		});
	</script>
	<script src="DML-Booking/crudBooking.js"></script>