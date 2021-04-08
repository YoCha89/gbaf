
<form method="post" action="bootstrap.php?action=updatePass&userName=<?=$_POST['userName']?>">
	<p>Pour mettre à jour votre mot de passe, répondez à votre question secrète.</p>

	<label for="newPass">Nouveau mot de passe</label>
	<input type="password" name="newPass">
	<label for="ConfNewPass">Confirmer le nouveau mot de passe</label>
	<input type="password" name="ConfNewPass">
	<p>Question secrète : <?= nl2br(htmlspecialchars($employee['secretQ'])) ?></p>
	<label for="secretA">Entrez votre réponse secrète</label>
	<input type="text" name="secretA">
	<input id="userName" name="userName" type="hidden" value="<?=$employee['userName']?>">
	<button type="submit">Mettre à jour</button>
</form>




<!--Si l'utilisateur oublie son mot de passe, il peut saisir son UserName et
répondre à la question secrète pour en créer un nouveau.-->