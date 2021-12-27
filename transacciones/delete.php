<?php
require_once '../layout/layout.php';
require_once '../helpers/utilities.php';
require_once 'transaccion.php';
require_once '../service/IServicesBase.php';
require_once 'serviceCookie.php';
require_once '../helpers/FileHandler/IFileHandler.php';
require_once '../helpers/FileHandler/JsonFileHandler.php';
require_once 'serviceFile.php';

$layout = new Layout();
$services = new ServiceFile();
$trans = isset($_GET['id']);

if($trans){
    $transId=$_GET['id'];
    $services->Delete($transId);  
}

header("Location: ../index.php");
exit();
?>