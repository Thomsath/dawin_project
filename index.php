<?php
//$bdd = new PDO('mysql:host=localhost;dbname=pt_smartcart','pt_smartcart', 'U3VJd4Q5');

//$bdd = new PDO('mysql:host=localhost;dbname=cdiscount','root','');

if(isset($_POST['sinscrire'])) {
	if(!empty($_POST['email']) && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			if(isset($error)) {
					unset($error);
			}

	$email=$_POST['email'];

	//$requete=$bdd->query("INSERT INTO abonne (mail) values ('$email')");

	//$requete->closeCursor();

	$done = "Merci, nous vous tiendrons informé!";
	}
	else {
		if(isset($done)) {
				unset($done);
		}
		$error = "Veuillez saisir une adresse mail valide";
	}

}


?>

<!DOCTYPE html>
<html>

<head>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="style.css" media="screen" title="no title" charset="utf-8">
	<link rel="shortcut icon" href="images/favicon.png" />

	<meta charset="utf-8">
	<title>SmartCart - Accueil</title>
</head>

<body>
	<div class="container">
		<div id="fb-root"></div>
		<div class="row">
			<div class="col-md-offset-2 col-md-8 main_teaser">

				<div id="top-form_teaser">
					<img src="images/logo.png" id="logo" alt="Logo SmartCart">
					<h1 id="main_title">It's raining bags!</h1>
					<br>
					<p>SmartCart est le site Internet qui va révolutionner vos achats sur Internet, en vous proposant des kits de produits préparés pour vous. Arrivée imminente...</p>
					<br>

				</div>
				<form class="form_teaser" method="POST" action="index.php" onsubmit="return verifForm(this)">
					<p>Restons en contact, vous ne serez pas spammé mais privilégié !</p>

					<?php if (isset($error)) { ?> <div class="alert alert-danger"> <p id="error"><?php echo $error; ?></p></div> <?php }
					else if (isset($done)) { ?><div class="alert alert-success"> <p id="error"> <?php echo $done; ?></p></div> <?php } ?>


					<input class="email_teaser" type="mail" name="email" placeholder="Votre adresse E-mail" onblur="verifMail(this)" />
					<input class="submit_teaser" name="sinscrire" type="submit" value="S'inscrire" />
				</form>
			</div>
		</div>
		<div class="row social-networks">
			<div class="col-md-12">
				<div class="btns-center">
				<a href="https://twitter.com/SmartCart_fr?ref_src=twsrc%5Etfw" class="twitter-follow-button"
					data-size="large"
					data-lang="fr"
					data-show-count="false"
					data-show-screen-name="false" ></a>
				<div class="fb-like btn-fb"
					data-href="https://www.facebook.com/SmartCartfr-150271318914286/"
					data-layout="button_count"
					data-action="like"
					data-size="large"
					data-show-faces="false"
					data-share="false"></div>
				</div>
			</div>
		</div>
	</div>

	<!-- FOOTER -->

	<footer>

	<div class="container container-footer">
		<div class="row">
			<div class="col-md-2 col-sm-4 col-xs-6" id="cieName">
				<p>&copy; SmartCart</p>
			</div>
			<div class="col-md-3 col-sm-4 col-xs-6" id="designer">
				<p>Design par Thomas Beaupertuis</p>
			</div>
			<div class="col-md-offset-3 col-md-3 col-sm-4" id="newsletter">
				<p>2017-2018</p>
				<!--<button type="button" class="btn-transp-white" data-toggle="modal" data-target="#myModal">S'inscrire à la Newsletter</button>-->
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
		<p id="error_pop"><?php if (isset($error_pop)) { echo $error_pop; } ?></p>
		<input class="email_teaser_pop" type="email" name="email_pop" placeholder="Votre adresse" onblur="verifMail(this)" />
		<input class="submit_teaser_pop" name="sinscrire" type="submit" value="S'inscrire" />
	</form>
        </div>
      </div>

    </div>
  </div>

</div>
</footer>
</body>
	<!-- SCRIPTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/carts_effect_main.js"></script>
	<script src="js/main_verif_mail.js"></script>
	<script src="js/fb.js"></script>
	<script src="js/app.js"></script>
</html>
