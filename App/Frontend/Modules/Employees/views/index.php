<div id="principal">

	<div id="bandeauAccueil"><p><span id="txtBandeauAccueil">Bienvenu sur votre portail GBAF !</span></p></div>

	<div class="form">
		<div class="blocForm">
			<form method="post" action="bootstrap.php?action=index"><!--Bloc de connexion-->
				<div class="champ">
					<label for="userName">Nom d'utilisateur :</label>
					<input type="text" name="userName"><br/>
				</div>
				<div class="champ">
					<label for="pass">Mot de passe :</label>
					<input type="password" name="pass">
				</div>
					<br/><button type="submit" class="bouton">Se connecter</button>
			</form>
		</div>

		<div id="option2">
			<div id="blocOubli"><!--Bloc de mise à jour du mot de passe-->
				<p>En cas d'oublie, entrez votre nom d'utilisateur avant de valider</p><br/>
				<form method="post" action="bootstrap.php?action=updatePass">
					<div class="champ">
						<label for="userName">Nom d'utilisateur :</label><br/>
						<input type="text" name="userName">
					</div>
					<br/><button type="submit" class="boutonOp2">Mot de passe oublié</button>
				</form>
			</div>

			<div id="separeVert"></div>
			<hr id="separeHori">
		
				
			<div id="blocCrea"><!--Bloc de création de compte-->
				<p>Vous n'avez pas encore de compte ?</p><br/>
				<p>Créez votre compte dès maintenant !</p><br/>
				<form method="post" action="bootstrap.php?action=createAccount">
					<br/><button type="submit" class="boutonOp2">Créer mon compte</button>
				</form>
			</div>
		</div>
	</div>
</div>