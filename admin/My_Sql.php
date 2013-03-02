<?php

class My_Sql
{
	private $_link;

	# connections data for mysql
	const DB_URL = 'localhost';
	const DB_USER = 'nykhos';
	const DB_PASSWORD = 'nykhone';
	const DB_NAME = 'cine_stats';

	const DEBUG = true;

	# anciennement connect
	public function __construct()
    {
		$_link = mysql_connect (
			self::DB_URL,
			self::DB_USER,
			self::DB_PASSWORD
		)
		or die ( "erreur de connexion au serveur: no user " + self::DB_USER + " in da database" );

		mysql_select_db( self::DB_NAME )
		or die ( "erreur de connexion a la base de donnees: no database" + self::DB_NAME );
	}

	public function disconnect()
	{
		mysql_close( $_link );
	}
/*
private function nyko_escape_char($TheString)
	{
		$aEscapedString = mysql_real_escape_string($TheString);
		return $aEscapedString;
	}

	public function nyko_select( $theFields, $theTables, $theJoints = "", $theWheres = "", $TheGroups = "", $TheOrders = "", $TheLimit = "", $TheInterval = "" )
	{
		$aQuery = "select $theFields from $theTables";
		if ($theWheres != "" or $theJoints != "") { $aQuery = $aQuery . " where"; }
		if ($theWheres == "" and $theJoints != "") { $aQuery = $aQuery . " $theJoints"; }
		if ($theWheres != "" and $theJoints == "") { $aQuery = $aQuery . " $theWheres"; }
		if ($theWheres != "" and $theJoints != "") { $aQuery = $aQuery . " $theJoints and $theWheres"; }
		if ($TheGroups != "") { $aQuery = $aQuery . " group by $TheGroups"; }
		if ($TheOrders != "") { $aQuery = $aQuery . " order by $TheOrders"; }
		if ($TheLimit != "") { $aQuery = $aQuery . " limit $TheLimit , $TheInterval"; }

		if ( self::DEBUG ) { print("$aQuery<br>"); }

		$aResult = mysql_query("$aQuery") or die ("Requete invalide : $aQuery");

		if ($aResult) { return $aResult; }
		else { print("probleme lors de ce select : $aQuery<br>");	}
	}

function nyko_update( $aTable, $aChange, $aWheres )
{
	$aQuery = "update $aTable set $aChange";
	if ($aWheres != "") { $aQuery = $aQuery . " where $aWheres"; }

	$aResult = mysql_query("$aQuery") or die ("Requete invalide : $aQuery");
	if ($aResult) {
		if ( self::DEBUG ) {
			$aAffected = mysql_affected_rows();
			print("$aAffected enregistrement(s) affect�(s) pour cette requ�te $aQuery<br>");
		}
	}
	else { print("probleme lors de cet update : $aQuery<br>"); }
}

function nyko_delete( $aTable, $aWheres )
{
	$aQuery = "delete from $aTable where $aWheres";
	$aResult = mysql_query("$aQuery") or die ("Requete invalide : $aQuery");
	if ($aResult) {
		if ( self::DEBUG ) {
			$aAffected = mysql_affected_rows();
			print("$aAffected enregistrement(s) affect�(s) pour cette requ�te $aQuery<br>");
		}
	}
	else { print("probleme lors de cet delete : $aQuery<br>"); }
}
*/
	public function nyko_insert( $theTable, $theFields, $theValues )
	{
		$aQuery = "insert into $theTable ( $theFields ) values ( $theValues )";
		$aResult = mysql_query( "$aQuery" );
		if ( $aResult )
		{
			if ( self::DEBUG )
			{
				$aAffected = mysql_affected_rows();
				print( "$aAffected enregistrement(s) affecte(s) pour cette requete $aQuery<br>" );
			}
		}
		else
		{
			print( "probleme lors de cet insert : $aQuery<br>" );
		}
	}
}
?>