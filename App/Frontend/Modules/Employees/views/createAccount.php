
<p>Créez votre compte pour accéder à votre portail.</p>

<div class="form">
	<div class="blocForm">
		<form method="post" action="bootstrap.php?action=createAccount">
			<?= isset($erreurs) && in_array(\Entity\Employees::NOM_INVALIDE, $erreurs) ? 'Veuillez saisir un nom.<br />' : '' ?>
			<div class="champ">
				<label for="name">Nom :</label>
				<input type="text" name="name"><br/>
			</div>
			<?= isset($erreurs) && in_array(\Entity\Employees::PRENOM_INVALIDE, $erreurs) ? 'Veuillez saisir un prénom.<br />' : '' ?>
			<div class="champ">
				<label for="firstName">Prénom :</label>
				<input type="text" name="firstName"><br/>
			</div>

			<?= isset($erreurs) && in_array(\Entity\Employees::ALIAS_INVALIDE, $erreurs) ? 'Veuillez saisir un nom d\'utilisateur.<br />' : '' ?>
			<div class="champ">
				<label for="userName">Nom d'utilisateur :</label>
				<input type="text" name="userName"><br/>
			</div>
			
			<hr>

			<?= isset($erreurs) && in_array(\Entity\Employees::MOT_DE_PASSE_INVALIDE, $erreurs) ? 'Veuillez saisir un autre mot de passe.<br />' : '' ?>
			<div class="champ">
				<label for="pass">Mot de passe :</label>
				<input type="password" name="pass"><br/>
			</div>
			<?= isset($erreurs) && in_array(\Entity\Employees::MOT_DE_PASSE_INVALIDE, $erreurs) ? 'Veuillez saisir un autre mot de passe.<br />' : '' ?>
			<div class="champ">
				<label for="confPass">Confirmer le mot de passe :</label>
				<input type="password" name="confPass"><br/>
			</div>

			<hr>

			<p>Si vous perdez votre mot de passe, vous aurez besoin de votre nom d'utilisateur et de votre réponse secrète pour le récupérer. Assurez-vous de les conserver.</p><br/>

			<?= isset($erreurs) && in_array(\Entity\Employees::QUESTION_INVALIDE, $erreurs) ? 'Veuillez saisir votre question secrète à nouveau (et si besoin, la réponse qui concorde).<br />' : '' ?>
			<div class="champ">
				<label for="secretQ">Saisissez votre question secrète :</label>
				<input type="text" name="secretQ"><br/>
			</div>
			<?= isset($erreurs) && in_array(\Entity\Employees::REPONSE_INVALIDE, $erreurs) ? 'Veuillez saisir votre réponse secrète à nouveau.<br />' : '' ?>
			<div class="champ">
				<label for="secretA">Saisissez votre réponse secrète :</label>
				<input type="text" name="secretA"><br/>
			</div>

			<button type="submit" class="bouton">Créer</button>
		</form>
</div>







<!--
WARNING : afin d'avoir un système de récupération de mot de passe viable, le userName doit être unique

Champs requis sur la page d’inscription :
○ Nom ;
○ Prénom ;
○ UserName ;
○ Password ;
○ Question secrète ;
○ Réponse à la question secrète.-->