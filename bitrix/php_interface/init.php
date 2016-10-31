<?
use \Bitrix\Main\Loader;

/*
* Конфигурация сайта
* */
$configuration = \Bitrix\Main\Config\Configuration::getInstance();

$configuration->add('newsIBlock', 14);
$configuration->add('w170h128crPlugId', '1104');

Loader::includeModule('itconstruct.uncachedarea');

if(Loader::includeModule('itconstruct.resizer')) {


    itc\Resizer::addPreset(
        'w170h128cr', array(
            'mode'   => 'crop',
            'width'  => 170,
            'height' => 128,
            'type'   => 'jpg'
        )
    );
}

/*
 * Установка LastModified
 * */
$LastModified_unix = strtotime(date("D, d M Y H:i:s", filectime($_SERVER['SCRIPT_FILENAME'])));
$LastModified = gmdate("D, d M Y H:i:s \G\M\T", $LastModified_unix);
$IfModifiedSince = false;


if (isset($_ENV['HTTP_IF_MODIFIED_SINCE']))
    $IfModifiedSince = strtotime(substr($_ENV['HTTP_IF_MODIFIED_SINCE'], 5));


if (isset($_SERVER['HTTP_IF_MODIFIED_SINCE']))
    $IfModifiedSince = strtotime(substr($_SERVER['HTTP_IF_MODIFIED_SINCE'], 5));


if ($IfModifiedSince && $IfModifiedSince >= $LastModified_unix) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 304 Not Modified');
    exit;
}


header('Last-Modified: '. $LastModified);
?>
