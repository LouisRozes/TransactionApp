<?php

class Utilities{

public function GetLastElement($list)
{
    $countlist = count($list);
    $lastElement = $list[$countlist -1];
    return $lastElement;
}

public function Filtrar($list,$property,$value)
{
    $filter=[];
    foreach($list as $item)
    {
        if($item->$property == $value)
        {
            array_push($filter,$item);
        }
    }
    return $filter;
}

public function GetCookieTime()
{
    return time() + 60 *60*24*30;
}

public function GetIndexElement($list,$property,$value)
{
    $index=0;

    foreach($list as $key=> $item)
    {
        if($item->$property == $value)
        {
            $index = $key;
        }
    }
    return $index; 
}
}
?>