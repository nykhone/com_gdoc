<?php
include 'data/SEANCE.php' ;
require_once('html/nyko_html.php');

function printTable( $theSS )
{
	startTable();

	for ( $aRowCpt = 0; $aRowCpt <= count( $theSS ); $aRowCpt++ )
	{
		startRow();
		for ( $aCellCpt = 1; $aCellCpt <= count( $theSS[$aRowCpt] ); $aCellCpt++ )
		{
//			if ( $aCellCpt == 1 || $aCellCpt == 2 || $aCellCpt == 12 )
//			{
				printCell( $theSS[ $aRowCpt ][ $aCellCpt ] );
//			}
		}
		endRow();
	}

	endTable();
}

?>

