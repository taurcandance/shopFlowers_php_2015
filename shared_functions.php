<?php

function generatePass($lenght)
{
    $chars    = 'abdefhiknrstyzABDEFGHKNQRSTYZ23456789';
    $numchars = strlen($chars);
    $string   = '';
    for ($i = 0; $i < $lenght; $i++) {
        $string .= substr($chars, rand(1, $numchars) - 1, 1);
    }

    return $string;
}

function print_flowers_as_catalog($flowers)
{
    echo '<div class="row">';
    foreach ($flowers as $item) {
        echo '<div class="col-md-3">';
        echo '<a href="#"><div id="name_flower">'.$item->getname().'</div></a>';
        echo '<a href="#"><img src="'.$item->getphoto().'"></a><br>'.'<div id="dcost"><span id="cost'.$item->getid().'">'.$item->getcost().'</span> руб </div><br>'.$item->getshade().', '.$item->getcover(
            ).', Высота до '.$item->getheight().' см, цвет '.$item->getcolor().'<br><br>';
        echo '<div id="button_transfer_to_basket" value="'.$item->getid().'">Добавить в корзину</div><br><br>';
        echo '</div>';
    }
    echo '</div>';
}

function sanitizeString($var)
{
    $var = strip_tags($var);
    $var = htmlspecialchars($var);
    $var = stripslashes($var);

    return $var;
}

function change_order_status_confirmed($pdo1, $client_id, $client_order_id)
{
    $status  = "confirmed";
    $sql1    = $pdo1->query("select * from flowers_order WHERE ID_order = '$client_order_id' AND ID_user = '$client_id' AND Status_order = 'unconfirmed'");
    $result1 = $sql1->fetchAll();
    if ($result1 == true) {
        $query2 = $pdo1->query(
            "
          Update flowers_order 
          SET    Status_order = '$status' 
          where  ID_order = '$client_order_id' 
          AND    ID_user = '$client_id'"
        );
    }
}

function get_calc_confirmed_order($pdo1, $client_order_id)
{
    $query1           = $pdo1->query(
        "
      select sum(all_total_sum) 
      from   flowers_product_in_order 
      WHERE  ID_order = $client_order_id"
    );
    $result_order_sum = $query1->fetch();

    return $result_order_sum['sum(all_total_sum)'];
}

function send_a_letter($order_id)
{
    $to      = 'zilanet@mail.ru';
    $subject = 'New '.$order_id.' order coming';
    $message = "you have a new order".$order_id;
    mail($to, $subject, $message);
}

function checkIsOld($login, $pass, $conn)
{
    $query = $conn->prepare("SELECT * FROM users WHERE login = '$login'");
    $query->execute();
    $result = $query->fetch();
    if ($result == false) {
        return false;
    }

    $dbpass = $result['password'];
    if (password_verify($pass, $dbpass)) {
        return true;
    } else {
        return false;
    }
}

//function getcookie($personId)
//{
//$cookie_id     = generatePass(255);
//$cookie_hash   = hash('ripemd160', $cookie_id);
//$pdo           = new PDO('mysql:host=localhost;dbname=compstore', 'root', 'zilman666');
//$query         = $pdo->query("
//  UPDATE users 
//  SET    cookieHash = '$cookie_hash' 
//  WHERE  personid = '$personId'");
//$query->execute();
//
//setcookie("cookie_hash","$cookie_hash", time() + 60*60*24*30);
//$query = null;
//$pdo   = null;
//}
//
//function co64($a)
//{
//    $a = base64_encode($a);
//    return $a;
//}
//
//function hscpost($a)
//{
//    $a = htmlspecialchars($_POST["$a"]);
//    return $a;
//}
//
//function de64($a)
//{
//    $a = base64_decode($a);
//    return $a;
//}
//
//function delcookie()
//{
//    setcookie ("ipguest", "", time() - 36000);
//    setcookie ("bro", "", time() - 36000);
//    setcookie ("cookie_id", "", time() - 36000);
//    setcookie ("cookie_hash", "", time() - 36000);
//    header('location:index.php');
//}
//
//function get_name_user() //с проверкой и удалением кук в случае не совпадения куки_хэша
//{
//    if (isset($_COOKIE['cookie_id']) && isset($_COOKIE['cookie_hash']))
//    {
//        $pdo  = new PDO('mysql:host=localhost;dbname=compstore', 'root', 'zilman666');
//        $sql  = $pdo->query("
//          SELECT cookie_hash 
//          FROM   guest 
//          WHERE  cookie_id = '$_COOKIE[cookie_id]'");
//        $res1 = $sql->fetch();
//        if ($_COOKIE['cookie_hash'] !== $res1['cookie_hash'])  //проверяем совпадают ли строка и хэш с БД и кук
//        {
//            setcookie ("ipguest", "", time() - 36000);
//            setcookie ("bro", "", time() - 36000);
//            setcookie ("cookie_id", "", time() - 36000);
//            setcookie ("cookie_hash", "", time() - 36000);
//            header('location:index.php');
//        }
//        else
//        {
//            $old_cookie_id = $_COOKIE['cookie_id'];
//            $bro           = co64($_SERVER['HTTP_USER_AGENT']);
//            $cookie_id     = generatePass(12);
//            $cookie_hash   = hash('ripemd160', $cookie_id);
//            $ip            = co64($_SERVER['REMOTE_ADDR']);
//            $pdo    = new PDO('mysql:host=localhost;dbname=compstore', 'root', 'zilman666');
//            $query1 = $pdo   ->query("
//              UPDATE guest 
//              SET    ipguest='$ip', cookie_id = '$cookie_id', cookie_hash = '$cookie_hash' 
//              WHERE  cookie_id = '$old_cookie_id' ");
//            $query1 -> execute();
//            $query2 = $pdo   ->query("
//              SELECT guestlogin 
//              from guest 
//              WHERE cookie_id = '$cookie_id' ");
//            $query2 -> execute();
//            $res    = $query2->fetchAll();
//            $login  = $res['guestlogin'];
//            $query1 = null;
//            $query2 = null;
//            $res    = null;
//            setcookie("ipguest", "$ip", time() + 60*60*24*30);
//            setcookie("bro", "$bro", time() + 60*60*24*30);
//            setcookie("cookie_id","$cookie_id", time() + 60*60*24*30);
//            setcookie("cookie_hash","$cookie_hash", time() + 60*60*24*30);
//        }
//    }
//}
//
//function check_likes_voice($pdo,$user_name,$num_post)
//{
//    $query_voice = $pdo->query("
//      SELECT * 
//      FROM   likes_table 
//      WHERE  id_post = '$num_post'");
//    $result_voice = $query_voice->fetchAll();
//    $a = "button_li";
//    $b = "button_li_on";
//    foreach ($result_voice as $items)
//    {
//        if (stripos($items['user_likes'], $user_name) === false)
//            {return $a;}
//        else
//            {return $b;}
//    }
//}
//
//function check_dislikes_voice($pdo,$user_name,$num_post)
//{
//    $query_voice = $pdo->query("
//      SELECT * 
//      FROM likes_table 
//      WHERE id_post = '$num_post'");
//    $result_voice = $query_voice->fetchAll();
//    $a = "button_disli";
//    $b = "button_disli_on";
//    foreach ($result_voice as $items)
//    {
//        if (stripos($items['user_dislikes'], $user_name) === false)
//            {return $a;}
//        else
//            {return $b;}
//    }
//}
//
//берёт ордер для корзины товаров по ИД пользователя
//function print_person_id_user($pdo) //
//{
//    if (isset($_COOKIE['cookie_hash']))
//    {
//        $query_for_person = $pdo -> query("
//          select person_id 
//          from   guest 
//          where  cookie_hash = '$_COOKIE[cookie_hash]' ");
//        $row_with_person  = $query_for_person->fetch();
//        $id_order_user    = $row_with_person['person_id'];
//        return $id_order_user;
//    }
//}
//
//function get_name_flower_by_id($pdo1,$id_product)
//{
//    $query_for_flname = $pdo1->query("
//      select flower_name 
//      from   flowers 
//      where  flower_id = '$id_product'");
//    $row_flower_name  = $query_for_flname->fetch();
//    $name_flower      = $row_flower_name['flower_name'];
//    return $name_flower;
//}
//
//function get_cost_flower($pdo1,$id_product)
//{
//    $query_for_cost  = $pdo1->query("
//      select flower_cost 
//      from   flowers 
//      where  flower_id = '$id_product'");
//    $row_flower_cost = $query_for_cost->fetch();
//    $cost_flower     = $row_flower_cost['flower_cost'];
//    return $cost_flower;
//}
//
//function get_person_id($pdo)
//{
//    if (isset ($_COOKIE['cookie_hash']))
//    {
//        $sql    = $pdo->query("
//          select person_id 
//          from   guest 
//          where  cookie_hash = '$_COOKIE[cookie_hash]'");
//        $result = $sql->fetch();
//        return $result['person_id'];
//    }
//    else
//    {
//        $cookie_id   = generatePass(12);
//        $cookie_hash = hash('ripemd160', $cookie_id);
//        $ip          = co64($_SERVER['REMOTE_ADDR']);
//
//        $query = $pdo->prepare("
//        INSERT INTO guest 
//        SET  person_id = null, ipguest = '$ip', cookie_hash = '$cookie_hash'");
//        $query->execute();
//
//        setcookie("cookie_hash",$cookie_hash, time() + 60*60*24*30);
//
//        $sqll    = $pdo->query("
//        select person_id 
//        from   guest 
//        where  cookie_hash = '$_COOKIE[cookie_hash]'");
//        $resultt = $sqll->fetch();
//        return $resultt['person_id'];
//
//        $pdo   = null;
//        $query = null;
//        header('location:catalog-flowers.php');
//    }
//}
//
//function out_bas_res($pdo1,$pdo)
//{
//    $id_user_order     = print_person_id_user($pdo);
//
//    $sql_order    = $pdo1-> query("
//      select ID_order 
//      from   flowers_order 
//      where  ID_user = '$id_user_order' 
//      AND    Status_order='unconfirmed'");
//    $result_order = $sql_order->fetch();
//    $res_ord      = $result_order['ID_order'];
//
//    $products_in_order = $pdo1->query("
//      select * 
//      from  flowers_product_in_order 
//      where ID_order = '$res_ord'");
//    $result1      = $products_in_order->fetchAll();
//    return $result1;
//}
//
//function print_real_id_order($pdo, $pdo1)
//{
//    $id_user      = print_person_id_user($pdo);
//    $query_order  = $pdo1->query("
//      select ID_order 
//      from   flowers_order 
//      WHERE  ID_user = '$id_user' 
//      AND    Status_order = 'unconfirmed'");
//    $result_order = $query_order->fetch();
//    $res_ord      = $result_order['ID_order'];
//    if ($res_ord == null)
//    {
//        $status      = "unconfirmed";
//        $sql         = $pdo1->query("select ID_order from flowers_order");
//        $result      = $sql->fetchAll();
//        $count_order = max($result);//тупо через кол-во эл-ов массива
//        $new_order   = $count_order['ID_order'] + 1;
//
//        $query_new = $pdo1->query("
//          INSERT into flowers_order 
//          SET ID_order = '$new_order', ID_user = '$id_user', Status_order = '$status'");
//        return $new_order;
//    }
//    else
//    {
//    return $res_ord;
//    }
//}
//
//function check_repetition($pdo1,$order_id,$product_id)
//{
//    $ask_isset_in_order = $pdo1->query("
//      select * 
//      from  flowers_product_in_order 
//      where ID_product = '$product_id' 
//      AND   ID_order = '$order_id'");
//    $result_ask = $ask_isset_in_order->fetch();
//    return $result_ask;
//}
//
//function get_order_id($pdo1,$user_id)
//{
//    $sql    = $pdo1->query("
//      select ID_order 
//      from flowers_order 
//      where ID_user = '$user_id' 
//      AND Status_order = 'unconfirmed'");
//    $result = $sql->fetch();
//    if ($result == true)
//    {
//      return $result['ID_order'];
//    }
//    else
//    {
//        $status      = "unconfirmed";
//        $sql1        = $pdo1->query("select ID_order from flowers_order");
//        $result1     = $sql1->fetchAll();
//        $count_order = max($result1);//тупо через кол-во эл-ов массива
//        $new_order   = $count_order['ID_order'] + 1;
//
//        $query = $pdo1->query("
//          INSERT into flowers_order 
//          SET ID_order = '$new_order', ID_user = '$user_id', Status_order = '$status'");
//        return $new_order;
//    }
//}
//
//function check_status_Dislike($pdo,$dis_user_name,$num_post)
//{
//    $query  = $pdo  ->query("
//      SELECT * 
//      FROM  likes_table 
//      WHERE id_post = '$num_post'");
//    $result = $query->fetch();
//    if (stripos($result['user_dislikes'], $dis_user_name) === false)
//    {return true;}
//    else
//    {return false;}
//}
//
//function check_status_Like($pdo,$user_name,$num_post)
//{
//    $query  = $pdo  ->query("
//      SELECT * 
//      FROM  likes_table 
//      WHERE id_post = '$num_post'");
//    $result = $query->fetch();
//    if (stripos($result['user_likes'], $user_name) === false)
//    {return true;}
//    else
//    {return false;}
//}