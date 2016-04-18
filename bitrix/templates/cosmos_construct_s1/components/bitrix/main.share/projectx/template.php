<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this->setFrameMode(true);
if (strlen($arResult["PAGE_URL"]) > 0)
{
	?>
<div class="si-share noborder tright clearfix">
    <span class="rightmargin-sm"><?=GetMessage('MS_MD_SHARE')?></span>
    <div>
        <noindex>
        <a href="https://vk.com/share.php?url=<?=$arResult["PAGE_URL"]?>" target="_blank" onclick="window.open(this.href, 'shareWin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" class="social-icon si-borderless si-vk">
            <i class="icon-vk"></i>
            <i class="icon-vk"></i>
        </a>
        <a href="https://www.facebook.com/sharer.php?u=<?=$arResult["PAGE_URL"]?>" target="_blank" onclick="window.open(this.href, 'shareWin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" class="social-icon si-borderless si-facebook">
            <i class="icon-facebook"></i>
            <i class="icon-facebook"></i>
        </a>
        <a href="https://twitter.com/share?url=<?=$arResult["PAGE_URL"]?>" target="_blank" onclick="window.open(this.href, 'shareWin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" class="social-icon si-borderless si-twitter">
            <i class="icon-twitter"></i>
            <i class="icon-twitter"></i>
        </a>
        <a href="https://www.pinterest.com/pin/create/button/?url=<?=$arResult["PAGE_URL"]?>" target="_blank" onclick="window.open(this.href, 'shareWin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" class="social-icon si-borderless si-pinterest">
            <i class="icon-pinterest"></i>
            <i class="icon-pinterest"></i>
        </a>
        <a href="https://plus.google.com/share?url=<?=$arResult["PAGE_URL"]?>" target="_blank" onclick="window.open(this.href, 'shareWin',
'left=20,top=20,width=500,height=500,toolbar=1,resizable=0'); return false;" class="social-icon si-borderless si-gplus">
            <i class="icon-gplus"></i>
            <i class="icon-gplus"></i>
        </a>                       
        </noindex>
    </div>
</div>
    <?
}
else
{
	?><?=GetMessage("SHARE_ERROR_EMPTY_SERVER")?><?
}
?>