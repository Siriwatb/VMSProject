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
      FORM1 !
    </div>
    <div class="ui basic button" id="FORM2">
      FORM2 !
    </div>
    <div class="ui basic button" id="FORM3">
      FORM3 !
    </div>
    <!-- จัดการข้อมประเภทยานพาหนะ -->
    <div class="ui small modal" id="formAdd">
  		<div class="header">จัดการข้อมูลประเภทยานพาหนะ</div>
  		<div class="content">
  			<div class="ui grid">
  				<div class="twelve wide column centered grid">
  					<form class="ui form" id="formAdd-VHO" method="post">
              <div class="ui equal width form">
                <div class="fields">
                  <div class="inline field">
                    <label>ชื่อประเภท</label>
                    <input type="text" placeholder="">
                  </div>
                </div>
                <div class="fields">
                  <div class="inline field">
                    <label>จำนวนที่นั่ง</label>
                    <input type="text" placeholder="">
                  </div>
                </div>
                <div class="fields">
                  <div class="field">
                    <label>รายละเอียด</label>
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

<!-- จัดการข้อมูลยานพาหนะ -->
<div class="ui small modal" id="formAdd2">
  <div class="header">จัดการข้อมูลยานพาหนะ</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-VHO" method="post">
          <div class="ui equal width form">
            <div class="fields">
              <div class="inline field">
                <label>รหัสยานพาหนะ</label>
                <input type="text" placeholder="">
              </div>
            </div>
            <div class="fields">
              <div class="inline field">
                <label>หมายเลขทะเบียน</label>
                <input type="text" placeholder="">
              </div>
            </div>
            <div class="fields">
              <div class="inline field">
                <label>ยี่ห้อ</label>
                <input type="text" placeholder="">
              </div>
              </div>
              <div class="fields">
                <div class="required field">
						      <label>ประเภทยานพาหนะ</label>
									<div class="ui dropdown selection">
							      <input type="hidden">
							      <div class="default text">เลือกประเภท</div>
							      <i class="dropdown icon"></i>
							      <div class="menu">
							        <div class="item" data-value="คณะครุศาสตร์">คณะครุศาสตร์</div>
							        <div class="item" data-value="คณะมนุษยศาสตร์และสังคมศาสตร์">คณะมนุษยศาสตร์และสังคมศาสตร์</div>
											<div class="item" data-value="คณะวิทยาศาสตร์">คณะวิทยาศาสตร์</div>
											<div class="item" data-value="คณะวิทยาการจัดการ">คณะวิทยาการจัดการ</div>
											<div class="item" data-value="คณะเทคโนโลยี">คณะเทคโนโลยี</div>
							      </div>
							    </div>
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

<!--จัดการข้อมูลข้อคำถาม  -->
<div class="ui small modal" id="formAdd3">
  <div class="header">จัดการข้อมูลข้อคำถาม</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-VHO" method="post">
          <div class="ui equal width form">
            <div class="fields">
              <div class="inline field">
                <label>ข้อคำถาม</label>
                <input type="text" placeholder="">
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
      $('#FORM2').click(function(){
        $('#formAdd2').modal('show')
      });
      $('#FORM3').click(function(){
        $('#formAdd3').modal('show')
      });
    });
  </script>
</html>
