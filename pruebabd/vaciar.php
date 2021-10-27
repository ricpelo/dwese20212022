<?php

session_start();
$_SESSION['carrito'] = [];
header('Location: index.php');
