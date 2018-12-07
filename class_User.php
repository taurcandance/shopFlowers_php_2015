<?php
require_once 'class_CollectorOrders.php';

class User
{
    private $name;
    private $personId;
    private $cookieHash;
    private $isAnonym;
    private $dataTime;
    private $password;
    private $address;
    private $telephone;
    private $currOrder;
    private $userInfo;
//  private $prevOrders;

    function __construct($cookieHash)
    {
        $this->name;
        $this->personId;
        $this->isAnonym = true;
        $this->dataTime;
        $this->cookieHash = $cookieHash;
        $this->password;
        $this->address;
        $this->telephone;

        $info = "";
        foreach ($_SERVER as $key => $value) {
            $info .= $key.' := '.$value."; \n";
        }
        $this->userInfo = $info;
    }

    public function getCurrOrder()
    {
        if ( ! is_null($this->currOrder)) {
            return $this->currOrder;
        }

        $this->currOrder = new CollectorOrders($this->getPersonId());

        return $this->currOrder;
    }

    public function getTelephone()
    {
        return $this->telephone;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function getPersonId()
    {
        return $this->personId;
    }

    public function getLogin()
    {
        return $this->name;
    }

    public function isAnonym()
    {
        return $this->isAnonym;
    }

    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    public function setName($login)
    {
        $this->name = $login;
    }

    public function setPass($pass)
    {
        $this->password = $pass;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function setCookieHash($cookieHash)
    {
        $this->cookieHash = $cookieHash;
    }

    public function setPersonId($personId)
    {
        $this->personId = $personId;
    }

    public function setAnonym($bool)
    {
        $this->isAnonym = $bool;
    }


    public function load($connection)
    {
        $qet_user_data = $connection->query(
            "
        select * 
        from   users 
        where  cookiehash = '$this->cookieHash' "
        );
        $user_data     = $qet_user_data->fetch();

        $this->name      = $user_data['login'];
        $this->personId  = $user_data['personid'];
        $this->address   = $user_data['address'];
        $this->telephone = $user_data['telephone'];

        if ($this->name !== null) {
            $this->isAnonym = false;
        }
    }


    public function save($connection)
    {
        if ($this->name !== null) {
            $this->isAnonym = false;
        }

        if ($this->isAnonym == true) {
            $writeToDb = $connection->query(
                "
            INSERT INTO users
            SET personId = null, 
                cookiehash = '$this->cookieHash', 
                login = '$this->name', 
                password = '$this->password',
                userIp = '$this->userInfo'            
            "
            );
        }

        if ($this->isAnonym == false) {
            $writeToDb = $connection->query(
                "
            UPDATE users
            SET login = '$this->name', 
                password = '$this->password',
                address = '$this->address',
                telephone = '$this->telephone',
                userIp = '$this->userInfo'
            WHERE  cookiehash = '$this->cookieHash' 
            "
            );
        }
    }
}