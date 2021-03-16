<?php
namespace Model;

use \OCFram\Manager;
use\Entity\Comments;

abstract class CommentsManager extends Manager
{
  //Vérifie si un utilisateur précis à déja commenté un produit précis
  abstract public function allowComment($productId, $employeeId);

  //Récupère la liste des commentaires sur un produit précis
  abstract public function getComments($productId);

  //Compte le nopmbre de commentaires pour un produit précis
  abstract public function CountComments($productId);

  //Ajout du commentaire par un utilisateur précis sur un produit précis
   abstract public function AddComment(Comments $comment);
}

