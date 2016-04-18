<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//delayed function must return a string
if(empty($arResult))
	return "";
	
$strReturn = '<ol class="breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';

$num_items = count($arResult);
for($index = 0, $itemSize = $num_items; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	
	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
		$strReturn .= '<li itemprop="title"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url">'.$title.'</a></li>';
	else
		$strReturn .= '<li class="active" itemprop="title"><a href="'.$arResult[$index]["LINK"].'" title="'.$title.'" itemprop="url">'.$title.'</a></li>';
}

$strReturn .= '</ol>';

return $strReturn;
?>