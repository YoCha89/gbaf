
<p>Créez votre compte pour accéder à votre portail.</p>

<form method="post" action="create-account.html">
	<?= isset($erreurs) && in_array(\Entity\Employees::NOM_INVALIDE, $erreurs) ? 'Veuillez saisir un nom.<br />' : '' ?>
	<label for="Name">Nom</label>
	<input type="text" name="Name">
	<?= isset($erreurs) && in_array(\Entity\Employees::PRENOM_INVALIDE, $erreurs) ? 'Veuillez saisir un prénom.<br />' : '' ?>
	<label for="firstName">Prénom</label>
	<input type="text" name="firstName">

	<?= isset($erreurs) && in_array(\Entity\Employees::ALIAS_INVALIDE, $erreurs) ? 'Veuillez saisir un nom d\'utilisateur.<br />' : '' ?>
	<label for="userName">Nom d'utilisateur</label>
	<input type="text" name="userName">
	

	<?= isset($erreurs) && in_array(\Entity\Employees::MOT_DE_PASSE_INVALIDE, $erreurs) ? 'Veuillez saisir un autre mot de passe.<br />' : '' ?>
	<label for="pass">Mot de passe</label>
	<input type="password" name="pass">
	<?= isset($erreurs) && in_array(\Entity\Employees::MOT_DE_PASSE_INVALIDE, $erreurs) ? 'Veuillez saisir un autre mot de passe.<br />' : '' ?>
	<label for="confPass">Confirmer le mot de passe</label>
	<input type="password" name="confPass">

	<p>Si vous perdez votre mot de passe, vous aurez besoin de votre nom d'utilisateur et de votre réponse secrète pour le récupérer. Assurez-vous de les conserver.</p>

	<?= isset($erreurs) && in_array(\Entity\Employees::QUESTION_INVALIDE, $erreurs) ? 'Veuillez saisir votre question secrète à nouveau (et si besoin, la réponse qui concorde).<br />' : '' ?>
	<label for="secretQ">Saisissez votre question secrète</label>
	<input type="text" name="secretQ">
	<?= isset($erreurs) && in_array(\Entity\Employees::REPONSE_INVALIDE, $erreurs) ? 'Veuillez saisir votre réponse secrète à nouveau.<br />' : '' ?>
	<label for="secretA">Saisissez votre réponse secrète</label>
	<input type="text" name="secretA">

	<button type="submit">Créer</button>
</form>







<!--
WARNING : afin d'avoir un système de récupération de mot de passe viable, le userName doit être unique

Champs requis sur la page d’inscription :
○ Nom ;
○ Prénom ;
○ UserName ;
○ Password ;
○ Question secrète ;
○ Réponse à la question secrète.-->