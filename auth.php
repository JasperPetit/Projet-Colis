<?php

session_start();

if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: login.php');
    exit();
}


$nom_complet = $_SESSION['nom_complet'];
$role_utilisateur = $_SESSION['role'];
$id_utilisateur = $_SESSION['utilisateur_id'];
?>