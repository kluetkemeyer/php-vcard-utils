<?php

/**
 * The writer module for VCards.
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
class VCardWriter implements VCardWriterInterface
{

	/**
	 * The character sequence for a line-break
	 *
	 * A line break will start a new line within the VCard format.
	 */
	const LINEBREAK = "\r\n";
	
	/**
	 * The character sequence for a break according to folding technique.
	 *
	 * This kind of linebreak is used to wrap a long line with more than 75 
	 * octets of character data into multiple lines without starting a new
	 * content line.
	 */
	const FOLDINGBREAK = "\r\n ";
	
	/**
	 * The maximal length of a single VCard line
	 *
	 * Lines longer than this length will be handled according to the folding
	 * strategy.
	 */
	const FOLDINGLENGTH = 75;
	
	/**
	 * The character encoding of the output.
	 *
	 * According to RFC6350 section 3.1. the charset MUST be UTF-8. Every other
	 * encoding is not allowed as format.
	 */
	const ENCODING = 'UTF-8';
	
	/**
	 * The output stream.
	 *
	 * This output stream is used to write the formatted VCard information to.
	 * 
	 * @var resource
	 */
	private $stream;
	
	
	/**
	 * Creates a new VCard writer.
	 *
	 * Creates a new writer, which will write the formatted VCard output into
	 * the given stream. This stream might be any file stream or some special
	 * stream like STDOUT.
	 *
	 * @param		resource			$outputStream
	 *				The stream to write the formatted VCard output to.
	 */
	public function __construct($outputStream)
	{
		$this->stream = $outputStream;
	}
	
	
	/**
	 * Prints a line to the given output stream.
	 *
	 * The line will be formatted according to RFC6350 section 3. This includes
	 * the UTF-8 charset format and a line folding technique limiting the 
	 * maximum width to 75 octets (excluding the linebreak).
	 *
	 * @param		string				$str
	 *				The content, that shall be written to the line. This content
	 *				MUST not start with a space or contain any linebreak 
	 *				character (U+000D or U+000A)
	 */
	protected function _printLine($str) 
	{
		while (mb_strlen($str, self::ENCODING) > self::FOLDINGLENGTH) {
			$line = mb_substr($str, 0, self::FOLDINGLENGTH, self::ENCODING);
			$str = mb_substr($str, self::FOLDINGLENGTH, mb_strlen($str, self::ENCODING), self::ENCODING);
			fputs($this->stream, $line . self::FOLDINGBREAK);
		}
		fputs($this->stream, $str . self::LINEBREAK);
	}	
	
	protected function _printContentLine($name, $value, $group=null, array $params=array())
	{
		$line = $group === null ? '' : $group . '.';
		$line .= $name;
		foreach($params as $key => $param) {
			$line .=';' 
				. ($param === null
						? $key
						: $key . '=' . $param);
		}
		$line .= ':' . $value;
		
		$this->_printLine($line);
	}
	
	/**
	 * Writes the initiation sequence.
	 *
	 * @param		string				$version
	 *				The version of the VCard object.
	 */
	public function startVCard($version = self::VCARD_VERSION_LATEST)
	{
		$this->_printLine('BEGIN:VCARD');
		$this->_printLine('VERSION:' . $version);
	}
	 
	/**
	 * Writes the finalization sequence.
	 */
	public function endVCard()
	{
		$this->_printLine('END:VCARD');
	}
}
 