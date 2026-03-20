<?php
// 1. SÉCURITÉ : On vérifie que l'admin est bien connecté
require_once __DIR__ . '/../vendor/autoload.php';
\App\Securite::verifierConnexion();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Serveur - Mininagios</title>
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
            padding: 20px;
            box-sizing: border-box;
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

        /* --- CARTE FORMULAIRE (LIQUID GLASS) --- */
        .form-card {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(40px) saturate(180%);
            -webkit-backdrop-filter: blur(40px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-top: 1px solid rgba(255, 255, 255, 0.8);
            border-left: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 500px; /* Un peu plus large que le login */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            z-index: 10;
        }

        /* En-tête */
        .header-section {
            text-align: center;
            margin-bottom: 30px;
        }

        h1 {
            font-weight: 600;
            font-size: 24px;
            margin: 0 0 8px 0;
            letter-spacing: -0.5px;
        }

        .subtitle {
            font-size: 14px;
            color: #86868b;
        }

        /* --- CHAMPS DE FORMULAIRE --- */
        .input-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #515154;
            margin-bottom: 8px;
            margin-left: 4px;
        }

        input, select {
            width: 100%;
            padding: 14px 16px;
            background: rgba(255, 255, 255, 0.5);
            border: 1px solid rgba(0, 0, 0, 0.04);
            border-radius: 12px;
            box-sizing: border-box;
            font-size: 15px;
            color: #1d1d1f;
            transition: all 0.2s ease;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.02);
            font-family: inherit;
        }

        /* Style spécifique pour le menu déroulant */
        select {
            cursor: pointer;
            appearance: none;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%2386868b%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22%2F%3E%3C%2Fsvg%3E");
            background-repeat: no-repeat, repeat;
            background-position: right .7em top 50%, 0 0;
            background-size: .65em auto, 100%;
        }

        input:focus, select:focus {
            outline: none;
            background: #ffffff;
            border-color: #007aff;
            box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.2);
        }

        /* --- BOUTONS --- */
        .btn-submit {
            width: 100%;
            padding: 14px;
            margin-top: 10px;
            background-color: #0071e3;
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-submit:hover { background-color: #0077ed; }
        .btn-submit:active { transform: scale(0.98); }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #0071e3;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover { text-decoration: underline; }

        /* Option pour mettre en rouge les systèmes interdits dans le select */
        option.danger { color: #ff3b30; }
    </style>
</head>
<body>

<div class="apple-mesh-bg"></div>

<div class="form-card">

    <div class="header-section">
        <h1>🏭 Provisionner un Serveur</h1>
        <div class="subtitle">Configuration d'une nouvelle instance sécurisée</div>
    </div>

    <form method="POST" action="traitementPersisteServeur.php">

        <div class="input-group">
            <label>Nom d'hôte (Hostname)</label>
            <input type="text" name="hostname" required placeholder="Ex: SRV-DB-02">
        </div>

        <div class="input-group">
            <label>Adresse IP</label>
            <input type="text" name="ip" required placeholder="Ex: 192.168.1.50" pattern="^([0-9]{1,3}\.){3}[0-9]{1,3}$" title="Veuillez entrer une adresse IPv4 valide">
        </div>

        <div class="input-group">
            <label>Système d'Exploitation</label>
            <select name="os" required>
                <option value="" disabled selected>Choisissez un OS...</option>
                <option value="Debian 12">Debian 12</option>
                <option value="Ubuntu 24.04">Ubuntu 24.04</option>
                <option value="Windows Server 2022">Windows Server 2022</option>
                <option value="RedHat 9">RedHat 9</option>
                <option value="Windows XP" class="danger">Windows XP (Interdit)</option>
                <option value="TempleOS" class="danger">TempleOS (Interdit)</option>
            </select>
        </div>

        <div class="input-group">
            <label>Mot de passe Root (Secret)</label>
            <input type="password" name="root_pass" required placeholder="••••••••">
        </div>

        <button type="submit" class="btn-submit">Créer le serveur</button>

    </form>

    <a href="dashboard.php" class="back-link">← Retour au Dashboard</a>
</div>

</body>
</html>