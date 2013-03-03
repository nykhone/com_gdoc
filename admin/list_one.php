<?php

include 'data/SEANCE.php' ;

require_once('html/nyko_html.php');
require_once('data/YEAR_SEANCES.php');

$__spreadsheet_id = $_GET['spread'];
$__spreadsheet_year = $_GET['year'];

$vo = new YEAR_SEANCES( $__spreadsheet_id, $__spreadsheet_year );

// TODO : filtre sur les colonnes
// TODO : page sur les lignes
startTable();
startRow();
headers( $vo );
endRow();
all_lines( $vo );
endTable();

function headers( $__vo )
{
    $a_headers = $__vo->get_headers();
    for ( $a_cpt = 0; $a_cpt < count( $a_headers ); $a_cpt++ )
    {
        if ( $a_cpt == 0 || $a_cpt == 1 || $a_cpt == 6 )
        {
            printCell( $a_headers[ $a_cpt ] );
        }
    }
    printCell('imdb');
    printCell('add to sql');
}

function all_lines( $__vo )
{
    $a_seances = $__vo->get_rows();
    for ( $a_cpt = 0; $a_cpt < count( $a_seances ); $a_cpt++ )
    {
//        $a_seance = $a_seances[ $a_cpt ]->get_filtered();
        $a_seance = $a_seances[ $a_cpt ]->get();
        // recuperer plutot une structure avec les colonnes et les infos necessaires (year/id)
        // a combiner avec all headers pour chaque colonne ->
        // - le nom de la col
        // - la maniere de la construire (<a href='...?val_col_1'>val_col_2/val_col_3</a>)
        //= view table html ?
        
        startRow();
        for ( $a_cpt_2 = 0; $a_cpt_2 < count( $a_seance ); $a_cpt_2++ )
        {
            if ( $a_cpt_2 == 0 || $a_cpt_2 == 1 || $a_cpt_2 == 6 )
            {
                printCell( $a_seance[ $a_cpt_2 ] );
            }            
        }

	$link = 'show_one_imdb.php?imdb=' . $a_seances[ $a_cpt ]->get_imdb();
	print_cell_link( 'imdb', $link );

	$link_2 = 'sql_add_one_imdb.php?year=' . $a_seances[ $a_cpt ]->get_year() . '&id=' . $a_seances[ $a_cpt ]->get_id();
	print_cell_link( 'in sql', $link_2 );

        endRow();
    }
}

?>
