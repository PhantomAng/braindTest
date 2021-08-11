<?php
AddEventHandler('main', 'OnBeforeEventSend', Array("MyObr", "PickupAddress"));
use  \Bitrix\Catalog;
define('idDelivery', 3); //идентификатор службы доставки самовывоз

class MyObr
{
    function PickupAddress(&$arFields, &$arTemplate)
    {
        if($arTemplate['EVENT_NAME'] === 'SALE_NEW_ORDER')
        {

            $id = $arFields['ORDER_REAL_ID'];
            $order = \Bitrix\Sale\Order::load($id);
            $shipment = $order->getDeliveryIdList();
            foreach ($shipment as $sh)
            {
                $idDelivery = $sh;
            }
            if($idDelivery == idDelivery)
            {
                $storeId = false;
                foreach ($order->getShipmentCollection() as $col)
                {
                    $storeId = $col->getStoreId();
                    if($storeId) break;
                }
                if($storeId)
                {
                    $arStore = Catalog\StoreTable::getRow(
                        [
                            'select'=>['ADDRESS'],
                            'filter'=>[
                                'ID'=>$storeId,
                            ]
                        ]
                    );
                }
                $arFields += array("ADDRESS_PICKUP"=>'Адрес пункта самовывоза: '.$arStore['ADDRESS']);
            }
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