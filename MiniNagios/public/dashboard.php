<?php
// 1. Chargement de l'autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// 2. SÉCURITÉ : On vérifie la connexion AVANT tout le reste !
\App\Securite::verifierConnexion();

use App\ServeurRepository;
use App\Database;

// 3. Récupération des données
$monPDO = Database::getConnection();
$monRepository = new ServeurRepository($monPDO);
$monTableauServeurs = $monRepository->listerTous();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Administration Mininagios</title>
    <style>
        /* --- TYPOGRAPHIE ET FOND APPLE --- */
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f5f5f7;
            color: #1d1d1f;
            overflow-x: hidden;
        }

        /* Arrière-plan fluide (Mesh Gradient) */
        .apple-mesh-bg {
            position: fixed;
            top: 0; left: 0; width: 100vw; height: 100vh;
            z-index: -1;
            background-image:
                    radial-gradient(at 80% 0%, hsla(189, 100%, 56%, 0.4) 0px, transparent 50%),
                    radial-gradient(at 0% 50%, hsla(333, 100%, 82%, 0.4) 0px, transparent 50%),
                    radial-gradient(at 80% 100%, hsla(242, 100%, 70%, 0.4) 0px, transparent 50%),
                    radial-gradient(at 0% 0%, hsla(343, 100%, 76%, 0.4) 0px, transparent 50%);
            filter: blur(60px);
            animation: breathe 15s ease-in-out infinite alternate;
        }

        @keyframes breathe {
            0% { transform: scale(1); }
            100% { transform: scale(1.1) translate(2%, 2%); }
        }

        /* --- CARTE PRINCIPALE (LIQUID GLASS) --- */
        .dashboard-container {
            background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(40px) saturate(180%);
            -webkit-backdrop-filter: blur(40px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-top: 1px solid rgba(255, 255, 255, 0.8);
            border-left: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 24px;
            padding: 40px;
            width: 90%;
            max-width: 1000px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            margin: 40px 0;
        }

        /* En-tête du Dashboard */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        h1 {
            font-weight: 600;
            font-size: 28px;
            margin: 0;
            letter-spacing: -0.5px;
        }

        /* --- BOUTONS STYLE APPLE --- */
        .btn {
            padding: 10px 18px;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-block;
        }

        .btn-add {
            background-color: #0071e3;
            color: white;
            box-shadow: 0 4px 10px rgba(0, 113, 227, 0.2);
        }
        .btn-add:hover { background-color: #0077ed; transform: scale(0.98); }

        .btn-delete {
            color: #ff3b30;
            background: rgba(255, 59, 48, 0.1);
        }
        .btn-delete:hover { background: rgba(255, 59, 48, 0.2); }

        /* --- TABLEAU ÉPURÉ --- */
        .table-wrapper {
            background: rgba(255, 255, 255, 0.4);
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th, td {
            padding: 16px 20px;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        th {
            background: rgba(0, 0, 0, 0.02);
            font-weight: 600;
            font-size: 13px;
            color: #86868b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        tr:last-child td { border-bottom: none; }

        tr:hover td { background: rgba(255, 255, 255, 0.3); }

        td {
            font-size: 15px;
            color: #1d1d1f;
        }

        td strong { font-weight: 600; }

        td code {
            font-family: 'SF Mono', ui-monospace, monospace;
            background: rgba(0,0,0,0.04);
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 13px;
        }
    </style>
</head>
<body>

<div class="apple-mesh-bg"></div>

<div class="dashboard-container">

    <div class="header-section">
        <div>
            <h1>Dashboard Sécurisé</h1>
            <p style="color: #86868b; margin-top: 5px; font-size: 14px;">Gestion des serveurs Mininagios</p>
        </div>
        <a href="ajouter_machine.php" class="btn btn-add">+ Ajouter un serveur</a>
    </div>

    <div class="table-wrapper">
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
            <?php if (empty($monTableauServeurs)): ?>
                <tr>
                    <td colspan="5" style="text-align: center; color: #86868b;">Aucun serveur provisionné pour le moment.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($monTableauServeurs as $s): ?>
                    <tr>
                        <td><strong><?= htmlspecialchars($s['hostname']) ?></strong></td>
                        <td><code><?= htmlspecialchars($s['ip']) ?></code></td>
                        <td><?= htmlspecialchars($s['os']) ?></td>
                        <td><?= htmlspecialchars($s['date_creation']) ?></td>
                        <td>
                            <a href="supprimer.php?id=<?= $s['id'] ?>"
                               class="btn btn-delete"
                               onclick="return confirm('Supprimer définitivement <?= htmlspecialchars($s['hostname']) ?> ?')">
                                Supprimer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>