<?php
require_once 'class_SelectCriteria.php';
require_once 'shared_functions.php';

class UrlParser
{
    public function Parse($filter_arr_param)
    {
        $select_param = new SelectCriteria();
        foreach ($filter_arr_param as $key => $value) {
            $select_param->param_name = sanitizeString($key);
            foreach ($value as $key => $value) {
                $select_param->param_value = sanitizeString($value);
            }
        }

        return $select_param;
    }
}
