<?php

class CollectorOrders
{
    private $orderId;
    private $userId;
    private $costProduct;
    private $productId;
    private $dataTime;
    private $quantityProduct;
    private $status;

    function __construct($userId)
    {
        $this->status = "unconfirmed";
        $this->orderId;
        $this->userId = $userId;
        $this->dataTime;
        $this->costProduct;
        $this->productId;
        $this->quantityProduct;
    }

    public function getstatus()
    {
        return $this->status;
    }

    public function getQuanProduct()
    {
        return $this->quantityProduct;
    }

    public function getOrderId()
    {
        return $this->orderId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getCostProduct()
    {
        return $this->costProduct;
    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getDataTime()
    {
        return $this->dataTime;
    }


    public function setStatus($status)
    {
        $this->status = $status;
    }

    public function setQuanFlower($quanFlow)
    {
        $this->quantityProduct = $quanFlow;
    }

    public function init($connection)
    {
        $this->orderId = $this->giveOrderId($connection);
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function setCostProduct($costProduct)
    {
        $this->costProduct = $costProduct;
    }

    public function setProductId($productId)
    {
        $this->productId = $productId;
    }


    public function addToBasket($connection)
    {
        $insertFlowerstoBasket = $connection->query(
            "
        INSERT into flowers_product_in_order 
        SET ID_order          = '$this->orderId' ,
            ID_product        = '$this->productId',
            cost              = '$this->costProduct',
            quantity_products = '$this->quantityProduct',
            all_total_sum     = ('$this->quantityProduct' * '$this->costProduct')"
        );
    }

    public function checkRepetition($connection)
    {
        $ask_isset_in_order = $connection->query(
            "
        SELECT *
        FROM  flowers_product_in_order 
        WHERE ID_product = '$this->productId' 
        AND   ID_order = '$this->orderId'"
        );
        $res                = $ask_isset_in_order->fetch();
        if ($res) {
            return true;
        } else {
            return false;
        }
    }

    public function giveOrderId($connection)
    {
        $getOrderId = $connection->query(
            "
        SELECT id_order 
        FROM flowers_order 
        WHERE id_user = '$this->userId' 
        AND status_order = 'unconfirmed' "
        );
        $res        = $getOrderId->fetch();
        if ($res) {
            return $res['id_order'];
        } else {
            $sql           = $connection->query("select * from flowers_order");
            $result        = $sql->fetchAll();
            $count_order   = count($result);
            $new_order     = ++$count_order;
            $this->orderId = $new_order;
            $this->createNodeInOrders($connection);

            return $new_order;
        }
    }

    public function createNodeInOrders($connection)
    {
        $create_order = $connection->query(
            "
        INSERT into flowers_order 
        SET id_order     = '$this->orderId' ,
            id_user      = '$this->userId',
            status_order = '$this->status',
            cost_total   = '0',
            count_order  = null; "
        );
    }
}