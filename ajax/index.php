<?
define('NO_AGENT_CHECK', true);
define("STOP_STATISTICS", true);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
if (isset($_POST['md_ajax']) && $_POST['md_ajax'] == 'Y') {
    //return ajax web form
    if (isset($_POST['type']) && $_POST['type'] == "form" && isset($_POST['id'])) {

    }

}