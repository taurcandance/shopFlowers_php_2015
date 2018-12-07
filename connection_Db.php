<?php

try {
    $pdo1 = new PDO('mysql:host=localhost;dbname=flowersDB1', 'root', '');
    $pdo1->exec("set names utf-8");
} catch (PDOException $error2) {
    print "Errorrrrrrr!: ".$error2->getMessage()."<br />";
    die();
}