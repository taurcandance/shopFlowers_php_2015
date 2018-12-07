<?php
require_once 'shared_functions.php';
require_once 'connection_Db.php';

if (isset($_GET['id_product_up']) && isset($_GET['id_order'])) {
    $product_id = sanitizeString($_GET['id_product_up']);
    $order_id   = sanitizeString($_GET['id_order']);

    $query_update_quantity_product = $pdo1->query(
        "
    UPDATE flowers_product_in_order 
    SET    quantity_products = quantity_products + 1,
           all_total_sum = quantity_products*cost
    WHERE  ID_order = $order_id 
    AND    ID_product = $product_id"
    );


    $query_new_quantity_product = $pdo1->query(
        "
    SELECT quantity_products 
    FROM   flowers_product_in_order
    WHERE  ID_order = $order_id
    AND    ID_product = $product_id"
    );
    $result                     = $query_new_quantity_product->fetch();
    $number_q_pr                = $result['quantity_products'];

    $outp = '[{"Answer":"'.$number_q_pr.'"}]';
    echo $outp;
    $pdo = null;
} elseif (isset($_GET['id_product_down']) && isset($_GET['id_order'])) {
    $product_id = sanitizeString($_GET['id_product_down']);
    $order_id   = sanitizeString($_GET['id_order']);

    $query_update_quantity_product = $pdo1->query(
        "
    UPDATE flowers_product_in_order 
    SET    quantity_products = quantity_products - 1, 
           all_total_sum = quantity_products*cost          
    WHERE  ID_order = $order_id 
    AND    ID_product = $product_id"
    );

    $query_new_quantity_product = $pdo1->query(
        "
    SELECT quantity_products 
    FROM   flowers_product_in_order
    WHERE  ID_order = $order_id
    AND    ID_product = $product_id"
    );
    $result                     = $query_new_quantity_product->fetch();
    $number_q_pr                = $result['quantity_products'];

    $outp = '[{"Answer":"'.$number_q_pr.'"}]';
    echo $outp;
    $pdo = null;
}