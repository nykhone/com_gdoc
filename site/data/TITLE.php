<?php

include 'data/SEANCE.php' ;

final class TITLE
{
	private $_original = '';
	private $_english = '';
	private $_french = '';
	private $_perso = '';

	public function TITLE( $__fill_element, $__fill_type = 'array' )
	{
		switch ( $__fill_type )
		{
			case 'array' :
			default :
				// TODO : check array size -> error
				$this->_original = $__fill_element[ 0 ];
				$this->_english = $__fill_element[ 1 ];
				$this->_french = $__fill_element[ 2 ];
				$this->_perso = $__fill_element[ 2 ];
			break;
		}
	}

	public function get_original()
	{
		return $this->_original;
	}

	public function get_english()
	{
		return $this->_english;
	}

	public function get_french()
	{
		return $this->_french;
	}

	public function get_perso()
	{
		return $this->_perso;
	}

	public function set_en_title( $__title )
	{
		$this->_english = $__title;
	}
}

?>