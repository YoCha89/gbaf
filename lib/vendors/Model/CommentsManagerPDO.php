<?php
namespace Model;

use \Entity\Comments;

class CommentsManagerPDO extends CommentsManager
{
	public function allowComment($productId, $employeeId)
	{
  		$sql =$this->dao->prepare('SELECT content, employeeId FROM comments WHERE productId = :productId');
  		$sql->bindValue(':productId', (int) $productId, \PDO::PARAM_INT);
		$sql->execute();

		$sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comments');
		$productComments = $sql->fetchAll();

		$sql->closeCursor();

		foreach ($productComments as $comment) 
		{
			if ($comment['employeeId'] != $employeeId)
			{
				$commented=true;
			}
			else
			{
				$commented=false;
			}
		}

		return $commented;
	}

	public function getComments($productId)
	{
		$sql =$this->dao->prepare('SELECT id, employeeId, productId, content, creationDate FROM comments WHERE productId = :productId ORDER BY creationDate DESC');
		$sql->bindValue(':productId', (int) $productId, \PDO::PARAM_INT);
		$sql->execute();
    
    	$sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comments');
    
    	$listComments = $sql->fetchAll();

    	foreach ($listComments as $comments)
	    {
	    	$comments->setCreationDate(new \DateTime($comments->creationDate()));
	    }
    
    	$sql->closeCursor();
    
    	return $listComments;
	}

	public function countComments($productId)
	{
		$sql = $this->dao->prepare('SELECT COUNT(*) FROM comments WHERE productId = :productId');
  		$sql->bindValue(':productId', (int) $productId, \PDO::PARAM_INT);
		$sql->execute();
    	$sql->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comments');
    
    	$commentsNumber = $sql->fetchAll();
    
    	$sql->closeCursor();
    
   		return $commentsNumber;
	}

	public function AddComment(Comments $comment)
	{
		$sql = $this->dao->prepare('INSERT INTO comments SET employeeId = :employeeId, author = :author, productId = :productId, content = :content, creationDate = NOW()');
    
    	$sql->bindValue(':employeeId', (int) $comment->employeeId(), \PDO::PARAM_INT);
    	$sql->bindValue(':author', $comment->author());
    	$sql->bindValue(':productId', (int) $comment->productId(), \PDO::PARAM_INT);
    	$sql->bindValue(':content', $comment->content());
    
    	$sql->execute();
    
    	$comment->setId($this->dao->lastInsertId());

    	$sql->closeCursor();
	}
}