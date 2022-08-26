<?php

// Le FrontController : point d'entrée unique de l'application

// Autoload de Composer, pour charger automatiquement
// les classes et fonctions disponibles dans le dossier vendor/

// Avec l'autoload (PSR-4) on indique à Composer
// qu'il gère le chargement automatique de nos classes

require __DIR__ . '/../vendor/autoload.php';

// Instanciation d'AltoRouter
// https://altorouter.com/
$router = new AltoRouter();
// On définit le chemin de base de notre dossier de travail sur localhost
// $router->setBasePath('/trinity/s05/S05-projet-oShop-jc-oclock/public');
// On rend dynamique "le chemin Web" du dossier public
// via la variable $_SERVER['BASE_URI'] fournie par Apache/.htaccess
// Notre code fonctionnera donc sur n'importe quelle VM et même en prod (ex. sur http://oclock.io)
$router->setBasePath($_SERVER['BASE_URI']);

// Notre route pour la home
$router->map(
    // Méthode HTTP
    'GET',
    // La motif de l'URL (la route)
    '/',
    // Destination de la route = page que l'on souhaite afficher
    [
        'controller' => 'oShop\Controllers\MainController',
        'method' => 'home',
    ],
    // Nom interne de la route
    'home'
);

// Mentions légales
$router->map(
    'GET',
    '/mentions-legales/',
    [
        'controller' => 'oShop\Controllers\MainController',
        'method' => 'legalNotice',
    ],
    // Nom interne de la route
    'legal-notice'
);

// Notre route pour la categorie
$router->map(
    'GET',
    // La motif de l'URL (la route) avec paramètre dynamique
    // https://altorouter.com/usage/mapping-routes.html
    '/catalogue/categorie/[i:id]',
    // Destination de la route
    [
        'controller' => 'oShop\Controllers\CatalogController',
        'method' => 'category',
    ],
    // Nom interne de la route
    // pour générer les URLs via $router->generate()
    'category'
);

// Produits par type
$router->map(
    'GET',
    '/catalogue/type/[i:id]',
    [
        'controller' => 'oShop\Controllers\CatalogController',
        'method' => 'type',
    ],
    'type'
);

// Les produits par marque
$router->map(
    'GET',
    '/catalogue/marque/[i:id]',
    [
        'controller' => 'oShop\Controllers\CatalogController',
        'method' => 'brand',
    ],
    'brand'
);

// Page produit
$router->map(
    'GET',
    '/catalogue/produit/[i:id]',
    [
        'controller' => 'oShop\Controllers\CatalogController',
        'method' => 'product',
    ],
    'product'
);

// La requête du client correspond-elle à une route configurée dans AltoRouter
$match = $router->match();

// Si une route correspond
if ($match !== false) {
    // $match = [
    //   "target" => [
    //     "controller" => "CatalogController"
    //     "method" => "category"
    //   ]
    //   "params" => [
    //     "id" => 2
    //    ]
    //   "name" => "category"
    // ]

    //dd($match); // dump($match); die();

    // Destination de la route
    $destination = $match['target'];

    // On détermine le contrôleur à appeler
    $controllerName = $destination['controller'];
    // On détermine la méthode à appeler
    $methodName = $destination['method'];

    // Dispatcher

    // @todo Vérifier que la destination existe, sinon 404

    // 1. On instancie notre contrôleur
    $controller = new $controllerName(); // Par ex. new MainController()

    // 2. On appelle la méthode souhaitée du contrôleur
    // en lui transmettant les paramètres fournis par AltoRouter
    // c'est en effet AltoRouter qui extrait les valeurs
    // d'une route comme /category/[i:id] depuis /category/2
    // ce qui donnerait
    // "params" => [
    //     "id" => "2"
    // ]
    $controller->$methodName($match['params']); // Par ex. ->home();
}
else {
    // On envoie une 404
    http_response_code(404);
    echo 'Page non trouvée.';
}