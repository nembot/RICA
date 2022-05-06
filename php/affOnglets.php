<?php

function affOnglets( $Array, $ID )
	{
	$Onglets = "";
	
	/* Tête */
	$Onglets .= "<div class=\"onglets\" id=\"".$ID."\">";
	
	/* Elements */
	foreach($Array as $I => $V)
		{
		if (isset($V['label']))
			{
			if (isset($V['lien']))	{ $Onglets .= "<a href=\"index.php?P=".$I."\""; }
			else					{ $Onglets .= "<span"; }
		
			if (isset($V['click']))	{ $Onglets .= " onclick=\"onglet(this, 'form_".$I."')\""; }
			if (isset($V['class']))	{ $Onglets .= " class=\"".$V['class']."\""; }
		
			$Onglets .= ">".$V['label'];
		
			if (isset($V['lien']))	{ $Onglets .= "</a>"; }
			else					{ $Onglets .= "</span>"; }
			}
		}
	
	/* Pied */
	$Onglets .= "</div>";
	
	return $Onglets;
	}

?>
