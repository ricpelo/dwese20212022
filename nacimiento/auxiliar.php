<?php

function prueba(int $a)
{
    return $a + 1;
}

function mostrar_errores(array $error): void
{
    foreach ($error as $err): ?>
        <p>Error: <?= $err ?></p>
    <?php
    endforeach;
}

function selected($a, $b)
{
    return ($a == $b) ? 'selected' : '';
}

function calcular_edad($fecha_nac)
{
    return (new DateTime())->diff(new DateTime($fecha_nac))->y;
}

function comprobar_parametros($par, &$error)
{
    $res = $par;

    if (!empty($_GET)) {
        if ($par == array_intersect_key($par, $_GET)) {
            $res = array_map('trim', $_GET);
        } else {
            $error[] = 'Los parámetros recibidos no son correctos.';
        }
    }

    return $res;
}

function comprobar_valores($par, &$error)
{
    extract($par);

    if ($nombre === '') {
        $error[] = 'El nombre es obligatorio.';
    }

    if ($apellidos === '') {
        $error[] = 'Los apellidos son obligatorios.';
    }

    if ($fecha_nac === '') {
        $error[] = 'La fecha es obligatoria.';
    } elseif (!comprobar_fecha($fecha_nac)) {
        $error[] = 'La fecha es incorrecta.';
    }
}

function comprobar_fecha($fecha)
{
    $ret = false;
    $fecha = explode('-', $fecha);

    if (count($fecha) == 3) {
        [$a, $m, $d] = $fecha;
        if (checkdate($m, $d, $a)) {
            $ret = true;
        }
    }

    return $ret;
}

function dibujar_formulario($par)
{
    extract($par);
    ?>
    <form action="" method="GET">
        <div>
            <label for="nombre">Nombre:</label>
            <input id="nombre" type="text" name="nombre" size="10"
                value="<?= $nombre ?>">
        </div>
        <div>
            <label for="apellidos">Apellidos:</label>
            <input id="apellidos" type="text" name="apellidos" size="10"
                value="<?= $apellidos ?>">
        </div>
        <div>
            <label for="fecha_nac">Fecha de nacimiento:</label>
            <input id="fecha_nac" type="date" name="fecha_nac" size="10"
                value="<?= $fecha_nac ?>">
        </div>
        <div>
            <button type="submit">Enviar</button>
        </div>
    </form>
    <?php
}

function primera_vez()
{
    return empty($_GET);
}
