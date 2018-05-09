<?php
include_once '../../../ConfigDB.php';

if($_GET['show_id'])
{
	$id = $_GET['show_id'];
	$stmt=$conn->prepare("SELECT VehicleID,Brand,Picture ,Registration, Odometer,`Num of seats`,`Date insurance expires` ,`Vehicle status`,Name_Type ,Department FROM vehicle as VH join vehicle_type as TY on VH.TypeID = TY.TypeID WHERE VehicleID=:id");
	$stmt->execute(array(':id'=>$id));
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

}

?>

  <form class="ui form" id="formShow-VH">
    <div class="ui equal width form">
    <div class "fields">
    <div class "field">
     <img class="ui centered small image" "center" src="../../images/Vehicles-Images/<?php echo $row['Picture']; ?>" >
    </div>
    </div>
      <div class="fields">
        <div class="field">
          <label>รหัสยานพาหนะ</label>
          <input readonly="" type="text" placeholder="รหัสยานพาหนะ" name="VehicleID" id="VehicleIDEdit" value="<?php echo $row['VehicleID']; ?>">
        </div>
        <div class="field">
        <div class="field">
          <label>หมายเลขทะเบียน</label>
          <input type="text" placeholder="หมายเลขทะเบียน" readonly="" value="<?php echo $row['Registration']; ?>">
        </div>
        </div>
      </div>
      <div class="fields">
        <div class="field">
          <label>ยี่ห้อ</label>
          <input type="text" placeholder="ยี่ห้อ" readonly="" value="<?php echo $row['Brand']; ?>">
        </div>
        <div class="field">
          <label>ประเภทยานพาหนะ</label>
          <input type="text" placeholder="ประเภทรถ" readonly="" value=" <?php echo $row['Name_Type']; ?>">
        </div>
      </div>
      <div class="fields">
      <div class="field">
          <label>หมายเลขระยะทางเริ่มต้น</label>
          <input type="number" placeholder="ระยะทางเริ่มต้น" readonly="" value="<?php echo $row['Odometer']; ?>">
        </div>
        <div class="field">
          <label>จำนวนที่นั่ง</label>
          <input type="number" placeholder="ระบุจำนวนที่นั่ง" readonly="" value="<?php echo $row['Num of seats']; ?>">
        </div>
      </div>
      <div class="fields">
        <?php
				// แปลงวันที่
				$dateInsuranceEX = $row['Date insurance expires'];
				$date = date_create_from_format('Y-m-d',$dateInsuranceEX );
				$dateInsurance = date_format($date,'j/m/Y');
				 ?>
          <div class="field">
            <label>วันที่หมดประกัน</label>
            <!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
            <div class="ui calendar" id="DateExp">
              <div class="ui input left icon">
                <i class="calendar icon"></i>
                <input type="text" placeholder="วันที่หมดประกัน" readonly="" name="DateInsuranceExp" value="<?php echo $dateInsurance; ?>">
              </div>
            </div>
          </div>
          <div class="required field">
          <label>สังกัด</label>
          <input type="text" placeholder="สังกัด" readonly="" value="<?php echo $row['Department']; ?>">
        </div>
      </div> 
        <!-- <div class="field">
					<label>รูปภาพ</label>
					<div class="ui fluid action input">
						<input type="text" readonly>
						<input type="file" name="Vehicle_image" accept="image/*">
						<div class="ui icon button">
							<i class="attach icon"></i>
						</div>
					</div>
				</div> -->
      
    </div>
  </form>
  <script>
    $('#vh-showpathEdit,#btnEditImage').click(function (e) {
      e.stopImmediatePropagation();
      console.log('triggered');
      $('#Vehicle_imageEdit').click();
      $('#Vehicle_imageEdit').on('change', function () {
        var filename = $('#Vehicle_imageEdit').val().replace(/C:\\fakepath\\/i, '')
        $('#vh-showpathEdit').val(filename);
      });
    });
  </script>

  <script>
    $(document).ready(function () {
      $('.ui.dropdown').dropdown();

      $('#btnEditSubmit-VH').click(function () {
        $('#formEdit-VH').form('submit');
      });

      // $('input:text, .ui.button', '.ui.action.input')
      // 	.on('click', function(e) {
      // 			$('input:file', $(e.target).parents()).click();
      // 	});
      //
      // $('input:file', '.ui.action.input')
      // 	.on('change', function(e) {
      // 			var name = e.target.files[0].name;
      // 			$('input:text', $(e.target).parent()).val(name);
      // 	});


    });
  </script>
  <script>
    function checkAvailabilityRegis() {
      if ($('#RegistrationEdit').val() == '') {
        return false;
      }
      jQuery.ajax({
        url: "DML-Vehicle/check_RegisEdit.php",
        data: {
          Registration: $("#RegistrationEdit").val(),
          VehicleID: $('#VehicleIDEdit').val()
        },
        // 'Registration='+$("#RegistrationEdit").val()+'VehicleID='+$('#VehicleIDEdit').val() ,
        type: "POST",
        beforeSend: function () {
          $("#loadingCheckEdit").addClass("loading");
          $("#statusEditRE").removeClass('green checkmark red remove');
        },
        success: function (data) {
          $("#loadingCheckEdit").removeClass("loading");
          $("#statusEditRE").addClass(data);
          if (data == 'green checkmark') {
            $("#statusEditRE").val(1);
            $('#dupEditRE').fadeOut();
          } else {
            $("#statusEditRE").val(0);
            $('#dupEditRE').fadeIn();
          }
        },
        error: function () {}
      });

    }
  </script>
  <script src="DML-Vehicle/crud-VH.js"></script>