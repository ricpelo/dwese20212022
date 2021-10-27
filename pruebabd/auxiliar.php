<?php

function conectar()
{
    return new PDO(
        'pgsql:host=localhost;dbname=prueba',
        'prueba',
        'prueba'
    );
}

function filtrar_trim($nombre, $metodo = INPUT_POST)
{
    return filter_input($metodo, $nombre, FILTER_CALLBACK,
                        ['options' => 'trim']);
}

function mostrar_error($error, $par)
{
    if (isset($error[$par])) { ?>
        <span style="color: red"><?= $error[$par] ?></span><?php
    }
}

function mostrar_formulario(array $params, $error, $update = false)
{
    extract($params);
    ?>
    <div>
        <form action="" method="POST">
            <div>
                <label for="nombre">Nombre:</label>
                <input id="nombre" name="nombre" type="text"
                    value="<?= $nombre ?>">
                <?php mostrar_error($error, 'nombre') ?>
            </div>
            <div>
                <label for="fecha_alt">Fecha de alta:</label>
                <input id="fecha_alt" name="fecha_alt" type="text"
                    value="<?= $fecha_alt ?>">
                <?php mostrar_error($error, 'fecha_alt') ?>
            </div>
            <div>
                <label for="salario">Salario:</label>
                <input id="salario" name="salario" type="text"
                    value="<?= $salario ?>">
                <?php mostrar_error($error, 'salario') ?>
            </div>
            <div>
                <label for="depart_id">Departamento:</label>
                <input id="depart_id" name="depart_id" type="text"
                    value="<?= $depart_id ?>">
                <?php mostrar_error($error, 'depart_id') ?>
            </div>
            <div>
                <button type="submit">
                    <?= ($update) ? 'Modificar' : 'Insertar' ?>
                </button>
                <button><a href="index.php">Volver</a></button>
            </div>
        </form>
    </div><?php
}

function comprobar_cookie()
{
    return !isset($_COOKIE['aceptar_banner']);
}
