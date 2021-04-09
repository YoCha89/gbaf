<img src="<?=$product['logoUrl']?>" alt="logoPartenaireU" id="logoPartenaireU"/>
<h2><?= $product['title'] ?></h2>
<a href=""></a>
<p><?= nl2br($product['description'])?></p>

<form method="post" action="bootstrap.php?action=commentProduct&id=<?= $product['id']?>">
	<input id="SalId" name="SessionId" type="hidden" value="<?= $salId ?>">
	<input id="firstName" name="SessionFName" type="hidden" value="<?= $firstName ?>">
	<?= isset($erreurs) && in_array(\Entity\Comments::CONTENU_INVALIDE, $erreurs) ? 'Veuillez saisir un commentaire textuel.<br />' : '' ?>
	<label for="commentaire">Rédigez votre commentaire</label>
	<input type="text" name="content" id="commentaire">
	<div class="button">
    <button type="submit">Valider</button>
    </div>
</form>




