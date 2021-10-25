<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empleados</title>
</head>
<body>
    <?php
    require 'auxiliar.php';


    $nombre = (isset($_GET['nombre'])) ? trim($_GET['nombre']) : null;
    $denominacion = (isset($_GET['denominacion'])) ? trim($_GET['denominacion']) : null;
    $salario = (isset($_GET['salario'])) ? trim($_GET['salario']) : null;

    $query = "FROM emple e LEFT JOIN depart d ON e.depart_id = d.id";

    $where = [];
    $execute = [];

    if (isset($nombre) && $nombre !== '') {
        $where[] = 'preparar(nombre) LIKE preparar(:nombre)';
        $execute[':nombre'] = "%$nombre%";
    }

    if (isset($denominacion) && $denominacion !== '') {
        $where[] = 'preparar(denominacion) LIKE preparar(:denominacion)';
        $execute[':denominacion'] = "%$denominacion%";
    }

    if (isset($salario) && $salario !== '') {
        if (is_numeric($salario)) {
            $where[] = 'salario = :salario';
            $execute[':salario'] = $salario;
        }
    }

    if (!empty($where)) {
        $query .= ' WHERE ' . implode(' AND ', $where);
    }

    $pdo = conectar();
    $sent = $pdo->prepare("SELECT COUNT(*) $query");
    $sent->execute($execute);
    $count = $sent->fetchColumn();
    $sent = $pdo->prepare("SELECT e.*,
                                  d.denominacion, d.localidad $query");
    $sent->execute($execute);
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
                <label for="salario">Salario: </label>
                <input id="salario" type="text" name="salario"
                       value="<?= $salario ?>">
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
                <th>Acciones</th>
            </thead>
            <tbody>
                <?php foreach ($sent as $fila):
                    // echo "<pre>"; print_r($fila); echo "</pre>";
                    ?>
                    <tr>
                        <td><?= $fila['nombre'] ?></td>
                        <td><?= $fila['fecha_alt'] ?></td>
                        <td><?= $fila['salario'] ?></td>
                        <td><?= $fila['denominacion'] ?></td>
                        <td><?= $fila['localidad'] ?></td>
                        <td>
                            <form action="borrar.php" method="GET">
                                <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                <button type="submit">Borrar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
            <tfoot>
                <td colspan="6">
                    Total de filas: <?= $count ?>
                </td>
            </tfoot>
        </table>
    </div>
</body>
</html>
