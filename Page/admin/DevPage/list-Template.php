<?php include 'header.php' ?>
<!-- ตารางข้อมูลประเภทยานพาหนะ -->
<div class="ui container"> <!-- ตั้งชื่อ class ตามงาน เช่น TableDriver , TableVehicle -->
  <h1 class="ui block header">
    <div class="fontMitr">
      หัวข้อเพจ <!-- ใส่หัวข้อ ของ เพจนั้น  -->
    </div>
  </h1>
      <button class="ui blue button" id="btnAdd-" > <!-- ตั้ง id button  btnAdd-... ตามด้วยชื่องาน เช่น btnAdd-Driver -->
        <i class="plus icon"></i>
        เพิ่มข้อมูล
      </button>
      <div class="ui horizontal divider">
        <h3 class="fontMitr">
          ชื่อตารางข้อมูล <!-- ชื่อตาราง เช่น ตารางข้อมูลประเภทยานพาหน -->
        </h3>
      </div>
      <table class="ui celled table" cellspacing="0" width="100%" id="Name-Table"> <!--  ตั้ง id ตาราง เช่น Driver-Table , Vehicle-Table    -->
        <thead>
          <tr>
            <!-- หัวคอลัมภ์ -->
          <th>ลำดับ</th>
          <th>ชื่อ-นามสกุล</th>
          <th>ตำแหน่ง</th>
          <th>แก้ไข/ลบ</th>

          </tr>
        </thead>

      </table>

</div>

<!-- Modal จัดการข้อมประเภทยานพาหนะ -->
<div class="ui small modal" id="ModalformAdd-Name"> <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
  <div class="header">หัวข้อ Modal</div> <!-- หัวข้อ Modal -->
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="formAdd-Name" method="post"> <!-- ตั้ง id ตามนี้ เปลี่ยนเฉพาะตรง Name ตามงาน-->
          <div class="ui equal width form">

            <div class="fields">
              <div class="required field">
                <label>text Input</label>
                <input type="text" placeholder="xxxxxx" name="TypeName" id="TypeName">
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>text Area</label>
                <textarea rows="3" placeholder="xxxxxxx" name="TypeDescription"></textarea>
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <div class="ui selection dropdown">
                  <input type="hidden" name="gender">
                  <i class="dropdown icon"></i>
                  <div class="default text">dropdown</div>
                  <div class="menu">
                    <div class="item" data-value="1">1</div>
                    <div class="item" data-value="2">2</div>
                    <div class="item" data-value="3">3</div>
                  </div>
                </div>
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>DateTimePicker</label>
                <!-- <input type="date" placeholder="วันที่หมดประกัน" > -->
                <div class="ui calendar" id="Date">
                  <div class="ui input left icon">
                    <i class="calendar icon"></i>
                    <input type="text" placeholder="xxxxx" name="">
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
    <div class="ui red button" id="btnExit-">
        ยกเลิก
    </div>
    <div class="ui disabled green button" id="btnAddSubmit-" >
        เพิ่มข้อมูล
    </div>
  </div>
</div>

<!-- ฟอร์มแก้ไข  -->
<div class="ui small modal" id="ModalformEdit-Name">
  <div class="header">หัวข้อ</div>
  <div class="content">
    <div class="ui grid">
      <div class="twelve wide column centered grid">
        <form class="ui form" id="drumFormVHType">
          <div class="ui equal width form">
            <div class="fields">
              <div class="required field">
                <label>textInput</label>
                <input type="text" placeholder="ทดลอง" >
              </div>
            </div>
            <div class="fields">
              <div class="field">
                <label>textarea</label>
                <textarea rows="4" placeholder="ทดลอง" ></textarea>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="actions">
    <div class="ui red button" id="btnEditExit-VHType">
        ยกเลิก
    </div>
    <div class="ui green button" id="btnEditSubmit-VHType" >
        แก้ไขข้อมูล
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function () {


      readRecord();
  });
</script>

<script>
  function readRecord() {


        var oTable = $('#Name-Table').dataTable({
          retrieve: true,
          "pageLength": 15,
          "bLengthChange": false,
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
          // "bDestroy": true,


          "aoColumns": [
              null, null, null, {"bSortable": false}
          ],
          "aaSorting": [],
    		});
            // $('#Name-Table').dataTable({
            // retrieve: true,
            // bAutoWidth: false,
            // "aoColumns": [
            //     null, null, null, {"bSortable": false}
            // ],
            // "aaSorting": [],
            // "iDisplayLength": 10});

        $.ajax({
            url: 'test_ajax.php',
            dataType: 'json',
            success: function (s) {
                console.log(s);
                oTable.fnClearTable();
                for (var i = 0; i < s.length; i++) {
                    oTable.fnAddData([
                        s[i][0],
                        s[i][1],
                        s[i][2],
                        s[i][3]
                    ]);
                } // End For

            },
            error: function (e) {
                console.log(e.responseText);
            }
        });
  };
</script>


<script>
	// $(document).ready(function(){
  var calendarText = {

    days: ['อา.', 'จ.', 'อ.', 'พ.', 'พฤ.', 'ศ.', 'ส.'],
    months: ['มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'],
    monthsShort: ['ม.ค.', 'ก.พ.', 'มี.ค.', 'เม.ย.', 'พ.ค.', 'มิ.ย.', 'ก.ค.', 'ส.ค.', 'ก.ย.', 'ต.ค.', 'พ.ย.', 'ธ.ค.'],
    today: 'Today',
    now: 'Now',
    am: 'AM',
    pm: 'PM'

  }

  $('.ui.dropdown').dropdown();

    $('.ui.modal').modal({
      closable : false,
      autofocus : false
    });

    $('#btnAdd-').click(function() {
      $('#Date').calendar({
        type:'date',
        text : calendarText,
        constantHeight: false,
        formatter: {
          date: function (date, settings) {
            if (!date) return '';
            var day = date.getDate();
            var month = date.getMonth()+1;
            var year = date.getFullYear();
            return day + '/' + month + '/' + year;
          }
        }
      });
      $('#formAdd-').form('reset');
      $('#formAdd-').form('clear');
      // $("#status").removeClass('green checkmark red remove');
      $('#ModalformAdd-Name').modal('show');
    });
    //
    $('#btnExit-').click(function() {
      $('#formAdd-').form('reset');
      $('#ModalformAdd-Name').modal('hide');

    });

</script>
