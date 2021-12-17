<?php

/**
 * Mumsys_DateTime_Formatter
 * for MUMSYS Library for Multi User Management System (MUMSYS)
 *
 * @license LGPL Version 3 http://www.gnu.org/licenses/lgpl-3.0.txt
 * @copyright Copyright (c) by Florian Blasel for FloWorks Company, 2021
 *
 * @category    Mumsys
 * @package     Library
 * @subpackage  DateTime
 * Created: 2021-12-17
 */


/**
 * DateTime Formatter for locale specific settings. Eg. having local based
 * month or day names. Otherwise you dont need this class.
 *
 * Thiss class requires intl extension
 *
 * @category    Mumsys
 * @package     Library
 * @subpackage  DateTime
 */
class Mumsys_DateTime_Formatter
    extends Mumsys_Abstract
    implements Mumsys_DateTime_Interface
{
    /**
     * Version ID information.
     */
    const VERSION = '1.0.0';

    /**
     * Locale to be used. E.g: en_US
     * @var string
     */
    private $_locale;

    /**
     * Date format string. E.g: Y-m-d H:i:s
     * @var string
     */
    private $_pattern;

    /**
     * DateTime object to initially start converting with __toSting magics.
     * @var \DateTime
     */
    private $_datetime;


    /**
     * Initialise the object.
     *
     * @param string $pattern Format of the datetime string, e.g: Y-m-d H:i:s
     * @param string $locale Locale to use, e.g: en_US
     * @param DateTime|null $datetime Optional datetime to run with __toSting method
     */
    public function __construct( $pattern, $locale = 'en_US',
        \DateTime | null $datetime = null )
    {
        $this->setLocale( $locale );
        $this->setPattern( $pattern );

        if ( $datetime !== null ) {
            $this->_datetime = $datetime;
        }
    }


    /**
     * Sets the locale.
     *
     * Unverified! Make sure a valid locale will be set.
     *
     * @param string $locale Locale like en_UK
     */
    public function setLocale( $locale ): void
    {
        $this->_locale = $locale;
    }


    /**
     * Sets the pattern for the output format.
     *
     * Note: the input format is fixed by the \DateTime object itselfs. When using
     * formatLocale() this pattern is used but may differ from standard DateTime patterns.
     *
     * @param string $pattern Output format, e.g: Y-m-d H:i:s
     */
    public function setPattern( $pattern ): void
    {
        $this->_pattern = $pattern;
    }


    /**
     * Returns the formatted string from given DateTime object based on given locale setting.
     *
     * This method you need if you need day or month names locale specific.
     *
     * @param DateTime $datetime DateTime object
     *
     * @return string Formatted, locale specific string
     */
    public function formatLocale( \DateTime $datetime ): string
    {
        $formatter = new \IntlDateFormatter(
            $this->_locale, \IntlDateFormatter::FULL, \IntlDateFormatter::FULL
        );
        $formatter->setPattern( $this->_pattern );

        return $formatter->format( $datetime );
    }


    /**
     * Returns the formatted string from given DateTime object based on given
     * locale setting on construction.
     *
     * @return string Formatted, locale specific string
     * @throws Mumsys_DateTime_Exception If DateTime not exists to convert/ format
     */
    public function __toString(): string
    {
        if ( $this->_datetime === null ) {
            throw new Mumsys_DateTime_Exception( 'DateTime not set' );
        }

        return $this->formatLocale( $this->_datetime );
    }

}
