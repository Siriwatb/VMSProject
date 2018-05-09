<?php 
include "header.php";
require_once '../../ConfigDB.php';

 ?>
<div class="ui container">
<!-- ตารางข้อมูลพนักงานขับยานพาหนะ -->
<div class="TablePersonnel">
  <h1 class="ui block header">
    <div class="fontMitr">
      ข้อมูลผู้จองยานพาหนะ
    </div>
  </h1>

      <table class="ui celled table" cellspacing="0" width="100%" id="Personnel-Table">
        <thead>
          <tr>
          <th>รหัสบุคลากร</th>
          <th>ชื่อ-นามสกุล</th>
          <th>เบอร์โทร</th>
          <th>ที่อยู่</th>
          <th>ตำแหน่ง</th>
          <th>หน่วยงาน</th>
          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT * FROM `personnel` WHERE Position <> 'ผู้ดูแลระบบ' ");
              // $stmt->bindParam(":Office", $_SESSION['Office']);
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <td><?php echo $row['PersonnelID']; ?></td>
              <td><?php echo $row['Name']; ?></td>
              <td><?php echo $row['Telephone number']; ?></td>
              <td><?php echo $row['Address']; ?></td>
              <td><?php echo $row['Position']; ?></td>
              <td><?php echo $row['Department']; ?></td>
            </tr>
              <?php
            }
            ?>
          </tbody>
      </table>

</div>
</div>


<script>
	$(document).ready(function(){
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
      "bDestroy": true
		});
	});
</script>
