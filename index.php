<?php include_once 'permissioncheck.php'; ?>
<!DOCTYPE html>
<html lang="th">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>Vehicle Management System</title>
    <script src="jquery-3.1.1.min.js"></script>

    <link rel="stylesheet" href="font/googleFont.css">

    <link rel="stylesheet" href="semantic.min.css">
    <link rel="stylesheet" href="css/editModal.css">
    <script src="semantic.min.js"></script>

    <style type="text/css">
    body {
      background-image: url('images/public-transportation-tram-bus-seats.jpeg');
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;

      opacity: 0.85;
    }
    body > .grid {
      height: 100%;
    }
    .image {
      margin-top: -100px;
    }
    .column {
      max-width: 450px;
    }
    .middled{
      position:absolute;
       height:auto;
       top:25%;

    }


  </style>



  </head>
  <body>

      <div class="ui secondary grey inverted middle aligned center aligned segment middled">

        <div class="ui text container">
          <h1 class="ui inverted fontTrirong">
             ระบบบริการและจัดการฝ่ายยานพาหนะ
          </h1>
          <h2 class="ui inverted fontTrirong">มหาวิทยาลัยราชภัฎอุดรธานี</h2>
          <p></p>
        </div>
        <div class="ui container">
          <button class="yellow massive ui button" id="btnLogin">
           <div class="fontMitr">
             เข้าสู่ระบบ
           </div>
          </button>
        </div>
        <div class="ui container">
          <button class="circular ui icon button" data-tooltip="วิธีใช้" data-position="bottom left"  data-inverted="">
            <i class="help icon" ></i>
          </button>
          <button class="circular ui icon button" data-tooltip="ติดต่อเรา" data-position="bottom left"  data-inverted="">
            <i class="mail icon" ></i>
          </button>
        </div>

      </div>



<div class="ui tiny modal">

  <div class="content">


    <h2 class="ui green center aligned header">
      <div class="fontPridi">
          เข้าสู่ระบบ
      </div>
    </h2>
    <!-- ฟอร์ม Login -->
      <form  class="ui large form" id="login-form">
          <div class="field">
            <div class="ui left icon input">
              <i class="user icon"></i>
              <input type="text" name="username" placeholder="ชื่อผู้ใช้" id="username">
            </div>
          </div>
          <div class="field">
            <div class="ui left icon input">
              <i class="lock icon"></i>
              <input type="password" name="password" placeholder="รหัสผ่าน" id="password">
            </div>
          </div>
          <div class="ui error message" ></div>
          <div class="ui hidden message" id="msgBox"></div>
          <div class="ui hidden message" id="loadingBox"></div>
      </form>
  </div>
  <div class="actions">
    <div class="ui  red deny button" id="btnClrExit">
      <div class="fontKanit">
        ยกเลิก
      </div>
    </div>
    <div class="ui green button" id="btnSubmit">
        <div class="fontKanit">
          เข้าสู่ระบบ
        </div>
    </div>
  </div>

</div>

  </body>

  <script>
  $(document).ready(function() {
    $('.ui.modal').modal({
      closable : false,
      useCSS   : true
    });

    $("#btnLogin").click(function(){
      $('.ui.tiny.modal').modal('show');
    });

    $('#btnSubmit').click(function() {
      $('#login-form').form('submit')
    });

    $("#btnClrExit").click(function(){
      $('#login-form').form('reset');
      $('.ui.error.message').html('');
      $('#msgBox').removeClass('success negative');
      $('#msgBox').addClass('hidden');
      $('#msgBox').fadeOut();
    });

  });
  </script>
  <script src="js/Login.js"></script>
</html>
