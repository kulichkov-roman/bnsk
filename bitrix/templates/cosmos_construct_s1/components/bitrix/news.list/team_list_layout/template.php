<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
CModule::IncludeModule("boxsol.cosmos");
?>
<?$this->setFrameMode(true);
if (count($arResult["ITEMS"])  < 1) return;
$rowCounter = 0;
if ($arParams["TEAM_TYPE"] == "noteam-list") {
    $classTeam = '';
} else {
    $classTeam = " team-list";
}

if (!isset($arParams["TEAM_COLS"]) && (int)$arParams["TEAM_COLS"] < 1) $arParams["TEAM_COLS"] = 2; 
$colInfo = CMarsHelper::getColInfo($arParams["TEAM_COLS"]);
?>
<?=$arResult["DESCRIPTION"]?>
<?foreach($arResult["ITEMS"] as $arItem):?>
    <?
    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
    ?>
    <div class="<?=$colInfo["CLASS"]?> <?if(($rowCounter+1) == $colInfo["NUM"]) echo "col_last ";?>bottommargin" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
        <div class="team<?=$classTeam?> clearfix">
            <div class="team-image">
                <img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>" alt="<?=$arItem["PREVIEW_PICTURE"]["ALT"]?>" title="<?=$arItem["PREVIEW_PICTURE"]["TITLE"]?>">
            </div>
            <div class="team-desc">
                <div class="team-title"><h4><?=$arItem["NAME"]?></h4><span><?=$arItem["PREVIEW_TEXT"]?></span></div>
                <div class="team-content">
                    <p><?=$arItem["DETAIL_TEXT"]?></p>
                </div>
            </div>
        </div>
    </div>
    <?
    $rowCounter++;
    if ($rowCounter == $colInfo["NUM"]) :?><div class="clear"></div><?
    $rowCounter = 0;
    endif;?>
<?endforeach;?>
<div class="clear"></div>