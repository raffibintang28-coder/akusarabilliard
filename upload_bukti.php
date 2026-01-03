<?php
session_start();
include 'config/koneksi.php';

if(!isset($_SESSION['user'])){
  header("location:login.php");
  exit;
}

$id = $_GET['id'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Upload Bukti Transfer</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="box">
<h2>Upload Bukti Transfer</h2>

<form method="post" enctype="multipart/form-data">
<input type="file" name="bukti" required>
<br><br>
<button class="btn" name="upload">Upload</button>
</form>

<?php
if(isset($_POST['upload'])){
  $file = $_FILES['bukti']['name'];
  $tmp  = $_FILES['bukti']['tmp_name'];

  $nama_baru = time().'_'.$file;
  move_uploaded_file($tmp, "uploads/bukti/".$nama_baru);

  mysqli_query($koneksi,"
    UPDATE orders 
    SET bukti='$nama_baru'
    WHERE id='$id'
  ");

  echo "<p style='color:green'>Upload berhasil. Tunggu verifikasi admin.</p>";
}
?>

<br>
<a href="riwayat.php">← Kembali</a>
</div>

</body>
</html>
