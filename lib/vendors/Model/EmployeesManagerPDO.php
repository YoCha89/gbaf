<?php
namespace Model;

use \Entity\Employees;

abstract class EmployeesManagerPDO extends EmployeesManager
{
	public function getEmployeePass($userName)
	{
		$sql =$this->dao->prepare('SELECT pass FROM employees WHERE userName = :userName');
  		$sql->bindValue(':userName', $userName);
		$sql->execute();

		$sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Employees');
		$pass = $sql->fetchAll();

		$sql->closeCursor();

		return $pass;
	}

	public function getEmployeePerId($id)
	{
		$sql =$this->dao->prepare('SELECT id, name, firstName, userName, pass, secretQ, secretA FROM employees WHERE id = :id');
  		$sql->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$sql->execute();

		$sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Employees');
		$employee = $sql->fetchAll();

		$sql->closeCursor();

		return $employee;
	}

	public function checkUserName($userName)
	{
		$sql =$this->dao->prepare('SELECT userName FROM employees WHERE userName = :userName');
  		$sql->bindValue(':userName', $userName);
		$sql->execute();

		$sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Employees');
		$userName = $sql->fetchAll();

		$sql->closeCursor();

		return $userName;
	}

	public function updatePass($id, $pass)
	{
		$sql = $this->dao->prepare('UPDATE employees SET pass = :pass WHERE id= :id');

		$sql->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$sql->bindValue(':pass', $employee->pass());
		
		$sql->execute();

    	$sql->closeCursor();
	}

	public function addEmployee(Employees $employee)
	{
		$sql = $this->dao->prepare('INSERT INTO employees SET name = :name, firstName = :firstName, userName = :userName, pass = :pass, secretQ = :secretQ, secretA = :secretA');
    
    	$sql->bindValue(':name', $employee->name());
    	$sql->bindValue(':firstName', $employee->firstName());
    	$sql->bindValue(':userName', $employee->userName());
    	$sql->bindValue(':pass', $employee->pass());
    	$sql->bindValue(':secretQ', $employee->secretQ());
    	$sql->bindValue(':secretA', $employee->secretA());
    
    	$sql->execute();
    
    	$employee->setId($this->dao->lastInsertId());

    	$sql->closeCursor();
	}

	public function updateEmployee(Employees $employee)
	{
		$sql = $this->dao->prepare('UPDATE employees SET name = :name, firstName = :firstName, userName = :userName, pass = :pass, secretQ = :secretQ, secretA = :secretA WHERE id= :id');
    
    	$sql->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    	$sql->bindValue(':name', $employee->name());
    	$sql->bindValue(':firstName', $employee->firstName());
    	$sql->bindValue(':userName', $employee->userName());
    	$sql->bindValue(':pass', $employee->pass());
    	$sql->bindValue(':secretQ', $employee->secretQ());
    	$sql->bindValue(':secretA', $employee->secretA());
    
    	$sql->execute();

    	$sql->closeCursor();
	}	
}





