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

    $nombre = (isset($_GET['nombre'])) ? trim($_GET['nombre']) : null;
    $denominacion = (isset($_GET['denominacion'])) ? trim($_GET['denominacion']) : null;

    $pdo = conectar();

    $query = "FROM emple e
         LEFT JOIN depart d
                ON e.depart_id = d.id
             WHERE preparar(nombre) LIKE preparar('%$nombre%')
               AND preparar(denominacion) LIKE preparar('%$denominacion%')";
    $sent = $pdo->query("SELECT COUNT(*) $query");
    $count = $sent->fetchColumn();
    $sent = $pdo->query("SELECT * $query");
    ?>
    <div>
        <form action="" method="GET">
            <div>
                <label for="nombre">Nombre: </label>
                <input id="nombre" type="text" name="nombre"
                       value="<?= $nombre ?>">
                <label for="denominacion">Departamento: </label>
                <input id="denominacion" type="text" name="denominacion"
                       value="<?= $denominacion ?>">
            </div>
            <div>
                <button type="submit">Filtrar</button>
            </div>
        </form>
    </div>

    <div>
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
    </div>
</body>
</html>
