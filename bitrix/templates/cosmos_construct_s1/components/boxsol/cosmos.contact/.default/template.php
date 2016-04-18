<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
$randString = $this->randString(6);
if ($_REQUEST["AJAX_QUICK_CONTACT"] == "Y"){
	$APPLICATION->RestartBuffer();

	if (!empty($arResult["ERROR_MESSAGE"]))
	{
		foreach ($arResult["ERROR_MESSAGE"] as $v)
			echo '<i class="icon-remove-sign"></i>' . $v . '</br>';
		die();
	}
	if (strlen($arResult["OK_MESSAGE"]) > 0)
	{
		?><i class="icon-ok-sign"></i> <?= $arResult["OK_MESSAGE"] ?><?
		die();
	}

	echo GetMessage("SOMETHING_GOES_WRONG");
	die();
}
else
{
	$this->setFrameMode(true);
	$frame = $this->createFrame()->begin("");
}
$strContactFormId = "contact-form-" . $randString;
$strResultFormId = "contact-form-result-" . $randString;
$strFormProccesId = "form-process-" . $randString;
$strAjaxQuickContactName = "AJAX_QUICK_CONTACT_".$randString;

$strImagCaptchaId = "imgCaptcha-".$randString;
$strHIddenCaptchaId = "hiddenCaptcha-".$randString;
?>
<div class="form-process" id="<?=$strFormProccesId?>"></div>
<div class="well well-lg nobottommargin">
	<div id="<?=$strResultFormId?>" data-notify-type="success"
		 data-notify-msg="<i class=icon-ok-sign></i> <?= $arParams["OK_TEXT"] ?>"></div>
	<form action="<?//=POST_FORM_ACTION_URI?><?= $APPLICATION->GetCurPageParam("AJAX_QUICK_CONTACT=Y", array("AJAX_QUICK_CONTACT", "success")); ?>" method="POST"
		  class="nobottommargin" id="<?=$strContactFormId?>">
		<?=bitrix_sessid_post()?>
		<h3><?=$arResult["FORM_TITLE"]?></h3>
		<?$threeInLineCounter = 0;?>
		<?foreach ($arResult["FORM_FIELDS"] as $keyFormField => $arFormField):?>
			<?
			if ($arParams["FORM_TYPE"] == "CONTACT_FORM" && $arFormField["type"] !== "textarea") {
				$threeInLineCounter++;
				if ($threeInLineCounter == 3 ) {
					$colSize = "col_one_third col_last";
					$threeInLineCounter = 0;
				} else {
					$colSize = "col_one_third";
				}
			} else {
				$colSize = "col_full";
			}

			?>
			<div class="<?=$colSize?><?if ($arFormField["hidden"]) echo ' hidden' ?>">
				<label for="<?=$randString?>-<?=$keyFormField?>" class="nobottommargin">
					<?=GetMessage("COSMOS_LABEL_" . $keyFormField)?><?if ($arFormField["required"]) echo ' *' ?>
				</label>
				<?if($arFormField["type"] == "text"): ?>
					<?if($keyFormField == "PRODUCT"):?>
						<input disabled id="<?=$randString?>-<?=$keyFormField?>" name="<?=$keyFormField?>" placeholder="<?=GetMessage("COSMOS_LABEL_" . $keyFormField)?><?if ($arFormField["required"]) echo ' *' ?>"
							   value="<?=$arResult["PRODUCT"]["NAME"]?>" class="<?if ($arFormField["required"]) echo 'required ' ?>sm-form-control input-block-level" type="text">
						<input name="<?=$keyFormField?>" value="<?=$arResult["PRODUCT"]["NAME"]?>" type="hidden">
						<input id="<?=$randString?>-<?=$keyFormField?>_CODE" name="<?=$keyFormField?>_CODE"
							   value="<?=$arResult["PRODUCT"]["CODE"]?>" type="hidden">
					<?else:?>
						<input id="<?=$randString?>-<?=$keyFormField?>" name="<?=$keyFormField?>" value="" placeholder="<?=GetMessage("COSMOS_LABEL_" . $keyFormField)?><?if ($arFormField["required"]) echo ' *' ?>"
							   class="<?if ($arFormField["required"]) echo 'required ' ?>sm-form-control input-block-level" type="text">
					<?endif;?>
				<?endif;?>
				<?if($arFormField["type"] == "textarea"): ?>
					<textarea id="<?=$randString?>-<?=$keyFormField?>" name="<?=$keyFormField?>" placeholder="<?=GetMessage("COSMOS_LABEL_" . $keyFormField)?><?if ($arFormField["required"]) echo ' *' ?>"
							  class="<?if ($arFormField["required"]) echo 'required ' ?>sm-form-control input-block-level"></textarea>
				<?endif;?>
			</div>
		<?endforeach;?>

		<?if($arParams["USE_CAPTCHA"] == "Y"):?>
			<div class="mf-captcha col_full">
				<div class="col_half">
					<div class="mf-text"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></div>
					<input id="word-<?=$strFormProccesId?>" type="text" name="captcha_word" size="30" maxlength="50" value="" class="sm-form-control input-block-level">
				</div>
				<div class="col_half col_last">
					<div class="form-process" id="captcha-<?=$strFormProccesId?>"></div>
					<div class="mf-text"><?=GetMessage("MFT_CAPTCHA")?></div>
					<input id="<?=$strHIddenCaptchaId?>" type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
					<img id="<?=$strImagCaptchaId?>" src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA" onclick="loadNewCaptcha();">
				</div>
			</div>
		<?endif;?>
		<input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
		<input type="hidden" name="RAND_STRING" value="<?=$randString?>">
		<div class="col_full nobottommargin">
			<input class="button button-3d nomargin" type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>">
		</div>
	</form>
	<script type="text/javascript">
		$("#<?=$strContactFormId?>").validate({
			submitHandler: function (form) {
				$('#<?=$strFormProccesId?>').fadeIn();
				$(form).ajaxSubmit({
					target: '#<?=$strResultFormId?>',
					success: function (data) {
						$('#<?=$strFormProccesId?>').fadeOut();
						if ('<i class="icon-ok-sign"></i> <?=$arParams["OK_TEXT"]?>' == data) {
							$(form).find('.sm-form-control').val('');
							$('#<?=$strResultFormId?>').attr('data-notify-type', 'success');
						} else {
							loadNewCaptcha();
							$('#<?=$strResultFormId?>').attr('data-notify-type', 'error');
						}
						$('#<?=$strResultFormId?>').attr('data-notify-msg', $('#<?=$strResultFormId?>').html()).html('');
						SEMICOLON.widget.notifications($('#<?=$strResultFormId?>'));
					}
				});
			}
		});
		function loadNewCaptcha(){
			$('#captcha-<?=$strFormProccesId?>').fadeIn();
			$('#word-<?=$strFormProccesId?>').val('');
			$.get("<?=$this->GetFolder()?>/captcha.php", function(response) {
				var capCode = response;
				$("#<?=$strHIddenCaptchaId?>").val(capCode);
				$("#<?=$strImagCaptchaId?>").one("load", function() {
					$('#captcha-<?=$strFormProccesId?>').fadeOut();
				}).attr("src", "/bitrix/tools/captcha.php?captcha_sid="+capCode);
			});
		}
	</script>
</div><? $frame->end(); ?>