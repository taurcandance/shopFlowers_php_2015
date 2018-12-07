<?php

function print_head_and_scripts()
{
    echo '
    <!DOCTYPE html>
    <html lang = "ru" >
    <head >
        <meta charset = "utf-8" >
        <meta name = "viewport" content = "width=device-width, initial-scale=1, shrink-to-fit=no" >
        <title > GreenPlanet.by</title >
        <link href = "css/bootstrap.css" rel = "stylesheet" >
        <link href = "css/style.css"     rel = "stylesheet" >
        <script src = "js/publicScripts/jquery-3.2.1.js"></script>
        <script src = "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script >
        <script src = "js/publicScripts/bootstrap.js"></script >
        <script src = "js/internalScripts/menu_select.js" type = "text/javascript"></script>
        <script  type="text/javascript" src="js/internalScripts/transfer-to-basket.js"></script>
    </head >
    <body>

    ';
}