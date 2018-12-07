<?php
require_once 'class_SiteManager.php';

function init_user()
{
    SiteManager::getInstance()->getUser();
}