<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js">
  	</script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.13/js/dataTables.semanticui.min.js">
  	</script>
  	<script type="text/javascript" language="javascript" src="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.js">
  	</script>
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.6/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/dataTables.semanticui.min.css">
  </head>
  <body>
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


  </body>
  <script>
	$(document).ready(function(){
		$('#datatable').DataTable();

	});
	</script>
</html>
