<?php
require_once 'class_User.php';
require_once 'shared_functions.php';

class SiteManager
{
    private $connect;
    private $curr_user;

    public static function getInstance()
    {
        static $accountLoader = null;
        if ($accountLoader) {
            return $accountLoader;
        }

        $accountLoader = new SiteManager();

        return $accountLoader;
    }

    function __construct()
    {
        try {
            $this->connect = new PDO('mysql:host=127.0.0.1;dbname=flowersDB1', 'root', '');
            $this->connect->exec("set names utf-8");
        } catch (PDOException $error2) {
            print "already connected database!: ".$error2->getMessage()."<br>";
            die();
        }
    }

    public function getConnection()
    {
        return $this->connect;
    }

    public function getUser()
    {
        if ( ! is_null($this->curr_user)) {
            return $this->curr_user;
        }

        $cookieHash = $_COOKIE['cookieHash'];

        if (is_null($cookieHash)) {
            $cookie_id  = generatePass(255);
            $cookieHash = hash('ripemd160', $cookie_id);
            $user       = new User($cookieHash);
            $user->save($this->connect);
        } elseif ( ! is_null($cookieHash)) {
            $user = new User($cookieHash);
            $user->load($this->connect);
            $user->save($this->connect);
        }

        $this->curr_user = $user;
        setcookie("cookieHash", "$cookieHash", time() + 60 * 60 * 24 * 180);

        return $user;
    }
}