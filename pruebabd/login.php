<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
    require 'auxiliar.php';

    $username = filtrar_trim('username');
    $password = filtrar_trim('password');

    $error = [];

    if (isset($username, $password)) {
        $pdo = conectar();

        $sent = $pdo->prepare('SELECT *
                                FROM usuarios
                                WHERE username = :username');
        $sent->execute([':username' => $username]);
        $fila = $sent->fetch();

        if ($fila !== false
        && password_verify($password, $fila['password'])) {
            $_SESSION['login'] = [
                'id' => $fila['id'],
                'username' => $fila['username'],
            ];
            header('Location: index.php');
            return;
        } else {
            $error[] = "Nombre de usuario o contraseña incorrectos.";
        }
    }
    ?>

    <?php cabecera() ?>

    <?php foreach ($error as $err): ?>
        <h3 style="color: red"><?= $err ?></h3>
    <?php endforeach ?>

    <form action="" method="POST">
        <div>
            <label for="username">Nombre de usuario:</label>
            <input id="username" name="username" type="text"
                   value="<?= $username ?>">
        </div>
        <div>
            <label for="password">Contraseña:</label>
            <input id="password" name="password" type="password">
        </div>
        <div>
            <button type="submit">Login</button>
        </div>
    </form>
</body>
</html>
