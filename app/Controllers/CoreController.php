<?php

namespace oShop\Controllers;

use oShop\Models\Type;
use oShop\Models\Brand;

/**
 * Les méthodes partagées par tous les contrôleurs
 * @laurianne
 * > en gros ce qu'on met dans corecontroller
 * > c'est ce qui est commun entre main et catalog.
 * > le but est juste d'éviter la répétition !
 */

class CoreController
{
    // Fonction qui affiche le template voulu
    // Avec les données associées à ce template

    /**
     * @Claudia
     * public: tout le monde y a acces;
     * private: est dispo que dans la class ou elle est crée,
     * protected: dispo pour les enfants et class ou elle est crée
     */
    protected function show($viewName, $viewVars = []) {

        // On récupère notre variable $router créé "au niveau global de PHP" càd dans index.php
        global $router;

        // $viewVars est disponible dans chaque fichier de vue

        // Variable qui contient la base URL pour les liens absolus
        // sera disponible dans les templates (la variable est "plus lisible" ainsi)
        $absoluteUrl = $_SERVER['BASE_URI'];
        
        // On va chercher les 5 marques du pied de page
        // qui seront directement accessibles dans footer.tpl.php

        // (Une fois que ces Models ont étés fabriqués,
        // je peux aller appeler une de ses méthode dans un contrôleur
        // pour aller récupérer des données en BDD)

        $brandModel = new Brand();
        $topFiveBrands = $brandModel->findTopFiveFooter();
        // dd($topFiveBrands);

        // Idem pour les types
        // On va chercher les 5 types du pied de page
        $typeModel = new Type();
        $topFiveTypes = $typeModel->findTopFiveFooter();
        // dd($topFiveTypes);

        // En-tête
        require __DIR__ . '/../views/header.tpl.php';
        // Inclusion du template pour rendu HTML renvoyé par le serveur
        require __DIR__ . '/../views/' . $viewName . '.tpl.php';
        // Pied de page
        require __DIR__ . '/../views/footer.tpl.php';
    }
}