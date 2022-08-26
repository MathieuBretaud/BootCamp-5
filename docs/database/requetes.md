# Requêtes SQL

## Layout principal

### Les 5 types dans le footer

```sql
-- Sélection
SELECT *
-- Où (table) ?
FROM `type`
-- Condition sur une colonne
WHERE `footer_order` != 0
-- Tri des résultats
ORDER BY `footer_order` ASC
-- Limitation des résultats
LIMIT 5
```

### Les 5 marques dans le footer

```sql
SELECT *
FROM `brand`
WHERE `footer_order` != 0
ORDER BY `footer_order` ASC
LIMIT 5
```

## Home

### Les 5 catégories mises en avant

```sql
SELECT *
FROM `category`
WHERE `home_order` != 0
ORDER BY `home_order` ASC
LIMIT 5
```

## Catégories de produits

> Les 3 types de requêtes pour les produits *par catégorie, marque ou type* sont complètement similaires, c'est juste la condition `WHERE` qui change.

### Tous les produits de la catégorie #1 triés par nom

```sql
SELECT *
FROM `product`
WHERE `category_id`=1
ORDER BY `name` ASC;
```

### Tous les produits de la catégorie #1 triés par prix

```sql
SELECT *
FROM `product`
WHERE `category_id`=1
ORDER BY `price` ASC;
```

## Marques (de produits)

### Tous les produits de la marque #1 triés par nom

```sql
SELECT *
FROM `product`
WHERE `brand_id`=1
ORDER BY `name` ASC;
```

### Tous les produits de la marque #1 triés par prix

```sql
SELECT *
FROM `product`
WHERE `brand_id`=1
ORDER BY `price` ASC;
```

## Types de produits

### Tous les produits du type #1 triés par nom

```sql
SELECT *
FROM `product`
WHERE `type_id`=1
ORDER BY `name` ASC;
```

### Tous les produits du type #1 triés par prix

```sql
SELECT *
FROM `product`
WHERE `type_id`=1
ORDER BY `price` ASC;
```

### Produit

### Tous les produits

```sql
SELECT * FROM product
```

### Récupérer le produit ayant un id donné (#2)

```sql
-- Juste les infos de base
SELECT *
FROM product
WHERE id = 2
```

### Exemple de "jointure" en SQL

- Tous les produits et toutes les infos liées

```sql
SELECT *
FROM `product`
INNER JOIN brand ON product.brand_id = brand.id
INNER JOIN category ON product.category_id = category.id
INNER JOIN type ON product.type_id = type.id
```

- Le produit dont l'id est 5 avec ses infos liées

```sql
-- product.* => Toutes les colonnes de la table product
-- brand.name => la colonne 'name' de la table 'brand'
-- Les noms de la marque, de la catégorie et du type seuls MAIS renommés (aliasés)
SELECT product.*, brand.name AS brand_name, category.name AS category_name, type.name AS type_name
FROM `product`
INNER JOIN brand ON product.brand_id = brand.id
-- On va tout de même récupèrer le produit
-- même s'il est sans catégorie (NULL autorisé, car cardinalité min à 0 sur cette relation),
-- grâce au LEFT JOIN
LEFT JOIN category ON product.category_id = category.id
INNER JOIN type ON product.type_id = type.id
WHERE product.id = 5
```

Voir : https://sql.sh/cours/jointures