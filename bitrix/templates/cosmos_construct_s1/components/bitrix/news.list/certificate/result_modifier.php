<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arDefaultParams = array(
    'NL_USE_IMAGE_RESIZE' => 'Y',
    'NL_IMAGE_RESIZE_WIDTH' => 200,
    'NL_IMAGE_RESIZE_HEIGHT' => 200,
    'NL_IMAGE_RESIZE_TYPE' => BX_RESIZE_IMAGE_PROPORTIONAL,
);

$arParams = array_merge($arDefaultParams, $arParams);
$arParams['NL_IMAGE_RESIZE_WIDTH'] = (int) $arParams['NL_IMAGE_RESIZE_WIDTH'];
$arParams['NL_IMAGE_RESIZE_HEIGHT'] = (int) $arParams['NL_IMAGE_RESIZE_HEIGHT'];
$arParams['NL_IMAGE_RESIZE_TYPE'] = (int) $arParams['NL_IMAGE_RESIZE_TYPE'];

if ($arParams["NL_USE_IMAGE_RESIZE"] == "Y") {
    foreach ($arResult["ITEMS"] as $keyItem => $arItem) {
        $pictureId = $arItem["PREVIEW_PICTURE"]["ID"];

        if (isset($pictureId) && $pictureId > 0) {
            $arFileTmp = CFile::ResizeImageGet(
                $pictureId,
                array("width" => $arParams["NL_IMAGE_RESIZE_WIDTH"], "height" => $arParams["NL_IMAGE_RESIZE_HEIGHT"]),
                $arParams["NL_IMAGE_RESIZE_TYPE"],
                true
            );
            $arResult["ITEMS"][$keyItem]["PREVIEW_PICTURE_RESIZED"] = array(
                'SRC' => $arFileTmp["src"],
                'WIDTH' => $arFileTmp["width"],
                'HEIGHT' => $arFileTmp["height"],
            );
        }

    }
}



?>