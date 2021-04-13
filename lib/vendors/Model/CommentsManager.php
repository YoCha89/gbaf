<?php
namespace Model;

use \OCFram\Manager;
use\Entity\Comments;

abstract class CommentsManager extends Manager
{
  //Vérifie si un utilisateur unique à déja commenté un produit unique
  abstract public function allowComment($productId, $employeeId);

  //Récupère la liste des commentaires sur un produit unique
  abstract public function getComments($productId);

  //Compte le nombre de commentaires pour un produit unique
  abstract public function CountComments($productId);

  //Ajout du commentaire par un utilisateur unique sur un produit unique
   abstract public function AddComment(Comments $comment);
}

