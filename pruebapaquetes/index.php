<?php

/**
 * Genera un PDF.
 *
 * @author    Ricardo Pérez
 * @copyright 2021 Ricardo Pérez <ricardo@iesdonana.org>
 * @license   GPL-3 https://www.gnu.org/licenses/gpl-3.0.en.html
 */

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
