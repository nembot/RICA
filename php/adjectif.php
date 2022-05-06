<?php

function adjectif($Clan)
	{
	switch($Clan)
		{
		case "Contrebande":	return "contrebandier"; break;
		case "Empire":		return "impérial"; break;
		case "Rebellion":	return "rebelle"; break;
		default:			return "neutre"; break;
		}
	}

?>
