<?php

function BBClan($Texte, $Clan)
	{
	switch($Clan)
		{
		case "Contrebande":	return "[color=darkgreen]".$Texte."[/color]";
		case "Empire":		return "[color=darkblue]".$Texte."[/color]";
		case "Rebellion":	return "[color=darkred]".$Texte."[/color]";
		default:			return $Texte;
		}
	}

?>
