<?php

use Bitrix\Main\Web\Uri;

require($_SERVER['DOCUMENT_ROOT'] . '/mobile/headers.php');
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?php
$entityType = $_GET['type'];
$entityId = $_GET['id'];

CModule::IncludeModule('bizproc');
global $USER;

$moduleId = 'crm';
$entity = $_GET['entity'];
[$crm, $documentType] = explode('_', $entityType);
unset($crm);

$documentId = $documentType . '_' . $entityId;
$userId = $USER->getId();

$typeArray = [$moduleId, $entity, $documentType];
$documentIdArray = $documentId ? [$moduleId, $entity, $documentId] : null;

$documentStates = \CBPDocument::GetDocumentStates($typeArray, $documentIdArray);
$userGroups = $USER->GetUserGroupArray();

$templateList = \CBPDocument::getTemplatesForStart($userId, $typeArray, $documentIdArray, [
    "UserGroups" => $userGroups,
    "DocumentStates" => $documentStates
]);

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$path = $request->getRequestedPageDirectory() . '/form';
$params = $request->getQueryList()->toArray();

$uri = new Uri($path);
$uri->addParams($params);
$url = $uri->getUri();

?>

<h1>Шаблон</h1>
<ul>
    <?php foreach($templateList as $template): ?>
        <li>
            <a href="<?=$url?>&template_id=<?=$template['id']?>"><?=$template['name']?></a>
        </li>
    <?php endforeach ?>
</ul>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>