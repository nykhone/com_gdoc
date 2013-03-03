<?php

require_once('data/LANGUE.php');
require_once('data/PEOPLE.php');
require_once('data/TITLE.php');

final class IMDB_FILM
{
	private $_directors; // array of PEOPLE [imdb/name]
	private $_langues; // array of LANGUE [id/code/name]
	private $_title; // TITLE [vo/en/fr/perso]
	private $_date;

	private $_imdb_vote;
	private $_synopsis = '';
	private $_actors; // array of PEOPLE [imdb/name]
	private $_story = '';
	private $_genre = '';
	private $_country; // array of PAYS
	private $_runtime = '';
	private $_color = '';

	private $_imdb = '';
	private $_imdb_credits;
	private $_imdb_full_credits;
	private $_web_imdb_akas;

	private $_TITLE_PATH = 'http://www.imdb.com/title/';

	public function IMDB_FILM( $__fill_element, $__fill_type = 'imdb' )
	{
		switch ( $__fill_type )
		{
			case 'database' :
			case 'session' :
			case 'imdb' :
			default :
				self::fill_from_imdb( $__fill_element );
			break;
		}
	}

	public function get_langues()
	{
		return $this->_langues;
	}

	public function get_directors()
	{
		return $this->_directors;
	}

	public function get_date()
	{
		return $this->_date;
	}

	public function get_title()
	{
		return $this->_title;
	}

	private function fill_from_imdb( $__imdb_id )
	{
		$credits_url = $this->_TITLE_PATH . $__imdb_id;
		$full_credits_url = $this->_TITLE_PATH . $__imdb_id . '/fullcredits';
		$release_info_akas = $this->_TITLE_PATH . $__imdb_id . '/releaseinfo#akas';
		$this->_imdb_credits = file_get_contents("$credits_url");
		$this->_imdb_full_credits = file_get_contents("$full_credits_url");
		$this->_web_imdb_akas = file_get_contents( "$release_info_akas" );
		
		// TODO : cleaner les sauts de lignes voir AKA

		self::set_langues();
		self::set_directors();
		self::set_title_date();
	}

	private function set_langues()
	{
		$this->_langues = array();

		if ( preg_match_all(
				'/<a href="\/language\/([a-z]+)">([a-z]+)<\/a>/i',
				$this->_imdb_credits,
				$table,
				PREG_SET_ORDER ) )
		{
			for ( $cpt = 0; $cpt < count( $table ); $cpt++ )
			{
				$vo = new LANGUE ( array( 0, $table[ $cpt ][ 1 ], $table[ $cpt ][ 2 ] ) );
				array_push( $this->_langues, $vo );
			}
		}
	}

	private function set_directors()
	{
		$this->_directors = array();

		if ( preg_match_all(
				'/Directed by<\/a><\/h5><\/td><\/tr>(.+)<tr><td colspan="4">&nbsp;<\/td><\/tr><\/table>/i',
				$this->_imdb_full_credits,
				$table,
				PREG_SET_ORDER ) )
		{
			$table_2 = explode( '</tr>', $table[ 0 ][ 0 ] );
			for ( $cpt = 1; $cpt < count( $table_2 ); $cpt++ )
			{
				if ( preg_match_all(
						'/.+\/name\/(.+)\/">(.+)<\/a>/i',
						$table_2[ $cpt ],
						$table_3,
						PREG_SET_ORDER ) )
				{
					$vo = new PEOPLE ( array( $table_3[ 0 ][ 1 ], $table_3[ 0 ][ 2 ] ) );
					array_push( $this->_directors, $vo );
				}
			}
		}
	}

	// TODO refaire avec recherche en francais
	// -> set fr et recuperer original en dessous (titre original)
	// proposer tous les titres disponibles pour le titre perso
	private function set_title_date()
	{
		print $this->_web_imdb_akas;
		if ( preg_match_all(
				'/<a href="\/title\/tt[0-9]+\/">(.+) \(([0-9]+)\)<\/a>/i',
				$this->_web_imdb_akas,
				$table,
				PREG_SET_ORDER ) )
		{
			$this->_title = new TITLE ( array ( $table[ 0 ][ 1 ], "", "", "" ) );
			$this->_date = $table[ 0 ][ 2 ];
		}

		$this->_web_imdb_akas = preg_replace( '/\n/', '', $this->_web_imdb_akas );
		//print $this->_web_imdb_akas;

		if ( preg_match_all(
				'/Also.+<table border="0" cellpadding="2">(.+)<\/tr><\/table>/i',
				$this->_web_imdb_akas,
				$table_2,
				PREG_SET_ORDER ) )
		{
			if ( preg_match_all(
					'/.+<td>(.+)<\/td><td>.+ \(English title\)<\/td>/i',
					$table_2[ 0 ][ 1 ],
					$table_3,
					PREG_SET_ORDER ) )
			{
				$this->_title->set_en_title( $table_3[ 0 ][ 1 ] );
			}
		}
	}
}
?>