<?php
include('../../../ConfigDB.php');

$tblVehOff = $conn->prepare("SELECT * FROM `personnel`");
$tblVehOff->execute();
$i = 1;
while($row=$tblVehOff->fetch())
{
      $output[] = array($i, $row[3], $row[6], '<button id='.$row[0].' class="small ui blue icon button"><i class="write icon"></i></button><button id='.$row[0].' class="small ui red icon button"><i class="erase icon"></i></button>');

      $i++;
}

echo  json_encode($output);
// $sql = " SELECT * FROM `personnel` ORDER BY personnelID DESC ";
//   $query = mysqli_query($conn, $sql);
//   $i = 1;
//   while ($fetch = mysqli_fetch_array($query)) {
//       $output[] = array($i, $fetch[1], $fetch[6], '<button id='.$fetch[0].' class="small ui blue icon button"><i class="write icon"></i></button>
//                                                   <button id='.$fetch[0].'class="small ui red icon button"><i class="erase icon"></i></button>');
//
//       $i++;
//   }
//   echo json_encode($output);

 ?>
