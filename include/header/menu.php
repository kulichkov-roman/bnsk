<? $APPLICATION->IncludeComponent("bitrix:menu", "horizontal_multilevel", array(
    "ROOT_MENU_TYPE" => "top",
    "MAX_LEVEL" => "3",
    "CHILD_MENU_TYPE" => "left",
    "USE_EXT" => "Y",
    "MENU_CACHE_TYPE" => "A",
    "MENU_CACHE_TIME" => "36000000",
    "MENU_CACHE_USE_GROUPS" => "Y",
    "MENU_CACHE_GET_VARS" => ""
),
    false,
    array(
        "HIDE_ICONS" => "Y",
        "ACTIVE_COMPONENT" => "Y"
    )
); ?>