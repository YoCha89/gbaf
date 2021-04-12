<?php
namespace Entity;

use \OCFram\Entity;

class Employees extends Entity
{
	protected $id,
            $name,
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
  const ID_NON_VALIDE = 7;

    public function isValid()
    {
      return !(empty($this->name) || empty($this->firstName) || empty($this->userName) || empty($this->pass) || empty($this->secretQ) || empty($this->secretA));
    }

  // GETTERS //
  public function id()
  {
    return $this->id;
  }

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
  public function setId($id)
  {
    if (!is_int($id) || empty($id))
    {
      $this->erreurs[] = self::ID_NON_VALIDE;
    }

    $this->id = $id;
  }


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