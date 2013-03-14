<?php if(isset($_GET['step'])) { 
	// etape 2 verification du code recu
	if($_GET['step'] == '2') { ?>
	<form method="POST" action="controllers/verify_user_number.php">										
		<label for="expediteur">
				Entrez le code<br /> de verification 
		</label>
		<input name="expediteur" id="expediteur" type="text" placeholder="ex: Q5D6E (recu par SMS)"/>
									
		<button class="btn btn-info clearfix" type="submit">Verfier <i class="icon-double-angle-right"></i></button>
	</form>
	
	<?php }
	// etape 3 identification
	if($_GET['step'] == '3') { ?>
	<form method="POST" action="controllers/log_in.php">
		<label for="expediteur">
				Votre numero
		</label>
		
		<input name="user" id="user" type="text" placeholder="ex: +23799124249" />
		<label for="expediteur">
				Votre mot de passe
		</label>
		
		<input name="user" id="user" type="text" />
									
		<button class="btn btn-info clearfix" type="submit">Connexion <i class="icon-double-angle-right"></i></button>
	</form>
	
	
	<?php }
	// etape 6 num destinataires
	if($_GET['step'] == '6') { ?>
	<form method="POST" action="controllers/get_dest_number.php">
		<label for="expediteur">
				Numero destinataire
		</label>
		
		<div id="dd" class="wrapper-dropdown" tabindex="1">
			<span>Pays du destinataire</span>
			<ul class="dropdown">
				<li><a href="#">Cameroun <span class="indicatif">+237</span></a></li>
				<li><a href="#">C&ocirc;te d'ivoire <span class="indicatif">+225</span></a></li>
				<li><a href="#">Ghana <span class="indicatif">+233</span></a></li>
			</ul>
		</div>
		
		<input name="expediteur" id="expediteur" type="text" placeholder="ex: +23711111111"/>
									
		<button class="btn btn-info clearfix" type="submit">Suivant <i class="icon-double-angle-right"></i></button>
	</form>
	<?php }
	
	// etape 7 num destinataires
	if($_GET['step'] == '7') { ?>
	<form method="POST" id="myform" action="controllers/check_sms.php">
		<label for="expediteur">
				De <span> +23799124249 </span>
		</label>
		
		<label for="expediteur">
			Votre Correspondant
		</label>
		
		<div id="dd" class="wrapper-dropdown" tabindex="1">
			<span>Pays du destinataire</span>
			<ul class="dropdown">
				<li><a href="#">Cameroun <span class="indicatif">+237</span></a></li>
				<li><a href="#">C&ocirc;te d'ivoire <span class="indicatif">+225</span></a></li>
				<li><a href="#">Ghana <span class="indicatif">+233</span></a></li>
			</ul>
			
			<input id="num_expediteur" type="hidden" name="num_expediteur"/>
		
		</div>
		<input name="expediteur" id="expediteur" type="text" placeholder="ex: +23711111111"/>
		<div>Votre message
		<div id="count">145</div>
		<div id="barbox"><div id="bar"></div></div>
		</div>
		<textarea id="contentbox"></textarea>
		<button class="btn btn-info clearfix" type="submit">Suivant <i class="icon-double-angle-right"></i></button>
	</form>
	<?php }
	
	// etape 7 num destinataires
	if($_GET['step'] == '8') { ?>
	<form method="POST" id="myform" action="controllers/check_sms.php">
		<label for="expediteur">
				De <span> +23799124249 </span>
		</label>
		
		<label for="recepteur">
			A <span> +23776270034 </span>
		</label>
		
		<label for="message">
			Votre message :<br />
			<span style="font-style:italic"> "Ici on redige le message de notre correspondant et on s'assure que celui ci est expedie. Merci"</span>
		</label>
		
		
		
		<button class="btn btn-info clearfix" type="submit">Confirmer et envoyer <i class="icon-double-angle-right"></i></button>
	</form>
	
	<?php }
	
	// etape 7 num destinataires
	if($_GET['step'] == '9') { ?>
	<div>
		<br /><br />
		Votre message a bien ete bien envoye. <br /><br /><br />
		<button class="btn btn-info clearfix" type="submit">Envoyer un autre message<i class="icon-double-angle-right"></i></button><br /><br /><br /><br /><br />
		
	</div>
	
	<?php }
 } else { ?>
<form method="POST" action="controllers/get_user_number.php">										
	<label for="expediteur">
			Votre Num&eacute;ro
	</label>
	
	<div id="dd" class="wrapper-dropdown" tabindex="1">
		<span>Pays de l'exp&eacute;diteur</span>
		<ul class="dropdown">
			<li><a href="#">Cameroun <span class="indicatif">+237</span></a></li>
			<li><a href="#">C&ocirc;te d'ivoire <span class="indicatif">+225</span></a></li>
			<li><a href="#">Ghana <span class="indicatif">+233</span></a></li>
		</ul>
		<input id="ind_num" type="hidden" name="ind_num"/>
	</div>
	
	<input name="expediteur" id="expediteur" type="text" placeholder="ex: +23711111111"/>
								
	<button class="btn btn-info clearfix" type="submit">Suivant <i class="icon-double-angle-right"></i></button>
</form>
<?php } ?>