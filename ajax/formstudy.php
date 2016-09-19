<?
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

	require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

	global $USER;

	if ($USER->isAdmin() ) {
		require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
	} else {
		LocalRedirect(SITE_DIR);
		die();
	}

}
	define('NO_AGENT_CHECK', true);
	define("STOP_STATISTICS", true);
	require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

	?>
	<?$APPLICATION->IncludeComponent(
	"bitrix:iblock.element.add.form", 
	"popup", 
	array(
		"COMPONENT_TEMPLATE" => "popup",
		"IBLOCK_TYPE" => "md_info_s1",
		"IBLOCK_ID" => "36",
		"STATUS_NEW" => "N",
		"LIST_URL" => "",
		"USE_CAPTCHA" => "N",
		"USER_MESSAGE_EDIT" => "Сохранено",
		"USER_MESSAGE_ADD" => "Ваша заявка принята. Скоро наш менеджер свяжется с Вами.",
		"DEFAULT_INPUT_SIZE" => "30",
		"RESIZE_IMAGES" => "Y",
		"PROPERTY_CODES" => array(
			0 => "IBLOCK_SECTION",
			1 => "NAME",
			2 => "153",
			3 => "157",
			4 => "154",
			5 => "155",
			6 => "152",
			7 => "147",
			8 => "148",
			9 => "149",
			10 => "150",
			11 => "151",
		),
		"PROPERTY_CODES_REQUIRED" => array(
			0 => "153",
			1 => "157",
			2 => "152",
		),
		"SECTION_ID" => "#FORM_SECTION_ID#",
		"GROUPS" => array(
			0 => "2",
		),
		"STATUS" => "INACTIVE",
		"ELEMENT_ASSOC" => "CREATED_BY",
		"MAX_USER_ENTRIES" => "100000",
		"MAX_LEVELS" => "100000",
		"LEVEL_LAST" => "N",
		"MAX_FILE_SIZE" => "0",
		"PREVIEW_TEXT_USE_HTML_EDITOR" => "N",
		"DETAIL_TEXT_USE_HTML_EDITOR" => "N",
		"SEF_MODE" => "N",
		"CUSTOM_TITLE_NAME" => "",
		"CUSTOM_TITLE_TAGS" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_FROM" => "",
		"CUSTOM_TITLE_DATE_ACTIVE_TO" => "",
		"CUSTOM_TITLE_IBLOCK_SECTION" => "",
		"CUSTOM_TITLE_PREVIEW_TEXT" => "",
		"CUSTOM_TITLE_PREVIEW_PICTURE" => "",
		"CUSTOM_TITLE_DETAIL_TEXT" => "",
		"CUSTOM_TITLE_DETAIL_PICTURE" => "",
		"FORM_TITLE" => "Забронировать курс"
	),
	false
);?><?
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || empty($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
	global $USER;
	if ($USER->isAdmin() ) {
		require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
	}

}