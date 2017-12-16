<?php
/**
 * Created by PhpStorm.
 * User: Clément
 * Date: 16/12/2017
 * Time: 21:25
 */

class Autoloader
{
    private static $_instance = null;

    /**
     * Call the constructor of the class if it doesn't exist yet.
     */
    public static function charger()
    {
        if(null !== self::$_instance) {
            throw new RuntimeException(sprintf('%s is already started', __CLASS__));
        }

        self::$_instance = new self();


        if(!spl_autoload_register(array(self::$_instance, '_autoload'), false)) {
            throw RuntimeException(sprintf('%s : Could not start the autoload', __CLASS__));
        }
    }

    private static function _autoload($class)
    {
        global $rep;
        $filename = $class.'.php';
        $dir =array('model/','model/metier/','./','config/','controller/','dal/','parser/');
        foreach ($dir as $d){
            $file=$rep.$d.$filename;
            if (file_exists($file))
            {
                require_once($file);
            }
        }
    }
}