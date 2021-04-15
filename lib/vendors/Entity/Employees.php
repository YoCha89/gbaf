<?php
namespace Entity;

use \OCFram\Entity;

class Employees extends Entity
{
	protected $name,
            $firstName,
            $userName,
            $pass,
            $secretQ,
            $secretA;

  const NOM_NON_VALIDE = 1;
	const PRENOM_NON_VALIDE = 2;
	const ALIAS_NON_VALIDE = 3;
	const MOT_DE_PASSE_NON_VALIDE = 4;
	const QUESTION_NON_VALIDE = 5;
	const REPONSE_NON_VALIDE = 6;

  //Nous excluons les champs vides ou les champs composés uniquement d'espaces
  public function isValid()
  {
      if (!(empty($this->name) || empty($this->firstName) || empty($this->userName) || empty($this->pass) || empty($this->secretQ) || empty($this->secretA)))
      {
        return !(preg_match('#^\s+$#', $this->name) || preg_match('#^\s+$#', $this->firstName) || preg_match('#^\s+$#', $this->userName) || preg_match('#^\s+$#', $this->pass) || preg_match('#^\s+$#', $this->secretQ) || preg_match('#^\s+$#', $this->secretA));
      }

      else
      {
        return false;
      }
  }

  // GETTERS //
  public function name()
  {
   return $this->name;
  }

  public function firstName()
  {
    return $this->firstName;
  }

  public function userName()
  {
   return $this->userName;
  }

  public function pass()
  {
    return $this->pass;
  }

   public function secretQ()
  {
    return $this->secretQ;
  }

   public function secretA()
  {
    return $this->secretA;
  }



 // SETTERS //
  public function setName($name)
  {
    if (!is_string($name) || empty($name))
    {
      $this->erreurs[] = self::NOM_NON_VALIDE;
    }

    $this->name = $name;
  }

  public function setFirstName($firstName)
  {
    if (!is_string($firstName) || empty($firstName))
    {
      $this->erreurs[] = self::PRENOM_NON_VALIDE;
    }

    $this->firstName = $firstName;
  }

  public function setUserName($userName)
  {
    if (!is_string($userName) || empty($userName))
    {
      $this->erreurs[] = self::ALIAS_NON_VALIDE;
    }

    $this->userName = $userName;
  }

  public function setPass($pass)
  {
    if (!is_string($pass) || empty($pass))
    {
      $this->erreurs[] = self::MOT_DE_PASSE_NON_VALIDE;
    }

    $this->pass = $pass;
  }

   public function setSecretQ($secretQ)
  {
    if (!is_string($secretQ) || empty($secretQ))
    {
      $this->erreurs[] = self::QUESTION_NON_VALIDE;
    }

    $this->secretQ = $secretQ;
  }

   public function setSecretA($secretA)
  {
    if (!is_string($secretA) || empty($secretA))
    {
      $this->erreurs[] = self::REPONSE_NON_VALIDE;
    }

    $this->secretA = $secretA;
  }
}