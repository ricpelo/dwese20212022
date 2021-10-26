<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar un empleado</title>
</head>
<body>
    <?php
    require 'auxiliar.php';

    $id = filtrar_trim('id', INPUT_GET);
    $error = [];

    $pdo = conectar();

    if (isset($id)) {
        if (!ctype_digit($id)) {
            // Error
            header('Location: index.php');
            return;
        }
        $sent = $pdo->prepare('SELECT *
                                 FROM emple
                                WHERE id = :id');
        $sent->execute([':id' => $id]);
        $fila = $sent->fetch(PDO::FETCH_ASSOC);

        if ($fila === false) {
            // Error
            header('Location: index.php');
            return;
        }
    }

    $nombre = filtrar_trim('nombre');
    $fecha_alt = filtrar_trim('fecha_alt');
    $salario = filtrar_trim('salario');
    $depart_id = filtrar_trim('depart_id');

    if (!isset($nombre, $fecha_alt, $salario, $depart_id)) {
        extract($fila);
    }

    mostrar_formulario(
        compact(
            'nombre',
            'fecha_alt',
            'salario',
            'depart_id'
        ),
        $error
    );
    ?>
</body>
</html>
