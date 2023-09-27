<?php

use Bitrix\Main\Web\Uri;

require($_SERVER['DOCUMENT_ROOT'] . '/mobile/headers.php');
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

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

$uri = new Uri($path);
$uri->addParams($params);
$url = $uri->getUri();

?>

<h1>Сущность</h1>
<ul>
    <?php foreach($entityList as $entity): ?>
        <?php
        if($table === \Bitrix\Crm\ContactTable::class) {
            $entityName = implode(' ', array_filter([$entity['LAST_NAME'], $entity['NAME'], $entity['SECOND_NAME']]));
        } else {
            $entityName = $entity['TITLE'];
        }

        ?>
        <li>
            <a href="<?=$url?>&id=<?=$entity['ID']?>">[<?=$entity['ID']?>] <?=$entityName?></a>
        </li>
    <?php endforeach ?>
</ul>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>