<?php
session_start();

$i = $_GET['i'];
unset($_SESSION['cart'][$i]);

header("location:cart.php");
