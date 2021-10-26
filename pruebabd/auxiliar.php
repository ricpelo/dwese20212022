<?php

function conectar()
{
    return new PDO(
        'pgsql:host=localhost;dbname=prueba',
        'prueba',
        'prueba'
    );
}

function filtrar_trim($nombre)
{
    return filter_input(INPUT_POST, $nombre, FILTER_CALLBACK,
                        ['options' => 'trim']);
}

function mostrar_error($error, $par)
{
    if (isset($error[$par])) { ?>
        <span style="color: red"><?= $error[$par] ?></span><?php
    }
}
