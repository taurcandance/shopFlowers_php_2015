<?php
require_once 'user_initial.php';
require_once 'content_head_and_scripts.php';
require_once 'content_logo.php';
require_once 'content_headerMenu.php';
require_once 'content_footer.php';
require_once 'class_OrdersManager.php';


$user         = SiteManager::getInstance()->getUser();
$dbConnect    = SiteManager::getInstance()->getConnection();
$orderManager = new OrdersManager();
$orderList    = $orderManager->loadUnconfirmedOrder($user->getPersonId(), $dbConnect);

if (is_null($orderList) or empty($orderList)) {
    header('location:index.php');
}
print_head_and_scripts(); ?>

    <link rel="stylesheet" type="text/css" href="css/basket.css">
    <script type="text/javascript" src="js/publicScripts/jquery-3.2.1.js"></script>
    <script type="text/javascript" src="js/internalScripts/transfer-to-basket.js"></script>
    <script type="text/javascript" src="js/internalScripts/quantity-up-basket.js"></script>
    <script type="text/javascript" src="js/internalScripts/quantity-down-basket.js"></script>
    <script type="text/javascript" src="js/internalScripts/handler-butt-delete-in-basket.js"></script>
    <script type="text/javascript" src="js/internalScripts/calc-sum-prod-basket.js"></script>
    <script type="text/javascript" src="js/internalScripts/calc-total-basket.js"></script>

<?php print_logo();
print_header_menu(); ?>

    <div class="container-fluid" id="basket_content">
        <div class="container-1">
            <div class="box_contact_us">
                <h2>Корзина товаров <span id="num_order_span">(заказ №<span id="num_order"><?php echo $orderManager->getOrderForManager(); ?></span>)</span></h2>
            </div>
        </div>

        <div class="container-1">
            <div class="box_contact_us">
                <span id="box_contact_us_span"><h3>Наши контакты: г. Гродно, Центральный рынок; мтс 8-029-5812152</h3></span>
            </div>
        </div>

        <div class="container-1">
            <div class="box-1">

                <div class="box">
                    <h3>№</h3>
                </div>

                <?php // просто вывод нумерации по кол-ву позиций товаров
                $i = 0;
                foreach ($orderList as $item) {
                    $i++;
                    echo '<div class="box" value = "'.$i.'">';
                    echo '<h3><span name="poz" value="'.$i.'">'.$i.'</span></h3>';
                    echo '</div>';
                }
                ?>

            </div>

            <div class="box-2">
                <div class="box">
                    <h3>Наименование товара</h3>
                </div>

                <?php
                $i = 0;
                foreach ($orderList as $item) {
                    $i++;
                    echo '<div class = "box" value="'.$i.'">';
                    echo '<h3>&emsp;'.$item->getProductName().'</h3>';
                    echo '</div>';
                }
                ?>
            </div>

            <div class="box-3">
                <div class="box">
                    <h3>Количество</h3>
                </div>

                <?php
                $i = 0;
                foreach ($orderList as $item) {
                    $i++;
                    echo '<div class="box" value="'.$i.'">';
                    echo '<h3><span class="but_up" value="'.$item->getProductId().'"></span>';
                    echo '<span name ="quantity" value="'.$item->getProductQuant().'" id="quant'.$item->getProductId().'">'.$item->getProductQuant().'</span>';
                    echo '<span class="but_down" value="'.$item->getProductId().'"></span></h3>';
                    echo '</div>';
                }
                ?>
            </div>

            <div class="box-4">
                <div class="box">
                    <h3>Цена</h3>
                </div>

                <?php
                $i = 0;
                foreach ($orderList as $item) {
                    $i++;
                    echo '<div class="box" value="'.$i.'">';
                    echo '<h3><span name="cost_prod" id="cost_prod'.$item->getProductId().'">'.$item->getProductCost().'</span></h3>';
                    echo '</div>';
                }
                ?>
            </div>

            <div class="box-5">
                <div class="box">
                    <h3>Сумма</h3>
                </div>

                <?php
                $i = 0;
                foreach ($orderList as $item) {
                    $i++;
                    echo '<div class="box" value="'.$i.'">';
                    echo '<h3><span class="cost" name="cost_poz" value="'.$i.'" id="sum_prod'.$item->getProductId().'">'.$item->getProductSum().'</span> руб
                <span class="but_del" value="'.$item->getProductId().'"></span></h3>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>

        <div class="container-1">
            <div class="box-summ">
                <h3>Сумма заказа </h3>
            </div>
            <div class="box-summ-num">
                <h3><span id="sum"></span> руб</h3>
            </div>
        </div>

        <form action="handler-status-basket-ok.php" method="get"
        ">
        <div class="container-1">
            <div class="box_contact_us">
                <h3>Контакты покупателя<span id="small-text"> (только для резидентов РБ)</span></h3>
            </div>
        </div>

        <div class="container-3">
            <div class="box-summ-num1">
                <h3><input id="user_source" placeholder="Фамилия Имя Отчество" type="text" name="FIO"/></h3>
            </div>
            <div class="box-summ1">
                <h3>Ваше Ф.И.О.</h3>
            </div>
        </div>

        <div class="container-3">
            <div class="box-summ-num1">
                <h3><input id="user_source" placeholder="г. Минск, пр. Победителей, дом 5" type="text" name="Adress"/></h3>
            </div>
            <div class="box-summ1">
                <h3>Адрес</h3>
            </div>
        </div>

        <div class="container-3">
            <div class="box-summ-num1">
                <h3><input id="user_source" placeholder="+375-29-2812152 мтс" type="text" name="Telephones"/></h3>
            </div>
            <div class="box-summ1">
                <h3>Телефон для связи</h3>
            </div>
        </div>

        <div class="container-3">
            <div class="box-summ-num1">
                <h3><input id="user_source" placeholder="email@tut.by" type="text" name="email"/></h3>
            </div>
            <div class="box-summ1">
                <h3>Ваш e-mail(если есть)</h3>
            </div>
        </div>

        <div class="container-3">
            <div class="box-summ-num1">
                <h3><input id="user_source" placeholder="Комментарий, если необходим" type="text" name="Comments"/></h3>
            </div>
            <div class="box-summ1">
                <h3>Комментарий/Вопрос</h3>
            </div>
        </div>
        <div class="container-1">
            <div class="box_push1">
            </div>
            <div class="box_push2">
                <h3><input id="confirm" type="submit" value="Подтвердить заказ"></h3>
            </div>
        </div>
    </div>
<?php print_footer();