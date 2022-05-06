<?php

// Transforme une chaine d'éléments en un tableau associatif
function assocElements($Elements)
	{
	$Tableau = array();
	$Elements = preg_split("#§#", $Elements);
	$E=1; while(isset($Elements[$E])) 
		{
		preg_match("#^(?:([^:]*) : )?(.*)$#", $Elements[$E], $Matches);
		if ($Matches[1] != "")
			{
			if (isset($Tableau[ $Matches[1] ]))	{ $Tableau[ $Matches[1] ] .= ", ".$Matches[2]; }
			else								{ $Tableau[ $Matches[1] ] = $Matches[2]; }
			}
		else									{ $Tableau[] = $Matches[2]; }
		$E++;
		}
	
	return $Tableau;
	}

?>
