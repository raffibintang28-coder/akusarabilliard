<?php
session_start();
include 'config/koneksi.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// CEK LOGIN
if(!isset($_SESSION['user'])){
    header("location:login.php");
    exit;
}

$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Riwayat Pesanan</title>
<link rel="stylesheet" href="css/style.css">
<style>
table{width:100%;border-collapse:collapse;margin-top:20px;}
th,td{border:1px solid #ccc;padding:8px;text-align:center;}
th{background:#f4f4f4;}
.btn{padding:5px 10px;background:#333;color:#fff;text-decoration:none;border-radius:4px;}
.total{font-weight:bold;}
</style>
</head>
<body>

<div class="box">
<h2>🧾 Riwayat Pesanan Saya</h2>

<table>
<tr>
<th>No</th>
<th>Produk</th>
<th>Qty</th>
<th>Harga/item (Rp)</th>
<th>Total (Rp)</th>
<th>Status</th>
<th>Tanggal</th>
<th>Bukti Transfer</th>
</tr>

<table class="table-riwayat">

<?php
$no = 1;
$data = mysqli_query($koneksi,"
    SELECT * FROM orders
    WHERE user='$username'
    ORDER BY created_at DESC
");

if(!$data){
    echo "<tr><td colspan='8'>Query error: ".mysqli_error($koneksi)."</td></tr>";
}
else if(mysqli_num_rows($data) == 0){
    echo "<tr><td colspan='8'>Belum ada pesanan</td></tr>";
}
else{
    while($d = mysqli_fetch_assoc($data)){
        $qty = $d['qty'] ?? 1; // jika belum ada kolom qty, default 1
        $price = $d['price'] ?? 0; // jika belum ada kolom price, default 0
        $total = $qty * $price;
?>
<tr>
<td><?= $no++ ?></td>
<td><?= $d['product'] ?></td>
<td><?= $qty ?></td>
<td><?= number_format($price) ?></td>
<td><?= number_format($total) ?></td>
<td><?= $d['status'] ?></td>
<td><?= date('d-m-Y', strtotime($d['created_at'])) ?></td>
<td>
<?php if(empty($d['bukti'])){ ?>
<a href="upload_bukti.php?id=<?= $d['id'] ?>" class="btn">Upload Bukti</a>
<?php } else { ?>
<span style="color:green">Sudah Upload</span>
<?php } ?>
</td>
</tr>
<?php }} ?>
</table>

<br>
<a href="index.php" class="btn">← Kembali Belanja</a>
</div>

</body>
</html>
