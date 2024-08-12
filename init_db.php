<?php

declare(strict_types=1);

// Configuration de la connexion à la base de données
$host = 'localhost';    // Nom d'hôte
$dbname = 'omzu3666_clairesim_db'; // Nom de la base de données
$user = 'omzu3666_clasim';  // Nom d'utilisateur
$pass = '4wm^hgv9dixP'; // Mot de passe

try {
    // Connexion à MySQL sans spécifier de base de données
    $pdo = new PDO("mysql:host=$host;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Création de la base de données si elle n'existe pas
    $pdo->exec("
        CREATE DATABASE IF NOT EXISTS `$dbname` 
        CHARACTER SET utf8mb4 
        COLLATE utf8mb4_unicode_ci;
    ");

    // Sélection de la base de données nouvellement créée
    $pdo->exec("USE `$dbname`");

    // Lecture du fichier SQL pour créer les tables
    $sql = file_get_contents(__DIR__ . '/sql/data_table_setup.sql');

    // Exécution des requêtes SQL
    $pdo->exec($sql);

    // Ajout d'un utilisateur admin avec mot de passe hashé
    $stmt = $pdo->prepare("
        INSERT INTO `user` (`lastName`, `firstName`, `email`, `pseudo`, `pswd`, `userRole`) 
        VALUES (:lastName, :firstName, :email, :pseudo, :pswd, :userRole)
    ");

    $password = 'adminblog'; // Remplacez ce mot de passe par celui de votre choix
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt->execute([
        'lastName' => 'simonot',
        'firstName' => 'claire ',
        'email' => 'claire@admin.com',
        'pseudo' => 'admin',
        'pswd' => $hashedPassword,
        'userRole' => 'admin'
    ]);

    echo "La base de données, les tables, et l'utilisateur admin ont été créés avec succès.";
} catch (PDOException $exception) {
    echo "Erreur : " . $exception->getMessage();
}
