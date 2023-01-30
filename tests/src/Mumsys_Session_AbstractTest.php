<?php


/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-05-17 at 18:55:26.
 */
class Mumsys_Session_AbstractTest
    extends Mumsys_Unittest_Testcase
{
    /**
     * @var Mumsys_Session_Abstract
     */
    private $_object;


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void
    {
        $this->_object = new Mumsys_Session_None();
    }


    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown(): void
    {
        unset( $this->_object );
    }


    /**
     * @covers Mumsys_Session_Abstract::__construct
     * @covers Mumsys_Session_Abstract::get
     * @covers Mumsys_Session_Abstract::register
     * @covers Mumsys_Session_Abstract::replace
     * @covers Mumsys_Session_Abstract::getCurrent
     * @covers Mumsys_Session_Abstract::getAll
     * @covers Mumsys_Session_Abstract::remove
     * @covers Mumsys_Session_Abstract::clear
     */
    public function testGetReplaceRegister()
    {
        $this->_object->replace( 'key1', 'value1' );
        $this->_object->replace( 'key2', 'value2' );
        $this->_object->register( 'key3', 'value3' );

        $actual1 = $this->_object->get( 'key1' );
        $actual2 = $this->_object->get( 'key2' );
        $actual3 = $this->_object->get( 'key3' );
        $actual4 = $this->_object->get( 'key4' );

        $this->assertingEquals( 'value1', $actual1 );
        $this->assertingEquals( 'value2', $actual2 );
        $this->assertingEquals( 'value3', $actual3 );
        $this->assertingNull( $actual4 );

        $expected1 = array(
            'key1' => 'value1',
            'key2' => 'value2',
            'key3' => 'value3'
        );
        $expected2 = array('mumsys_none' => $expected1);

        $this->assertingEquals( $expected1, $this->_object->getCurrent() );
        $this->assertingEquals( $expected2, $this->_object->getAll() );

        $this->assertingTrue( $this->_object->remove( 'key3' ) );
        $this->assertingFalse( $this->_object->remove( 'key4' ) );

        $this->_object->clear();
        $this->assertingEquals( array(), $this->_object->getAll() );
        $this->assertingEquals( array(), $this->_object->getCurrent() );
    }


    /**
     * @covers Mumsys_Session_Abstract::register
     */
    public function testRegisterException()
    {
        $this->_object->replace( 'key1', 'value1' );

        $this->expectingExceptionMessageRegex( '/(Session key "key1" exists)/' );
        $this->expectingException( 'Mumsys_Session_Exception' );
        $this->_object->register( 'key1', 'value1' );
    }


    /**
     * @covers Mumsys_Session_Abstract::__destruct
     */
    public function test_destruct()
    {
        $this->assertingEquals( array(), $this->_object->getAll() );
        $this->assertingEquals( array(), $this->_object->getCurrent() );
    }


    /**
     * @covers Mumsys_Session_Abstract::remove
     */
    public function testRemove()
    {
        $this->assertingFalse( $this->_object->remove( 'key4' ) );
    }


    /**
     * @covers Mumsys_Session_Abstract::getID
     */
    public function testGetID()
    {
        $this->assertingEquals( 'mumsys_none', $this->_object->getID() );
    }

}
