<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require 'auxiliar.php';

    $pdo = conectar();
    $sent = $pdo->query('SELECT COUNT(*)
                           FROM emple e
                      LEFT JOIN depart d
                             ON e.depart_id = d.id');
    $count = $sent->fetchColumn();
    $sent = $pdo->query('SELECT *
                           FROM emple e
                      LEFT JOIN depart d
                             ON e.depart_id = d.id');
    ?>

    <table border="1">
        <thead>
            <th>Nombre</th>
            <th>Fecha de alta</th>
            <th>Salario</th>
            <th>Departamento</th>
            <th>Localidad</th>
        </thead>
        <tbody>
            <?php foreach ($sent as $fila): ?>
                <tr>
                    <td><?= $fila['nombre'] ?></td>
                    <td><?= $fila['fecha_alt'] ?></td>
                    <td><?= $fila['salario'] ?></td>
                    <td><?= $fila['denominacion'] ?></td>
                    <td><?= $fila['localidad'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
        <tfoot>
            <td colspan="5">
                Total de filas: <?= $count ?>
            </td>
        </tfoot>
    </table>
</body>
</html>
