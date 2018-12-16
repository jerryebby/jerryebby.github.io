<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$data=array();

$link = array (
                'host' => "127.0.0.1",
                'port' =>"3306",
                'account' =>"php_jerry",
                'password' =>"FrzbumJquiq5RQzt",
                'dbname' =>"clothespricecompare"
);
$dbconnect='mysql:host='.$link['host'].';port='.$link['port'].
    ';dbname='.$link['dbname'].';charset=utf8';
try
{
    $connect = new PDO($dbconnect,$link['account'],$link['password']);
    $connect -> query("SET NAMES 'utf8'");
    $connect -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
    echo "Connection failed: " ;
    echo iconv('gbk', 'utf-8',$e->getMessage());
    exit();
}







?>
