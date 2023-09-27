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

<ul class="list-group">
    <?php foreach($entityList as $entity): ?>
        <li class="list-group-item text-center">
            <a href="entity?type=<?=$entity['ID']?>&entity=<?=$entity['ENTITY']?>" class="bizproc__link"><?=$entity['NAME']?></a>
        </li>
    <?php endforeach ?>
</ul>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>