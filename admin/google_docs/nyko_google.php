<?php

require_once('Zend/Loader.php');

class nyko_google
{
	# user and password for google spreadsheet
	const AUTH_USER = 'nicholas.dupuy.dev';
	const AUTH_PASSWORD = 'n.d.dev.2013';

	# page 1 code in google spreadsheet
	const AUTH_PAGE_1 = 'od6';

	public function __construct()
    {
		Zend_Loader::loadClass('Zend_Gdata');
		Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
		Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');
		Zend_Loader::loadClass('Zend_Http_Client');
	}

	public static function get_spreadsheets_service()
	{
		$aService = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
		$aClient = Zend_Gdata_ClientLogin::getHttpClient( self::AUTH_USER, self::AUTH_PASSWORD, $aService );
		$aSS_Service = new Zend_Gdata_Spreadsheets( $aClient );
		return $aSS_Service;
	}

	public static function get_spreadsheets_list()
	{
		$aSS = self::get_spreadsheets_service();
		$aFeed = $aSS->getSpreadsheetFeed();
		return $aFeed->entries;
	}

	public static function get_spreadsheet_rows( $theSID )
	{
		$aSS = self::get_spreadsheets_service();
		$aQuery = new Zend_Gdata_Spreadsheets_ListQuery();
		$aQuery->setSpreadsheetKey( $theSID );
		$aQuery->setWorksheetId( self::AUTH_PAGE_1 );
		$aFeed = $aSS->getListFeed( $aQuery );
		return $aFeed->entries;
	}
}