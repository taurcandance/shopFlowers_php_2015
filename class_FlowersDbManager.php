<?php
require_once 'class_Flower.php';

class FlowersDbManager
{
    private static $pdo;

    public static function init()
    {
        if (self::$pdo != null) {
            return;
        }

        try {
            self::$pdo = new PDO('mysql:host=127.0.0.1;dbname=flowersDB1', 'root', '');
            self::$pdo->exec("set names utf-8");
        } catch (PDOException $error2) {
            print "Errorrrrrrr!: ".$error2->getMessage()."<br>";
            die();
        }
    }

    public function getFlowers()
    {
        $flowers = FlowersDbManager::$pdo->query(
            "
            SELECT flower_id               AS id,
                   flower_name             AS name,
                   flower_photo_path       AS photo,
                   flower_description      AS description,
                   flower_perennial_annual AS annual,
                   flower_height           AS height,
                   flower_cost             AS cost,
                   flower_color            AS color,
                   flower_shade_loving     AS shade,
                   flower_ground_cover     AS cover,
                   flower_cut              AS cut
            FROM flowers"
        )->fetchAll(PDO::FETCH_CLASS, 'Flower');

        return $flowers;
    }
}

FlowersDbManager::init();