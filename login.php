<?php
  include_once 'autoload.php';
  
  $error = "";
  
  if(!empty(Session::get('email')))  URL::redirect("setting.php");
  if (!empty($_POST['submit'])) {
    $email = $_POST['email'];

    if (!empty($email)) {
      $data = json_decode(file_get_contents(DATA_USER), TRUE);
        $userInfo = (isset($data[$email]) && !empty($data[$email])) ? $data[$email] : null;
        if (isset($userInfo['email']) && !empty($userInfo['email'])) {
          $userInfo['login_time'] = time();
          $userInfo['login_key'] = md5(SECRET_KEY . $userInfo['login_time'] . $userInfo['email']);
          $linkConfirm = Utils::createLinkConfirmLogin($userInfo);
          Mail::sendMail($userInfo['email'], $userInfo['fullName'], $linkConfirm);
    
          URL::redirect('process.php');
        } else {
          $error = 'Email này không tồn tại';
        }
    } else {
      $error = 'Please enter full information';
    }
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
      <h1 class="text-center">Login</h1>
      <div class="col-md-12">
        <div class="modal-dialog" style="margin-bottom:0">
          <div class="modal-content">
            <div class="panel-heading">
              <h3 class="panel-title">Sign In</h3>
            </div>
            <div class="panel-body">
              <?php echo HTMLHelper::showMessage($error); ?>
              <form action="" method="POST" role="form">
                <fieldset>
                  <div class="form-group">
                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
                  </div>
                  <input name="submit" type="submit" value="Login" class="btn btn-primary">
                </fieldset>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php include_once 'html/script.php'; ?>
  </body>
</html>