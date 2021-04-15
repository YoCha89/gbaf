<div class="form">
	<p><div id='pMaj'>Mettez à jour les informations de votre compte.</div></p><br/>
	<div class="blocForm">
		<form method="post" action="bootstrap.php?action=updateAccount">
			<?= isset($erreurs) && in_array(\Entity\Employees::NOM_INVALIDE, $erreurs) ? 'Veuillez saisir un nom.<br />' : '' ?>
			<div class="champ">
			<label for="name">Nom : </label>
			<input type="text" name="name" value="<?php echo $employee['name'] ?>">
			</div>
			<?= isset($erreurs) && in_array(\Entity\Employees::PRENOM_INVALIDE, $erreurs) ? 'Veuillez saisir un prénom.<br />' : '' ?>
			<div class="champ">
			<label for="firstName">Prénom : </label>
			<input type="text" name="firstName" value="<?php echo $employee['firstName'] ?>">
			</div>

			<?= isset($erreurs) && in_array(\Entity\Employees::ALIAS_INVALIDE, $erreurs) ? 'Veuillez saisir un nom d\'utilisateur.<br />' : '' ?>
			<div class="champ">
			<label for="userName">Nom d'utilisateur : </label>
			<input type="text" name="userName" value="<?php echo $employee['userName'] ?>">
			</div>

			<?= isset($erreurs) && in_array(\Entity\Employees::QUESTION_INVALIDE, $erreurs) ? 'Veuillez saisir votre question secrète à nouveau (et si besoin, la réponse qui concorde).<br />' : '' ?>
			<div class="champ">
			<label for="secretQ">Saisissez votre question secrète : </label>
			<input type="text" name="secretQ" value="<?php echo $employee['secretQ'] ?>">
			</div>

			<?= isset($erreurs) && in_array(\Entity\Employees::REPONSE_INVALIDE, $erreurs) ? 'Veuillez saisir votre réponse secrète à nouveau.<br />' : '' ?>
			<div class="champ">
			<label for="secretA">Saisissez votre réponse secrète : </label>
			<input type="text" name="secretA" value="<?php echo $employee['secretA'] ?>">
			</div>

			<button type="submit" class="bouton">Mettre à jour</button>
		</form>
	</div>
</div>