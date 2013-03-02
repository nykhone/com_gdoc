<?php

final class SEANCE
{
    private $_year;
    private $_id;
	// TODO VO sur tous ces champs !!
	// VO langue : id / drapeau / name french / name english / ...
	// ...
	
	// TODO : appliquer les surcharges magiques pour changer un seul champ ?
	// http://www.php.net/manual/fr/language.oop5.overloading.php
    private $_date = '';
    private $_title = '';
    private $_langue = '';
    private $_subtitle = '';
    private $_special = '';
    private $_how = '';
    private $_city = '';
    private $_place = '';
    private $_chanel = '';
    private $_who = '';
    private $_number = '';
    private $_imdb = '';

	public function SEANCE( $__fill_element, $__fill_type = 'gdata' )
	{
		switch ( $__fill_type )
		{
			case 'array' :
				// TODO : check array size -> error
				$this->_date = $__fill_element[ 0 ];
				$this->_title = $__fill_element[ 1 ];
				$this->_langue = $__fill_element[ 2 ];
				$this->_subtitle = $__fill_element[ 3 ];
				$this->_special = $__fill_element[ 4 ];
				$this->_how = $__fill_element[ 5 ];
				$this->_city = $__fill_element[ 6 ];
				$this->_place = $__fill_element[ 7 ];
				$this->_chanel = $__fill_element[ 8 ];
				$this->_who = $__fill_element[ 9 ];
				$this->_number = $__fill_element[ 10 ];
				$this->_imdb = $__fill_element[ 11 ];
			break;
			case 'gdata' :
			default :
				$this->fill_from_gdata( $__fill_element );
			break;
		}
	}

	// return all fields of a seance in an array
	public function get()
	{
		$seance = array( $this->_date, $this->_title, $this->_langue, $this->_subtitle, $this->_special, $this->_how, $this->_city, $this->_place, $this->_chanel, $this->_who, $this->_number, $this->_imdb );
		return $seance;
	}

	// TODO : get specific indexes only ?
	// need to filtering entetes too !
//	public function get_filtered( $__filter = null )
//	{
//		return array( $this->_date, $this->_title, $this->_city, $this->_imdb );
//	}

    public function get_year_id()
    {
        return $this->_year . '-' . $this->_id;
    }

    public function get_year()
    {
        return $this->_year;
    }

    public function get_imdb()
    {
        return $this->_imdb;
    }

    public function get_id()
    {
        return $this->_id;
    }

    public function get_title()
    {
        return $this->_title;
    }

    public function set_year( $__year )
    {
        $this->_year = $__year;
    }

    public function set_id( $__id )
    {
        $this->_id = $__id;
    }

	public function equals( $__seance )
	{
		// TODO
	}

	public function mix(Paint $another)
	{
		// any algo
	}

	private function fill_from_gdata( $__row_data )
	{
		$cell_cpt = 1;
		foreach( $__row_data as $cell_data )
		{
			$value = $cell_data->getText();

			switch ( $cell_cpt )
			{
				case 1 :
					$this->_date = $value;
				break;
				case 2 :
					$this->_title = $value;
				break;
				case 3 :
					$this->_langue = $value;
				break;
				case 4 :
					$this->_subtitle = $value;
				break;
				case 5 :
					$this->_special = $value;
				break;
				case 6 :
					$this->_how = $value;
				break;
				case 7 :
					$this->_city = $value;
				break;
				case 8 :
					$this->_place = $value;
				break;
				case 9 :
					$this->_chanel = $value;
				break;
				case 10 :
					$this->_who = $value;
				break;
				case 11 :
					$this->_number = $value;
				break;
				case 12 :
					$this->_imdb = $value;
				break;

				default :
					// TODO : gestion des erreurs
				break;
			}

			$cell_cpt++;
		}
	}
}

?>