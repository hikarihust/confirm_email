<?php
  include_once 'autoload.php';
  if(!empty(Session::get('email')))  URL::redirect("setting.php"); 
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include_once 'html/head.php'; ?>
  </head>
  <body>
    <?php include_once 'html/nav.php'; ?>
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-primary">
            <div class="panel-heading">Setting Email</div>
            <div class="panel-body">
              <?php echo HTMLHelper::showMessage("Chúng tôi đã gửi liên kết để đăng nhập. Bấm vào nút bên trong email là xong. Kiểm tra cả hộp thư rác nếu bạn không tìm thấy email trong hộp thư chính.
                ", "success")?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include_once 'html/script.php'; ?>
  </body>
</html>