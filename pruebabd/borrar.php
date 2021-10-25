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
    $id = (isset($_GET['id'])) ? trim($_GET['id']) : null;
    ?>
    <h3>¿Seguro que desea borrar el empleado?</h3>
    <form action="index.php" method="POST">
        <input type="hidden" name="id" value="<?= $id ?>">
        <button type="submit">Sí</button>
        <button><a href="index.php">No</a></button>
    </form>
</body>
</html>
