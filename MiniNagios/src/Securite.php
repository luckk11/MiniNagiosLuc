<?php

namespace App;

class Securite
{
    /**
     * Vérifie si l'utilisateur est connecté.
     * Si non, redirige immédiatement vers la page de connexion.
     */
    public static function verifierConnexion(): void
    {
        // On démarre la session si elle n'est pas déjà active
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si la clé 'admin_id' n'existe pas, l'utilisateur n'est pas authentifié
        if (!isset($_SESSION['admin_id'])) {
            header("Location: login.php");
            exit();
        }
    }
}