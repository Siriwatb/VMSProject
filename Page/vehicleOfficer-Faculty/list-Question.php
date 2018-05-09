<?php 
include "header.php";
require_once '../../ConfigDB.php';

 ?>

<div class="ui container" id='content-loader'>
    <div class="TableQuestion">
      <h1 class="ui block header">
        <div class="fontMitr">
          จัดการข้อมูลคำถาม
        </div>
      </h1>
      <button class="ui blue button" id="btnAdd-Question">
        <i class="plus icon" ></i>
        เพิ่มข้อมูล
      </button>
      <div class="ui horizontal divider">
        <h3 class="fontMitr">
          ตารางข้อมูลคำถาม
        </h3>
      </div>
      <table class="ui celled table" cellspacing="0" width="100%" id="Question-Table">
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
                      <a id="<?php echo $row['QuesNo']; ?>" class="edit-link-Question" href="#" title="แก้ไข">
                      <i class="write square icon"></i>
                      </a>
              </td>
              <td>
                      <a id="<?php echo $row['QuesNo']; ?>" class="delete-link-Question" href="#" title="ลบ">
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
    </div>

<!-- ฟอร์มเพิ่มข้อมูล -->
    <div class="ui small modal" id="ModalformAdd-Question">
      <div class="header">จัดการข้อมูลข้อคำถาม</div>
      <div class="content">
        <div class="ui grid">
          <div class="twelve wide column centered grid">
            <form class="ui form" id="formAdd-Question" method="post">
              <div class="ui equal width form">
                <div class="fields">
                  <div class="inline field">
                    <label>ข้อคำถาม</label>
                    <textarea rows="4" placeholder="ระบุคำถาม" name="question" id="question" onblur="checkAvailabilityQuestion()"></textarea>
                    <div class="ui message hidden" id=msgCheck>
                      <i class="icon" id="statusQ" ></i>
                      <label id="statusText">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="actions">
        <div class="ui reset red deny button" id="btnAddExit-Question">
            ยกเลิก
        </div>
        <div class="ui disabled green submit button" id="btnAddSubmit-Question" >
            เพิ่มข้อมูล
        </div>
      </div>
    </div>

    <!-- ฟอร์มแก้ไข  -->
    <div class="ui small modal" id="ModalformEdit-Question">
      <div class="header">จัดการข้อมูลข้อคำถาม</div>
      <div class="content">
        <div class="ui grid">
          <div class="twelve wide column centered grid">
            <form class="ui form" id="drumFormQ" >
              <div class="ui equal width form">
                <div class="fields">
                  <div class="inline field">
                    <label>ข้อคำถาม</label>
                    <textarea rows="4" placeholder="ทดลอง"></textarea>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="actions">
        <div class="ui reset red deny button" id="btnEditExit-Question">
            ยกเลิก
        </div>
        <div class="ui green submit button" id="btnEditSubmit-Question" >
            แก้ไขข้อมูล
        </div>
      </div>
    </div>

  <script>
	//  $(document).ready(function(){
    $('.ui.modal').modal({
      closable : false,
      autofocus : false
    });
		$('#Question-Table').DataTable({
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

    $('#btnAdd-Question').click(function() {
      $('#formAdd-Question').form('reset');
      $('#formAdd-Question').form('clear');
      $("#status").removeClass('green checkmark red remove');
      $("#msgCheck").removeClass('success negative');
      $('#msgCheck').fadeOut();
      $('#ModalformAdd-Question').modal('show');

    });

    $('#btnAddExit-Question').click(function() {
      $('#formAdd-Question').form('reset');
      $('#formAdd-Question').form('clear');
      $("#status").removeClass('green checkmark red remove');
      $("#msgCheck").removeClass('success negative');
      $('#msgCheck').fadeOut();
    });

    $('#btnAddSubmit-Question').click(function() {
      $('#formAdd-Question').form('submit');
    });
	// });
	</script>
  <script src="DML-Question/crud-Question.js"></script>
<script>
  function checkAvailabilityQuestion() {
    if( $('#formAdd-Question').form('is valid') == false) {
      $('#msgCheck').fadeIn();
      $("#statusQ").addClass('red remove');
      $("#msgCheck").addClass('negative');
      $("#statusText").text('กรุณากรอกคำถาม');
				return false ;
			}
    jQuery.ajax({
    url: "DML-Question/check_Question.php",
    data: 'question='+$("#question").val(),
    type: "POST",
    beforeSend: function(){
      $("#statusQ").removeClass('green checkmark red remove');
      $("#msgCheck").removeClass('success negative');
      $("#statusQ").addClass("notched circle loading");
      $('#msgCheck').fadeIn();
    },
    success:function(data){
      $("#statusQ").removeClass("notched circle loading");
      $("#statusQ").addClass(data);
      if (data=='green checkmark') {
        $('#btnAddSubmit-Question').removeClass('disabled')
        $("#msgCheck").addClass('success');
        $("#statusText").text('สามารถใช้ได้');
        return true;
      }
      else {
        $('#btnAddSubmit-Question').addClass('disabled')
        $("#msgCheck").addClass('negative');
        $("#statusText").text('มีคำถามนี้ในระบบแล้ว กรุณาเปลี่ยนคำถาม');
        return false;
      }

    },
    error:function (){}
    });
  }
  </script>
