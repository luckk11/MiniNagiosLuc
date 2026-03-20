<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mininagios - Connexion</title>
    <style>
        /* --- TYPOGRAPHIE ET FOND APPLE --- */
        body {
            /* Utilisation de la police système Apple (San Francisco) */
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            background-color: #f5f5f7;
            position: relative;
            color: #1d1d1f;
        }

        /* Arrière-plan fluide (Mesh Gradient animé type macOS) */
        .apple-mesh-bg {
            position: absolute;
            width: 100vw;
            height: 100vh;
            z-index: 0;
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

        /* --- CARTE LIQUID GLASS (VIBRANCY) --- */
        .apple-glass-card {
            /* Effet Vibrancy Apple */
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(40px) saturate(180%);
            -webkit-backdrop-filter: blur(40px) saturate(180%);

            /* Bordure simulant la coupe du verre */
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-top: 1px solid rgba(255, 255, 255, 0.8);
            border-left: 1px solid rgba(255, 255, 255, 0.8);

            border-radius: 24px; /* Arrondi doux type Apple */
            padding: 48px 40px;
            width: 100%;
            max-width: 380px;

            /* Ombre portée très diffuse */
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
            z-index: 10;
            position: relative;
            box-sizing: border-box;
        }

        /* Textes */
        h1 {
            font-weight: 600;
            font-size: 24px;
            margin: 0 0 8px 0;
            text-align: center;
            letter-spacing: -0.5px;
        }

        .subtitle {
            text-align: center;
            font-size: 14px;
            color: #86868b;
            margin-bottom: 32px;
            font-weight: 400;
        }

        /* --- CHAMPS DE FORMULAIRE --- */
        .input-group {
            margin-bottom: 20px;
        }

        /* Apple cache souvent les labels pour un design épuré, ou les met très discrets */
        label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #515154;
            margin-bottom: 6px;
            margin-left: 4px;
        }

        input {
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
        }

        input::placeholder {
            color: #86868b;
        }

        /* Le fameux "Focus Ring" d'Apple */
        input:focus {
            outline: none;
            background: #ffffff;
            border-color: #007aff;
            box-shadow: 0 0 0 4px rgba(0, 122, 255, 0.2);
        }

        /* --- BOUTON APPLE --- */
        .btn-apple {
            width: 100%;
            padding: 14px;
            margin-top: 10px;
            background-color: #0071e3; /* Le bleu officiel Apple */
            color: white;
            border: none;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        .btn-apple:hover {
            background-color: #0077ed;
        }

        .btn-apple:active {
            transform: scale(0.98);
        }

        /* --- ERREUR --- */
        .error-badge {
            background: rgba(255, 59, 48, 0.1); /* Rouge Apple */
            color: #ff3b30;
            padding: 12px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            text-align: center;
            margin-bottom: 24px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
    </style>
</head>
<body>

<div class="apple-mesh-bg"></div>

<div class="apple-glass-card">
    <h1>Mininagios</h1>
    <div class="subtitle">Connectez-vous avec votre identifiant.</div>

    <?php if (isset($_GET['erreur'])): ?>
        <div class="error-badge">Identifiant ou mot de passe incorrect.</div>
    <?php endif; ?>

    <form action="traitement_login.php" method="POST">
        <div class="input-group">
            <label for="email">E-mail</label>
            <input type="email" id="email" name="email" required placeholder="nom@exemple.com">
        </div>

        <div class="input-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required placeholder="Requis">
        </div>

        <button type="submit" class="btn-apple">Se connecter</button>
    </form>
</div>

</body>
</html>