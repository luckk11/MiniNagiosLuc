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



<<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - MiniNagios</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background-color: #f9f9f9; }

        /* Style du bouton Ajouter */
        .btn-add {
            text-decoration: none;
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border-radius: 4px;
            display: inline-block;
            margin-bottom: 20px;
            font-weight: bold;
        }

        /* Style du tableau */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: white;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            color: #333;
            text-transform: uppercase;
            font-size: 0.85rem;
        }

        tr:hover { background-color: #f5f5f5; }

        /* Style du bouton supprimer */
        .btn-delete {
            color: #d9534f;
            text-decoration: none;
            font-weight: bold;
        }
        .btn-delete:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h2>🏢 Liste des Serveurs Provisionnés</h2>

<a href="ajouter_machine.php" class="btn-add">+ Ajouter un serveur</a>

<table>
    <thead>
    <tr>
        <th>Hostname</th>
        <th>Adresse IP</th>
        <th>Système d'Exploitation</th>
        <th>Date de Création</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($serveurs as $s): ?>
        <tr>
            <td><strong><?= htmlspecialchars($s['hostname']) ?></strong></td>
            <td><code><?= htmlspecialchars($s['ip']) ?></code></td>
            <td><?= htmlspecialchars($s['os']) ?></td>
            <td><?= $s['date_creation'] ?></td>
            <td>
                <a href="supprimer.php?id=<?= $s['id'] ?>"
                   class="btn-delete"
                   onclick="return confirm('Êtes-vous sûr de vouloir supprimer le serveur <?= $s['hostname'] ?> ?')">
                    Supprimer
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>