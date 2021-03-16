<?php
namespace Model;

use \OCFram\Manager;

abstract class ProductsManager extends Manager
{
  //Récupération de tous les produits à lister
  abstract public function getList();

  //Récupération d'un produit précis
  abstract public function getUnique();
}