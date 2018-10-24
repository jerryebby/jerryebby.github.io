<?php
$link = array (
                'host' => "35.189.180.77",
                'port' =>"3306",
                'account' =>"app_engine",
                'password' =>"4Zz53OVMaFPlRtih",
                'dbname' =>"clothespricecompare"
);
$dbconnect='mysql:host='.$link['host'].';port='.$link['port'].
    ';dbname='.$link['dbname'].';charset=utf8';
try
{
    $connect = new PDO($dbconnect,$link['account'],$link['password']);
    $connect -> query("SET NAMES 'utf8");
    $connect -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(Exception $e)
{
    echo "Connection failed: " ;
    echo iconv('gbk', 'utf-8',$e->getMessage());
    exit();
}

$sql = 'SELECT * FROM `PRODUCT`';
$select =$connect -> prepare($sql);
$select -> execute();
echo $select;
?>
