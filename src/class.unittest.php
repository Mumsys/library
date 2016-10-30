<?php

/**
 * Mumsys_Unittest_Testcase
 * for MUMSYS / Multi User Management System (MUMSYS)
 *
 * @license GPL Version 3 http://www.gnu.org/licenses/gpl-3.0.txt
 * @copyright Copyright (c) 2015 by Florian Blasel for FloWorks Company
 * @author Florian Blasel <flobee.code@gmail.com>
 *
 * @category    Mumsys
 * @package     Mumsys_Library
 * @subpackage  Unittest
 */


/**
 * PhpUnit test case class as wrapper for PHPUnit_Framework_TestCase.
 *
 * phpunit >= phpunit 3.4
 *
 * @category    Mumsys
 * @package     Mumsys_Library
 * @subpackage  Unittest
 */
class Mumsys_Unittest_Testcase
    extends PHPUnit_Framework_TestCase
{
    /**
     * Methods memory container
     * @var array
     */
    private static $_methods = array();


    /**
     * Checks PhpUnit setExpectedException() if available.
     *
     * @deprecated since version 5.2.0
     *
     * @param string $exceptionName
     * @param string $exceptionMessage
     * @param integer|string $exceptionCode
     *
     * @throws Exception
     */
    public function setExpectedException( $exceptionName, $exceptionMessage = '', $exceptionCode = null )
    {
        $message = 'setExpectedException() will be removed with phpunit ~ 5.9*.'
            . 'Please use setExpectedExceptionRegExp()';

        self::_checkMethod('setExpectedException', $message);
    }


    /**
     * Checks PhpUnit assertType() if available.
     *
     * Available from PHPUnit <= 3.5
     *
     * @param mixed $expected Expected value
     * @param mixed $actual Actual value
     * @param string $message Message to print if assertion is wrong
     *
     * @throws Exception If assertType() is not available
     */
    public static function assertType( $expected, $actual, $message = '' )
    {
        $message = 'assertType() was removed since phpunit 3.5*. You may check with assertInternalType() ?';
        self::_checkMethod('assertType', $message);
    }


    /**
     * Checks PhpUnit getMock() if available.
     *
     * @deprecated since version 5.4.0
     *
     * @param string $originalClassName
     * @param array $methods
     * @param array $arguments
     * @param string $message
     * @param bool $callOriginalConstructor
     * @param bool $callOriginalClone
     * @param bool $callAutoload
     * @param bool $cloneArguments
     * @param bool $callOriginalMethods
     */
    public static function getMock( $originalClassName, $methods, $arguments, $message, $callOriginalConstructor,
        $callOriginalClone, $callAutoload, $cloneArguments, $callOriginalMethods )
    {
        $message = 'getMock() will be removed in the future. Deprecated since Release 5.4.0';
        self::_checkMethod('getMock', $message);
    }

    /**
     * Checks PhpUnit hasPerformedExpectationsOnOutput() if available.
     */
    public static function hasPerformedExpectationsOnOutput()
    {
        $message = 'hasPerformedExpectationsOnOutput() will be removed in the future.'
            . 'Marked as deprecated since Release (found 5.4.*)';
        self::_checkMethod('hasPerformedExpectationsOnOutput', $message);
    }


    /**
     * Checks PhpUnit getMockWithoutInvokingTheOriginalConstructor() if available.
     *
     * @param string $originalClassName Class name
     */
    public static function getMockWithoutInvokingTheOriginalConstructor( $originalClassName )
    {
        $message = 'getMockWithoutInvokingTheOriginalConstructor() will be
            removed in the future. Deprecated since Release 5.4.0';

        self::_checkMethod('getMockWithoutInvokingTheOriginalConstructor', $message);
    }


    /**
     * Checks if given method exists in current version of PHPUnit.
     *
     * @param string $method Method to check if exists
     */
    private static function _checkMethod( $method, $message )
    {
        if ( !isset(self::$_methods[$method]) ) {
            self::$_methods[$method] = method_exists('PHPUnit_Framework_TestCase', $method);
        }

        if ( self::$_methods[$method] ) {
            parent::markTestIncomplete($message);
        } else {
            throw new Exception($message);
        }

        return self::$_methods[$method];
    }

}