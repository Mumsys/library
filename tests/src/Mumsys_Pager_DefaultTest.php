<?php


/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-08-16 at 21:10:32.
 */
class Mumsys_Pager_DefaultTest
    extends PHPUnit_Framework_TestCase
{
    /**
     * @var Mumsys_Pager_Default
     */
    protected $_object;
    /**
     * Version ID.
     * @var string
     */
    private $_version = '3.1.0';

    /**
     * List of options to initialise the object
     * @var array
     */
    private $_options;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->_options = array(
            'cntitems' => 15,
            'pagestart' => 0,
            'limit' => 5,
            'basiclink' => 'index.php?',
            'pagestartVarname' => 'offset',
            'showPageNumbers' => true,
            'showSummary' => true
            );
        $this->_object = new Mumsys_Pager_Default($this->_options);
    }


    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        $this->_object = null;
    }


    /**
     * Test 4 code coverage.
     * @covers Mumsys_Pager_Default::__construct
     * @covers Mumsys_Pager_Default::render
     */
    public function test_construct()
    {
        $x = new Mumsys_Pager_Default($this->_options);
        $expected = 'results: <b>15</b>, results per page: <b>5</b>, pages: <b>3</b>';
        $actual = $this->_object->getSummary();

        $this->assertEquals($expected, $actual);

        $regex = '/(Invalid parameter "test" found)/i';
        $this->setExpectedExceptionRegExp('Mumsys_Pager_Exception', $regex);
        new Mumsys_Pager_Default(array('test'=> 'value'));
    }


    /**
     * @covers Mumsys_Pager_Default::getParts
     * @covers Mumsys_Pager_Default::render
     */
    public function testGetParts()
    {
        $actual1 = $this->_object->getParts();
        $expected1 = array(
            'summary' => 'results: <b>15</b>, results per page: <b>5</b>, pages: <b>3</b>',
            'pageFirst' => '&laquo;&laquo;&laquo;',
            'pageLast' => '<a href="index.php?&amp;offset=10">&raquo;&raquo;&raquo;</a>',
            'pagePrev' => '&laquo;',
            'pageNext' => '<a href="index.php?&amp;offset=5">&raquo;</a>',
            'slider' => ' &gt;<strong>1</strong>&lt;  | <a href="index.php?'
            . '&amp;offset=5">2</a> | <a href="index.php?&amp;offset=10">3</a>',
        );

        $expected2 = $expected1;
        $this->_options['pagestart'] = 10;
        $expected2['pageLast'] = '&raquo;&raquo;&raquo;';
        $expected2['pageFirst'] = '<a href="index.php?&amp;offset=0">&laquo;&laquo;&laquo;</a>';
        $expected2['pagePrev'] = '<a href="index.php?&amp;offset=5">&laquo;</a>';
        $expected2['pageNext'] = '&raquo;';
        $expected2['slider'] = '<a href="index.php?&amp;offset=0">1</a> | <a href="index.php?&amp;offset=5">2</a> |  &gt;<strong>3</strong>&lt; ';

        $this->_object = new Mumsys_Pager_Default($this->_options);
        $actual2 = $this->_object->getParts();


        $this->assertEquals($expected1, $actual1);
        $this->assertEquals($expected2, $actual2);
    }


    /**
     * @covers Mumsys_Pager_Default::getHtml
     */
    public function testGetHtml()
    {
        $actual1 = $this->_object->getHtml();
        $expected1 = '<div class="pnnavi">
[ &laquo;&laquo;&laquo; | &laquo; |  &gt;<strong>1</strong>&lt;  | <a href="index.php?&amp;offset=5">2</a> | <a href="index.php?&amp;offset=10">3</a><a href="index.php?&amp;offset=5">&raquo;</a> | <a href="index.php?&amp;offset=10">&raquo;&raquo;&raquo;</a> ]</div>

<div class="pnnavi summary">
results: <b>15</b>, results per page: <b>5</b>, pages: <b>3</b></div>
';

        $this->assertEquals($expected1, $actual1);
    }


    /**
     * @covers Mumsys_Pager_Default::getSlider
     */
    public function testGetSlider()
    {
        $actual1 = $this->_object->getSlider();
        $expected1 = ' &gt;<strong>1</strong>&lt;  | <a href="index.php?&amp;offset=5">2</a> | <a href="index.php?&amp;offset=10">3</a>';

        $this->assertEquals($expected1, $actual1);
    }


    /**
     * @covers Mumsys_Pager_Default::getSummary
     */
    public function testGetSummary()
    {
        $actual1 = $this->_object->getSummary();
        $expected1 = 'results: <b>15</b>, results per page: <b>5</b>, pages: <b>3</b>';

        $this->assertEquals($expected1, $actual1);
    }


    /**
     * @covers Mumsys_Pager_Default::render
     */
    public function testRender()
    {
        $actual1 = $this->_object->render();
        $expected1 = $expected1 = '<div class="pnnavi">
[ &laquo;&laquo;&laquo; | &laquo; |  &gt;<strong>1</strong>&lt;  | <a href="index.php?&amp;offset=5">2</a> | <a href="index.php?&amp;offset=10">3</a><a href="index.php?&amp;offset=5">&raquo;</a> | <a href="index.php?&amp;offset=10">&raquo;&raquo;&raquo;</a> ]</div>

<div class="pnnavi summary">
results: <b>15</b>, results per page: <b>5</b>, pages: <b>3</b></div>
';


        $this->_options['cntitems'] = 150;
        $this->_object = new Mumsys_Pager_Default($this->_options);

        $actual2 = $this->_object->render();
        $expected2 = '<div class="pnnavi">
[ &laquo;&laquo;&laquo; | &laquo; |  &gt;<strong>1</strong>&lt;  | <a href="index.php?&amp;offset=5">2</a> | <a href="index.php?&amp;offset=10">3</a> | <a href="index.php?&amp;offset=15">4</a> | <a href="index.php?&amp;offset=20">5</a> | <a href="index.php?&amp;offset=25">6</a> | <a href="index.php?&amp;offset=30">7</a> | <a href="index.php?&amp;offset=35">8</a> | <a href="index.php?&amp;offset=40">9</a><a href="index.php?&amp;offset=5">&raquo;</a> | <a href="index.php?&amp;offset=145">&raquo;&raquo;&raquo;</a> ]</div>

<div class="pnnavi summary">
results: <b>150</b>, results per page: <b>5</b>, pages: <b>30</b></div>
';

        $this->_options['pagestart'] = 10;
        $this->_options['limit'] = 24;
        $this->_options['cntitems'] = 50;
        $this->_options['dynamic'] = false;
        $this->_object = new Mumsys_Pager_Default($this->_options);
        $actual3 = $this->_object->render();
        $expected3 = '<div class="pnnavi">
[ <a href="index.php?&amp;offset=0">&laquo;&laquo;&laquo;</a> | <a href="index.php?&amp;offset=0">&laquo;</a> | <a href="index.php?&amp;offset=0">1</a> | <a href="index.php?&amp;offset=24">2</a> | <a href="index.php?&amp;offset=48">3</a><a href="index.php?&amp;offset=34">&raquo;</a> | <a href="index.php?&amp;offset=48">&raquo;&raquo;&raquo;</a> ]</div>

<div class="pnnavi summary">
results: <b>50</b>, results per page: <b>24</b>, pages: <b>3</b></div>
';
        $this->assertEquals($expected1, $actual1);
        $this->assertEquals($expected2, $actual2);
        $this->assertEquals($expected3, $actual3);
    }


    /**
     * @covers Mumsys_Pager_Default::getMessageTemplates
     * @covers Mumsys_Pager_Default::setMessageTemplates
     */
    public function testGetSetMessageTemplates()
    {
        $actual1 = $this->_object->getMessageTemplates();
        $expected1 = array(
            'PAGER_PAGEFIRST' => '&laquo;&laquo;&laquo;',
            'PAGER_PAGENEXT' => '&raquo;',
            'PAGER_PAGEPREV' => '&laquo;',
            'PAGER_PAGELAST' => '&raquo;&raquo;&raquo;',
            'PAGER_RESULTS' => 'results: ',
            'PAGER_RESULTPAGES' => 'pages: ',
            'PAGER_RESULTSPERPAGE' => 'results per page: ',
            'PAGER_HIGHLIGHTLEFT' => ' &gt;',
            'PAGER_HIGHLIGHTRIGHT' => '&lt; ',
            'PAGER_SLIDERPREFIX' => '[ ',
            'PAGER_SLIDERSUFFIX' => ' ]',
            'PAGER_SLIDERDELIMITER' => ' | ',
        );

        $this->_object->setMessageTemplates($expected1);
        $actual2 = $this->_object->getMessageTemplates();

        $this->assertEquals($expected1, $actual1);
        $this->assertEquals($expected1, $actual2);
    }


    /**
     * Version check
     */
    public function testCheckVersion()
    {
        $this->assertEquals($this->_version, Mumsys_Pager_Default::VERSION);
    }

}
