<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrar un empleado</title>
</head>
<body>
    <?php
    require 'auxiliar.php';

    if (isset($_POST['id'])) {
        $id = trim($_POST['id']);

        if (ctype_digit($id)) {
            $pdo = conectar();
            $sent = $pdo->prepare('DELETE
                                    FROM emple
                                    WHERE id = :id');
            if ($sent->execute([':id' => $id])
                && $sent->rowCount() === 1) {
                // Bien
            } else {
                // Mal
            }
            header('Location: index.php');
            return;
        }
    } elseif (isset($_GET['id'])) {
        $id = trim($_GET['id']);
    } else {
        header('Location: index.php');
        return;
    }
    ?>
    <h3>¿Seguro que desea borrar el empleado?</h3>
    <form action="" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        <button type="submit">Sí</button>
        <button><a href="index.php">No</a></button>
    </form>
</body>
</html>
