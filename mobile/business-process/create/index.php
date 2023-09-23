<?php
require($_SERVER['DOCUMENT_ROOT'] . '/mobile/headers.php');
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?php
$APPLICATION->IncludeComponent(
    'skillline:lists.element.edit',
    '',
    [
        'IBLOCK_TYPE_ID' => 'bitrix_processes',
        'IBLOCK_ID' => $_GET['iblock_id'],
    ]
);
?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php'); ?>