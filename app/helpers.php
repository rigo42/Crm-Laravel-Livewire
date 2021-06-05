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