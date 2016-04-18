<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();?>

<?if($arResult["MESSAGE"]):?>
	<?echo $arResult["MESSAGE"]?>
	<?$this->setFrameMode(false);?>
<?else:?>
	<?$this->setFrameMode(true);?>

	<h5><?=GetMessage('SUBSCRIBE_INFO')?></h5>
	<div id="widget-subscribe-form-result" data-notify-type="success" data-notify-msg=""></div>
	<form id="widget-subscribe-form" role="form" method="POST" action="/ajax/subscribe.php<?//echo $arResult["FORM_ACTION"]?>" class="nobottommargin">
		<div class="subscribe-rubrics">
			<?foreach($arResult["RUBRICS"] as $arRubric):?>
				<input name="RUB_ID[]" value="<?echo $arRubric["ID"]?>" id="RUB_<?echo $arRubric["ID"]?>" type="checkbox" checked><label for="RUB_<?echo $arRubric["ID"]?>"><?echo $arRubric["NAME"]?></label><br>
			<?endforeach?>
			<input name="FORMAT" value="text" id="FORMAT_text" type="radio"><label for="FORMAT_text"><?echo GetMessage("CT_BSS_TEXT")?></label>
			<input name="FORMAT" value="html" id="FORMAT_html" type="radio" checked><label for="FORMAT_html"><?echo GetMessage("CT_BSS_HTML")?></label>
		</div>
	    <div class="input-group divcenter">
	        <span class="input-group-addon"><i class="icon-email2"></i></span>
	        <input type="email" id="widget-subscribe-form-email" name="EMAIL" class="form-control required" placeholder="<?=GetMessage("CT_ENTER_YOUR_EMAIL")?>">
	        <span class="input-group-btn">
				<?echo bitrix_sessid_post();?>
	            <button class="btn btn-success" name="Update" type="submit"><?echo GetMessage("CT_BSS_FORM_BUTTON")?></button>
	        </span>
	    </div>
	</form>

	<script type="text/javascript">
	    jQuery("#widget-subscribe-form").validate({
	        submitHandler: function(form) {
	            if (validateEmail($('#widget-subscribe-form-email').val(), '#widget-subscribe-form-email')) {
	            	jQuery(form).find('.input-group-addon').find('.icon-email2').removeClass('icon-email2').addClass('icon-line-loader icon-spin');
		            jQuery(form).ajaxSubmit({
		                target: '#widget-subscribe-form-result',
		                success: function() {
		                    jQuery(form).find('.input-group-addon').find('.icon-line-loader').removeClass('icon-line-loader icon-spin').addClass('icon-email2');
		                    jQuery('#widget-subscribe-form').find('.form-control').val('');
		                    jQuery('#widget-subscribe-form-result').attr('data-notify-msg', jQuery('#widget-subscribe-form-result').html()).html('');
		                    SEMICOLON.widget.notifications(jQuery('#widget-subscribe-form-result'));
		                }
		            });
	            }
	        }
	    });
		$('#widget-subscribe-form-email').keyup(function(){
			var email = this.value;
			validateEmail(email, '#widget-subscribe-form-email');
		});
	</script>
<?endif?>
