<?
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
	define('NO_AGENT_CHECK', true);
	define("STOP_STATISTICS", true);
	require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');

	if (false && CModule::IncludeModule("form"))
	{
		foreach ($_REQUEST as $key => $value) {
			$_REQUEST[$key] = iconv('utf-8', SITE_CHARSET, $_REQUEST[$key]);
			$_POST[$key] = $_REQUEST[$key];
		}

		$APPLICATION->IncludeComponent(
			"bitrix:form.result.new",
			"ajax_form",
			array(
				"WEB_FORM_ID"            => "#WEB_FORM_CONTACT_ID#",
				"IGNORE_CUSTOM_TEMPLATE" => "N",
				"USE_EXTENDED_ERRORS"    => "N",
				"SEF_MODE"               => "N",
				"SEF_FOLDER"             => "/",
				"CACHE_TYPE"             => "A",
				"CACHE_TIME"             => "3600",
				"LIST_URL"               => "",
				"EDIT_URL"               => "",
				"SUCCESS_URL"            => "",
				"CHAIN_ITEM_TEXT"        => "",
				"CHAIN_ITEM_LINK"        => "",
				"VARIABLE_ALIASES"       => array(
					"WEB_FORM_ID" => "WEB_FORM_ID",
					"RESULT_ID"   => "RESULT_ID",
				)
			),
			false
		);
	}
	else
	{
		?>
		<div class="portfolio-ajax-modal ajax-modal-transparent">
		<div class="clearfix"><?
			$APPLICATION->IncludeFile(
				SITE_DIR . "include/contact/feedback.php",
				Array(),
				Array("MODE" => "html")
			);
			?></div></div><?
	}
}
?>