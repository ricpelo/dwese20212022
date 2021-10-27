<?php
setcookie('aceptar_banner', '1', time() + 3600 * 24 * 30);
header('Location: index.php');
