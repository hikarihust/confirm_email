<?php
  include_once 'autoload.php';
  
  if(empty(Session::get('email'))) URL::redirect("login.php"); 

  $email = Session::get('email');
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
                <?php echo HTMLHelper::showMessage($email, 'success')?>
              </div>
          </div>
        </div>
      </div>
    </div>
    <?php include_once 'html/script.php'; ?>
  </body>
</html>