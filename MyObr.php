<?php
AddEventHandler('main', 'OnBeforeEventSend', Array("MyObr", "PickupAddress"));

class MyObr
{

    function PickupAddress(&$arFields, &$arTemplate)
    {
        if($arTemplate['EVENT_NAME'] === 'SALE_NEW_ORDER')
        {
            $date = serialize($arFields);
            file_put_contents($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/include/text1.txt", $date);
            $id = $arFields['ORDER_REAL_ID'];
            $order = \Bitrix\Sale\Order::load($id);
            $shipment = $order->getDeliveryIdList();
            foreach ($shipment as $sh)
            {
                $idDelivery = $sh;
            }
            file_put_contents($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/include/text1.txt", $idDelivery);
            if($idDelivery == 3)
            {
                $arFields += array("ADDRESS_PICKUP"=>'Адрес пункта самовывоза: ул.Ленина 17, 3 этаж, офис 43');
            }
            $temp = serialize($arFields);
            file_put_contents($_SERVER['DOCUMENT_ROOT']."/bitrix/php_interface/include/text1.txt", $temp);
        }
        elseif($arTemplate['EVENT_NAME'] === 'SALE_STATUS_CHANGED_F'){
            $id = $arFields['ORDER_REAL_ID'];
            $order = \Bitrix\Sale\Order::load($id);

            $idUser = $order->getUserId();
            $user = new CUser();
            $params = array(
                'PERSONAL_COUNTRY'=>'',
                'PERSONAL_STATE'=>'',
                'PERSONAL_CITY'=>'',
                'PERSONAL_ZIP'=>'',
                'PERSONAL_STREET'=>'',
                'PERSONAL_MAILBOX'=>'',
                'PERSONAL_NOTES'=>''
            );
            $user->Update($idUser, $params);
        }
    }

}