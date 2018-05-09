<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
    <!-- <script type="text/javascript" language="javascript" src="//code.jquery.com/jquery-1.12.4.js"></script> -->
    <script src="../../jquery-3.1.1.min.js"></script>
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

    <div class="ui basic button" id="FORM1">
      FORM !
    </div>
    <div class="ui small modal" id="formAdd">
  		<div class="header">จัดการข้อมูลการตรวจซ่อมบำรุง</div>
  		<div class="content">
  			<div class="ui grid">
  				<div class="twelve wide column centered grid">
  					<form class="ui form" id="formAdd-VHO" method="post">
              <div class="ui equal width form">
                <div class="fields">
                  <div class="inline field">
                    <label>วันที่ทำการตรวจซ่อมบำรุง</label>
                    <input type="text" placeholder="">
                  </div>
                </div>
                <div class="fields">
                  <div class="inline field">
                    <label>รายละเอียดการตรวจซ่อมบำรุง</label>
                    <textarea rows="4" placeholder="ระบุรายละเอียด"></textarea>
                  </div>
                </div>
              </div>
  					</form>
  				</div>
  			</div>
  		</div>
  		<div class="actions">
  			<div class="ui reset red deny button" id="btnExit-VHO">

  	        ยกเลิก

  	    </div>
  	    <div class="ui green submit button" id="btnAddVHO-Submit" >

  	          เพิ่มข้อมูล

  	    </div>
  		</div>
  	</div>
  </body>
  <script>
    $(document).ready(function(){
      $('#FORM1').click(function(){
        $('#formAdd').modal('show')
      });
    });
  </script>
</html>
