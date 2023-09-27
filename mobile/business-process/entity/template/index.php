<?php
require($_SERVER['DOCUMENT_ROOT'] . '/mobile/headers.php');
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
<style>
    .bizproc__link {
        width: 100%;
        height: 100%;
        font-size: 24px;
        text-decoration: none;
        color: black;
        display: block;
    }
</style>

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

$uri = new \Bitrix\Main\Web\Uri($path);
$uri->addParams($params);
$url = $uri->getUri();
?>

<ul class="list-group">
    <?php foreach($templateList as $template): ?>
        <li class="list-group-item text-center">
            <a href="<?=$url?>&template_id=<?=$template['id']?>" class="bizproc__link"><?=$template['name']?></a>
        </li>
    <?php endforeach ?>
</ul>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>