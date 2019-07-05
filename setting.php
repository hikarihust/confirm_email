<?php
  include_once 'autoload.php';
  
  if(empty(Session::get('email'))) URL::redirect("login.php"); 

  $email = Session::get('email');
  $data = json_decode(file_get_contents(DATA_USER), TRUE);
  $userInfo = $data[$email];

  $msg = '';
  $type = '';

  if (!empty($_POST['submit'])) {
    $userInfo['login_email_confirm'] = $_POST['setting'];
    $data[$email] = $userInfo;

    file_put_contents(DATA_USER, json_encode($data));
    $msg = 'Update successful';
    $type = 'success';
  }
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
        <div class="col-md-6">
          <div class="panel panel-primary">
              <div class="panel-heading">Setting Email</div>
              <div class="panel-body">
                <?php echo HTMLHelper::showMessage($msg, $type)?>
                <form action="" method="POST">
                  <div class="form-group">
                    <label for="Setting">Xác nhận đăng nhập qua email</label>
                    <div class="radio">
                      <div class="row">
                        <div class="col-md-2">
                          <label><input <?php echo ($userInfo["login_email_confirm"] == "on" ? 'checked' : ''); ?> type="radio" name="setting" id="optionsRadios0" value="on">Yes</label>
                        </div>
                        <div class="col-md-2">
                          <label><input  <?php echo ( ($userInfo["login_email_confirm"] == "off" ) ? 'checked' : ''); ?> type="radio" name="setting" id="optionsRadios1" value="off">No</label>
                        </div>
                      </div>
                    </div>
                  </div>
                  <input type="submit" name="submit" class="btn btn-success" value="Submit">
                </form>
              </div>
          </div>
        </div>
      </div>
    </div>
    <?php include_once 'html/script.php'; ?>
  </body>
</html>