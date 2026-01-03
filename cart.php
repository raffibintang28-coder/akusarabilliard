<?php
session_start();

if(isset($_POST['add'])){
  $item = [
    'id' => $_POST['id'],
    'name' => $_POST['name'],
    'price' => $_POST['price'],
    'qty' => 1
  ];

  $_SESSION['cart'][] = $item;
}
?>

<h2>🛒 Keranjang Belanja</h2>
<a href="index.php">← Kembali belanja</a>
<hr>

<?php
$total = 0;

if(!empty($_SESSION['cart'])){
  foreach($_SESSION['cart'] as $i => $c){
    $subtotal = $c['price'] * $c['qty'];
    $total += $subtotal;
?>
<p>
<?php echo $c['name']; ?> |
Rp <?php echo number_format($c['price']); ?> |
<a href="remove_cart.php?i=<?php echo $i; ?>">Hapus</a>
</p>
<?php } ?>

<hr>
<b>Total: Rp <?php echo number_format($total); ?></b><br><br>
<a href="checkout.php">Lanjut ke Checkout</a>

<a href="checkout.php">Checkout</a>

<?php } else { ?>
<p>Keranjang masih kosong</p>
<?php } ?>

<div class="box">
   <!-- isi cart / checkout -->
</div>
