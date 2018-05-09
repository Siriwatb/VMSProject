<?php

require_once '../../ConfigDB.php';
$item = '';
$stmt2 = $conn->prepare("SELECT * FROM `vehicle_type");
// $stmt3 = $conn->prepare("SELECT * FROM `vehicle_type");
$stmt2->execute();
// $stmt3->execute();
  $row3=$stmt2->fetch(PDO::FETCH_ASSOC);
// if ($row3==0) {
//   echo '<div class="disabled item">ไม่มีข้อมูล</div>';
// }
// else {
  while($row3==$stmt2->fetch(PDO::FETCH_ASSOC))
  {
    echo '<div class="item"  data-value='.$row3['TypeID'].'>'.$row3['Name_Type'].'</div>';
  }
// }

// 

?>
