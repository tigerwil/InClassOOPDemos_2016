<?php

//testing the connection to database


/*
 * Autoloading Classes
 * Whenever your code tries to create a new instance of a class that PHP
 * doesn't know about, PHP automatically calls your __autoload() function
 * passing in the name of the class it's looking for.  Your function's job
 * is to locate and include the class file, thereby loading the class.
 */

function __autoload($class){
    require_once 'classes/'.$class.'.php';  
    //require_once 'classes/DbConnect.php';
    //require_once 'classes/DbHandler.php';
}

//Instantiate the database handler 
$dbh = new DbHandler();
//var_dump($dbh);



