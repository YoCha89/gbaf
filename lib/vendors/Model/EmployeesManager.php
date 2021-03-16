<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Employees;

abstract class EmployeesManager extends Manager
{
	//Récupération du pass pour comparaison et connexion
	abstract public function getEmployeePass($userName)

	//Saisie des informations relatives à un employé grace à son id
	abstract public function getEmployeePerId($id)

	//Vérifie la disponibilité d'un nom d'utilisateur
	abstract public function checkUserName($userName)

	//met à jour le mot de passe de l'utilisateur
	abstract public function updatePass($id, $pass)

	//ajoute un utilisateur en BDD
	abstract public function addEmployee(Employees $employee)

	//met à jour les information d'un utilisateur en BDD
	abstract public function updateEmployee(Employees $employee)

	//fonction permettant un chemin similaire pour la création/mise à jour de compte au sein du controleur du module Employees
	public function save(Employees $employee)
  {
    if ($employee->isValid())
    {
      $employee->isNew() ? $this->addEmployee($employee) : $this->updateEmployee($employee);
    }
    else
    {
      throw new \RuntimeException('Le profil doit être validée pour être enregistrée');
    }
  }
}






