<?php
require($_SERVER['DOCUMENT_ROOT'] . '/mobile/headers.php');
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/header.php');

$bizproc = new Bizproc();
$bizproc->clearCache();

$processList = $bizproc->getList();

?>

<ul class="business-process__wrapper">
    <?php foreach($processList as $process): ?>
        <li class="business-process__item">
            <a href="create?iblock_id=<?=$process['ID']?>" class="business-process__link"><?=$process['NAME']?></a>
        </li>
    <?php endforeach ?>
</ul>

<style>
    .business-process__wrapper {
        padding: 12px;
        margin: 0 auto;
        list-style-type: none;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .business-process__item {
        max-width: 100%;
        min-height: 50px;
        padding: 10px;
        text-align: center;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 1px solid #b6cbd0;
        border-radius: 10px;
        background-color: #d3e6f9;
    }

    .business-process__item:active {
        background: #a4cff9;
    }

    .business-process__link {
        font-size: 24px;
        color: rgb(32, 103, 176);
    }
</style>

<?php
class Bizproc
{
    private string $iblockType = 'bitrix_processes';

    public function getList() : array
    {
        $request = \Bitrix\Iblock\IblockTable::getList([
            'filter' => ['IBLOCK_TYPE_ID' => $this->iblockType]
        ]);

        return $request->fetchAll();
    }


    public function clearCache() : void
    {
        BXClearCache(true);
        if(class_exists(\Bitrix\Main\Data\ManagedCache::class)) {
            (new \Bitrix\Main\Data\ManagedCache())->cleanAll();
        }

        if(class_exists(\CStackCacheManager::class)) {
            (new \CStackCacheManager())->CleanAll();
        }

        if(class_exists(\Bitrix\Main\Data\StaticHtmlCache::class)) {
            \Bitrix\Main\Data\StaticHtmlCache::getInstance()->deleteAll();
        }
    }
}
?>

<?php require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/footer.php')?>