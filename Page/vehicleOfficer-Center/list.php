<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
		<script src="../../jquery-3.1.1.min.js"></script>


		<script src="../../semantic.min.js"></script>
		<script src="../../js/jquery.dataTables.min.js"></script>
		<script src="../../js/dataTables.semanticui.min.js"></script>
  	<link rel="stylesheet" href="../../font/googleFont.css">
    <link rel="stylesheet" href="../../semantic.min.css">
  	<link rel="stylesheet" href="../../css/editModal.css">
		<link rel="stylesheet" href="../../css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="../../css/dataTables.semanticui.min.css">
  </head>
  <body>
    <!-- ตารางข้อมูลประเภทยานพาหนะ -->
    <div >
      <table class="ui celled table" cellspacing="0" width="100%" id="datatable">
        <thead>
          <tr>
          <th>รหัสประเภท</th>
          <th>ชื่อประเภท</th>
          <th>รายละเอียด</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT * FROM `vehicle_type`");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <td><?php echo $row['TypeID']; ?></td>
              <td><?php echo $row['Name_Type']; ?></td>
              <td><?php echo $row['Description']; ?></td>
              <td>
                      <a id="<?php echo $row['TypeID']; ?>" class="edit-link" href="#" title="แก้ไข">
                      <i class="write square icon"></i>
                      </a>
              </td>
              <td>
                      <a id="<?php echo $row['TypeID']; ?>" class="delete-link" href="#" title="ลบ">
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

    <!-- ตารางข้อมูลยานพาหนะ -->
    <div class="ui container">
      <table class="ui celled table" cellspacing="0" width="100%" id="datatable">
        <thead>
          <tr>
          <th>รหัสยานพาหนะ</th>
          <th>เลขทะเบียน</th>
          <th>ยี่ห้อ</th>
          <th>รูปภาพ</th>
          <th>หมายเลขไมล์</th>
          <th>จำนวนที่นั่ง</th>
          <th>วันที่หมดประกัน</th>
          <th>สถานะรถ</th>
          <th>รหัสประเภท</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT * FROM `vehicle`");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <td><?php echo $row['VehicleID']; ?></td>
              <td><?php echo $row['Name_Type']; ?></td>
              <td><?php echo $row['Registration']; ?></td>
              <td><?php echo $row['Brand']; ?></td>
              <td><?php echo $row['Picture']; ?></td>
              <td><?php echo $row['Odometer']; ?></td>
              <td><?php echo $row['Num_of_seats']; ?></td>
              <td><?php echo $row['Vehicle_status']; ?></td>
              <td><?php echo $row['TypeID']; ?></td>
              <td>
                      <a id="<?php echo $row['TypeID']; ?>" class="edit-link" href="#" title="แก้ไข">
                      <i class="write square icon"></i>
                      </a>
              </td>
              <td>
                      <a id="<?php echo $row['TypeID']; ?>" class="delete-link" href="#" title="ลบ">
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

    <!-- ตารางข้อมูลข้อคำถาม -->
    <div class="ui container">
      <table class="ui celled table" cellspacing="0" width="100%" id="datatable">
        <thead>
          <tr>
          <th>เลขที่</th>
          <th>หัวข้อคำถาม</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT * FROM `question`");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <td><?php echo $row['QuesNo']; ?></td>
              <td><?php echo $row['Question']; ?></td>
              <td>
                      <a id="<?php echo $row['QuesNo']; ?>" class="edit-link" href="#" title="แก้ไข">
                      <i class="write square icon"></i>
                      </a>
              </td>
              <td>
                      <a id="<?php echo $row['QuesNo']; ?>" class="delete-link" href="#" title="ลบ">
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

    <!-- ตารางข้อมูลการตรวจซ่อมบำรุงยานพาหนะ -->
    <div class="ui container">
      <table class="ui celled table" cellspacing="0" width="100%" id="datatable">
        <thead>
          <tr>
          <th>รหัสการตรวจซ่อม</th>
          <th>รายละเอียด</th>
          <th>วันที่</th>
          <th>ที่อยู่</th>
          <th>เวลา</th>
          <th>รหัสยานพาหนะ</th>
          <th>รหัสเจ้าหน้าที่</th>
          <th>แก้ไข</th>
          <th>ลบ</th>
          </tr>
        </thead>
          <tbody>
            <?php
              require_once '../../ConfigDB.php';

              $stmt = $conn->prepare("SELECT * FROM `maintenance`");
              $stmt->execute();
              while($row=$stmt->fetch(PDO::FETCH_ASSOC))
              {
            ?>
            <tr>
              <td><?php echo $row['MainID']; ?></td>
              <td><?php echo $row['Description']; ?></td>
              <td><?php echo $row['DateMain']; ?></td>
              <td><?php echo $row['TimeMain']; ?></td>
              <td><?php echo $row['VehicleID']; ?></td>
              <td><?php echo $row['OfficerID']; ?></td>
              <td>
                      <a id="<?php echo $row['MainID']; ?>" class="edit-link" href="#" title="แก้ไข">
                      <i class="write square icon"></i>
                      </a>
              </td>
              <td>
                      <a id="<?php echo $row['MainID']; ?>" class="delete-link" href="#" title="ลบ">
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

  </body>
  <script>
	$(document).ready(function(){
		$('#datatable').DataTable();

	});
	</script>
</html>
