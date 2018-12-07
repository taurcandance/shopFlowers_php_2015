<?php

class FlowersFilterManager
{
    public function select_($all_flowers, $arr_criterias, $range_criterias = null)
    {
        if (empty($arr_criterias)) {
            return $result = $all_flowers;
        }

        $result = array();
        foreach ($all_flowers as $item) {
            if ($this->check_flower($item, $arr_criterias, $range_criterias)) {
                $result[] = $item;
            }
        }

        return $result;
    }

    private function check_flower($flower, $arr_criterias, $range_criterias)
    {
        foreach ($arr_criterias as $param => $values) {
            $found    = false;
            $add_meth = "get".$param; // доступ через гет-методы(ибо поля прайват)
            foreach ($values as $value) {
                if ($flower->$add_meth() == $value) {
                    $found = true;
                    break;
                }
            }
            if ( ! $found) {
                return false;
            }
        }

        return true;
    }
}