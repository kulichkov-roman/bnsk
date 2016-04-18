<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);
if (count($arResult["ITEMS"])  < 1) return;
?>
<?foreach($arResult["SECTIONS"] as $arSection):?>
	<div class="fancy-title title-bottom-border bottommargin-sm">
		<h3><?=$arSection["NAME"]?></h3>
	</div>
	<?
	echo $arSection["DESCRIPTION"]; 
	$rowCounter = 0;
	?>
	<div class="col_full">
		<?foreach($arSection["ITEMS"] as $arItem):?>
		    <?
		    $this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		    $this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		    $rowCounter++;
		    ?>
			<div class="col_one_third<?=($rowCounter % 3 == 0) ? " col_last": ""?>" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="thumbnail">
					<a href="<?=$arItem["DETAIL_PAGE_URL"]?>">
						<img src="<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>">
					</a>
					<div class="caption">
						<h5><a href="<?=$arItem["DETAIL_PAGE_URL"]?>"><?=$arItem["NAME"]?></a></h5>
						<p><?=$arItem["PREVIEW_TEXT"]?></p>
						<?foreach($arItem["DISPLAY_PROPERTIES"] as $pid=>$arProperty):?>
							<?
							$icon = CMarsHelper::getIconByPropCode($arProperty["CODE"]);
							if ($icon) {
								echo $icon;
							} else {
								echo $arProperty["NAME"] . ':&nbsp;';
							}
							?>
							<?if(is_array($arProperty["DISPLAY_VALUE"])):?>
								<?=implode("&nbsp;/&nbsp;", $arProperty["DISPLAY_VALUE"]);?>
							<?else:?>
								<?=$arProperty["DISPLAY_VALUE"];?>
							<?endif?>
							<br />
						<?endforeach;?>
					</div>
				</div>
			</div>
		    <?
		    if ($rowCounter == $colInfo["NUM"]) :?><div class="clear"></div><?
		    $rowCounter = 0;
		    endif;?>
		<?endforeach;?>
	</div>
	<div class="clear"></div>
<?endforeach;?>

<div class="clear"></div>