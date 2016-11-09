<?
use \Bitrix\Main\Loader;

/*
* Конфигурация сайта
* */
$configuration = \Bitrix\Main\Config\Configuration::getInstance();

$configuration->add('newsIBlock', 14);
$configuration->add('w170h128crPlugId', '1104');

Loader::includeModule('itconstruct.uncachedarea');

if(Loader::includeModule('itconstruct.resizer'))
{
    itc\Resizer::addPreset(
        'w170h128cr', array(
            'mode'   => 'crop',
            'width'  => 170,
            'height' => 128,
            'type'   => 'jpg'
        )
    );
}
/**
 * Универсальная функция обрезки текста в том числе и формата html
 *
 * @param        $strText
 * @param        $intLen
 * @param string $endStr
 * @param string $type
 * @param string $option
 *
 * @return mixed|string
 */
function truncateStr($strText, $intLen, $endStr = "", $type = "text", $option = "")
{
    switch($type)
    {
        case "html":
            switch($option)
            {
                case 'fp':
                    $obParser = new CTextParser;

                    $symbols = strip_tags($strText);
                    $symbols_len = strlen($symbols);

                    if($symbols_len < strlen($strText))
                    {
                        $strip_text = $obParser->strip_words($strText, $intLen);

                        if($symbols_len > $intLen)
                            $strip_text = $strip_text.$endStr;

                        $final_text = $obParser->closetags($strip_text);

                        preg_match('|<p>(.*)</p>|Uis', $final_text, $arFinalText);

                        $final_text = current($arFinalText);
                    }
                    elseif($symbols_len > $strText)
                    {
                        $final_text = substr($strText, 0, $intLen).$endStr;
                        preg_match('|<p>(.*)</p>|Uis', $final_text, $arFinalText);

                        $final_text = current($arFinalText);
                    }
                    else
                    {
                        $final_text = $strText;
                    }
                    break;
                default:
                    $obParser = new CTextParser;

                    $symbols = strip_tags($strText);
                    $symbols_len = strlen($symbols);

                    if($symbols_len < strlen($strText))
                    {
                        $strip_text = $obParser->strip_words($strText, $intLen);

                        if($symbols_len > $intLen)
                            $strip_text = $strip_text.$endStr;

                        $final_text = $obParser->closetags($strip_text);
                    }
                    elseif($symbols_len > $strText)
                        $final_text = substr($strText, 0, $intLen).$endStr;
                    else
                        $final_text = $strText;
                    break;
            }
            return $final_text;
            break;
        case "text":
            if(strlen($strText) > $intLen)
                return rtrim(substr($strText, 0, $intLen), ".").$endStr;
            else
                return $strText;
            break;
    }
    return false;
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
