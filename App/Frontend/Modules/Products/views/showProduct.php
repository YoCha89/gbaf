

<img src="<?=$product['logoUrl']?>" alt="logoPartenaireU" id="logoPartenaireU"/>
<h2><?= $product['title'] ?></h2>
<a href="">Consulter le site du partenaire</a>
<p><?= nl2br($product['description']) ?></p>

<p> <?= $commentsNumber[0] ?> commentaires</p>

<?php 
	//Affichage dynamique de l'action "commenter le produit"
	echo $commentOption;

	//Affichage dynamique de la possibilité de liker/disliker le produit 
	echo $likeOption;
	
	//Affichage des commentaires sur le produit-->
	if (empty($listComments))
	{
		echo 'Pas de commentaire pour ce produit';
	}

	else
	{
		foreach ($listComments as $comment)
		{
			echo('<p>'.$comment['author'].'</p>
			<p>'.$comment['creationDate']->format('d/m/Y à H\hi').'</p>
			<p>'.nl2br($comment['content']).'</p>');	
		}
	}  
?>


<a href="bootstrap.php?action=showProducts">Liste des partenaires GBAF</a>

