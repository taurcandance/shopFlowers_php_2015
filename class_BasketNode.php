<?php
require_once 'class_SiteManager.php';

class BasketNode
{
    private $orderId;
    private $productId;
    private $productName;
    private $productQuantity;
    private $datatime;


    private $productCost;
    private $productSum;

    function __construct()
    {
        $connection        = SiteManager::getInstance()->getConnection();
        $this->productName = self::getNameById($this->productId, $connection);
    }

    private static function getNameById($id_product, $conn)
    {
        $query_for_flname = $conn->query(
            "
            select flower_name 
            from   flowers 
            where  flower_id = '$id_product'"
        );
        $row_flower_name  = $query_for_flname->fetch();
        $name_flower      = $row_flower_name['flower_name'];

        return $name_flower;
    }

    /* set*/
    public function setProductId($productId)
    {
        $this->productId = $productId;
    }

    public function setProductName($productName)
    {
        $this->productName = $productName;
    }

    public function setProductQuant($productQuant)
    {
        $this->productQuantity = $productQuant;
    }

    public function setProductCost($productCost)
    {
        $this->productCost = $productCost;
    }

    public function setProductSum($productSum)
    {
        $this->productSum = $productSum;
    }

    /* get */
    public function getOrderId()
    {
        return $this->orderId;

    }

    public function getProductId()
    {
        return $this->productId;
    }

    public function getProductName()
    {
        return $this->productName;
    }

    public function getProductQuant()
    {
        return $this->productQuantity;
    }

    public function getProductCost()
    {
        return $this->productCost;
    }

    public function getProductSum()
    {
        return $this->productSum;
    }

    public function getDatatime()
    {
        return $this->datatime;
    }
}
