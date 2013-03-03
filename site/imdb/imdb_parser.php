<?php

/**
* class.imdb_parser.php (php4)
* Parse information of any film - need a fetched imdb.com video-detail-site
* @author       Bernd Essl <bernd@ak47.at>
* @copyright    Bernd Essl <bernd@ak47.at>
* @license      license   http://gnu.org/copyleft/gpl.html GNU GPL
* @version      SVN: 4
* @link         http://ak-47.at/
*/


class IMDB_Parser
{

	function getMovieActors( $imdb_website )
	{
		$aReturn = "?????";

		if ( preg_match( '/<b class="blackcatheader">Cast overview, first billed only:(.+)<a href="fullcredits">\(more\)<\/a>/', $imdb_website, $hit ) )
		{
			if ( preg_match_all( '/<a href="\/name\/nm\d{1,8}\/">([^<]+)<\/a>/', $hit[ 0 ], $results, PREG_PATTERN_ORDER ) )
			{
				$aReturn = $results[ 1 ];
			}
		}

		return $aReturn;
	}

	function getMovieDirectedBy( $imdb_website )
	{
		$aReturn = "?????";

//		if (preg_match('<b class="blackcatheader">Directed by<\/b><br>(.+)<b class="blackcatheader">Writing credits<\/b>', $imdb_website, $hit))
//		{
//			$aReturn = "true";
//		}
// un seul réalisateur á chaque fois

		if ( preg_match( '/<b class="blackcatheader">Directed by<\/b><br>.?<a href="\/name\/(.+)\/">(.+)<\/a><br>/sU', $imdb_website, $aDirector ) )
		{
			$aReturn = $aDirector;
			// 0:toute la chaine, 1:code imdb, 2:nom
		}

		return $aReturn;
	}


}
?>