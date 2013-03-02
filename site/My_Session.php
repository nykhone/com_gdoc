<?php

require_once '/home/nykhos/Desktop/www/Joomla_2_5_8/administrator/components/com_gdoc/Zend/Session/Namespace.php';

// TODO : comprendre les sessions globales !
// http://framework.zend.com/manual/fr/zend.session.global_session_management.html

class My_Session
{
    public static $_session;
    // Un constructeur privé ; empêche la création directe d'objet
    public static function Init() 
    {
        self::$_session = new Zend_Session_Namespace( 'cine_stats' );
    }

    public static function Set( $__arg_0, $__arg_1, $__arg_2, $__value )
    {
        $a_field = $__arg_0 . '-' . $__arg_1 . '-' . $__arg_2;
        self::$_session->$a_field = $__value;
    }

    public static function Get( $__arg_0, $__arg_1, $__arg_2 )
    {
        $a_field = $__arg_0 . '-' . $__arg_1 . '-' . $__arg_2;
        return self::$_session->$a_field;
    }
}   

?>
