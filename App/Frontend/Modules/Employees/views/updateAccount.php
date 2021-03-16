
<p>Mettez à jour les informations de votre compte.</p>

<form method="post" action="<?='update-account-'.$_POST['id'].'.html'?>">
	<?= isset($erreurs) && in_array(\Entity\Employees::NOM_INVALIDE, $erreurs) ? 'Veuillez saisir un nom.<br />' : '' ?>
	<label for="name">Nom</label>
	<input type="text" name="Name" value="<?php echo $employee['name'] ?>">
	<?= isset($erreurs) && in_array(\Entity\Employees::PRENOM_INVALIDE, $erreurs) ? 'Veuillez saisir un prénom.<br />' : '' ?>
	<label for="firstName">Prénom</label>
	<input type="text" name="firstName" value="<?php echo $employee['firstName'] ?>">

	<?= isset($erreurs) && in_array(\Entity\Employees::ALIAS_INVALIDE, $erreurs) ? 'Veuillez saisir un nom d\'utilisateur.<br />' : '' ?>
	<label for="userName">Nom d'utilisateur</label>
	<input type="text" name="userName" value="<?php echo $employee['userName'] ?>">

	<?= isset($erreurs) && in_array(\Entity\Employees::QUESTION_INVALIDE, $erreurs) ? 'Veuillez saisir votre question secrète à nouveau (et si besoin, la réponse qui concorde).<br />' : '' ?>
	<label for="secretQ">Saisissez votre question secrète</label>
	<input type="text" name="secretQ" value="<?php echo $employee['secretQ'] ?>">
	<?= isset($erreurs) && in_array(\Entity\Employees::REPONSE_INVALIDE, $erreurs) ? 'Veuillez saisir votre réponse secrète à nouveau.<br />' : '' ?>
	<label for="secretA">Saisissez votre réponse secrète</label>
	<input type="text" name="secretA" value="<?php echo $employee['secretA'] ?>">
</form>



<!--Chargement automatique des champs autre que MDP
lien de cette action au sein du Header-->

