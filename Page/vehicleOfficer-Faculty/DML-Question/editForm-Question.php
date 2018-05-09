<?php
include_once '../../../ConfigDB.php';

if($_GET['edit_id'])
{
	$id = $_GET['edit_id'];
	$stmt=$conn->prepare("SELECT * FROM `question` WHERE quesNo=:id");
	$stmt->execute(array(':id'=>$id));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

}

?>
<form class="ui form" id="formEdit-Question" >
	<div class="ui equal width form">
		<div class="fields">
			<div class="inline field">
				<label>ข้อคำถาม</label>
				<textarea rows="4" placeholder="ระบุคำถาม" name="question"><?php echo $row['Question']; ?></textarea>
			</div>
			<input type="hidden" name="QuesNo" value="<?php echo $row['QuesNo']; ?>">
		</div>
	</div>
</form>

<script>
$(document).ready(function(){

  $('#btnEditSubmit-Question').click(function(){
  	$('#formEdit-Question').form('submit');
  });

});
</script>
<script src="DML-Question/crud-Question.js"></script>
