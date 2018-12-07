<?php
require_once 'class_BasketNode.php';

class OrdersManager extends BasketNode
{
    private $orderForManager;

    public function getOrderForManager()
    {
        return $this->orderForManager;
    }

    public function setOrderForManager($orderForManager)
    {
        $this->orderForManager = $orderForManager;
    }


    public function loadUnconfirmedOrder($userId, $connection)
    {
        $getOrderId = $connection->query(
            "
            SELECT id_order 
            FROM flowers_order 
            WHERE id_user = '$userId' 
            AND status_order = 'unconfirmed' "
        );
        $res        = $getOrderId->fetch();
        if ($res) {
            $order                 = ($res['id_order']);
            $this->orderForManager = $order;
            $getOrderList          = $connection->query(
                " 
                SELECT 
                      ID_order          as orderId,
                      ID_product        as productId,
                      quantity_products as productQuantity,
                      selecttime        as datatime,
                      cost              as productCost,
                      all_total_sum     as productSum
                FROM flowers_product_in_order 
                WHERE ID_order = '$order' "
            )->fetchAll(PDO::FETCH_CLASS, 'BasketNode');

            return $getOrderList;
        } else {
            return null;
        }
    }

    public function loadConfirmedOrder($userId, $connection)
    {
        $getOrderId = $connection->query(
            "
            SELECT id_order 
            FROM flowers_order 
            WHERE id_user = '$userId' 
            AND status_order = 'confirmed' "
        );
        $res        = $getOrderId->fetchAll();
        if ($res) {
            $ara = [];
            $i   = 0;
            foreach ($res as $item) {

                $order                 = ($item['id_order']);
                $this->orderForManager = $order;

                $query = $connection->query(
                    "
                SELECT 
                      ID_order          as orderId,
                      ID_product        as productId,
                      quantity_products as productQuantity,
                      selecttime        as datatime,
                      cost              as productCost,
                      all_total_sum     as productSum
                FROM flowers_product_in_order 
                WHERE ID_order = '$order' "
                )->fetchAll(PDO::FETCH_CLASS, 'BasketNode');

                $ara[$i] = $query;
                $i++;
            }

            return $ara;
        } else {
            return null;
        }
    }

//    public function saveChangeQuant($connection)
//    {
//        $saveQuan = $connection->query("
//            UPDATE  flowers_product_in_order
//            SET     quantity_products = $this->getProductQuant() + 1,
//                    all_total_sum     = $this->getProductQuant()*$this->getProductCost()
//            WHERE   ID_order          = $this->orderForManager
//            AND     ID_product        = $this->$this->getProductId() ");
//        if ($saveQuan == false){return false;}
//    }
//
}