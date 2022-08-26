<?php

namespace oShop\Models;

use PDO;
use oShop\Utils\Database;

class Category extends CoreModel
{
    private $name;
    private $subtitle;
    private $picture;
    private $home_order;

    /**
     * Get one category by its id
     * 
     * @param int $id Category primary key
     * @return Category Category found
     */
    public function find(int $id): Category
    {
        // Requête pour une catégorie
        $sql = "SELECT * FROM category WHERE id={$id}";

        // On récupère la connexion à PDO
        $pdo = Database::getPDO();

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        // On récupère un objet de type Category
        $category = $pdoStatement->fetchObject('oShop\Models\Category');

        // On le renvoie
        return $category;
    }

    /**
     * Get all categories
     */
    public function findAll(): array
    {
        // Requête pour toutes les catégories
        $sql = "SELECT * FROM category;";

        // On récupère la connexion à PDO
        $pdo = Database::getPDO();

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        // On récupère un tableau d'objets de type Category
        $categories = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'oShop\Models\Category');

        // On le renvoie
        return $categories;
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
     * Get the value of subtitle
     */ 
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * Set the value of subtitle
     *
     * @return  self
     */ 
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;

        return $this;
    }

    /**
     * Get the value of picture
     */ 
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * Set the value of picture
     *
     * @return  self
     */ 
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of home_order
     */ 
    public function getHome_order()
    {
        return $this->home_order;
    }

    /**
     * Set the value of home_order
     *
     * @return  self
     */ 
    public function setHome_order($home_order)
    {
        $this->home_order = $home_order;

        return $this;
    }
}
