<?php
namespace Model;

use \OCFram\Manager;
use \Entity\Likes;

abstract class LikesManager extends Manager
{
  //Vérifie si un utilisateur unique à déja liké/disliké un produit unique
  abstract public function allowlike($productId, $employeeId);

  //compte le nombre total d'employees ayant donné leurs avis sur un produit unique
  abstract public function countVerdicts($productId);

  //compte le nombre total de likes reçu par un produit unique
  abstract public function countLikes($productId);

  //Enregistrer son like/dislike sur un produit unique
  abstract public function addLikeVerdict(Likes $like);
}

