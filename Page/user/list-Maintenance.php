<?php 
include "header.php";
include_once '../../ConfigDB.php';

?>
<div class="ui container">
  <!-- ตารางข้อมูลการตรวจซ่อมบำรุงยานพาหนะ -->
    <div class="TableMaintenance">
      <h1 class="ui block header">
        <div class="fontMitr">
          การตรวจซ่อมบำรุงยานพาหนะ
        </div>
      </h1>

      <table class="ui celled table" cellspacing="0" width="100%" id="maintenance-Table">
        <thead>
          <tr>
          <th>รหัสการตรวจซ่อม</th>
          <th>รายละเอียด</th>
          <th>วันที่</th>

          <th>เวลา</th>
          <th>ยานพาหนะทะเบียน</th>
          <th>เจ้าหน้าที่</th>

          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT m.MainID , m.DateMain ,m.TimeMain , m.Description , v.Registration , off.Name
                                      FROM maintenance as m JOIN officer_vehicles as off ON m.OfficerID = off.OfficerID
                                                            JOIN vehicle as v ON m.VehicleID = v.VehicleID");
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

            </tr>
              <?php
            }
            ?>
          </tbody>
      </table>
  </div>


  <script>
	$(document).ready(function(){

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

	});
	</script>
