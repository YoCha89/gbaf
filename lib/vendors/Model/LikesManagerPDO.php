<?php
namespace Model;

use \Entity\Likes;

class LikesManagerPDO extends LikesManager
{
	public function allowlike($productId, $employeeId)
	{
  		$sql =$this->dao->prepare('SELECT verdict, employeeId FROM likes WHERE productId = :productId');
  		$sql->bindValue(':productId', (int) $productId, \PDO::PARAM_INT);
		$sql->execute();

		$sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Likes');
		$productVerdicts = $sql->fetchAll();

		$sql->closeCursor();

		foreach ($productVerdicts as $like) 
		{
			if ($like['employeeId'] != $employeeId)
			{
				$evaluated=true;
			}
			else
			{
				$evaluated=false;
			}
		}

		return $evaluated;
	}

	public function countVerdicts($productId)
	{
  		$sql = $this->dao->prepare('SELECT COUNT(*) FROM likes WHERE productId = :productId');
  		$sql->bindValue(':productId', (int) $productId, \PDO::PARAM_INT);
		$sql->execute();
    	$sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Likes');
    
    	$verdictNumber = $sql->fetchAll();
    
    	$sql->closeCursor();
    
   		return $verdictNumber;
	}

	public function countLikes($productId)
	{
		$sql = $this->dao->prepare('SELECT COUNT(*) FROM likes WHERE productId = :productId AND verdict = 1'); //Rappel : si l'utilisateur like un produit, la valeur 1 est entrée. En cas de dislike, c'est le 0.
		$sql = $this->dao->query($sql);
    	$sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Likes');
    
    	$likeNumber = $sql->fetchAll();
    
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
    
    	$like->setId($this->dao->lastInsertId());

    	$sql->closeCursor();
	}
}








