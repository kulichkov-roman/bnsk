<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Космос - корпоративный сайт");
?>

	<div class="col_full nobottommargin">
		<?
		$APPLICATION->IncludeFile(
			"/include/main/services_list.php",
			Array(),
			Array("MODE" => "html")
		);
		?>
	</div>
	<?
	$APPLICATION->IncludeFile(
			"/include/main/promo_client.php",
			Array(),
			Array("MODE" => "html")
	);
	?>
	<?
	$APPLICATION->IncludeFile(
		"/include/main/reviews_full.php",
		Array(),
		Array("MODE" => "html")
	);
	?>
	<div class="col_full nobottommargin">
		<div class="col_half bottommargin">
			<div class="fancy-title title-bottom-border">
				<h3>О компании</h3>
			</div>
			<?
			$APPLICATION->IncludeFile(
					"/include/main/about_company.php",
					Array(),
					Array("MODE" => "html")
			);
			?>
		</div>
		<div class="col_half col_last bottommargin">
			<?
			$APPLICATION->IncludeFile(
					"/include/main/news.list.php",
					Array(),
					Array("MODE" => "html")
			);
			?>

		</div>
	</div>
	<div class="col_full nobottommargin">
		<?
		$APPLICATION->IncludeFile(
			"/include/main/catalog_sections.php",
			Array(),
			Array("MODE" => "html")
		);
		?>
	</div>
	<div class="col_full nobottommargin">
		<div class="heading-block center">
			<h3>Наши клиенты</h3>
			<span>Компании, которые доверились нам</span>
		</div>
		<?
		$APPLICATION->IncludeFile(
				"/include/main/clients.php",
				Array(),
				Array("MODE" => "html")
		);
		?>
	</div>



<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>