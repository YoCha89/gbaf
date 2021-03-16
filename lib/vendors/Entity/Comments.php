<?php
namespace Entity;

use \OCFram\Entity;

class Comment extends Entity
{
	protected $employeeId,
            $author,
            $productId,
            $content,
            $creationDate;

  //Seul le contenu est entré par l'utilisateur. Le reste est automatique
  const CONTENU_INVALIDE = 1;

    public function isValid()
  {
    return !empty($this->content);
  }


  // GETTERS //
  public function author()
  {
    return $this->author;
  }

  public function employeeId()
  {
   return $this->employeeId;
  }

  public function productId()
  {
    return $this->productId;
  }

  public function content()
  {
   return $this->content;
  }

  public function creationDate()
  {
    return $this->creationDate;
  }


 // SETTERS //
  public function setEmployeeId($employeeId)
  {
    $this->employeeId = $employeeId;
  }

   public function setAuthor($author)
  {
    $this->author = $author;
  }

  public function setProductId($productId)
  {
    $this->productId = $productId;
  }

  public function setContent($content)
  {
    if (!is_string($content) || empty($content))
    {
      $this->erreurs[] = self::CONTENU_INVALIDE;
    }

    $this->content = $content;
  }

  public function setCreationDate(\DateTime $creationDate)
  {
    $this->creationDate = $creationDate;
  }
}