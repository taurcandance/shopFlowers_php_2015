<?php
require_once 'user_initial.php';
require_once 'shared_functions.php';
$user = SiteManager::getInstance()->getUser();

if ( ! isset($_COOKIE['cookieHash']) or is_null($_COOKIE['cookieHash'])) {
    header('Location:page_personalArea.php');
}

if (isset($_COOKIE['cookieHash']) && ! is_null($_COOKIE['cookieHash']) && isset($_POST['login']) && isset($_POST['pass'])) {
    $hashPass = password_hash(sanitizeString($_POST['pass']), PASSWORD_DEFAULT);
    $user->setName(sanitizeString($_POST['login']));
    $user->setPass($hashPass);
    $user->setTelephone(sanitizeString($_POST['telephone']));
    $user->setAddress(sanitizeString($_POST['address']));
    $user->save(SiteManager::getInstance()->getConnection());
    header('Location:index.php');
}
header('Location:page_personalArea.php');