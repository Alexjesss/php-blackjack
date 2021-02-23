<?php

spl_autoload_register('myAutoloader');

function myAutoloader($classname) {
    $path = "classes/";
    $extension = ".php";
    $fullPath = $path . $classname . $extension;

    include_once $fullPath;
}

