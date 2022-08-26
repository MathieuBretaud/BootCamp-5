<?php

namespace oShop\Models;

// use d'une classe native de PHP
use PDO;
// La classe Database du projet
use oShop\Utils\Database;

/**
 * Représentation de la table SQL 'brand'
 */

class Brand extends CoreModel
{
    /**
     * Les propriétés = les colonnes
     * 
     * ! pas de setter sur $id (Auto-increment Table SQL)
     * 
     * ! Les propriétés sont en snake_case au lieu de camelCase
     * ! c'est une exception à notre convention pour être raccord les colonnes
     */

    private $name;
    private $footer_order;

    /**
     * Les 5 marques du pied de page
     */
    public function findTopFiveFooter()
    {
        // Seule la requête change par rapport à findAll()
        $sql = 'SELECT *
        FROM `brand`
        WHERE `footer_order` != 0
        ORDER BY `footer_order` ASC
        LIMIT 5';

        // On récupère la connexion à PDO
        $pdo = Database::getPDO();

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        // On récupère des objets de type Brand
        $brands = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'oShop\Models\Brand');

        // On le renvoie
        return $brands;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of footer_order
     */ 
    public function getFooter_order()
    {
        return $this->footer_order;
    }

    /**
     * Set the value of footer_order
     *
     * @return  self
     */ 
    public function setFooter_order($footer_order)
    {
        $this->footer_order = $footer_order;

        return $this;
    }
}