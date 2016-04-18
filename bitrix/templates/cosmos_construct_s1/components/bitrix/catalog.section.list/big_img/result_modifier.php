<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach ($arResult["SECTIONS"] as $keySection => $arSection) {
    $pictureId = $arSection["PICTURE"]["ID"];

    if (isset($pictureId) && $pictureId > 0) {
        $arFileTmp = CFile::ResizeImageGet(
            $pictureId,
            array("width" => 400, "height" => 250),
            BX_RESIZE_IMAGE_EXACT,
            true
        );
        $arResult["SECTIONS"][$keySection]["PICTURE_RESIZED"] = array(
            'SRC' => $arFileTmp["src"],
            'WIDTH' => $arFileTmp["width"],
            'HEIGHT' => $arFileTmp["height"],
        );
    }
}



?>