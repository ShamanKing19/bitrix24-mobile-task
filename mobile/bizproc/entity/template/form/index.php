<?php

require($_SERVER['DOCUMENT_ROOT'] . '/mobile/headers.php');
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

?>

<?php

$entityType = $_GET['type'];
$entityId = $_GET['id'];
$templateId = $_GET['template_id'];


$entity = $_GET['entity'];
[$crm, $documentType] = explode('_', $entityType);
unset($crm);

$documentId = $documentType . '_' . $entityId;


?>

<?php
$APPLICATION->IncludeComponent("skillline:bizproc.workflow.start",
    'modern',
    [
        "MODULE_ID" => 'crm',
        "ENTITY" => $entity,
        "DOCUMENT_TYPE" => $documentType,
        "DOCUMENT_ID" => $documentId,
        "TEMPLATE_ID" => $templateId,
//        "AUTO_EXECUTE_TYPE" =>
    ]
);
?>

<?php

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
require($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/prolog_after.php");
require($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/include/epilog.php");

?>

