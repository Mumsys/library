<?php

/*{{{*/
/**
 * ----------------------------------------------------------------------------
 * Mumsys_Config
 * for MUMSYS Library for Multi User Management System (MUMSYS)
 * ----------------------------------------------------------------------------
 * @author Florian Blasel <flobee.code@gmail.com>
 * @copyright Copyright (c) 2009 by Florian Blasel for FloWorks Company
 * @license LGPL Version 3 http://www.gnu.org/licenses/lgpl-3.0.txt
 * ----------------------------------------------------------------------------
 * @category    Mumsys
 * @package     Mumsys_Library
 * @subpackage  Mumsys_Config
 * @version     1.0.0
 * Created: 2009-11-29
 * @filesource
 */
/*}}}*/

/**
 * Mumsys configuration.
 *
 * @category    Mumsys
 * @package     Mumsys_Library
 * @subpackage  Mumsys_Config
 */
class Mumsys_Config extends Mumsys_Abstract
{
    /**
     * Version ID information
     */
    const VERSION = '1.0.0';

    /**
     * Configuration vars in an array container.
     * @var array
     */
    protected $_config = array();

    /**
     * Context item which must be available for all mumsys objects
     * @var Mumsys_Context
     */
    protected $_context = array();


    /**
     * Initialize the config object.
     *
     * @param Mumsys_Context $context Context object
     * @param array $config Config parameter to be set
     * @throws Mumsys_Config_Exception
     */
    public function __construct(Mumsys_Context $context, array $config=array() )
    {
        $this->_context = $context;
        $this->_config = $config;
    }


    /**
     * Get a list of or a simgle config parameter.
     *
     * @param array|string $key A key or list of keys to return
     * @return array List of key/value pairs of requested keys. If the key does
     * not exists the $default will return for that key.
     */
    public function get( $key, $default = null )
    {
        $return = array();

        if (!is_array($key)) {
            $key = array($key);
        }

        foreach ($key as $k) {
            if (isset($this->_config[$k])) {
                $return[$k] = $this->_config[$k];
            } else {
                $return[$k] = $default;
            }
        }

        return $return;
    }


    /**
     * Get all config parameters
     *
     * @return array
     */
    public function getAll()
    {
        return $this->_config;
    }


    /**
     * Returns config values by given depth and values you want from the depth.
     *
     * Example (you want values from database -> configs -> a and c):
     * <pre>
     * $structure = array(
     *  'database'=> array(
     *      'configs'=> array(
     *          'a'=> array('some props'),
     *          'b'=> array('some props'),
     *          'c'=> array('some props') )));
     * $dept = array('database', 'configs');
     * $keys = array('a', 'c');
     * // returns: array('a'=> array('some props'), 'c'=> array('some props'));
     * </pre>
     *
     * @param array $depth List of values to discribe the depth
     * @param array $keys List of array keys you want to get from given depth
     * @return array List of key/values pairs with values which were found or false.
     */
    public function getSubValues( array $depth = array(), array $keys = array() )
    {
        $result = false;
        $cfg = & $this->_config;

        if (is_array($depth)) {
            foreach ($depth as $value) {
                if (isset($cfg[$value])) {
                    $cfg = $cfg[$value];
                }
            }
            foreach ($keys as $value) {
                if (isset($cfg[$value])) {
                    $result[$value] = $cfg[$value];
                }
            }
        }

        return $result;
    }


    /**
     * Register/ set a configuration parameter if not extsts.
     *
     * @param string $key Key-Name of the config-parameter
     * @param mixed $value Mixed value to be set.
     *
     * @throws Mumsys_Config_Exception If value is a object
     */
    public function register( $key, $value = null )
    {
        $this->_checkKey($key);

        if (array_key_exists($key, $this->_config[$k])) {
            $message = sprintf('Session key "%1$s" exists', $key);
            throw new Mumsys_Session_Exception($message);
        }
        $this->_config[$k] = $value;
    }


    /**
     * Load configuration by a given config-application key
     *
     * @param string $key config-application key to load
     * @return array Returns all configuration parameters
     */
    public function load( $key = 'mumsys' )
    {
        throw new Mumsys_Config_Exception('exit in: '.__FILE__.':'.__LINE__);

        $oDB = $this->_context->getDatabase();

        echo $sql = 'SELECT config_key, config_val, config_type '
            . 'FROM ' . $this->_config['table_prefix'] . $this->_config['table_config'] . ' '
            . 'WHERE config_app = \'' . $key . '\'';

        $oRes = $oDB->query($sql);
        if ($oDB->isError($oRes)) {
            exit('loading config failt. '.$this->_config['OO']['Mumsys_Db']->error_str);
        }
        while ( list($key, $val, $type) = $oRes->fetch('ROW') )
        {
            $key = trim($key);
            $val = trim($val);
            $result = null;
            $msgTmpl = 'Config exists for type: "%1$s", key: "%2$s" (value: "%3$s")';

            switch ( $type )
            {
                case 'BOOL':
                    if ( empty($val) || $val == 'false' ) {
                        $result = false;
                    } else {
                        $result = true;
                    }
                    $this->_config[$key] = $result;
                    break;

                case 'FUNCTION': //closures
                    $result = null;
                    break;

                case 'CONSTANT':
                    if ( defined($key) ) {
                        $message = sprintf($msgTmpl, $type, $key, substr($val,0,15));
                        throw new Mumsys_Config_Exception($message);
                    }
                    define($key, $val);
                    break;

                case 'SERIALIZED':
                    if ( isset($this->_config[$key]) ) {
                        $message = sprintf($msgTmpl, $type, $key, substr($val,0,15));
                        throw new Mumsys_Config_Exception($message);;
                    }
                    $this->_config[$key] = unserialize($val);

                    break;

                case 'JSON':
                    if ( isset($this->_config[$key]) ) {
                        $message = sprintf($msgTmpl, $type, $key, substr($val,0,15));
                        throw new Mumsys_Config_Exception($message);;
                    }
                    $this->_config[$key] = json_decode($val);
                    break;

                case 'VARIABLE':
                default:
                    if ( isset($this->_config[$key]) ) {
                        $message = sprintf($msgTmpl, $type, $key, substr($val,0,15));
                        throw new Mumsys_Config_Exception($message);;
                    }
                    $this->_config[$key] = $val;
                    break;
            }

            if (!isset($result)) {

            }


        }
        $oRes->free();
        return $this->_config;
    }
}
