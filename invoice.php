<?php
session_start();
include 'config/koneksi.php';

$user = $_SESSION['user'];

$data = mysqli_query($koneksi,"
  SELECT * FROM orders 
  WHERE user='$user' 
  ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Invoice</title>
<link rel="stylesheet" href="css/style.css">
</head>
<body>

<div class="box">
<h2>INVOICE PEMBAYARAN</h2>
<hr>

<p><b>Customer:</b> <?= $user; ?></p>
<p><b>Tanggal:</b> <?= date("d-m-Y"); ?></p>

<table>
<tr>
  <th>Produk</th>
  <th>Pembayaran</th>
  <th>Status</th>
</tr>

<?php 
$total = 0;
while($o=mysqli_fetch_array($data)){ 
?>
<tr>
  <td><?= $o['product']; ?></td>
  <td><?= $o['payment']; ?></td>
  <td><?= $o['status']; ?></td>
</tr>
<?php } ?>
</table>

<br>

<p><b>Total:</b> Sesuai checkout</p>

<br>

<button class="btn" onclick="window.print()">🖨 Print Invoice</button>
<a href="index.php" class="btn">Kembali ke Shop</a>

</div>

</body>
</html>
