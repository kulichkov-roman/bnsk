<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if ($_REQUEST["AJAX_QUICK_CONTACT"] == "Y")
{
	$APPLICATION->RestartBuffer();
	if (!empty($arResult["ERROR_MESSAGE"]))
	{
		foreach ($arResult["ERROR_MESSAGE"] as $v)
			echo '<i class="icon-remove-sign"></i>' . $v . '</br>';
	}
	if (strlen($arResult["OK_MESSAGE"]) > 0)
	{
		?><i class="icon-ok-sign"></i> <?= $arResult["OK_MESSAGE"] ?><?
	}
	die();
}
else
{
	$this->setFrameMode(true);
	$frame = $this->createFrame()->begin("");
}
?>

<div id="div-quick-contact-form" class="single-product shop-quick-view-ajax clearfix">
	<div class="form-process"></div>
	<div class="ajax-modal-title">
		<h2><?= GetMessage("MF_MD_QUICK_CONTACT"); ?></h2>
	</div>

	<div class="product modal-padding clearfix">
		<div id="quick-contact-form-result" data-notify-type="success"
				 data-notify-msg="<i class=icon-ok-sign></i> <?= $arParams["OK_TEXT"] ?>"></div>
		<form
				action="<? //=POST_FORM_ACTION_URI?><?= $APPLICATION->GetCurPageParam("AJAX_QUICK_CONTACT=Y", array("AJAX_QUICK_CONTACT", "success")); ?>"
				method="POST" id="quick-contact-form" name="quick-contact-form" class="quick-contact-form nobottommargin">
			<?= bitrix_sessid_post() ?>

			<? if (empty($arParams["SHOW_FIELDS"])
					|| in_array("NAME", $arParams["REQUIRED_FIELDS"])
					|| in_array("NAME", $arParams["SHOW_FIELDS"])
			): ?>
				<div class="col_full">
					<input type="text"
								 class="<? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])): ?>required <? endif ?>sm-form-control input-block-level"
								 id="quick-contact-form-name" name="user_name" value="<?= $arResult["AUTHOR_NAME"] ?>"
								 placeholder="<?= GetMessage("MF_MD_NAME") ?><? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])): ?> *<? endif ?>"/>
				</div>
			<? endif ?>
			<? if (empty($arParams["SHOW_FIELDS"])
					|| in_array("EMAIL", $arParams["REQUIRED_FIELDS"])
					|| in_array("EMAIL", $arParams["SHOW_FIELDS"])
			): ?>
				<div class="col_full">
					<input type="text"
								 class="<? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])): ?>required <? endif ?>sm-form-control email input-block-level"
								 id="quick-contact-form-email" name="user_email" value="<?= $arResult["AUTHOR_EMAIL"] ?>"
								 placeholder="<?= GetMessage("MF_MD_EMAIL") ?><? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])): ?> *<? endif ?>"/>
				</div>
			<? endif ?>
			<? if (empty($arParams["SHOW_FIELDS"])
					|| in_array("PHONE", $arParams["REQUIRED_FIELDS"])
					|| in_array("PHONE", $arParams["SHOW_FIELDS"])
			): ?>
				<div class="col_full">
					<input type="text"
								 class="<? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])): ?>required <? endif ?>sm-form-control phone input-block-level"
								 id="quick-contact-form-phone" name="user_phone" value="<?= $arResult["AUTHOR_PHONE"] ?>"
								 placeholder="<?= GetMessage("MF_MD_PHONE") ?><? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("PHONE", $arParams["REQUIRED_FIELDS"])): ?> *<? endif ?>"/>
				</div>
			<? endif ?>
			<? if (empty($arParams["SHOW_FIELDS"])
					|| in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])
					|| in_array("MESSAGE", $arParams["SHOW_FIELDS"])
			): ?>
				<div class="col_full">
				<textarea
						class="<? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])): ?>required <? endif ?>sm-form-control input-block-level short-textarea"
						id="quick-contact-form-message" name="MESSAGE" rows="4" cols="30"
						placeholder="<?= GetMessage("MF_MD_MESSAGE") ?><? if (empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])): ?> *<? endif ?>"><?= $arResult["MESSAGE"] ?></textarea>
				</div>
			<? endif ?>
			<input type="text" class="hidden" id="quick-contact-form-botcheck" name="quick-contact-form-botcheck" value=""/>

			<? if ($arParams["USE_CAPTCHA"] == "Y"): ?>
				<div class="col_full">
					<input type="hidden" name="captcha_sid" value="<?= $arResult["capCode"] ?>">
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?= $arResult["capCode"] ?>" width="180" height="40"
							 alt="CAPTCHA">
					<input type="text" class="required sm-form-control input-block-level" id="quick-contact-captcha"
								 name="captcha_word"
								 value="" placeholder="<?= GetMessage("MF_MD_CAPTCHA_CODE") ?> *"/>
				</div>
			<? endif; ?>
			<input type="hidden" name="PARAMS_HASH" value="<?= $arResult["PARAMS_HASH"] ?>">
			<button type="submit" id="quick-contact-form-submit" name="submit" class="button button-small button-3d nomargin"
							value="<?= GetMessage("MF_MD_SUBMIT") ?>"><?= GetMessage("MF_MD_SUBMIT") ?></button>
		</form>

		<script type="text/javascript">
			$("#quick-contact-form").validate({
				submitHandler: function (form) {
					if (validateEmail($('#quick-contact-form-email').val(), '#quick-contact-form-email')) {
						$('#div-quick-contact-form').find('.form-process').fadeIn();
						$(form).ajaxSubmit({
							target: '#quick-contact-form-result',
							success: function (data) {
								$('#div-quick-contact-form').find('.form-process').fadeOut();
								if ('<i class="icon-ok-sign"></i> <?=$arParams["OK_TEXT"]?>' == data) {
									$(form).find('.sm-form-control').val('');
									$('#quick-contact-form-result').attr('data-notify-type', 'success');
								} else {
									$('#quick-contact-form-result').attr('data-notify-type', 'error');
								}
								$('#quick-contact-form-result').attr('data-notify-msg', $('#quick-contact-form-result').html()).html('');
								SEMICOLON.widget.notifications($('#quick-contact-form-result'));
							}
						});
					}
				}
			});
		</script>
	</div>
</div>
<? $frame->end(); ?>