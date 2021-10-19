<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora</title>
</head>
<body>
    <?php
    require 'auxiliar.php';

    $error = [];

    $x = filtrar_numero('x', $error);
    $y = filtrar_numero('y', $error);
    $oper = filtrar_opciones('oper', OPER, $error);
    ?>

    <form action="" method="GET">
        <div>
            <label for="op1">Primer operando:</label>
            <input id="op1" type="text" name="x" size="10"
                   value="<?= $x ?>">
        </div>
        <div>
            <label for="op2">Segundo operando:</label>
            <input id="op2" type="text" name="y" size="10"
                   value="<?= $y ?>">
        </div>
        <div>
            <label for="op">Operación:</label>
            <select name="oper" id="op">
                <?php foreach (OPER as $op): ?>
                    <option value="<?= $op ?>" <?= selected($oper, $op) ?>>
                        <?= $op ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>
        <div>
            <button type="submit">Operar</button>
        </div>
    </form>

    <?php mostrar_errores($error) ?>

    <?php if (isset($x, $y, $oper)): ?>
        <?php if (empty($error)):
            $res = calcular($x, $y, $oper) ?>
            <p>El resultado es <?= $res ?></p>
        <?php endif ?>
    <?php endif ?>
</body>
</html>
