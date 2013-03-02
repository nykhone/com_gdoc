<?php

function getValues( $aRow )
{
	$aValues = "";
	for ( $aCellCpt = 1; $aCellCpt <= count( $aRow ); $aCellCpt++ )
	{
			$aValues .= '"' . $aRow[ $aCellCpt ] . '"';
			if ( $aCellCpt < count( $aRow ) )
			{
				$aValues .= ", ";
			}
	}
	return $aValues;
}

?>