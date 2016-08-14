<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<div class="content-wrap notoppadding topmargin-sm">
	<div class="container clearfix">
		<div class="sidebar nobottommargin clearfix">
			<?
			$arClasses = array(
				'xls'  => 'fa fa-file-excel-o',
				'pdf'  => 'fa fa-file-pdf-o',
				'doc' => 'fa fa-file-text-o'
			);
			foreach($arResult['ITEMS'] as $arItem){?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arFile['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));

				if($arItem['PROPERTIES']['TYPE_PRICE']['VALUE']) {
					$class = $arClasses[$arItem['PROPERTIES']['TYPE_PRICE']['VALUE']];
				}

				if($arItem['PROPERTIES']['FILE']['VALUE']) {
					$rsFile = CFile::GetByID($arItem['PROPERTIES']['FILE']['VALUE']);
					$arFile = $rsFile->Fetch();
					if(is_array($arFile)) {
						$arFile['FILE_SIZE'] = $arFile['FILE_SIZE'] / 1024 / 1024;
					}
				}

				?>
				<a class="price__link" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<i class="<?=$class?>" aria-hidden="true"></i><?=$arItem["NAME"].'.'.$arItem['PROPERTIES']['TYPE_PRICE']['VALUE']?><span><?if($arFile['FILE_SIZE']){?>(<?=round($arFile['FILE_SIZE'], 2)?> мб)<?}?></span>
				</a>
			<?}?>
		</div>
		<!-- Post Content
        ============================================= -->
	</div><!-- container clearfix -->
</div>
