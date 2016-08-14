<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Page\Asset;
use \Bitrix\Main\Localization\Loc;
use \Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);
$arCurrentSite = CSite::GetByID(SITE_ID)->Fetch();

CModule::IncludeModule("boxsol.cosmos");
?><!DOCTYPE html>
    <html dir="ltr" lang="<?=$arCurrentSite["LANGUAGE_ID"]?>">
    <head>
        <!-- Stylesheets
        ============================================= -->
        <link rel="shortcut icon" href="<?=SITE_DIR?>favicon.png">
        <link
            href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,300italic,400italic,600,600italic,700,700italic,800,800italic&subset=latin,cyrillic'
            rel='stylesheet' type='text/css'>
        <script>
            countDownLabels = <?=Loc::getMessage("HEADER_COUNTDOWN_LABLES");?>;
        </script>
        <?
        $APPLICATION->ShowHead();

        CMarsHelper::init();
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!--[if lt IE 9]>
        <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
        <![endif]-->

        <!-- External JavaScripts
        ============================================= -->
        <?$APPLICATION->AddHeadString('
            <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css">
        ');?>
        <title><?$APPLICATION->ShowTitle()?></title>
    </head>
<?
$bodyClass = "";
if (CMarsHelper::getOptionString("boxsol.cosmos", 'dark_site', 'N') == 'Y') $bodyClass .= " dark";
if (CMarsHelper::getOptionString("boxsol.cosmos", 'use_transition', 'N') == 'N') $bodyClass .= " no-transition";
if (CMarsHelper::getOptionString("boxsol.cosmos", 'use_smooth_scroll', 'N') == 'N') $bodyClass .= " no-smooth-scroll";
if (CMarsHelper::getOptionString("boxsol.cosmos", 'stretched', 'Y') == 'Y') $bodyClass .= " stretched";

$headerType = CMarsHelper::getOptionString("boxsol.cosmos", 'type_big_header', 1);//COption::GetOptionString("boxsol.cosmos", 'type_big_header', 1);//

$headerClass = "";
$headerAddtitional = "";
$menuClass = "";
$menuClass = CMarsHelper::getOptionString("boxsol.cosmos", 'menu_type', 'style-1');
$menuBgColor = CMarsHelper::getOptionString("boxsol.cosmos", 'bgcolor_menu', 'N');

if (CMarsHelper::getOptionString("boxsol.cosmos", 'sticky_menu', 'Y') !== 'Y') $headerClass .= " no-sticky";
if (CMarsHelper::getOptionString("boxsol.cosmos", 'full_header', 'N') == 'Y') $headerClass .= " full-header";
if (CMarsHelper::getOptionString("boxsol.cosmos", 'dark_menu', 'N') == 'Y') $headerClass .= " dark";
if (CMarsHelper::getOptionString("boxsol.cosmos", 'dark_dropdown_menu', 'N') == 'Y') $menuClass .= " dark";

if (CMarsHelper::getOptionString("boxsol.cosmos", 'sticky_dark_menu', 'N') == 'Y')
    $headerAddtitional .= ' data-sticky-class="dark"';
else
    $headerAddtitional .= ' data-sticky-class="not-dark"';

if ($headerType == 1) {
    $headerClass .= ' sticky-style-2';
    $menuClass = "style-2";
    if ($menuBgColor == "Y") {
        $menuClass .= ' bgcolor';
    }
}

if ($headerType == 2 && $menuBgColor == "Y") {
    $headerClass .= ' bgcolor';
}

$showTopSearch = CMarsHelper::getOptionString("boxsol.cosmos", 'show_top_search', 'Y');
$showTopBar = CMarsHelper::getOptionString("boxsol.cosmos", 'show_top_bar', 'N');

?>
<body class="<?= $bodyClass ?>">
<? $APPLICATION->ShowPanel(); ?>

    <!-- Document Wrapper
    ============================================= -->
<div id="wrapper" class="clearfix">
<? if ($showTopBar == 'Y'): ?>
    <!-- Top Bar
============================================= -->
    <div id="top-bar">
        <div class="container clearfix">
            <div class="col_half nobottommargin">
                <!-- Top Links
                ============================================= -->
                <div class="top-links">
                    <?
                    $APPLICATION->IncludeFile(
                        SITE_DIR . "include/header/top_links.php",
                        Array(),
                        Array("MODE" => "html")
                    );
                    ?>
                </div><!-- .top-links end -->
            </div>
            <div class="col_half fright col_last nobottommargin">
                <!-- Top Social
                ============================================= -->
                <div id="top-social">
                    <?
                    $APPLICATION->IncludeFile(
                        SITE_DIR . "include/header/top_social.php",
                        Array(),
                        Array("MODE" => "html")
                    );
                    ?>
                </div><!-- #top-social end -->
            </div>
        </div>
    </div><!-- #top-bar end -->
<? endif; ?>
    <!-- Header
    ============================================= -->
    <header id="header" class="<?= $headerClass ?>"<?= $headerAdditional ?>>
<?if ($headerType == 2) :?>
        <div id="header-wrap">
<?endif;?>
            <div class="container clearfix">

            <!-- Logo
            ============================================= -->
                <div id="logo">
                    <a href="<?= SITE_DIR ?>" class="standard-logo">
                        <?
                        $APPLICATION->IncludeFile(
                            SITE_DIR . "include/header/logo.php",
                            Array(),
                            Array("MODE" => "html")
                        );
                        ?>
                    </a>
                    <a href="<?= SITE_DIR ?>" class="retina-logo">
                        <?
                        $APPLICATION->IncludeFile(
                            SITE_DIR . "include/header/logo.php",
                            Array(),
                            Array("MODE" => "html")
                        );
                        ?>
                    </a>
                </div><!-- #logo end -->
                <div class="hidden-lg hidden-md center phone-header">
                    <?
                    $APPLICATION->IncludeFile(
                        SITE_DIR."include/header/call_number_v2.php",
                        Array(),
                        Array("MODE"=>"html")
                    );
                    ?>
                </div>

    <?if ($headerType == 1) :?>
                <div id="logo-slogan" class="hidden-sm hidden-xs">
                    <?
                    $APPLICATION->IncludeFile(
                        SITE_DIR."include/header/slogan.php",
                        Array(),
                        Array("MODE"=>"html")
                    );
                    ?>
                </div>

                <ul class="header-extras">
                    <li>
                        <div class="he-text">
                            <?
                            $APPLICATION->IncludeFile(
                                SITE_DIR."include/header/call_number_v2.php",
                                Array(),
                                Array("MODE"=>"html")
                            );
                            ?>
                        </div>
                    </li>
                    <li>
                        <?
                        $APPLICATION->IncludeFile(
                            SITE_DIR."include/header/third_col.php",
                            Array(),
                            Array("MODE"=>"html")
                        );
                        ?>
                    </li>
                </ul>
    <?endif;?>

                <?if ($headerType == 1) :?>
            </div><!--container clearfix-->
                    <div id="header-wrap">
                <?endif;?>
                <!-- Primary Navigation
                ============================================= -->
                <nav id="primary-menu" class="<?= $menuClass ?>">
                    <?if ($headerType == 1) :?>
                        <div class="container clearfix">
                    <?endif;?>
                    <?
                    $APPLICATION->IncludeFile(
                        SITE_DIR."include/header/menu.php",
                        Array(),
                        Array(
                            "MODE"=>"html",
                            "SHOW_BORDER" => false
                        )
                    );
                    ?>

                    <? if ($showTopSearch == 'Y'): ?>
                        <!-- Top Search
                        ============================================= -->
                        <div id="top-search">
                            <a href="#" id="top-search-trigger"><i class="icon-search3"></i><i
                                    class="icon-line-cross"></i></a>

                            <form action="<?= SITE_DIR ?>search/" method="get">
                                <input type="text" name="q" class="form-control" value=""
                                       placeholder="<?= Loc::getMessage("SEACTH_LINE") ?>">
                            </form>
                        </div><!-- #top-search end -->
                    <? endif; ?>
                    <?if ($headerType == 1) :?>
                        </div><!--container clearfix-->
                    <?endif;?>
                </nav><!-- #primary-menu end -->
                <?if ($headerType == 1) :?>
                    </div><!--header-wrap-->
                <?endif;?>

    <?if ($headerType == 2) :?>
            </div><!--container clearfix-->
        </div><!--header-wrap-->
    <?endif;?>

    </header><!-- #header end -->

<?
if ($APPLICATION->GetCurPage(true) !== SITE_DIR . "index.php"
    && $APPLICATION->GetDirProperty("hide_breadcrumbs") !== 'Y'
):

    $pageTitleClass = CMarsHelper::getOptionString("boxsol.cosmos", 'page_title', 'nobg');
    if (in_array($pageTitleClass, array("mini", "nobg"))) {
        $pageTitleClass = "page-title-" . $pageTitleClass;
    } else {
        $pageTitleClass = "";
    }
    $pageTitlePosition = CMarsHelper::getOptionString("boxsol.cosmos", 'page_title_pos', 'L');
    if ($pageTitlePosition == "L") {
        $pageTitleClass .= " page-title-left";
    } elseif ($pageTitlePosition == "C") {
        $pageTitleClass .= " page-title-center";
    }
    ?><section id="page-title" class="<?=$pageTitleClass?>">
        <div class="container clearfix">
            <h1 class="nott"><? $APPLICATION->ShowTitle(true) ?></h1>
            <? $APPLICATION->IncludeComponent("bitrix:breadcrumb", "marsd", array(
                "START_FROM" => "0",
                "PATH" => "",
                "SITE_ID" => "-"
            ),
                false,
                Array('HIDE_ICONS' => 'N')
            ); ?>
        </div>
    </section>
<? endif; ?>
<?
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "header",
        "AREA_FILE_RECURSIVE" => "N",
        "EDIT_TEMPLATE" => ""
    ),
    false
);
?><?
$APPLICATION->IncludeComponent(
    "bitrix:main.include",
    ".default",
    Array(
        "AREA_FILE_SHOW" => "page",
        "AREA_FILE_SUFFIX" => "promo",
        "AREA_FILE_RECURSIVE" => "N",
        "EDIT_TEMPLATE" => ""
    ),
    false
);
?>
    <section id="content">
    <div class="content-wrap notoppadding topmargin-sm">
<? if ($APPLICATION->GetCurPage(true) !== SITE_DIR . "index.php" && ($APPLICATION->GetDirProperty("left_sidebar") == 'Y' || $APPLICATION->GetDirProperty("right_sidebar") == 'Y')): ?>
    <div class="container clearfix">
<? endif; ?>
<? if ($APPLICATION->GetDirProperty("left_sidebar") == 'Y'): ?>
    <div class="sidebar nobottommargin clearfix">
        <?
        $APPLICATION->IncludeComponent(
            "bitrix:main.include",
            ".default",
            Array(
                "AREA_FILE_SHOW" => "sect",
                "AREA_FILE_SUFFIX" => "inc",
                "AREA_FILE_RECURSIVE" => "Y",
                "EDIT_TEMPLATE" => ""
            ),
            false
        );
        ?>
        <? $APPLICATION->ShowViewContent('catalog_smart_filter_left'); ?>
    </div>
<? endif; ?>
    <!-- Post Content
    ============================================= -->
<? if ($APPLICATION->GetDirProperty("left_sidebar") == 'Y' && $APPLICATION->GetDirProperty("right_sidebar") == 'Y'): ?>
    <div class="postcontent bothsidebar nobottommargin">
<? elseif ($APPLICATION->GetDirProperty("left_sidebar") == 'Y'): ?>
    <div class="postcontent col_last nobottommargin">
<? elseif ($APPLICATION->GetDirProperty("right_sidebar") == 'Y'): ?>
    <div class="postcontent nobottommargin">
<? else: ?>
    <div class="container nobottommargin">
<? endif; ?>