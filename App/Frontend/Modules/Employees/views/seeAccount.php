

<h2>Paramètre du compte</h2>


	<p>
	<div id='champSeeA'>Nom : <?=$employee['name']?></div><br/>
	<div id='champSeeA'>Prénom : <?=$employee['firstName']?></div><br/>
	<div id='champSeeA'>Nom d'utilisateur : <?=$employee['userName']?></div><br/>
	</p>
</div>

<form method="post" action="bootstrap.php?action=updateAccount&id=<?=$employee['id']?>">
	<button type="submit" class="bouton">Mettre à jour</button>
</form>

<a href="bootstrap.php?action=showProducts"><div id="lienPartenaires">Consulter la liste des partenaires</div></a>




