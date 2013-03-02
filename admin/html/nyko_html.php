<?php
require_once 'data/SEANCE.php';

function startTable()
{
	print "<table border='1'>";
}

function startRow()
{
	print "<tr>";
}

function endRow()
{
	print "</tr>";
}

function endTable()
{
	print "</table>";
}

function printCell( $theCellText )
{
	print "<td>";
	print $theCellText;
	print "</td>";
}

function print_cell_link( $__cell_text, $__cell_link )
{
	print "<td><a href='";
	print $__cell_link;
	print "' target=_blank>";
	print $__cell_text;
	print "</a></td>";
}

?>