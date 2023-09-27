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
$entityClass = $_GET['entity'];

\Bitrix\Main\Loader::IncludeModule('crm');

$classList = [
    'CRM_LEAD' => \Bitrix\Crm\LeadTable::class,
    'CRM_CONTACT' => \Bitrix\Crm\ContactTable::class,
    'CRM_COMPANY' => \Bitrix\Crm\CompanyTable::class,
    'CRM_DEAL' => \Bitrix\Crm\DealTable::class,
    'CRM_QUOTE' => \Bitrix\Crm\QuoteTable::class,
];

$table = $classList[$entityType];
$entityList = $table::getList()->fetchAll();

$request = \Bitrix\Main\Application::getInstance()->getContext()->getRequest();
$path = $request->getRequestedPageDirectory() . '/template';
$params = $request->getQueryList()->toArray();

$uri = new \Bitrix\Main\Web\Uri($path);
$uri->addParams($params);
$url = $uri->getUri();
?>

<ul class="list-group">
    <?php foreach($entityList as $entity): ?>
        <?php
        if($table === \Bitrix\Crm\ContactTable::class) {
            $entityName = implode(' ', array_filter([$entity['LAST_NAME'], $entity['NAME'], $entity['SECOND_NAME']]));
        } else {
            $entityName = $entity['TITLE'];
        }

        ?>
        <li class="list-group-item text-center">
            <a href="<?=$url?>&id=<?=$entity['ID']?>" class="bizproc__link">[<?=$entity['ID']?>] <?=$entityName?></a>
        </li>
    <?php endforeach ?>
</ul>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>