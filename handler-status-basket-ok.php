<?php
require_once 'connection_Db.php';
require_once 'shared_functions.php';
require_once 'user_initial.php';
require_once 'class_OrdersManager.php';


$user         = SiteManager::getInstance()->getUser();
$dbConnect    = SiteManager::getInstance()->getConnection();
$orderManager = new OrdersManager();
$orderList    = $orderManager->loadUnconfirmedOrder($user->getPersonId(), $dbConnect);

$client_id       = $user->getPersonId();
$client_order_id = $orderManager->getOrderForManager();

if ( ! empty($_GET['FIO']) && ! empty($_GET['Adress']) && ! empty($_GET['Telephones'])) {
    $client_order_id  = sanitizeString($client_order_id);
    $client_id        = sanitizeString($client_id);
    $client_fio       = sanitizeString($_GET['FIO']);
    $client_adress    = sanitizeString($_GET['Adress']);
    $client_telephone = sanitizeString($_GET['Telephones']);
    $client_email     = sanitizeString($_GET['email']);
    $client_comments  = sanitizeString($_GET['Comments']);
    $client_total_sum = get_calc_confirmed_order($pdo1, $client_order_id);

    $query = $pdo1->query(
        "
      INSERT into flowers_clients 
      SET client_id        = '$client_id' ,
          client_order_id  = '$client_order_id',
          client_name      = '$client_fio',
          client_adress    = '$client_adress',
          client_telephone = '$client_telephone',
          client_total_sum = '$client_total_sum',
          client_comments  = '$client_comments',
          client_email     = '$client_email'"
    );

    change_order_status_confirmed($pdo1, $client_id, $client_order_id);

    $sql2 = $pdo1->query(
        "
      UPDATE flowers_order 
      SET    total_cost = '$client_total_sum' 
      where  ID_order   = '$client_order_id' 
      AND    ID_user    = '$client_id'"
    );

    send_a_letter($client_order_id);
}
header('location:/page_basket.php');