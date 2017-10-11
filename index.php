<?php
//$bdd = new PDO('mysql:host=localhost;dbname=pt_smartcart','pt_smartcart', 'U3VJd4Q5');

$bdd = new PDO('mysql:host=localhost;dbname=cdiscount','root','');

if(isset($_POST['sinscrire'])) {
	if(!empty($_POST['email'])) {
	$email=$_POST['email'];

	$requete=$bdd->query("INSERT INTO abonne (mail) values ('$email')");

	$requete->closeCursor();	
	}
	else {
		$error = "Je suis une erreur";
	}

}

?>

<!DOCTYPE html>
<html>

<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">

	<meta charset="utf-8">
	<title>Teaser</title>
</head>

<body>
	<div id="fb-root"></div>
	<div class="row">
		<div class="col-md-offset-3 col-md-6 main_teaser">

			<div id="top-form_teaser">

				<h1 id="main_title">It's raining bags!</h1>
				<br>
				<p>SmartCart est le site internet qui va révolutionner vos achats sur Internet, en vous proposant des packs d'articles pré-faits.
					<br> Arrivée imminente...</p>
				<br>
				
			</div>
			<form class="form_teaser" method="POST" action="index.html" onsubmit="return verifForm(this)">
				<p>Restons en contact, vous ne serez pas spammé mais privilégié !</p>
				
				<div id="error"></div>
				
				<input class="email_teaser" type="mail" name="email" placeholder="Votre adresse E-mail" onblur="verifMail(this)" />
				<input class="submit_teaser" name="sinscrire" type="submit" value="S'inscrire" />
			</form>
		</div>
	</div>
	<div class="row social-networks">
		<div class="col-md-offset-4 col-md-2 btn-fb">
			<div class="fb-like" data-href="https://www.facebook.com/SmartCart_off-757030314487848/" data-layout="button_count" data-action="like" data-size="large" data-show-faces="false" data-share="false"></div>
		</div>
		<div class="col-md-2">
			<a href="https://twitter.com/SmartCart_fr?ref_src=twsrc%5Etfw" class="twitter-follow-button" 
				data-size="large" 
				data-lang="fr" 
				data-show-count="false"
				data-show-screen-name="false">
			</a>
		</div>
	</div>
</body>

<footer>
	<div class="container container-footer">
		<div class="row">
			<div class="col-md-3">
				<p>&copy; SmartCart</p>
			</div>
			<div class="col-md-3">
				<p>Designed by Thomas Beaupertuis</p>
			</div>
			<div class="col-md-offset-3 col-md-3">
				<button type="button" class="btn-transp-white" data-toggle="modal" data-target="#myModal">S'inscrire à la Newsletter</button>
			</div>
		</div>
	</div>
	<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">S'inscrire à la Newsletter</h4>
        </div>
        <div class="modal-body">
          <form class="form_teaser" method="POST" action="index.php" onsubmit="return verifForm(this)">
		<p>Restons en contact, vous ne serez pas spammé !</p>
		<p id="error"><?php if (isset($error)) { echo $error; } ?></p>
		<input class="email_teaser" type="mail" name="email" placeholder="Votre adresse E-mail" onblur="verifMail(this)" />
		<input class="submit_teaser" name="sinscrire" type="submit" value="S'inscrire" />
	</form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
</footer> 
	<!-- SCRIPTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/carts_effect_main.js"></script>
	<script src="js/main_verif_mail.js"></script>
	<script src="js/fb.js"></script>
</html>