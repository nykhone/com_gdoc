<?php

final class LANGUE
{
	private $_id = ''; // iso code en 5 lettres ?
	private $_code = '';
	private $_name = '';

	public function LANGUE( $__fill_element, $__fill_type = 'array' )
	{
		switch ( $__fill_type )
		{
			case 'array' :
			default :
				// TODO : check array size -> error
				$this->_id = $__fill_element[ 0 ];
				$this->_code = $__fill_element[ 1 ];
				$this->_name = $__fill_element[ 2 ];
			break;
		}
	}

	public function get_id()
	{
		return $this->_id;
	}

	public function get_code()
	{
		return $this->_code;
	}

	public function get_name()
	{
		return $this->_name;
	}
}

?>