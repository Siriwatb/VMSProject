<?php
include_once '../../../ConfigDB.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];
	$stmt=$conn->prepare("SELECT * FROM `maintenance` WHERE MainID=:id");
	$stmt->execute(array(':id'=>$id));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

}

?>

<form class="ui form" id="formEdit-M" method="post">
	<div class="ui equal width form">
		<div class="fields">
			<input type="hidden" name="mID" value="<?php echo $row['MainID']; ?>">
			<div class="required field">
				<label>ยานพาหนะ</label>
				<div class="ui input">
					<input type="text" readonly="" placeholder="เลือกยานพาหนะ" name='VehicleID' value="<?php echo $row['VehicleID']; ?>">
				</div>
			</div>
			<div class="field">
			</div>
		</div>
		<?php
		// แปลงวันที่
		$date = $row['DateMain'];
		$date = date_create_from_format('Y-m-d',$date);
		$date= date_format($date,'j/m/Y');
		 ?>
		<div class="fields">
			<div class="required field">
				<label>วันที่ทำการตรวจซ่อมบำรุง</label>
				<div class="ui calendar" id="DateEdit">
					<div class="ui input left icon">
						<i class="calendar icon"></i>
						<input type="text" placeholder="วันที่ตรวจซ่อมบำรุง" name="M-Date" value="<?php echo $date;?>">
					</div>
				</div>
			</div>
			<div class="required field">
				<label>เวลา</label>
				<div class="ui calendar" id="TimeEdit">
					<div class="ui right labeled  input left icon">
						<i class="calendar icon"></i>
						<input type="text" placeholder="เวลาตรวจซ่อมบำรุง" name='M-Time' value="<?php echo $row['TimeMain'];?>" >
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
				<textarea rows="4" placeholder="ระบุรายละเอียด" name="Description"><?php echo $row['Description']; ?></textarea>
			</div>
		</div>
	</div>
</form>


<script>
$(document).ready(function(){
	var calendarText = {
    days: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
    months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
    monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
    today: 'วันนี้',
    now: 'ปัจจุบัน',
    am: 'AM',
    pm: 'PM'
  }
	$('#DateEdit').calendar({
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
	$('#TimeEdit').calendar({
		on : 'click',
		type : 'time',
		ampm: false,
		text : calendarText,
		constantHeight: false,

	});
  $('#btnEditSubmit-M').click(function(){
  	$('#formEdit-M').form('submit');
  });

});
</script>
<script src="DML-Maintenance/crud-Maintenance.js"></script>
