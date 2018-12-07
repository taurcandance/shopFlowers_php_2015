<?php
require_once 'class_OrdersManager.php';

function print_history()
{
    $user         = SiteManager::getInstance()->getUser();
    $dbConnect    = SiteManager::getInstance()->getConnection();
    $orderManager = new OrdersManager();
    $orderList    = $orderManager->loadConfirmedOrder($user->getPersonId(), $dbConnect);

    if (is_null($orderList)) {
        echo '
        <div class="container-fluid" id="history_content">
            <span id="name_flower"> Исполненых заказов не найдено</span>
        </div>';

        return;
    }
    $i = 0;
    foreach ($orderList as $node) {
        echo '
        
        <div class="container-fluid" id="history_content">
            <span id="name_flower">Номер заказа '.$node[$i]->getOrderId().'</span><span id="name_flower"> от '.$node[$i]->getDatatime().'</span>    
            <div class="row" id="str-tbl">
                
                <div class="col-md-2" id="header_table_history">
                    Наименование растения
                </div>
            
                <div class="col-md-2" id="header_table_history">
                    Количество
                </div>
            
                <div class="col-md-2" id="header_table_history">
                    Цена
                </div>
            
                <div class="col-md-6" id="header_table_history">
                    Сумма
                </div>
            
            </div>';

        foreach ($node as $item) {
            echo '<div class="row" id="str-tbl">
                
                <div class="col-md-2">
                    '.$item->getProductName().'
                </div>
                
                <div class="col-md-2">
                    '.$item->getProductQuant().'
                </div>
                
                <div class="col-md-2">
                    '.$item->getProductCost().'
                </div>
                
                <div class="col-md-6">
                    '.round($item->getProductSum(), 2).'
                </div>
                
            </div>';
        }
    }
    echo '</div>
    ';
}