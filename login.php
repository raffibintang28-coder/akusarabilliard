<?php
session_start();
include 'config/koneksi.php';

if(isset($_POST['login'])){
  $u = $_POST['username'];
  $p = $_POST['password'];

  $q = mysqli_query($koneksi,"SELECT * FROM users WHERE username='$u' AND password='$p' AND role='user'");
  if(mysqli_num_rows($q)>0){
    $_SESSION['user'] = [
    'username' => $username
];
    header("location:index.php");
  }
}
?>

<form method="post">
<h2>User Login</h2>
<input name="username" placeholder="Username">
<input name="password" type="password" placeholder="Password">
<button name="login">Login</button>
</form>
