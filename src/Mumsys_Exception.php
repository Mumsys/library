<?php

/*{{{*/
/**
 * ----------------------------------------------------------------------------
 * MUMSYS 2 Library for Multi User Management Interface
 * ----------------------------------------------------------------------------
 * @author Florian Blasel <flobee.code@gmail.com>
 * ----------------------------------------------------------------------------
 * @copyright (c) 2015 by Florian Blasel
 * ----------------------------------------------------------------------------
 * @license LGPL Version 3 http://www.gnu.org/licenses/lgpl-3.0.txt
 * ----------------------------------------------------------------------------
 * @category    Mumsys
 * @package     Mumsys_Library
 * @version 0.1 - Created on 2009-11-27
 * $Id$
 */
/*}}}*/


/**
 * Generic Exception class
 *
 * @category    Mumsys
 * @package     Mumsys_Library
 */
class Mumsys_Exception extends Exception {
    /**
     * Default error code for technical errors, no futher reason as discribed
     * in the error message.
     */
     const ERRCODE_DEFAULT = 1;
}

