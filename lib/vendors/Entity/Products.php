<?php
namespace Entity;

use \OCFram\Entity;

class Product extends Entity
{
	protected $logoUrl,
            $title,
            $description;

  //Pas de constante d'erreur. Ce projet se concentre sur le frontend, il n'y a pas d'interface de création de produit, uniquement une interface de consultation.

    public function isValid()
  {
    return !(empty($this->logoUrl) || empty($this->title) || empty($this->description);
  }

  // GETTERS //
  public function logoUrl()
  {
   return $this->logoUrl;
  }

  public function title()
  {
    return $this->title;
  }

  public function description()
  {
   return $this->description;
  }



 // SETTERS //
  public function setLogoUrl($logoUrl)
  {
    $this->logoUrl = $logoUrl;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function setDescription($description)
  {
    $this->description = $description;
  }
}