function surligne(champ, erreur) {
		if (erreur) champ.style.backgroundColor = "#fba";
		else champ.style.backgroundColor = "#FFFFF";
	}

	/*function verifMail(champ) {
		var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
		if (!regex.test(champ.value)) {
			surligne(champ, true);
			return false;
		}
		else {
			surligne(champ, false);
			return true;
		}
	}*/

	function verifForm(f) {
		var mailOk = verifMail(f.email);

		if (mailOk) {
			test.innerHTML = "<div class=\"alert alert-success danger-email\"> <p id=\"error\">Merci, nous vous tiendrons informé !</p> </div>";
			return true;
		}
		else {
			var test = document.getElementById('error');
			test.innerHTML = "<div class=\"alert alert-danger danger-email\"> <p id=\"error\">Veuillez saisir une adresse mail valide</p> </div>";
			return false;
		}

	}
