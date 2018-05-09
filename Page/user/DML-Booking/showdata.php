<?php
require_once '../../../ConfigDB.php';
$uid = $_GET['uid'];
                      
?>
    <script src="../../../jquery-3.1.1.min.js"></script>
	  <script src="../../../semantic.min.js"></script>
		<script src="../../../js/jquery.dataTables.min.js"></script>
		<script src="../../../js/dataTables.semanticui.min.js"></script>
    <script src="../../../js/calendar.js"></script>

  	<link rel="stylesheet" href="../../../font/googleFont.css">
    <link rel="stylesheet" href="../../../css/calendar.css">
    <link rel="stylesheet" href="../../../semantic.min.css">
  	<link rel="stylesheet" href="../../../css/editModal.css">
		<link rel="stylesheet" href="../../../css/jquery.dataTables.min.css">
		<link rel="stylesheet" href="../../../css/dataTables.semanticui.min.css">
<table class="ui celled table" cellspacing="0" width="100%" id="Booking">
            <thead>
              <tr>
                <th>รหัสยานพาหนะ</th>
                <th>หมายเลขทะเบียน</th>
                <th>ประเภท</th>
                <th>สังกัด</th>
                
              </tr>
            </thead>
            <?php 
            $stmt = $conn->prepare("SELECT v.`VehicleID` as vhID,fa.Name as Fname,ve.`Name_Type` as nameTY,v.Registration as Re 
            FROM `list_using` as li  join `vehicle` as v on v.`VehicleID`= li.`VehicleID` 
            join faculty as fa on v.`Department` = fa.ID join `vehicle_type` as ve on v.`TypeID`= ve.`TypeID`
            WHERE li.UsingID = :UsingID");
            $stmt->bindParam(":UsingID",$uid );
            $stmt->execute();
            while($row=$stmt->fetch(PDO::FETCH_ASSOC))
          {     
              ?>
            <tbody>
                   
                  <tr>
                  <td>
                    <?php echo $row['vhID']; ?>
                  </td>
                  <td>
                    <?php echo $row['Re']; ?>
                  </td>
                  <td>
                    <?php echo $row['nameTY']; ?>
                  </td>
                  <td>
                    <?php echo $row['Fname']; ?>
                  </td>
                  </tr>
                  <?php
            }
            ?>
            </tbody>
          </table>