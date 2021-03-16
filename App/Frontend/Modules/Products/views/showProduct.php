

<img src="$product['logoUrl']" alt="logoPartenaireU" id="logoPartenaireU"/>
<h2><?= $product['title'] ?></h2>
<a href=""></a>
<p><?= nl2br$product['description'] ?></p>


<p> <?= $commentsNumber ?> commentaires</p>

<!-- Affichage dynamique de l'action "commenter le produit"-->
<?php 
	if ($allowComment != false)
	{
		echo ?> <a href="<?='comment-product-'.$_GET['id'].'.html'?>">Nouveau commentaire</a>
	<?php }
	else
	{
		echo ?> <p>Votre avis sur ce produit est enregistré</p>
	<?php }
?>

<!-- Affichage dynamique de la possibilité de liker/disliker le produit -->
<?php 
	if ($allowLike != false)
	{
		echo ?>
<span id='interfaceLike'>
<form method="post" action=<?='like-product-'.$_GET['id'].'.html'?>>
	<input id="verdict" name="like" type="hidden" value="1">
	<span id='boutonlike'><input type="image" id="like" alt="pouceup" src="liiiiiiiiiiiiiike.png"><?= $likes ?></span>
</form>

<form method="post" action=<?='like-product-'.$_GET['id'].'.html'?>>
	<input id="verdict" name="dislike" type="hidden" value="0">
	<span id='boutonlike'><input type="image" id="dislike" alt="poucedown" src="disliiiiiiiiiiiiiiiiiiiike.png"><?= $dislikes ?></span>
</form>
</span>

<?php }
	else
	{
		echo ?> <p>Vous avez déja évalué ce produit</p>
				<img src="liiiiiiiiiiiiiike.png" alt="imagelike" id="imagelike"><?= $likes ?> <img src="disliiiiiiiiiiiiiiiiiiiike.png" alt="imagedislike" id="imagedislike"><?= $dislikes ?>
	<?php }
?>

<!--Affichage des commentaires sur le produit-->
<?php
foreach ($listComments as $comment)
{
?>
  <p><?= $comment['author'] ?></p>
  <p><?= $comment['creationDate'] ?></p>
  <p><?= nl2br$comment['content'] ?></p>
<?php
}

