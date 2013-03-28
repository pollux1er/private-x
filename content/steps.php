<?php 
	include_once __includes_path__."/dao/config.inc.php";
	include_once __includes_path__."/dao/db.class.php";
	include_once __includes_path__."/dao/entity.class.php";
	include_once __includes_path__."/sms/sms.class.php";
if(isset($_GET['step'])) { 
	// etape 2 verification du code recu
	if($_GET['step'] == '2') { ?>
	<form method="POST" action="controllers/verify_user_number.php">										
		<label for="expediteur">
				Entrez le code<br /> de verification 
		</label>
		<input name="code" id="code" type="text" placeholder="ex: Q5D6E (recu par SMS)" />
									
		<button class="btn btn-info clearfix" type="submit">Verfier <i class="icon-double-angle-right"></i></button>
	</form>
	
	<?php }
	// etape 3 identification
	if($_GET['step'] == '3') { ?>
	<form method="POST" action="controllers/log_in.php">
		<label for="expediteur">
				Votre numero
		</label>
		<input name="user" id="user" type="text" value="<?php echo $_SESSION['sender_number']; ?>" />
		<label for="expediteur">
				Votre code ou mot de passe
		</label>
		<input name="user" id="user" type="text" />					
		<button class="btn btn-info clearfix" type="submit">Connexion <i class="icon-double-angle-right"></i></button>
	</form>
	
	
	<?php }
	// etape 6 num destinataires
	if($_GET['step'] == '6' && isset($_SESSION['sender_number'])) {
		$sms = new sms($_SESSION['sender_number']);
		$nbsms = $sms->get_nb_sms_sent_today();
		if($nbsms < $sms->max_sms) { 
	?>
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
		<input id="ind_num" type="hidden" name="ind_num"/>
		<input name="expediteur" id="expediteur" type="text" placeholder="ex: +23711111111"/>
									
		<button class="btn btn-info clearfix" type="submit">Suivant <i class="icon-double-angle-right"></i></button>
	</form>
	<?php } else { ?>
		<div>
		<br /><br />
		Votre limite de SMS a ete atteinte pour aujourd'hui. <br /><br /><br />
		<button class="btn btn-info clearfix" onclick="window.location='main.php?do=invite'" type="submit">Invitez des amis et envoyez plus de sms<i class="icon-double-angle-right"></i></button><br />
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-9496068225375418";
		/* SMS4EVER - */
		google_ad_slot = "6726011340";
		google_ad_width = 234;
		google_ad_height = 60;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
	</div>
	<?php }
	}
	// etape 7 num destinataires
	if($_GET['step'] == '7') { ?>
	<form method="POST" id="myform" action="controllers/check_sms.php">
		<label for="expediteur">
			De <span> <?php echo $_SESSION['sender_number']; ?> </span>
            <button class="btn btn-info clearfix" type="">Modifier <i class="icon-double-angle-left"></i></button>
		</label>
		<label for="expediteur">
			A <span> <?php echo $_SESSION['dest_number']; ?> </span>
            <button class="btn btn-info clearfix" type="">Modifier <i class="icon-double-angle-left"></i></button>
		</label>
		<div>Votre message
            <div id="count">145</div>
            <div id="barbox"><div id="bar"></div></div>
		</div>
		<textarea id="message" name="message"></textarea>
		<button class="btn btn-info clearfix" type="submit">Suivant <i class="icon-double-angle-right"></i></button>
	</form>
	<?php }
	
	// etape 7 num destinataires
	if($_GET['step'] == '8') { ?>
	<form method="POST" id="myform" action="controllers/send_sms.php">
		<label for="expediteur">
			De <span> <?php echo $_SESSION['sender_number']; ?> </span>
            <button class="btn btn-info clearfix" type="">Modifier <i class="icon-double-angle-left"></i></button>
		</label>
		<label for="recepteur">
			A <span> <?php echo $_SESSION['dest_number']; ?> </span>
            <button class="btn btn-info clearfix" type="">Modifier <i class="icon-double-angle-left"></i></button>
		</label>
		<label for="message">
			Votre message :<br />
			<span style="font-style:italic"><?php echo $_SESSION['message']; ?></span>
		</label>
        <button class="btn btn-info clearfix" type="">Modifier le message <i class="icon-double-angle-left"></i></button><br />
		<button class="btn btn-info clearfix" type="submit">Confirmer et envoyer <i class="icon-double-angle-right"></i></button>
	</form>
	
	<?php }
	
	// etape 7 num destinataires
	if($_GET['step'] == '9') { ?>
	<div>
		<br /><br />
		Votre message a bien ete bien envoye. <br /><br /><br />
		<button class="btn btn-info clearfix" onclick="window.location='main.php?step=6'" type="submit">Envoyer un autre message<i class="icon-double-angle-right"></i></button><br />
		<script type="text/javascript"><!--
		google_ad_client = "ca-pub-9496068225375418";
		/* SMS4EVER - */
		google_ad_slot = "6726011340";
		google_ad_width = 234;
		google_ad_height = 60;
		//-->
		</script>
		<script type="text/javascript"
		src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
		</script>
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
<h1 class="frontpageHeadline">Envoyez des SMS &agrave; vos amis! (C'est gratuit!)</h1>
<?php } ?>