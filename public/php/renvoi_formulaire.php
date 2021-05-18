<?php



// AJAX ne va passer qu'un seul objet, à savoir CET ARRAY !
 $array = array("firstname" => "",
 	"name" => "",
 	"email" => "",
 	"phone" => "",
 	"message" => "",
 	"firstnameError" => "",
 	"nameError" => "",
 	"emailError" => "",
 	"phoneError" => "",
 	"messageError" => "",
 	"isSuccess" => false);

$emailTo = "jacobjeremy5610012@gmail.com";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	//verifyInput protège les variables instanciées
	 $array["firstname"] = test_input($_POST["firstname"]);
     $array["name"] = test_input($_POST["name"]);
     $array["email"] = test_input($_POST["email"]);
     $array["phone"] = test_input($_POST["phone"]);
     $array["message"] = test_input($_POST["message"]);
     $array["isSuccess"] = true; 
     $emailText = "";



	 if (empty($array["firstname"]))
        {
        	// si le champ de firstname est vide, affichage du message
            $array["firstnameError"] = "Je veux juste connaître votre prénom.";
            // le formulaire n'étant pas correctement rempli, isSuccess devient false
            $array["isSuccess"] = false; 
        } 
        else
        {
            $emailText .= "Firstname: {$array['firstname']}\n";
            /*
				-* => concaténation
				j'ajoute à l'email ce qui renseigné au sein du prénom
			*/
        }

        if (empty($array["name"]))
        {
            $array["nameError"] = "Ainsi que votre nom.";
            $array["isSuccess"] = false; 
        } 
        else
        {
            $emailText .= "Name: {$array['name']}\n";
        }

        if(!isEmail($array["email"]))
        	// si ça n'est pas un mail
        {
        	// affichage du message d'erreur
            $array["emailError"] = "Ceci n'est pas une adresse mail valide.";
            $array["isSuccess"] = false; 
        } 
        else
        {
            $emailText .= "Email: {$array['email']}\n";
        }

        if (!isPhone($array["phone"]))
        	// si ça n'est pas un téléphone
        {
            $array["phoneError"] = "Chiffres et espaces UNIQUEMENT.";
            $array["isSuccess"] = false; 
        }
        else
        {
            $emailText .= "Phone: {$array['phone']}\n";
        }

        if (empty($array["message"]))
        {
            $array["messageError"] = "Ce champ ne doit pas être vide.";
            $array["isSuccess"] = false; 
        }
        else
        {
            $emailText .= "Message: {$array['message']}\n";
        }
        
        if($array["isSuccess"]) 
        {
        	// Envoi de l'email
            $headers = "From: {$array['firstname']} {$array['name']} <{$array['email']}>\r\nReply-To: {$array['email']}";
            // avec cette-fonction-là, on envvoie notre email
            mail($emailTo, "Un message de votre site", $emailText, $headers);
            // paramétrage de ce que nous allons recevoir
        }
        

        // Demande au json d'encoder l'intégralité de l'objet array
        echo json_encode($array); 
    }


    /* LES FONCTIONS */

    function isEmail($email) 
    {
    	// filter_var = filtrer ce qui est mail ou pas : @, ., com/net/:fr ...
        return filter_var($email, FILTER_VALIDATE_EMAIL);
        // nous renvoie true ou false
    }

    function isPhone($phone) 
    {
    	// doit nous renvoyer true ou false
        return preg_match("/^[0-9 ]*$/",$phone);
        /* preg_match = REGEX
			/^ = commence avec un slash et le chapeau
			[0-9] = demande que ça soit entre 0 et 9 OU les espaces
			* = permet au champ d'être vide et de répéter autant de caractères possibles
		*/
    }

    function test_input($data) 
    {
    	/* nettoyer formulaire avec ces trois actions : trim / stripslashes /htmlspecialchars
		*/
      $data = trim($data);
      // stripslashes => enlever tous les antislashs
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
 
?>