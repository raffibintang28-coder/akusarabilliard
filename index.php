<?php
session_start();
include 'config/koneksi.php';
?>
<link rel="stylesheet" href="css/style.css">

<header>
  <div class="logo">AKUSARA BILLIARD STORE</div>
  <nav>
    <a href="index.php">Shop</a>
    <a href="cart.php">Cart</a>
    <a href="login.php">Login</a>
  </nav>
</header>

<section class="hero">
  <h1>Professional Billiard Equipment</h1>
  <p>Trusted by players worldwide</p>
</section>

<div class="container">
<div class="products">

<?php
$data = mysqli_query($koneksi,"SELECT * FROM products");
while($p=mysqli_fetch_array($data)){
?>
<div class="product">
  <img src="img/<?php echo $p['image']; ?>">
  <h3><?php echo $p['name']; ?></h3>
  <div class="price">Rp <?php echo number_format($p['price']); ?></div>

  <form method="post" action="cart.php">
    <input type="hidden" name="id" value="<?= $p['id']; ?>">
    <input type="hidden" name="name" value="<?= $p['name']; ?>">
    <input type="hidden" name="price" value="<?= $p['price']; ?>">
    <button class="btn" name="add">Add to Cart</button>
  </form>
</div>
<?php } ?>

</div>
</div>

<footer>
2026 Akusara Billiard Store
</footer>
