<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */
$host="host=localhost";
$port="port=5432";
$dbname="dbname=My_project";
$credentials="user=postgres password=1234";
$con=pg_connect("$host $port $dbname $credentials")or die("Query Failed".pg_last_error());
if(!$dbname)
{
    echo "error unable to datbase";
}
 else {
    echo "open sucessfully";    
}
        

?>