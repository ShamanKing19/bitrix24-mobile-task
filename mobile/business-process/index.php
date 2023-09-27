<?php
require($_SERVER['DOCUMENT_ROOT'] . '/mobile/headers.php');
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');
?>

<?php
$entityList = [
    'CRM_LEAD' => [
        'ID' => 'CRM_LEAD',
        'ENTITY' => 'CCrmDocumentLead',
        'NAME' => 'Лид',
        'DESC' => 'Шаблоны бизнес-процессов для "Лидов"'
    ],
    'CRM_CONTACT' => [
        'ID' => 'CRM_CONTACT',
        'ENTITY' => 'CCrmDocumentContact',
        'NAME' => 'Контакт',
        'DESC' => 'Шаблоны бизнес-процессов для "Контактов"'
    ],
    'CRM_COMPANY' => [
        'ID' => 'CRM_COMPANY',
        'ENTITY' => 'CCrmDocumentCompany',
        'NAME' => 'Компания',
        'DESC' => 'Шаблоны бизнес-процессов для "Компаний"'
    ],
    'CRM_DEAL' => [
        'ID' => 'CRM_DEAL',
        'ENTITY' => 'CCrmDocumentDeal',
        'NAME' => 'Сделка',
        'DESC' => 'Шаблоны бизнес-процессов для "Сделок"'
    ],
    'CRM_QUOTE' => [
        'ID' => 'CRM_QUOTE',
        'ENTITY' => 'CCrmDocumentQuote',
        'NAME' => 'Коммерческое предложение',
        'DESC' => 'Шаблоны бизнес-процессов для "Коммерческих предложений"',
    ],
];
?>

<h1>Тип сущности</h1>
<ul>
    <?php foreach($entityList as $entity): ?>
        <li>
            <a href="entity?type=<?=$entity['ID']?>&entity=<?=$entity['ENTITY']?>"><?=$entity['NAME']?></a>
        </li>
    <?php endforeach ?>
</ul>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>