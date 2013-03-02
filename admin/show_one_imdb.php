<?php

require_once( 'data/IMDB_FILM.php' );
require_once( 'view/vlangue.php' );
require_once( 'view/vdirector.php' );

$__imdb_id = $_GET['imdb'];

$movie = new IMDB_FILM( $__imdb_id );

print 'title: ' . $movie->get_title()->get_original();
print '<br/>';

print 'title: ' . $movie->get_title()->get_english();
print '<br/>';

print 'date: ' . $movie->get_date();
print '<br/>';

$langue = new vlangue( $movie->get_langues() );
print $langue->get_all_format();
print '<br/>';

$director = new vdirector( $movie->get_directors() );
print $director->get_all_format();
print '<br/>';

?>