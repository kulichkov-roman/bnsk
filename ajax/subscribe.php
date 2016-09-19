<?
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {

    define('NO_AGENT_CHECK', true);
    define("STOP_STATISTICS", true);
    require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');
	//echo 'Вы <strong>успешно</strong> подписались!.';
	$APPLICATION->IncludeComponent(
		"boxsol:subscribe.simple.noauth", 
		"ajax_simple", 
		array(
			"SHOW_HIDDEN" => "N",
			"AJAX_MODE" => "N",
			"AJAX_OPTION_JUMP" => "N",
			"AJAX_OPTION_STYLE" => "Y",
			"AJAX_OPTION_HISTORY" => "N",
			"CACHE_TYPE" => "A",
			"CACHE_TIME" => "3600",
			"SET_TITLE" => "N",
			"AJAX_OPTION_ADDITIONAL" => ""
		),
		false
	);

}?>