<?php

/**
 * Unit test for the VCardWriter implementation.
 *
 * This unit test provides some great methods for testing the VCardWriter.
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


use de\brainiiiii\vcard\VCardWriter;
use de\brainiiiii\vcard\TestVCardWriter;
use PHPUnit_Framework_TestCase;



/**
 * Unit test for the VCardWriter implementation.
 *
 * This unit test provides some great methods for testing the VCardWriter.
 *
 * @category utilities
 * @package vcard-utils
 * @author Kilian Lütkemeyer <kilian@luetkemeyer.com>
 * @copyright 2013 Kilian Lütkemeyer
 * @license http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link http://de.brainiiiii/projects/php-vcard-utils
 * @version 0.1alpha
 */
class VCardWriterTest extends PHPUnit_Framework_TestCase
{
	
	/**
	 * Writes a simple one lined output.
	 *
	 * @test
	 */
	public function testShortOutput()
	{
		$writer = new TestVCardWriter();
		
		$this->expectOutputString("Hello World!\r\n");
		$writer->printLineWrapper("Hello World!");
	}
	
	/**
	 * Writes two simple and short lines.
	 *
	 * @test
	 */
	public function testMultipleShortOutput()
	{
		$writer = new TestVCardWriter();
		
		$this->expectOutputString("Hello\r\nWorld!\r\n");
		$writer->printLineWrapper("Hello");
		$writer->printLineWrapper("World!");
	}
	
	/**
	 * Writing a UTF-8 string.
	 *
	 * @test
	 */
	public function testPrintUTF8()
	{
		$str = 'ÄÖÜ';
		
		// to be sure this file contains valid UTF-8
		$this->assertSame(3, mb_strlen($str, 'UTF-8'));
		
		$writer = new TestVCardWriter();
		$this->expectOutputString("ÄÖÜ\r\n");
		$writer->printLineWrapper($str);
	}
	
	/**
	 * Print a long line.
	 *
	 * Prints a line containing more than 75 octets which causes the use of the
	 * folding technique as described in RFC6450 section 3.2.
	 *
	 * @test
	 */
	public function testFolding()
	{
		$writer = new TestVCardWriter();
		
		$this->expectOutputString("This is a very long string with more than 75 character-octets, which will c\r\n ause the folding of the vcard data\r\n");
		$writer->printLineWrapper("This is a very long string with more than 75 character-octets, which will cause the folding of the vcard data");
	}
	
}