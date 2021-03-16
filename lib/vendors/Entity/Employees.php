<?php
namespace Entity;

use \OCFram\Entity;

class Employee extends Entity
{
	protected $name,
            $firstName,
            $userName,
            $pass,
            $secretQ,
            $secretA;

  const NOM_INVALIDE = 1;
	const PRENOM_INVALIDE = 2;
	const ALIAS_INVALIDE = 3;
	const MOT_DE_PASSE_INVALIDE = 4;
	const QUESTION_INVALIDE = 5;
	const REPONSE_INVALIDE = 6;

    public function isValid()
    {
      return !(empty($this->name) || empty($this->firstName) || empty($this->userName) || empty($this->pass) || empty($this->secretQ) || empty($this->secretA));
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
      $this->erreurs[] = self::NOM_INVALIDE;
    }

    $this->name = $name;
  }

  public function setFirstName($firstName)
  {
    if (!is_string($firstName) || empty($firstName))
    {
      $this->erreurs[] = self::PRENOM_INVALIDE;
    }

    $this->firstName = $firstName;
  }

  public function setUserName($userName)
  {
    if (!is_string($userName) || empty($userName))
    {
      $this->erreurs[] = self::ALIAS_INVALIDE;
    }

    $this->userName = $userName;
  }

  public function setPass($pass)
  {
    if (!is_string($pass) || empty($pass))
    {
      $this->erreurs[] = self::MOT_DE_PASSE_INVALIDE;
    }

    $this->pass = $pass;
  }

   public function setSecretQ($secretQ)
  {
    if (!is_string($secretQ) || empty($secretQ))
    {
      $this->erreurs[] = self::QUESTION_INVALIDE;
    }

    $this->secretQ = $secretQ;
  }

   public function setSecretA($secretA)
  {
    if (!is_string($secretA) || empty($secretA))
    {
      $this->erreurs[] = self::REPONSE_INVALIDE;
    }

    $this->secretA = $secretA;
  }
}