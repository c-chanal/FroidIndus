<?php
/**
 * Classe abstraite Entite encapsulant les assesseurs en lecture et �criture
 * par d�faut aux attributs d'une classe.
 * N'a de sens que pour les classes de la couche mod�le qui ne contiennent
 * que des attributs et leurs assesseurs.
 *
 * @author Philippe_2
 */
abstract class Entite {
	/**
	 * Mutateur simple d'acc�s en �criture � un attribut.
	 * Peut �tre surcharg�.
	 * @param type $attribut le nom de l'attribut � modifier
	 * @param type $valeur la nouvelle valeur de l'attribut
	 * @return \Entite l'objet courant pour faciliter le chainage des set.
	 */
	protected function set($attribut, $valeur)
	{
		$this->$attribut = $valeur;
		return $this;
	}
	
	/**
	 * Lecteur simple d'acc�s en lecture � un attribut
	 * Peut �tre surcharg�.
	 * @param type $propriete le nom de l'attribut
	 * @return type la valeur de l'attribut
	 */
	protected function get($attribut)
	{
		return $this->$attribut;
	}
	
	/**
	 * M�thode "magique" interceptant l'appel de m�thode et cherchant a ex�cuter
	 * les assesseurs.
	 * @param type $methode nom complet de la m�thode
	 * @param type $attribValeur la valeur pass�e en param�tre � la m�thode
	 * @return type le r�sultat de l'ex�cution
	 */
	public function __call($methode, $attribValeur)
	{
		$prefix = substr($methode, 0, 3);
		$suffix = chr(ord(substr($methode, 3, 1)));
		$suffix .= substr($methode, 4);
		$cattrs = count($attribValeur);
		if(property_exists($this, $suffix))
		{
			if($prefix == 'set' && $cattrs == 1)
				return $this->set ($suffix, $attribValeur[0]);
			if($prefix == 'get' && $cattrs == 0)
				return $this->get($suffix);
		}
		trigger_error("La méthode $methode n'existe pas...");
	}
}

?>
