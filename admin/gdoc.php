<?php

require_once('google_docs/nyko_google.php');

JToolbarHelper::title( "GDoc" );

$aGNT = new nyko_google();
$aList = $aGNT->get_spreadsheets_list();

$aCpt = 1;
foreach ( $aList as $aSpreadsheet )
{
	if ( preg_match( "/^ok-/", $aSpreadsheet->title ) )
	{
		print "<br/> <b>doc #$aCpt</b> - $aSpreadsheet->title";
		$aTest = preg_replace( "/^https:\/\/spreadsheets.google.com\/feeds\/spreadsheets\/(.*)/", "$1", "$aSpreadsheet->id" );
		print "<br/>";
		print "link = <a href='/cine_stats/list_one.php?spread=$aTest'>$aTest</a>";
		print "<br/>";
		print "<a href='/cine_stats/import_all.php?spread=$aTest'>import in database</a>";
		print "<br/>";
	}
	$aCpt++;
}

?>
