<?php
include_once '../../../ConfigDB.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];
	$stmt=$conn->prepare("SELECT * FROM `vehicle_type` WHERE TypeID=:id");
	$stmt->execute(array(':id'=>$id));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

}

?>
<form class="ui form" id="formEdit-VHType" method="post">
  <div class="ui equal width form">
    <div class="fields">
      <div class="required field">
        <label>ชื่อประเภท</label>
        <input type="text" placeholder="กรอกชื่อประเภท" name="TypeName" value="<?php echo $row['Name_Type']; ?>">
      </div>
    </div>
    <div class="fields">
      <div class="field">
        <label>รายละเอียด</label>
        <textarea rows="4" placeholder="ระบุรายละเอียด" name="TypeDescription" ><?php echo $row['Description']; ?></textarea>
      </div>
      <input type="hidden" name="TypeID" value="<?php echo $row['TypeID']; ?>">
    </div>
  </div>
</form>

<script>
$(document).ready(function(){

  $('#btnEditSubmit-VHType').click(function(){
  	$('#formEdit-VHType').form('submit');
  });

});
</script>
<script src="DML-Vehicle_Type/crud-VHType.js"></script>
