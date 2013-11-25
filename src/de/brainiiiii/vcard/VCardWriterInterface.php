<?php

/**
 * Interface for a VCard writer module.
 *
 * The module for handling the output formatting of VCard information files 
 * according to RFC6530.
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
namespace de\brainiiiii\vcard;


use de\brainiiiii\vcard\VCardWriterInterface;


/**
 * The default writer for VCards.
 *
 * This class is used for writing valid formed VCards according to RFC6450. The
 * output will be written to the stream given as parameter on construction.
 *
 * @category utilities
 * @package vcard-utils
 * @author Kilian Lütkemeyer <kilian@luetkemeyer.com>
 * @copyright 2013 Kilian Lütkemeyer
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link http://de.brainiiiii/projects/php-vcard-utils
 * @version 0.1alpha
 */
interface VCardWriterInterface
{

	const VCARD_VERSION_4_0 = '4.0';
	
	const VCARD_VERSION_LATEST = self::VCARD_VERSION_4_0;

	/**
	 * Writes the initiation sequence.
	 *
	 * @param		string				$version
	 *				The version of the VCard object.
	 */
	public function startVCard($version = self::VCARD_VERSION_LATEST);
	 
	 
	/**
	 * Writes the finalization sequence.
	 */
	public function endVCard();
}
 