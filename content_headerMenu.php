<?php

function print_header_menu()
{
    $user = SiteManager::getInstance()->getUser();
    if($user->getLogin() == "")
    {
        $user_name = "";
        $page = "Войти";
        $href = "page_login.php";
    }
    else
    {
        $page = "Личный кабинет";
        $user_name = $user->getLogin();
        $user_name = substr($user_name, 0, 5)."";
        $user_name = " (".$user_name.")";
        $href = "page_historyOfOrders.php";
    }
    
    echo '
    <div class="container-fluid">
        <div id="header-menu">
            <div class="row">
                <div class="col-xs-6 col-sm-3"><a href="index.php"><h2>Каталог</h2></a></div>
                <div class="col-xs-6 col-sm-3"><a href="page_contacts.php"><h2>Доставка / О нас</h2></a></div>
                <div class="col-xs-6 col-sm-3"><a href="page_basket.php"><h2>Корзина</h2></a></div>
                <div class="col-xs-6 col-sm-3"><a href="'.$href.'"><h2>'.$page.$user_name.'</h2></a></div>
            </div>
        </div>
    </div>
    ';
}