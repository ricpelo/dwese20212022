<?php
session_start();

$id = filter_input(INPUT_GET, 'id');

foreach ($_SESSION['carrito'] as &$item) {
    if ($item['id'] === $id) {
        $item['cantidad']++;
        header('Location: index.php');
        return;
    }
}

$_SESSION['carrito'][] = ['id' => $id, 'cantidad' => 1];
header('Location: index.php');
