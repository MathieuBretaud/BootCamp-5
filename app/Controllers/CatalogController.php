<?php

namespace oShop\Controllers;

// Les classes utilisées dans ce fichier
// pas besoin de \ au début,
// use démarre de l'espace de nom global ("la racine des namespaces")

use oShop\Models\Product;

// Gestion de nos pages

class CatalogController extends CoreController
{
    // Page catégorie
    public function category($params)
    {
        // On récupère l'id de la catégorie
        $categoryId = $params['id'];

        // On va chercher les données de la catégorie en BDD
        $productModel = new Product();
        $products = $productModel->findAll();
        // dd($products);

        // Les données de la vue
        $viewVars = [
            'category_id' => $categoryId,
            'products' => $products,
        ];

        // On appelle la méthode qui affiche le template
        $this->show('category_products', $viewVars);
    }

    // Page marque
    public function brand($params)
    {
        // On récupère l'id de la marque
        $brandId = $params['id'];

        // On va chercher les données de la marque en BDD
        // ...

        // Les données de la vue
        $viewVars = [
            'brand_id' => $brandId,
        ];

        // On appelle la méthode qui affiche le template
        $this->show('brand_products', $viewVars);
    }

    // Page type
    public function type($params)
    {
        // On récupère l'id de la marque
        $typeId = $params['id'];

        // On va chercher les données de la marque en BDD
        // ...

        // Les données de la vue
        $viewVars = [
            'type_id' => $typeId,
        ];

        // On appelle la méthode qui affiche le template
        $this->show('type_products', $viewVars);
    }

    /**
     * Page produit
     */
    public function product($params)
    {
        // On récupère l'id du produit
        $productId = $params['id'];

        // On va chercher les données du produit en BDD
        // Notre modèle de base
        $productModel = new Product();
        
        // *****************************
        // Option 1 : plusieurs requêtes
        // *****************************
        
        // L'objet récupéré via notre modèle
        // $product = $productModel->find($productId);

        // On récupère la catégorie du $product via product_id
        // $categoryModel = new Category();
        // $category = $categoryModel->find($product->getId());

        // On récupère la marque du $product via brand_id
        // new Brand ...

        // On récupère le type du $product via type_id
        // new Type ...

        // *****************************
        // Option 2 : avec jointure
        // *****************************

        // L'objet récupéré via notre modèle
        // avec les infos associées
        $product = $productModel->findJoinedToAll($productId);

        // Une propriété publique est créée par PHP pour les 3 alias de la requête SQL
        // (ces propriétes n'existant pas concrètement dans le Model d'origine)
        dump($product->brand_name);

        dd($product);

        // @todo Appeler la méthode show()
    }
}