<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insertar un nuevo empleado</title>
</head>
<body>
    <?php
    require 'auxiliar.php';

    $nombre = filtrar_trim('nombre');
    $fecha_alt = filtrar_trim('fecha_alt');
    $salario = filtrar_trim('salario');
    $depart_id = filtrar_trim('depart_id');

    $error = [];

    if (isset($nombre)) {
        if ($nombre === '') {
            $error['nombre'] = 'El nombre es obligatorio.';
        }
    }

    if (isset($salario)) {
        if (!is_numeric($salario)) {
            $error['salario'] = 'El salario debe ser un número.';
        }
    }

    $pdo = conectar();

    if (isset($depart_id)) {
        if (!ctype_digit($depart_id)) {
            $error['depart_id'] = 'El departamento no existe.';
        } else {
            $sent = $pdo->prepare('SELECT COUNT(*)
                                     FROM depart
                                    WHERE id = ?');
            $sent->execute([$depart_id]);
            if ($sent->fetchColumn() === 0) {
                $error['depart_id'] = 'El departamento no existe.';
            }
        }
    }

    if (isset($nombre, $fecha_alt, $salario, $depart_id)
        && empty($error)) {
        $sent = $pdo->prepare(
            'INSERT INTO emple (nombre, fecha_alt, salario, depart_id)
                VALUES (:nombre, :fecha_alt, :salario, :depart_id)'
        );
        if (!$sent->execute([
            ':nombre' => $nombre,
            ':fecha_alt' => $fecha_alt,
            ':salario' => $salario,
            ':depart_id' => $depart_id,
        ]) || $sent->rowCount() !== 1) {
            // Ha habido un problema
        }
        header('Location: index.php');
        return;
    }
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
                <button type="submit">Insertar</button>
                <button><a href="index.php">Volver</a></button>
            </div>
        </form>
    </div>
</body>
</html>
