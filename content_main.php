<?php
require_once 'shared_functions.php';
require_once 'connection_Db.php';
require_once 'class_FlowersDbManager.php';

function print_main_content()
{
    echo '<div class="container-fluid"><div id="content">';
        $fm      = new FlowersDbManager();
        $flowers = $fm->getFlowers();
        print_flowers_as_catalog($flowers);
    echo '</div></div>';
}