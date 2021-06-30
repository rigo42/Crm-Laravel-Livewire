<?php 

function active($routeNames){
    $class = "";
    if(is_array($routeNames)){
        foreach($routeNames as $routeName){
           if(setActive($routeName)){
                $class = "menu-item-active active";
                break;
           }
        }
    }else{
        if(setActive($routeNames)){
            $class = "menu-item-active active";
        }
    }
   return $class;
}

function setActive($routeName){
    return request()->routeIs($routeName);
}

function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'KB', 'MB', 'GB', 'TB');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}