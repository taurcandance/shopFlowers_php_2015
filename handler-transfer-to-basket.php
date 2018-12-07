<?php
require_once 'shared_functions.php';
require_once 'user_initial.php';
require_once 'class_CollectorOrders.php';

$user      = SiteManager::getInstance()->getUser();
$collector = $user->getCurrOrder();
$dbConnect = SiteManager::getInstance()->getConnection();

if (isset($_GET['id_product']) && isset($_GET['product_cost']) && isset($_COOKIE['cookieHash'])) {
    $product_id   = sanitizeString($_GET['id_product']);
    $user_id      = sanitizeString($_GET['id_user']);
    $product_cost = sanitizeString($_GET['product_cost']);

    $collector->setProductId($product_id);
    $collector->init($dbConnect);

    if ($collector->checkRepetition($dbConnect)) {
        $outp = '[{"Answer":"Этот товар уже есть в корзине!"}]';
        echo $outp;

        return;
    } else {
        $quantity_products = 1;
        $collector->setUserId($user->getPersonId());
        $collector->setCostProduct($product_cost);
        $collector->setQuanFlower($quantity_products);

        $collector->addToBasket($dbConnect);
        $outp = '[{"Answer":"Успешно добавлено в корзину!"}]';
        echo $outp;

        return;
    }
}
$outp = '[{"Answer":"Что то пошло не так!"}]';
echo $outp;