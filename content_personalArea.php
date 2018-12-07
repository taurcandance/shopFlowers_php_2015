<?php

function print_personalArea()
{
    $user = SiteManager::getInstance()->getUser();
    echo '
        <form class="form-horizontal" id="form-register" action="handler-savePersonalArea.php" method="post">
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Изменить Логин</label>
                <div class="col-sm-10">
                    <input name="login" type="text" class="form-control" id="inputLogin3" placeholder="'.$user->getLogin().'">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Изменить Пароль</label>
                <div class="col-sm-10">
                    <input name="pass" type="password" class="form-control" id="inputPassword3" placeholder="New Password">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Указать контактный телефон</label>
                <div class="col-sm-10">
                    <input name="telephone" type="text" class="form-control" id="inputTelephone" placeholder="'.$user->getTelephone().'">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Указать адрес получателя</label>
                <div class="col-sm-10">
                    <input name="address" type="text" class="form-control" id="inputAddress" placeholder="'.$user->getAddress().'">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Сохранить</button>
                </div>
            </div>
            
       </form>
    ';
}