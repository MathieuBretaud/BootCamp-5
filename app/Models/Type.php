<?php

namespace oShop\Models;

use PDO;
use oShop\Utils\Database;

class Type extends CoreModel
{
    private $name;
    private $footer_order;

    // récupérer une liste de types de produits
    public function findAll()
    {
        $sql = '
            SELECT * FROM `type`
        ';
        // Database::getPDO() me retourne l'objet PDO représentant la connexion à la BDD
        $pdo = Database::getPDO();
        // j'execute ma requête pour récupérer les types de produits
        $pdoStatement = $pdo->query($sql);
        // fetchAll avec l'argument FETCH_CLASS renvoie un array qui contient tous mes résultats sous la forme d'objets de la classe spécifiée en 2e argument
        $results = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'oShop\Models\Type');

        return $results;
    }

    // récupérer une seule marque
    public function find($id)
    {
        // requête pour récupérer UNE marque
        $sql = '
            SELECT *
            FROM type
            WHERE id = ' . $id;

        // Database::getPDO() me retourne l'objet PDO représentant la connexion à la BDD
        $pdo = Database::getPDO();

        // j'execute ma requête pour récupérer le type
        $pdoStatement = $pdo->query($sql);

        // Je veux récupérer un objet Type, PDO le fait pour moi => fetchObject (au lieu de fetch)
        $result = $pdoStatement->fetchObject('oShop\Models\Type');

        return $result;
    }

    /**
     * Les 5 types du pied de page
     */
    public function findTopFiveFooter()
    {
        // Seule la requête change par rapport à findAll()
        $sql = 'SELECT *
        FROM `type`
        WHERE `footer_order` != 0
        ORDER BY `footer_order` ASC
        LIMIT 5';

        // On récupère la connexion à PDO
        $pdo = Database::getPDO();

        // On exécute la requête
        $pdoStatement = $pdo->query($sql);

        // On récupère des objets de type Type
        // càd des objets instanciés depuis la classe PHP Type
        $types = $pdoStatement->fetchAll(PDO::FETCH_CLASS, 'oShop\Models\Type');

        // On le renvoie
        return $types;
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
