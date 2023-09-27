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
$documentId = $documentType . '_' . $entityId;

$APPLICATION->IncludeComponent("skillline:bizproc.workflow.start",
    'modern',
    [
        'MODULE_ID' => 'crm',
        'ENTITY' => $entity,
        'DOCUMENT_TYPE' => $documentType,
        'DOCUMENT_ID' => $documentId,
        'TEMPLATE_ID' => $templateId,
    ]
);
?>

<script>
    BX.namespace('BizProcMobile');
    BX.BizProcMobile.showDatePicker = function(scope, event)
    {
        var format = 'M/d/y H:m';
        var wrapper = scope.parentNode;
        var input = BX.findChild(wrapper, {tag: 'input'});
        var type = input.getAttribute('data-type') === 'date'? 'date' : 'datetime';
        var pickerParams = {
            type: type,
            format: format,
            callback: function(value)
            {
                var d = new Date(Date.parse(value));
                var siteFormat = type === 'date' ? BX.message('FORMAT_DATE') : BX.message('FORMAT_DATETIME');
                var formatted = BX.formatDate(d, siteFormat);

                input.value = formatted;
                scope.innerHTML = formatted;
            }
        };
        BXMobileApp.UI.DatePicker.setParams(pickerParams);
        BXMobileApp.UI.DatePicker.show();
        return BX.PreventDefault(event);
    };
</script>

<?php require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>

