<?php
namespace Model;

use \Entity\Likes;

class LikesManagerPDO extends LikesManager
{
	public function allowlike($productId, $employeeId)
	{
  		$sql =$this->dao->prepare('SELECT employeeId FROM likes WHERE productId = :productId');
  		$sql->bindValue(':productId', (int) $productId, \PDO::PARAM_INT);
		$sql->execute();

		$sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Likes');
		$employeesIds = $sql->fetchall();

		$sql->closeCursor();

		if (!empty($employeesIds))
		{
			foreach ($employeesIds as $singleIds) 
			{
				if ($singleIds['employeeId'] != $employeeId)
				{
					$evaluate="allow";//si on ne trouve pas de match, l'utilisateur n'a jamais commenté le produit
				}
				else
				{
					$evaluate="forbid";//au premier match, on sait que le commentaire est déja entré
					break;
				}
			}
		}

		else
		{
			$evaluate="allow";//cas prévu pour le premier like/dislike
		}

		return $evaluate;
	}

	public function countVerdicts($productId)
	{
  		$sql = $this->dao->prepare('SELECT COUNT(*) FROM likes WHERE productId = :productId');
  		$sql->bindValue(':productId', (int) $productId, \PDO::PARAM_INT);
		$sql->execute();
    
    	$verdictNumber = $sql->fetch();
    
    	$sql->closeCursor();
    
   		return $verdictNumber;
	}

	public function countLikes($productId)
	{
		$sql = $this->dao->prepare('SELECT COUNT(*) FROM likes WHERE productId = :productId AND verdict = "O"'); //Rappel : si l'utilisateur like un produit, la valeur "O" est entrée. En cas de dislike, c'est "N".
		$sql->bindValue(':productId', (int)  $productId, \PDO::PARAM_INT);
		$sql->execute();
    
    	$likeNumber = $sql->fetch();

    	if (empty($likeNumber))
    	{
    		$likeNumber=0;//permet l'autorisation lors du premier like/dislike sur le produit
    	}
    
    	$sql->closeCursor();
    
   		return $likeNumber;
	}

	public function addLikeVerdict(Likes $like)
	{
		$sql = $this->dao->prepare('INSERT INTO Likes SET employeeId = :employeeId, productId = :productId, verdict = :verdict');
    
    	$sql->bindValue(':employeeId', (int) $like->employeeId(), \PDO::PARAM_INT);
    	$sql->bindValue(':productId', (int)  $like->productId(), \PDO::PARAM_INT);
    	$sql->bindValue(':verdict', $like->verdict());
    
    	$sql->execute();

    	$sql->closeCursor();
	}
}








