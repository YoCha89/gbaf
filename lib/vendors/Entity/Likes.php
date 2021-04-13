<?php
namespace Entity;

use \OCFram\Entity;

class Likes extends Entity
{
	protected $employeeId,
            $productId,
            $verdict;

//Pas de constante d'erreur. Les id sont automatiques et le verdict est décidé par un "click" et non une entrée textuelle.

  // GETTERS //
  public function employeeId()
  {
   return $this->employeeId;
  }

  public function productId()
  {
    return $this->productId;
  }

  public function verdict()
  {
   return $this->verdict;
  }


 // SETTERS //
  public function setEmployeeId($employeeId)
  {
    $this->employeeId = $employeeId;
  }

  public function setProductId($productId)
  {
    $this->productId = $productId;
  }

  public function setVerdict($verdict)
  {
    $this->verdict = $verdict;
  }
}