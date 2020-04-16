<?php

define('DIR_ROOT' , __DIR__.DIRECTORY_SEPARATOR);

// dépendances
include 'PhpEcho.php'; // moteur de rendu pour l'affichage
// modélisation : concepts d'une partie de tennis
include 'src/Joueur.php';
include 'src/Partie.php';
include 'src/Set.php';
include 'src/Jeu.php';

// routage très basique
$routes = [
    'start' => 'actions/start.php', // Soumission du formulaire de création de nouvelle partie de tennis
    'point' => 'actions/point.php'  // soumission d'un point marqué par un joueur 
];

parse_str($_SERVER['QUERY_STRING'], $query);
$action = $query['action'] ?? '';

session_start();

// page d'accueil
if ($action === '') {
    if (isset($_SESSION['partie'])) {
        // demande de la page d'accueil : alors qu'une partie est en cours => réinitialisation de la partie
        unset($_SESSION['partie']);
    }
echo new PhpEcho( [DIR_ROOT, 'vue Nouvelle_Partie.php']);
} elseif (isset($routes[$query['action']])) {
    include DIR_ROOT.$routes[$query['action']];
} else {
    echo 'Action non gérée';
}