<?php
session_start();
include 'config/koneksi.php';

if(isset($_POST['login'])){
  $u = $_POST['username'];
  $p = $_POST['password'];

  $q = mysqli_query($koneksi,"SELECT * FROM users WHERE username='$u' AND password='$p' AND role='admin'");
  if(mysqli_num_rows($q)>0){
    $_SESSION['admin'] = [
    'username' => $username
];
    header("location:admin/dashboard.php");
  }
}
?>

<form method="post">
<h2>Admin Login</h2>
<input name="username">
<input name="password" type="password">
<button name="login">Login Admin</button>
</form>
