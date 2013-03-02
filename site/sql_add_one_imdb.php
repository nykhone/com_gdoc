<?php

require_once 'My_Sql.php';
require_once 'My_Session.php';

// for deserialization
require_once 'data/SEANCE.php';

$__year = $_GET['year'];
$__id = $_GET['id'];
$__year_id = $__year . '-' . $__id;

My_Session::Init();
$a_rows = My_Session::Get( 'gdata', $__year, 'rows' );

for ( $a_cpt = 0; $a_cpt < count( $a_rows ); $a_cpt++ )
{
    $a_year_id = $a_rows[$a_cpt]->get_year_id(); 
    if ( $a_year_id == $__year_id )
    {
        print $a_rows[$a_cpt]->get_title();
        print '<br/>';
        // construire la requete SQL ici
    }
}

?>
