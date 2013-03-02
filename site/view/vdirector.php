<?php

class vdirector
{
	private $_director; // array of LANGUE

	// TODO prevoir localisation
	private $_TEXT_1 = 'directors: ';
	private $_TEXT_2 = 'director: ';
	
	public function vdirector( $__director )
	{
		$this->_director = $__director;
	}

	public function get_all_format()
	{
		$return = '';
		$lg_nb = count( $this->_director );

		if ( $lg_nb > 1 )
		{
			$return .= $this->_TEXT_1;
			for ( $lg_cpt = 0; $lg_cpt < $lg_nb - 1; $lg_cpt++ )
			{
				$return .= $this->_director[ $lg_cpt ]->get_name();
				$return .= ' | ';
			}
			$return .= $this->_director[ $lg_cpt ]->get_name();
		}
		else
		{
			$return .= $this->_TEXT_2;
			$return .= $this->_director[0]->get_name();
		}
		
		return $return;
	}
}

?>