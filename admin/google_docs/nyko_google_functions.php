<?php

function isNullRow( $theRow )
{
	return ( $theRow[ 0 ]->getText() == '-' );
}