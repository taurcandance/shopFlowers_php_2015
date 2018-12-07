<?php

function print_filter_menu()
{
    echo '
    <div class="container-fluid" id="filter-menu">
    <div class="row" >
        <div class="col-xs-4 col-sm-2">
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" condition="=" name="cover" value="Почвопокровное">
    Почвопокровное
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" condition="=" name="cover" value="Непочвопокровное">
    Непочвопокровное
                </label >
            </div >
        </div >
        <div class="col-xs-4 col-sm-2" >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" condition="=" name="shade" value="Светолюбивое">
    Светолюбивое
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" condition="=" name="shade" value="Тенелюбивое">
    Тенелюбивое
                </label >
            </div >
        </div >
        <div class="col-xs-4 col-sm-2" >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="height" condition="=" value="20">
    До 20 см высотой
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="height" condition="=" value="40">
    До 40 см высотой
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="height" condition="=" value="80">
    До 80 см высотой
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="height" condition="=" value="200">
    До 200 см и выше
                </label >
            </div >
        </div >
        <div class="col-xs-4 col-sm-2" >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="color" condition="=" value="Желтый">
    Жёлтый цвет
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="color" condition="=" value="Зеленый">
    Зелёный цвет
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="color" condition="=" value="Красный">
    Красный цвет
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="color" condition="=" value="Синий">
    Синий цвет
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="color" condition="=" value="Фиолетовый">
    Фиолетовый цвет
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="color" condition="=" value="Розовый">
    Розовый цвет
                </label >
            </div >
        </div >
        <div class="col-xs-4 col-sm-2" >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="cost" condition="=" value="2">
    Цена до 2 руб
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" name="cost" condition="=" value="3">
    Цена до 3 руб
                </label >
            </div >
        </div >
        <div class="col-xs-4 col-sm-2" >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" condition="=" name="annual" value="Многолетнее">
    Многолетнее
                </label >
            </div >
            <div class="checkbox" >
                <label id="menus_link">
                    <input type="checkbox" id="menu_link" condition="=" name="annual" value="Однолетнее">
    Однолетнее
                </label >
            </div >
        </div >
    </div >
</div >
';
}