
<?php

echo "<h1>DIAGNOSTIC PHP</h1>";

echo "<h2>Fichier exécuté :</h2>";
echo __FILE__;

echo "<h2>Connexion à MySQL :</h2>";

try {
    $pdo = new PDO(
        "mysql:host=127.0.0.1;dbname=touche_pas_au_klaxon;charset=utf8mb4",
        "root",
        ""
    );

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "<p>Connexion réussie.</p>";

    echo "<h2>Base utilisée :</h2>";
    echo $pdo->query("SELECT DATABASE()")->fetchColumn();

    echo "<h2>Nombre de trajets dans la vue :</h2>";

    $resultat = $pdo->query("SELECT COUNT(*) FROM vue_trajets");
    echo $resultat->fetchColumn();

    echo "<h2>Contenu de la vue :</h2>";

    $trajets = $pdo->query("SELECT * FROM vue_trajets")->fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($trajets);
    echo "</pre>";
} catch (PDOException $e) {
    echo "<p>ERREUR : " . htmlspecialchars($e->getMessage()) . "</p>";
}
