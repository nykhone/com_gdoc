<?php

// refactoring faire une vue specialisee (combiner vlangue et vdirector)
// _title : single / multi
// _data : name / code pour le lien
class vlangue
{
	private $_langue; // array of LANGUE

	// TODO prevoir localisation
	private $_TEXT_1 = 'languages: ';
	private $_TEXT_2 = 'language: ';
	
	public function vlangue( $__langue )
	{
		$this->_langue = $__langue;
	}

	public function get_all_format()
	{
		$return = '';
		$lg_nb = count( $this->_langue );

		if ( $lg_nb > 1 )
		{
			$return .= $this->_TEXT_1;
			for ( $lg_cpt = 0; $lg_cpt < $lg_nb - 1; $lg_cpt++ )
			{
				$return .= $this->_langue[ $lg_cpt ]->get_name();
				$return .= ' | ';
			}
			$return .= $this->_langue[ $lg_cpt ]->get_name();
		}
		else
		{
			$return .= $this->_TEXT_2;
			$return .= $this->_langue[0]->get_name();
		}
		
		return $return;
	}
}

?>