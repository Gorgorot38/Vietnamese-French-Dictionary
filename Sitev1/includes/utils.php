<?php
function actualiser_session()
{
	if(isset($_SESSION['idU']) && intval($_SESSION['idU']) != 0) //Vérification id
	{
		//utilisation de la fonction sqlquery, on sait qu'on aura qu'un résultat car l'id d'un membre est unique.
		$retour = sqlquery("SELECT idU, pseudo FROM users WHERE idU = ".intval($_SESSION['idU']), 1);
		
		//Si la requête a un résultat (c'est-à-dire si l'id existe dans la table membres)
		if(isset($retour['pseudo']) && $retour['pseudo'] != '')
		{
			if($_SESSION['idU'] != $retour['pass'])
			{
				//Dehors vilain pas beau !
				$informations = Array(/*Mot de passe de session incorrect*/
									true,
									'Session invalide',
									'Le mot de passe de votre session est incorrect, vous devez vous reconnecter.',
									'',
									'membres/connexion.php',
									3
									);
				require_once('../information.php');
				vider_cookie();
				session_destroy();
				exit();
			}
			
			else
			{
				//Validation de la session.
					$_SESSION['idU'] = $retour['idU'];
					$_SESSION['pseudo'] = $retour['pseudo'];
					$_SESSION['pass'] = $retour['pass'];
			}
		}
	}
	
	else //On vérifie les cookies et sinon pas de session
	{
		if(isset($_COOKIE['idU']) && isset($_COOKIE['pass'])) //S'il en manque un, pas de session.
		{
			if(intval($_COOKIE['idU']) != 0)
			{
				//idem qu'avec les $_SESSION
				$retour = sqlquery("SELECT idU, pseudo, pass FROM users WHERE idU = ".intval($_COOKIE['idU']), 1);
				
				if(isset($retour['pseudo']) && $retour['pseudo'] != '')
				{
					if($_COOKIE['pass'] != $retour['pass'])
					{
						//Dehors vilain tout moche !
						$informations = Array(/*Mot de passe de cookie incorrect*/
											true,
											'Mot de passe cookie erroné',
											'Le mot de passe conservé sur votre cookie est incorrect vous devez vous reconnecter.',
											'',
											'membres/connexion.php',
											3
											);
						require_once('../information.php');
						vider_cookie();
						session_destroy();
						exit();
					}
					
					else
					{
						//Bienvenue :D
						$_SESSION['idU'] = $retour['idU'];
						$_SESSION['pseudo'] = $retour['pseudo'];
						$_SESSION['pass'] = $retour['pass'];
					}
				}
			}
			
			else //cookie invalide, erreur plus suppression des cookies.
			{
				$informations = Array(/*L'id de cookie est incorrect*/
									true,
									'Cookie invalide',
									'Le cookie conservant votre id est corrompu, il va donc être détruit vous devez vous reconnecter.',
									'',
									'membres/connexion.php',
									3
									);
				require_once('../information.php');
				vider_cookie();
				session_destroy();
				exit();
			}
		}
		
		else
		{
			//Fonction de suppression de toutes les variables de cookie.
			if(isset($_SESSION['idU'])) unset($_SESSION['idU']);
			vider_cookie();
		}
	}
}

function vider_cookie()
{
	foreach($_COOKIE as $cle => $element)
	{
		setcookie($cle, '', time()-3600);
	}
}
?>