<?php 
require_once 'app/core/Core.php';
require_once 'app/controller/HomeController.php';
require_once 'app/controller/ErroController.php';
require_once 'app/Model/Postagem.php';
require_once 'app/lib/database/Connection.php';
require_once 'vendor/autoload.php';

$template = file_get_contents('app/template/estrutura.html');

ob_start();
$core = new Core;
$core->start($_GET);

$saida = ob_get_contents();
ob_end_clean();

$templateP = str_replace('{{area_dinamica}}', $saida, $template);
echo $templateP;