<?php
/*
 * This example shows Arabic image-based output on the EPOS TEP 220m.
 *
 * Because escpos-php is not yet able to render Arabic correctly
 * on thermal line printers, small images are generated and sent
 * instead. This is a bit slower, and only limited formatting
 * is currently available in this mode.
 * 
 * Requirements are:
 *  - imagick extension (For the ImagePrintBuffer, which does not
 *      support gd at the time of writing)
 *  - ArPHP 4.0 (release date: Jan 8, 2016), available from SourceForge, for
 *      handling the layout for this example.
 */
 require_once("Escpos.php");
/*require_once('/../autoload.php');
require_once("/../Escpos/Printer.php");
require_once("/../Escpos/PrintConnectors/FilePrintConnector.php");
require_once("/../Escpos/PrintBuffers/ImagePrintBuffer.php");
require_once("/../Escpos/CapabilityProfiles/EposTepCapabilityProfile.php");
*/
/*
 * Drop Ar-php into the folder listed below:
 */
//require_once("/I18N/Arabic.php");
//$fontPath = "D:/wamp/www/arabic_test/ARABIC/I18N/Arabic/Font/trado.ttf";
$fontPath = dirname(__FILE__) ."/printlogo/I18N/Arabic/Font/trado.ttf";

/*
 * Inputs are some text, line wrapping options, and a font size. 
 */
$textUtf8 = "كريسبى دجاج سندويش";
$maxChars = 100;
$fontSize = 50;

/*
 * First, convert the text into LTR byte order with line wrapping,
 * Using the Ar-PHP library.
 * 
 * The Ar-PHP library uses the default internal encoding, and can print
 * a lot of errors depending on the input, so be prepared to debug
 * the next four lines.
 * 
 * Note that this output shows that numerals are converted to placeholder
 * characters, indicating that western numerals (123) have to be used instead.
 */
mb_internal_encoding("UTF-8");
$Arabic = new I18N_Arabic('Glyphs');
$textLtr = $Arabic -> utf8Glyphs($textUtf8, $maxChars);
$textLine = explode("\n", $textLtr);

/*
 * Set up and use an image print buffer with a suitable font
 */
$buffer = new ImagePrintBuffer();
$buffer -> setFont($fontPath);
$buffer -> setFontSize($fontSize);
    
$profile = EposTepCapabilityProfile::getInstance();
//$printername="\\\\192.168.1.4\\GP-80160(Cut) Series";
//$connector = new FilePrintConnector($printername); 
        // = new WindowsPrintConnector("LPT2");
        // Windows LPT2 was used in the bug tracker
$connector = new NetworkPrintConnector('192.168.1.43', '9100');
$printer = new Printer($connector, $profile);
//$printer = new Escpos($connector);
//$printer = new Printer($connector, $profile);

$printer -> setPrintBuffer($buffer);

$printer -> setJustification(Printer::JUSTIFY_LEFT);
foreach($textLine as $text) {
    // Print each line separately. We need to do this since Imagick thinks
    // text is left-to-right
    $printer -> text($text . "\n");
}

$printer -> cut();
$printer -> close();
