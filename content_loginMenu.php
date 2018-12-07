<?php
require_once 'class_SiteManager.php';

function print_login_form()
{
    echo '    
        <form class="form-horizontal" id="form-register" action="handler-loginForm.php" method="post">
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Login</label>
                <div class="col-sm-10">
                    <input type="login" class="form-control" id="inputLogin3" placeholder="Login" name="user_login">
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="user_pass">
                </div>
            </div>
            
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Войти</button>
                </div>
            </div>
        </form>
        ';
}