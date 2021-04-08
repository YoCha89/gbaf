

<img src="$product['logoUrl']" alt="logoPartenaireU" id="logoPartenaireU"/>
<h2><?= $product['title'] ?></h2>
<a href="">Consulter le site du partenaire</a>
<p><?= nl2br($product['description']) ?></p>


<p> <?= $commentsNumber ?> commentaires</p>

<!-- Affichage dynamique de l'action "commenter le produit"-->
<?php 
	if ($allowComment !== 'allow')
	{
		echo ('<form method="post" action="bootstrap.php?action=commentProduct&product='.$products['id'].'">
			<button type="submit" class="bouton">Nouveau commentaire</button>
		</form>');
	} 

	else
	{
		echo '<p>Votre avis est enregistré</p>';
	}
?>
<!-- Affichage dynamique de la possibilité de liker/disliker le produit -->
<?php 
	if ($allowLike !== "allow")
	{
		echo 
			'<span id=\'interfaceLike\'>
			<?= $likes ?>
			<form method="post" action="bootstrap.php?action=likeProduct&product=<?= $products[\'id\']?>"> 
				<input id="verdict" name="like" type="hidden" value="1">
				<span id=\'boutonlike\'><input type="image" id="like" alt="pouceup" src="liiiiiiiiiiiiiike.png"></span>
			</form>

			<form method="post" action="bootstrap.php?action=likeProduct&product=<?= $products[\'id\']?>">
				<input id="verdict" name="dislike" type="hidden" value="0">
				<span id=\'boutonlike\'><input type="image" id="dislike" alt="poucedown" src="disliiiiiiiiiiiiiiiiiiiike.png"><?= $dislikes ?></span>
			</form>
			</span>';
	 }
	
	else
	{
		echo '<p>Produit évalué</p>
				<img src="liiiiiiiiiiiiiike.png" alt="imagelike" id="imagelike"><?= $likes ?> <img src="disliiiiiiiiiiiiiiiiiiiike.png" alt="imagedislike" id="imagedislike"><?= $dislikes ?>';
	}?>

<!--Affichage des commentaires sur le produit-->
<?php 
	if (empty($listComments))
	{
		echo 'Pas de commentaire pour ce produit';
	}

	else
	{
		foreach ($listComments as $comment)
		{
			echo'<p><?= $comment[\'author\'] ?></p>
			<p><?= $comment[\'creationDate\'] ?></p>
			<p><?= nl2br($comment[\'content\']) ?></p>';	
		}
	}  
?>


<a href="bootstrap.php?action=showProducts">Liste des partenaires GBAF</a>

