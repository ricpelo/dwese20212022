<?php

use Mpdf\Mpdf;

require 'vendor/autoload.php';

$mpdf = new Mpdf();
$html = <<<EOT
    <table border="1">
        <thead>
            <th>Columna</th>
        </thead>
        <tbody>
            <tr>
                <td>Hola</td>
            </tr>
        </tbody>
    </table>
EOT;
$mpdf->WriteHTML($html);
$mpdf->Output();
