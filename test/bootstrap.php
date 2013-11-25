<?php

/**
 * Bootstraps the test module.
 *
 * The file contains all commands, that must be executed to bootstrap the
 * testing progress.
 *
 * The MIT License (MIT)
 * 
 * Copyright (c) 2013 Kilian Lütkemeyer
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category utilities
 * @package vcard-utils
 * @author Kilian Lütkemeyer <kilian@luetkemeyer.com>
 * @copyright 2013 Kilian Lütkemeyer
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link http://de.brainiiiii/projects/php-vcard-utils
 * @version 0.1alpha
 * @since File available since version 0.1alpha
 */

 
spl_autoload_register('test_autoload');
 
 
function test_autoload($classname) {
	$includePath = array(dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR . 'src',
	dirname(__FILE__));
	
	$filename = strtr(trim($classname, '\\'), '\\', DIRECTORY_SEPARATOR) . '.php';
	foreach($includePath as $base) {
		$fn = rtrim($base, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR . $filename;
		if (file_exists($fn)) {
			require_once $fn;
			return true;
		}
	}
	return false;
}