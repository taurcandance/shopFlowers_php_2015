<?php
require_once 'shared_functions.php';
require_once 'connection_Db.php';

if (isset($_GET['id_product_del']) && isset($_GET['id_order'])) {
    $num_order   = sanitizeString($_GET['id_order']);
    $id_prod_del = sanitizeString($_GET['id_product_del']);

    $query_delete_product_in_order = $pdo1->query(
        "
            Delete from flowers_product_in_order  
            where ID_order=$num_order 
            AND ID_product=$id_prod_del"
    );

    $outp = '[{"Answer":"Товар удален"}]';
    echo $outp;
    $pdo = null;
} else {
    $outp = '[{"Answer":"Произошла ошибка - не получилось удалить"}]';
    echo $outp;
    $pdo = null;
}