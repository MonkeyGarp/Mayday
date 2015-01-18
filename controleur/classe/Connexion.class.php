<?php

class Connexion
{
	private static 	$host = "localhost",
					$user = "root",
					$pass = "",
					$bdd = "Mayday";

	public static function Connecter ()
	{
		try
		{
		    $db = new PDO("mysql:host=".self::$host."; dbname=".self::$bdd, self::$user, self::$pass);
		    return $db;
		}
		catch (Exception $e)
		{
		        die('Erreur : ' . $e->getMessage());
		        return null;
		}
	}

}

?>