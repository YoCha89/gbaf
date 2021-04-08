<p>Bienvenu sur votre portail GBAF !</p>

<form method="post" action="">
	<label for="userName">Nom d'utilisateur</label>
	<input type="text" name="userName">
	<label for="pass">Mot de passe</label>
	<input type="password" name="pass">
	<button type="submit">Se connecter</button>
</form>

<p>En cas d'oublie, merci d'entrez votre nom d'utilisateur avant de valider</p>
<form method="post" action="bootstrap.php?action=updatePass">
	<label for="userName">Nom d'utilisateur</label>
	<input type="text" name="userName">
	<button type="submit">Mot de passe oublié</button>
</form>

<p>Vous n'avez pas encore de compte ?</p>
<form method="post" action="bootstrap.php?action=createAccount">
	<button type="submit">Créer mon compte</button>
</form>




<!--Connexion requise pour accéder aux informations du site via un UserName
et un Password.
● Au chargement de la page, les champs UserName et Password prennent
toute la largeur de l’écran, entre le h eader et le f ooter .

Si l'utilisateur est déconnecté, il est redirigé automatiquement vers la
première page pour une nouvelle connexion via un UserName et un
Password.-->