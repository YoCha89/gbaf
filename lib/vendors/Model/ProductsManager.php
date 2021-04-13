<?php
namespace Model;

use \OCFram\Manager;

abstract class ProductsManager extends Manager
{
  //Récupération de tous les produits à lister sur la vue
  abstract public function getList();

  //Récupération d'un produit unique
  abstract public function getUnique($id);
}