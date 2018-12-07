<?php
require_once 'user_initial.php';
require_once 'connection_Db.php';
require_once 'shared_functions.php';
$user = SiteManager::getInstance()->getUser();

if ( ! isset($_COOKIE['cookieHash']) or is_null($_COOKIE['cookieHash'])) {
    header('Location:page_login.php');
}

if (isset($_COOKIE['cookieHash']) && ! is_null($_COOKIE['cookieHash']) && isset($_POST['user_login']) && isset($_POST['user_pass'])) {
    $name       = sanitizeString($_POST['user_login']);
    $pass       = sanitizeString($_POST['user_pass']);
    $cookieHash = sanitizeString($_COOKIE['cookieHash']);
    $hash       = password_hash($pass, PASSWORD_DEFAULT);

    if (checkIsOld($name, $hash, $pdo1)) {
        $cook = $result['cookiehash'];
        setcookie("cookieHash", "$cook", time() + 60 * 60 * 24 * 180);
        header('Location: index.php');
        exit();
    }
    $user->setName($name);
    $user->setPass($hash);
    $user->save(SiteManager::getInstance()->getConnection());
    header('Location: index.php');
}