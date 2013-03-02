<?php

require_once 'data/SEANCE.php';
require_once 'My_Session.php';

require_once( 'google_docs/nyko_google.php' );
require_once( 'google_docs/nyko_google_functions.php' );

class YEAR_SEANCES
{
    private $_year = 0;
    private $_headers = array(); // array of string
    private $_rows = array(); // array of SEANCE
    private $_rcount = 0;
    private $_hcount = 0;

    public function YEAR_SEANCES( $__fill_element, $__year = 0, $__fill_type = 'gdata' )
    {
        My_Session::Init();
        $session_rcount = $__year . '-rcount';
        if ( isset( $_SESSION[ $session_rcount ] ) )
	{
            // get data from session
            $this->_rcount = $_SESSION[ $session_rcount ];
            $this->_hcount = My_Session::Get( $__fill_type, $__year, 'hcount' );
            $this->_headers = My_Session::Get( $__fill_type, $__year, 'headers' );
            $this->_rows = My_Session::Get( $__fill_type, $__year, 'rows' );
        }
        else
        {
            switch ( $__fill_type )
            {
                case 'gdata' :
                default :
                    $this->_year = $__year;
                    $this->fill_from_gdata( $__fill_element );
                    $this->_rcount = count( $this->_rows );
                    $this->_hcount = count( $this->_headers );
                    $_SESSION[ $session_rcount ] = $this->_rcount;
                    My_Session::Set( $__fill_type, $__year, 'hcount', $this->_hcount );
                    My_Session::Set( $__fill_type, $__year, 'headers', $this->_headers );
                    My_Session::Set( $__fill_type, $__year, 'rows', $this->_rows );
                break;
            }
        }
    }

    private function fill_from_gdata( $__doc_id )
    {
        $doc = new nyko_google();
        $data = $doc->get_spreadsheet_rows( $__doc_id );
        $row_data = '';
        $row_id = 1;

        foreach ( $data as $row )
        {
            $row_data = $row->getCustom();
            $this->set_seance( $row_data, $row_id );
            $row_id++;
        }
        $this->set_entetes( $row_data );
    }

    private function set_entetes( $__row_data )
    {
        foreach( $__row_data as $cell_data )
        {
            $this->_headers[] = $cell_data->getColumnName();
        }
    }

    private function set_seance( $__row_data, $__row_id )
    {
        if ( !isNullRow( $__row_data ) )
        {
            $a_seance = new SEANCE( $__row_data );
            $a_seance->set_year( $this->_year );
            $a_seance->set_id( $__row_id );
            $this->_rows[] = $a_seance;
        }
    }

    public function get_headers()
    {
        return $this->_headers;
    }

    public function get_rows()
    {
        return $this->_rows;
    }

    public function get_hcount()
    {
        return $this->_hcount;
    }

    public function get_rcount()
    {
        return $this->_rcount;
    }
}	

?>