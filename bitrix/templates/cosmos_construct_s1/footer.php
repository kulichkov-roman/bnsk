<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Page\Asset;
Loc::loadMessages(__FILE__);
?>
</div><!-- postcontent - or container -->
<? if ($APPLICATION->GetDirProperty("right_sidebar") == 'Y'): ?>
	<div class="sidebar col_last nobottommargin clearfix">
		<?
		$APPLICATION->IncludeComponent(
				"bitrix:main.include",
				".default",
				Array(
						"AREA_FILE_SHOW"      => "sect",
						"AREA_FILE_SUFFIX"    => "rinc",
						"AREA_FILE_RECURSIVE" => "Y",
						"EDIT_TEMPLATE"       => ""
				),
				false
		);
		?>
		<? if ($APPLICATION->GetDirProperty("left_sidebar") !== 'Y'): ?>
			<?$APPLICATION->ShowViewContent('catalog_smart_filter_left');?>
		<?endif;?>
	</div>
<? endif; ?>
<?if ($APPLICATION->GetCurPage(true) !== SITE_DIR."index.php" && ($APPLICATION->GetDirProperty("left_sidebar") == 'Y' || $APPLICATION->GetDirProperty("right_sidebar") == 'Y')):?>
	</div><!-- container clearfix -->
<? endif; ?>
<?
$APPLICATION->IncludeComponent(
		"bitrix:main.include",
		".default",
		Array(
				"AREA_FILE_SHOW" => "page",
				"AREA_FILE_SUFFIX" => "footer",
				"AREA_FILE_RECURSIVE" => "N",
				"EDIT_TEMPLATE" => ""
		),
		false
);
?>

</div><!-- content-wrap -->
</section><!-- content -->
<!-- Footer
============================================= -->
<footer id="footer"<?if (CMarsHelper::getOptionString("boxsol.cosmos", 'show_dark_footer', 'N') == 'Y') :?> class="dark"<?endif;?>>

	<?if (CMarsHelper::getOptionString("boxsol.cosmos", 'show_big_footer', 'N') == 'Y') :?>
		<div class="container">

			<!-- Footer Widgets
			============================================= -->
			<div class="footer-widgets-wrap clearfix">

				<div class="row clearfix">
					<div class="col_two_third">

						<div class="col_two_third">

							<div class="widget clearfix">
								<?
								$APPLICATION->IncludeFile(
									SITE_DIR . "include/footer/instagram.php",
									Array(),
									Array("MODE" => "html")
								);
								?><?
								$APPLICATION->IncludeFile(
										SITE_DIR . "include/footer/info.php",
										Array(),
										Array("MODE" => "html")
								);
								?>
							</div>
						</div>

						<div class="col_one_third col_last">

							<div class="widget clearfix">
								<?
								$APPLICATION->IncludeFile(
										SITE_DIR . "include/footer/posts.php",
										Array(),
										Array("MODE" => "html")
								);
								?>
							</div>

						</div>

					</div>
				</div>

			</div>
			<!-- .footer-widgets-wrap end -->

		</div>
	<?endif;?>
	<!-- Copyrights
	============================================= -->
	<div id="copyrights">

		<div class="container clearfix">

			<div class="col_two_third nobottommargin">
					<?
					$APPLICATION->IncludeFile(
						SITE_DIR . "include/footer/links_horizontal.php",
						Array(),
						Array("MODE" => "html")
					);
					?>
			</div>

			<div class="col_one_third col_last tright nobottommargin">
				<div class="fright" style="margin-left: 20px;">
					<?
					$APPLICATION->IncludeFile(
						SITE_DIR . "include/footer/metrika.php",
						Array(),
						Array("MODE" => "html")
					);
					?>
					<div id="bx-composite-banner"></div>
				</div>
				<div class="fright clearfix">
					<?
					$APPLICATION->IncludeFile(
						SITE_DIR . "include/footer/contacts.php",
						Array(),
						Array("MODE" => "html")
					);
					?>
				</div>
			</div>
			<div class="line topmargin-md bottommargin-sm"></div>

			<div class="col_two_third nobottommargin">
				<div class="widget clearfix">
					<div class="clear-bottommargin-sm">
						<div class="row clearfix">

							<div class="col-md-6">
									<?
									$APPLICATION->IncludeFile(
										SITE_DIR . "include/footer/copyrights.php",
										Array(),
										Array("MODE" => "html")
									);
									?>
							</div>

							<div class="col-md-6">
								<div class="footer-big-contacts">
									<?
									$APPLICATION->IncludeFile(
										SITE_DIR."include/header/call_number_v2.php",
										Array(),
										Array("MODE"=>"html")
									);
									?><br>
									<?
									$APPLICATION->IncludeFile(
										SITE_DIR."include/footer/worktime.php",
										Array(),
										Array("MODE"=>"html")
									);
									?>
								</div>
								<div class="visible-xs bottommargin-sm"></div>
							</div>

						</div>
					</div>
				</div>
				<div class="visible-sm visible-xs bottommargin-sm"></div>
			</div>

			<div class="col_one_third col_last nobottommargin">

				<div class="clearfix">
					<?
					$APPLICATION->IncludeFile(
						SITE_DIR . "include/footer/social.php",
						Array(),
						Array("MODE" => "html")
					);
					?>
				</div>

			</div>

		</div>

	</div>
	<!-- #copyrights end -->

</footer><!-- #footer end -->

</div><!-- #wrapper end -->

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- Footer Scripts
============================================= -->
<?if(Option::get("main", "move_js_to_body") === "Y"):
	Asset::getInstance()->addJs(SITE_TEMPLATE_PATH . "/js/functions.js");
else: ?>
	<script type="text/javascript" src="<?= SITE_TEMPLATE_PATH ?>/js/functions.js"></script>
<?endif;?>
<?if (CMarsHelper::isPublicSettingsAvailable()) :?>
<?$APPLICATION->IncludeComponent(
		"boxsol:style.swticher",
		"cosmos",
		array(
		),
		false
);?>
<?endif;?>
</body>
</html>
