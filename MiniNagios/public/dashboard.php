<?php
require_once '../vendor/autoload.php'; // Ou vos require_once manuels selon votre structure

use App\Database;
use App\ServeurRepository;

// 1. Connexion à la base de données
$pdo = Database::getConnection();

// 2. Instanciation du repository
$repository = new ServeurRepository($pdo);

// 3. Récupération de la liste des serveurs
$serveurs = $repository->listerTous();
?>


<!DOCTYPE html>
<title>Dashboard</title>

<a href= "ajouter_machine.php">Ajouter</a>
<br>
<br>

<table border="1">
    <tr>
        <th>Hostname</th> <th>IP</th> <th>OS</th> <th>Date</th>
    </tr>
    <?php foreach ($serveurs as $s): ?>
        <tr>
            <td><?= $s['hostname'] ?></td>
            <td><?= $s['ip'] ?></td>
            <td><?= $s['os'] ?></td>
            <td><?= $s['date_creation'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>