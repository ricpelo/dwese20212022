<?php

function exception_error_handler($severidad, $mensaje, $fichero, $línea)
{
    if (!(error_reporting() & $severidad)) {
        // Este código de error no está incluido en error_reporting
        return;
    }
    throw new ErrorException($mensaje, 0, $severidad, $fichero, $línea);
}
set_error_handler("exception_error_handler");

try {
    echo 1 / 0;
    echo "Hola";
} catch (Throwable $th) {
    echo "Caso general";
} catch (DivisionByZeroError $th) {
    echo "Se ha producido un error cuyo mensaje es " . $th->getMessage();
}
