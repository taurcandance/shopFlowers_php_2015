<?php
require_once 'class_FlowersDbManager.php';
require_once 'class_FlowersFilterManager.php';
require_once 'shared_functions.php';
require_once 'class_UrlParser.php';

if (isset($_GET)) {
//  $url_parser          = new UrlParser();
//  $select_criterias  = $url_parser->Parse($_GET);
//  $sort_method     = sanitizeString($_GET['sort_method']);//asc-desc
    $fl_db_manager = new FlowersDbManager();
    $ffm           = new FlowersFilterManager();
    $all_flowers   = $fl_db_manager->getFlowers();
    $filter_params = $_GET;
    $flowers       = $ffm->select_($all_flowers, $filter_params);
//  $flowers              = $fsm->filter($flowers); //
    print_flowers_as_catalog($flowers);
}