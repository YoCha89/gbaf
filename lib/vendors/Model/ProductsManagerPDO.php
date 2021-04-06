<?php
namespace Model;

use \Entity\Products;

class ProductsManagerPDO extends ProductsManager
{
  public function getList()
  {
    $sql = 'SELECT id, logoUrl, title, description FROM products ORDER BY id DESC';
    
    $sql = $this->dao->query($sql);
    $sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Products');
    
    $listProducts = $sql->fetchAll();
    
    $sql->closeCursor();
    
    return $listProducts;
  }

  public function getUnique($id)
  {
    $sql = $this->dao->prepare ('SELECT id, logoUrl, title, description FROM products WHERE id = :id');
    
    $sql->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $sql->execute();

    $sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Products');
    
    $product = $sql->fetch();
    
    $sql->closeCursor();
    
    return $product;
  }
}