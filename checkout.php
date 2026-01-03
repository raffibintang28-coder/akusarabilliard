<?php
session_start();
include 'config/koneksi.php';

if(empty($_SESSION['cart'])){
  header("location:index.php");
  exit;
}

$total = 0;
foreach($_SESSION['cart'] as $c){
  $total += $c['price'] * $c['qty'];
}

if(isset($_POST['order'])){
  foreach($_SESSION['cart'] as $c){
    mysqli_query($koneksi,"INSERT INTO orders VALUES(
      NULL,
      '".$_SESSION['user']."',
      '".$c['name']."',
      '".$_POST['payment']."',
      '".$_POST['address']."',
      'Pending'
    )");
  }
  unset($_SESSION['cart']);
  header("location:invoice.php");
exit;
}
?>

<h2>Checkout</h2>

<h3>Ringkasan Belanja</h3>
<ul>
<?php foreach($_SESSION['cart'] as $c){ ?>
  <li><?= $c['name']; ?> - Rp <?= number_format($c['price']); ?></li>
<?php } ?>
</ul>

<b>Total: Rp <?= number_format($total); ?></b>

<hr>

<form method="post">
<label>Alamat Lengkap</label><br>
<textarea name="address" required></textarea><br><br>

<label>Metode Pembayaran</label><br>
<input type="radio" name="payment" value="Bank Transfer" required> Bank Transfer<br>
<input type="radio" name="payment" value="QRIS"> QRIS<br><br>

<div style="border:1px solid #ccc; padding:10px; width:300px;">
<b>Info Pembayaran</b><br>
Bank Transfer: BCA 123456789<br>
Atas Nama: AKUSARA BILLIARD STORE<br><br>
Bank Transfer: BRI 123456789<br>
Atas Nama: AKUSARA BILLIARD STORE<br><br>
<img src="img/qris.jpg" width="150">
</div><br>

<button name="order">Confirm & Pay</button>
</form>

<div class="box">
   <!-- isi cart / checkout -->
</div>
