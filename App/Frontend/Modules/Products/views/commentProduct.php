


<form method="post" action="">
	<input id="SalId" name="SessionId" type="hidden" value="$_SESSION['id']">
	<input id="firstName" name="SessionFName" type="hidden" value="$_SESSION['firstName']">
	<?= isset($erreurs) && in_array(\Entity\Comments::CONTENU_INVALIDE, $erreurs) ? 'Veuillez saisir un commentaire textuel.<br />' : '' ?>
	<label for="commentaire">Rédigez votre commentaire</label>
	<input type="text" name="content" id="commentaire">
	<div class="button">
    <button type="submit">Valider</button>
    </div>
</form>




