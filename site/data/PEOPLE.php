<?php

final class PEOPLE
{
	private $_imdb = '';
	private $_name = '';

	public function PEOPLE( $__fill_element, $__fill_type = 'array' )
	{
		switch ( $__fill_type )
		{
			case 'array' :
			default :
				// TODO : check array size -> error
				$this->_imdb = $__fill_element[ 0 ];
				$this->_name = $__fill_element[ 1 ];
			break;
		}
	}

	public function get_imdb()
	{
		return $this->_imdb;
	}

	public function get_name()
	{
		return $this->_name;
	}
}

?>