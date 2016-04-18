<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();


use \Bitrix\Main\Config\Option;
CModule::IncludeModule("boxsol.cosmos");

if ($arParams["IBLOCK_ID"] != Option::get("boxsol.cosmos", "feedback_iblock_id", "", SITE_ID)) {
	Option::set("boxsol.cosmos", "feedback_iblock_id", $arParams["IBLOCK_ID"], SITE_ID);
}
if ($arParams["EMAIL_TO"] != Option::get("boxsol.cosmos", "email_feedback_section_id_" . $arParams["SECTION_ID"], "", SITE_ID)) {
	Option::set("boxsol.cosmos", "email_feedback_section_id_" . $arParams["SECTION_ID"], $arParams["EMAIL_TO"], SITE_ID);
}

foreach ($arResult["PROPERTY_LIST_FULL"] as $keyProp => $arProp) {
	if ($arProp["PROPERTY_TYPE"] == "E") {

		$arSelect = Array("ID", "NAME", "CODE");
		$arFilter = Array("IBLOCK_ID"=>IntVal($arProp["LINK_IBLOCK_ID"]), "ACTIVE_DATE"=>"Y", "ACTIVE"=>"Y");
		$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>100), $arSelect);
		while($ob = $res->GetNextElement())
		{
			$itemToAdd = array();
			$arFields = $ob->GetFields();
			$itemToAdd["ID"] = $arFields["ID"]; 
			$itemToAdd["VALUE"] = $arFields["NAME"];
			if ($arFields["CODE"] == $_GET["ELEMENT_CODE"]) {
				$itemToAdd["DEF"] = "Y";
			}
			$arResult["PROPERTY_LIST_FULL"][$keyProp]["ENUM"][$itemToAdd["ID"]] = $itemToAdd;
			$arResult["PROPERTY_LIST_FULL"][$keyProp]["PROPERTY_TYPE"] = "L";
			$arResult["PROPERTY_LIST_FULL"][$keyProp]["MULTIPLE"] = "Y";
			$arResult["PROPERTY_LIST_FULL"][$keyProp]["PROPERTY_TYPE_OLD"] = "E";
		}
	}

	if (0 === strpos(strtolower($arProp["CODE"]), 'utm')) {
		$arResult["PROPERTY_LIST_FULL"][$keyProp]["DEFAULT_VALUE"] = htmlspecialcharsbx($_COOKIE[strtolower($arProp["CODE"])]);
	}

}