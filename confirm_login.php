<?php

include_once 'autoload.php';

if (!empty(Session::get('email'))) URL::redirect('setting.php');

$code = isset($_GET['code']) ? $_GET['code'] : '';
$time = isset($_GET['time']) ? $_GET['time'] : '';
$email = isset($_GET['email']) ? $_GET['email'] : '';

if ($time + EXPIRED_TIME < time()) {
  echo '<h3>Link hết hạn!! Vui lòng đăng nhập lại <a href="login.php">tại đây</a></h3>';
} else {
  if ($code === md5(SECRET_KEY . $time . $email)) {
    $data = json_decode(file_get_contents(DATA_USER), TRUE);
    $userInfo = (isset($data[$email]) && !empty($data[$email])) ? $data[$email] : null;

    if (isset($userInfo['email']) && !empty($userInfo['email'])) {
      if ($userInfo['status'] === 'active') {
        Session::set('email', $email);
        URL::redirect('setting.php');
      }
    }
  } 
  echo '<h3>Thất bại!! Vui lòng đăng nhập lại <a href="login.php">tại đây</a></h3>';
}