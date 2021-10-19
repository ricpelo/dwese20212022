<?php declare(strict_types=1) ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fechas</title>
</head>
<body>
    <?php
    require 'auxiliar.php';

    echo prueba("1");

    $error = [];

    const PAR = [
        'nombre' => '',
        'apellidos' => '',
        'fecha_nac' => '',
    ];

    $par = comprobar_parametros(PAR, $error);

    if (!primera_vez()) {
        comprobar_valores($par, $error);
    }

    dibujar_formulario($par);
    mostrar_errores($error);

    if (!primera_vez() && empty($error)): ?>
        <p>La edad es: <?= calcular_edad($par['fecha_nac']) ?></p>
    <?php
    endif ?>
</body>
</html>
