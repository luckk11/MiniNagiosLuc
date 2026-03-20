<?php
require '../vendor/autoload.php';
use App\ServeurRepository ;
use App\Database;

if (isset($_GET['id'])){

    $db = Database::getConnection();
    $serveurRepository = new ServeurRepository($db) ;

    $id = $_GET['id'] ;
    $serveurRepository->supprimerParId($id);
}
header('Location: dashboard.php');
exit;
