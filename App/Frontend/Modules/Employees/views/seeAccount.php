

<h2>Paramètre du compte</h2>

<p>

Nom : <?$employee['name']?><br/>

Prénom : <?$employee['firstName']?> <br/>	

Nom d'utilisateur : <?$employee['userName']?><br/>

</p>

<form method="post" action="<?='update-account-'.$_SESSION['id'].'html'?>">
	<button type="submit">Mettre à jour ses informations</button>
</form>



