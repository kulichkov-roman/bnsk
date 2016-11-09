<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$this->setFrameMode(true);

$arViewStyles = array(
	'TILE' => array(
		'COL_SIZE' => 'col_half',
		'TRUNCATE' => true,
		),
	'LINE' => array(
		'COL_SIZE' => 'col_full',
		'TRUNCATE' => false,
		),
);

$arCurView = $arViewStyles[$arParams['VIEW_MODE']];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

?>
<?if ($arParams["SL_USE_TITLE"] == "Y") :?>
	<div class="heading-block center">
		<h3><?=$arParams["TITLE_TEXT"]?></h3>
		<span><?=$arParams["UNDER_TITLE_TEXT"]?></span>
	</div>
<?endif;?>

<?if ('Y' == $arParams['SHOW_PARENT_NAME'] && 0 < $arResult['SECTION']['ID'])
{
    $this->AddEditAction($arResult['SECTION']['ID'], $arResult['SECTION']['EDIT_LINK'], $strSectionEdit);
    $this->AddDeleteAction($arResult['SECTION']['ID'], $arResult['SECTION']['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
    ?>
    <div class="fancy-title title-border">
        <h2 id="<? echo $this->GetEditAreaId($arResult['SECTION']['ID']); ?>">
            <?
            echo (
            isset($arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]) && $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"] != ""
                ? $arResult['SECTION']["IPROPERTY_VALUES"]["SECTION_PAGE_TITLE"]
                : $arResult['SECTION']['NAME']
            );
            ?>
        </h2>
    </div>
<?}?>

<?
if (0 < $arResult["SECTIONS_COUNT"])
{
	$sectionCounter = 0;
	foreach ($arResult['SECTIONS'] as $keySection => &$arSection)
	{
		$sectionCounter++;
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);
		if (false === $arSection['PICTURE'])
			$arSection['PICTURE'] = array(
				'ALT' => (
				'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
					? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_ALT"]
					: $arSection["NAME"]
				),
				'TITLE' => (
				'' != $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
					? $arSection["IPROPERTY_VALUES"]["SECTION_PICTURE_FILE_TITLE"]
					: $arSection["NAME"]
				)
			);
		?>
		<div class="<?=$arCurView["COL_SIZE"]?><?=($sectionCounter%2) ? '':'  col_last' ?>">
			<div class="feature-box fbox-large fbox-rounded fbox-effect fbox-light" id="<? echo $this->GetEditAreaId($arSection['ID']); ?>">
				<div class="fbox-icon">
					<a href="<?=$arSection['SECTION_PAGE_URL']; ?>" title="<?=$arSection['PICTURE']['TITLE']; ?>">
						<?if (isset($arSection['PICTURE']["SRC"])):?>
							<img src="<?=$arSection['PICTURE']['SRC'];?>" title="<?=$arSection['PICTURE']['TITLE']; ?>" alt="<?=$arSection['PICTURE']['ALT']; ?>">
						<?else:?>
							<i class="icon-line-image"></i>
						<?endif;?>
					</a>
				</div>
				<h3><a href="<?=$arSection['SECTION_PAGE_URL']; ?>"><?=$arSection['NAME'];?>
						<?if ($arParams["COUNT_ELEMENTS"]) echo '(' . $arSection['ELEMENT_CNT'] . ')' ?></a>
				</h3>
				<?$keySection++;?>
				<?if (isset($arResult['SECTIONS'][$keySection]["RELATIVE_DEPTH_LEVEL"]) && $arResult['SECTIONS'][$keySection]["RELATIVE_DEPTH_LEVEL"] != 1):?>
					<p>
						<?while(isset($arResult['SECTIONS'][$keySection]["RELATIVE_DEPTH_LEVEL"]) && $arResult['SECTIONS'][$keySection]["RELATIVE_DEPTH_LEVEL"] != 1):?>
							<a class="btn btn-default btn-xs" href="<?=$arResult['SECTIONS'][$keySection]["SECTION_PAGE_URL"]?>">
								<?=$arResult['SECTIONS'][$keySection]["NAME"]?></a>
							<?
							unset($arResult['SECTIONS'][$keySection]);
							$keySection++;
							?>
						<?endwhile;?>
					</p>
				<?endif;?>
				<p><?
					if ($arCurView["TRUNCATE"]) {
						echo truncateStr($arSection["DESCRIPTION"], $arParams["TRUNCATE_DESCRIPTION"], '', 'html');
					} else {
						echo $arSection["DESCRIPTION"];
					}
					?>&nbsp;
				</p>
			</div>
		</div>
		<?//=($sectionCounter%2) ? '':'<div class="divider"><i class="icon-circle"></i></div>' ?>
		<?
	}
}
?>
<div class="clear"></div>
