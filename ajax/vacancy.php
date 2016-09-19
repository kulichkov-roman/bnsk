<?
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    define('NO_AGENT_CHECK', true);
    define("STOP_STATISTICS", true);
    require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
    foreach ($_REQUEST as $key => $value) {
        $_REQUEST[$key] = iconv('utf-8', SITE_CHARSET, $_REQUEST[$key]);
    }

    $APPLICATION->IncludeComponent(
        "bitrix:form.result.new", 
        "ajax_form", 
        array(
            "WEB_FORM_ID" => "#WEB_FORM_VACANCY_ID#",
            "IGNORE_CUSTOM_TEMPLATE" => "N",
            "USE_EXTENDED_ERRORS" => "N",
            "SEF_MODE" => "N",
            "SEF_FOLDER" => "/company/",
            "CACHE_TYPE" => "A",
            "CACHE_TIME" => "3600",
            "LIST_URL" => "",
            "EDIT_URL" => "",
            "SUCCESS_URL" => "",
            "CHAIN_ITEM_TEXT" => "",
            "CHAIN_ITEM_LINK" => "",
            "VARIABLE_ALIASES" => array(
                "WEB_FORM_ID" => "WEB_FORM_ID",
                "RESULT_ID" => "RESULT_ID",
            )
        ),
        false
    );
}
?>