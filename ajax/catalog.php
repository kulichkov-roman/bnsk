<?
if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
{
    define('NO_AGENT_CHECK', true);
    define("STOP_STATISTICS", true);
    require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
?>
    <?if (COption::GetOptionString("boxsol.cosmos", 'show_element_popup', 'N') == 'Y'):?>
        <div class="portfolio-ajax-modal">
            <div class="modal-padding clearfix">
    <?else:?>
        <div class="portfolio-ajax-modal ajax-modal-max-450 ajax-modal-transparent">
            <div class="clearfix">
    <?endif;?>
                 <?if (COption::GetOptionString("boxsol.cosmos", 'show_element_popup', 'N') == 'Y'):?>
                    <div class="col_half center hidden-sm">
                        <?$elementId = $APPLICATION->IncludeComponent(
                            "bitrix:catalog.element",
                            "ajax_zakaz",
                            array(
                                //"IBLOCK_TYPE" => "md_catalog",
                                "PRODUCT_IBLOCK_ID" => "11",
                                "ELEMENT_ID" => "",
                                "ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
                                "SECTION_ID" => $_REQUEST["SECTION_ID"],
                                "SECTION_CODE" => "",
                                "PRICE_CODE" => array(
                                    0 => "PRICE",
                                    1 => "NEW_PRICE",
                                ),
                                "PROPERTY_CODE" => array(
                                    0 => "PRICECURRENCY",
                                    1 => "PRODUCT_STATUS",
                                ),
                            ),
                            false
                        );?>
                    </div>
                <div class="col_half col_last">
                <?else:?>
                    <div class="col_full nobottommargin">
                <?endif;?>
                    <?
                    if (in_array($_GET["TYPE"], array("ZAKAZ", "ASK_PRICE", "ASK_QUESTION"))) {
                        $formType = $_GET["TYPE"];
                    } else {
                        $formType = "ZAKAZ";
                    }
                    $APPLICATION->IncludeComponent(
                        "boxsol:cosmos.contact",
                        "",
                        array(
                            "USE_CAPTCHA" => "Y",
                            "OK_TEXT" => "Спасибо, ваше сообщение принято.",
                            "FORM_TYPE" => $formType,
                            "SEND_ADMIN_EMAIL" => "Y",
                            "PRODUCT_ELEMENT_CODE" => $_REQUEST["ELEMENT_CODE"],
                            "PRODUCT_IBLOCK_ID" => "11",
                        ),
                        false
                    );?>
                </div>
            </div>
        </div>
<?
}
?>