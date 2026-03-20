<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Administration Mininagios</title>
    <style>
        /* Styles de base pour centrer le contenu */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        /* Conteneur principal du formulaire (la "carte") */
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px; /* Largeur maximale pour les grands écrans */
            box-sizing: border-box;
        }

        /* Style du titre principal */
        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 8px;
            margin-top: 0;
        }

        /* Style du sous-titre */
        .subtitle {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            font-size: 14px;
        }

        /* Espacement entre les champs */
        .form-group {
            margin-bottom: 20px;
        }

        /* Style des étiquettes (Labels) */
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #555;
            font-size: 14px;
        }

        /* Style des champs de saisie (Inputs) */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box; /* Important pour le padding */
            transition: border-color 0.3s;
        }

        /* Effet au survol/focus des champs */
        input:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0,123,255,0.1);
        }

        /* Style du bouton de connexion */
        .btn-submit {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        /* Effet au survol du bouton */
        .btn-submit:hover {
            background-color: #0056b3;
        }

        /* Liens d'aide en bas (optionnel) */
        .footer-links {
            text-align: center;
            margin-top: 25px;
            font-size: 13px;
        }

        .footer-links a {
            color: #007bff;
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        /* Adaptations pour mobiles */
        @media (max-width: 480px) {
            .login-card {
                padding: 25px;
                margin: 20px;
            }
            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>

<div class="login-card">
    <h1>Administration Mininagios</h1>
    <p class="subtitle">Connectez-vous pour accéder au tableau de bord</p>

    <form action="traitement_login.php" method="POST">

        <div class="form-group">
            <label for="email">Adresse Email</label>
            <input type="email" id="email" name="email" required placeholder="admin@mininagios.local" autocomplete="username">
        </div>

        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" required placeholder="••••••••" autocomplete="current-password">
        </div>

        <button type="submit" class="btn-submit">Se connecter</button>
    </form>

    <div class="footer-links">
        <p><a href="#">Mot de passe oublié ?</a></p>
        <p>Retour au <a href="/">site principal</a></p>
    </div>
</div>

</body>
</html>