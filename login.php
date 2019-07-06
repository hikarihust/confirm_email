<?php
  include_once 'autoload.php';
  
  $error = "";
  
  if(!empty(Session::get('email')))  URL::redirect("setting.php");
  if (!empty($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    if (!empty($email) && !empty($password)) {
      $data = json_decode(file_get_contents(DATA_USER), TRUE);
        $userInfo = $data[$email];
        if (($userInfo['email'] === $email) && ($userInfo['password'] === $password)) {
          if ($userInfo['login_email_confirm'] === 'on') {
            $userInfo['login_key'] = substr(md5(SECRET_KEY . time()), 1, 10);
            $userInfo['login_time'] = time();

            $data[$email] = $userInfo;
            file_put_contents(DATA_USER, json_encode($data));

            $linkConfirm = Utils::createLinkConfirmLogin($userInfo);
            Mail::sendMail($userInfo['email'], $userInfo['fullName'], $linkConfirm);
      
            URL::redirect('process.php');
          } else {
            Session::set('email', $email);
            URL::redirect('setting.php');
          }
        } else {
          $error = 'Login is failed';
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
                  <div class="form-group">
                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
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