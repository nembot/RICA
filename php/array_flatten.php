<?php

// Aplatit la structure d'un array, sans conserver les clés
function array_flatten($Array)
	{
	$FlatArray = array();
	foreach($Array as $SubArray)
		{
		if (is_array($SubArray)) { $FlatArray = array_merge($FlatArray, array_flatten($SubArray)); }
		else              		 { $FlatArray[] = $SubArray; }
		}
	return $FlatArray;
	}

?>
