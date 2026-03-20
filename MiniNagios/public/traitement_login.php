<?php
// 1. Inclusion de l'autoloader pour charger les classes (Database, etc.)
require_once __DIR__ . '/../vendor/autoload.php';

use App\Database;

// 2. On vérifie que les données arrivent bien en POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupération et nettoyage rapide des données saisies
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        try {
            $pdo = Database::getConnection();

            // 3. Recherche de l'administrateur par son email
            $sql = "SELECT id, email, mot_de_passe FROM administrateurs WHERE email = :email LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['email' => $email]);

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // 4. Vérification du mot de passe avec password_verify()
            // password_verify compare le texte brut saisi avec le hash stocké en BDD
            if ($user && password_verify($password, $user['mot_de_passe'])) {

                // --- CAS : OK ---
                session_start();
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_email'] = $user['email'];

                // Redirection vers le dashboard
                header("Location: dashboard.php");
                exit;

            } else {
                // --- CAS : KO (Identifiants incorrects) ---
                header("Location: login.php?erreur=1");
                exit;
            }

        } catch (\Exception $e) {
            // Erreur de base de données
            die("Erreur technique : " . $e->getMessage());
        }
    } else {
        // Champs vides
        header("Location: login.php?erreur=1");
        exit;
    }
} else {
    // Si on accède au fichier en direct sans passer par le formulaire
    header("Location: login.php");
    exit;
}