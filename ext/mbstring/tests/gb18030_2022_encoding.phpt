--TEST--
Exhaustive test of verification and conversion of GB18030-2022 text
--EXTENSIONS--
mbstring
--SKIPIF--
<?php
if (getenv("SKIP_SLOW_TESTS")) die("skip slow test");
?>
--FILE--
<?php
include('encoding_tests.inc');
srand(2323); // Make results consistent
mb_substitute_character(0x25); // '%'

$updatedMappings = [
  "\xA6\xD9" => "\xFE\x10",
  "\xA6\xDA" => "\xFE\x12",
  "\xA6\xDB" => "\xFE\x11",
  "\xA6\xDC" => "\xFE\x13",
  "\xA6\xDD" => "\xFE\x14",
  "\xA6\xDE" => "\xFE\x15",
  "\xA6\xDF" => "\xFE\x16",
  "\xA6\xEC" => "\xFE\x17",
  "\xA6\xED" => "\xFE\x18",
  "\xA6\xF3" => "\xFE\x19",

  "\xA8\xBC" => "\x1E\x3F",
  "\xA8\xBF" => "\x01\xF9",
  "\xA9\x89" => "\x30\x3E",
  "\xA9\x8A" => "\x2F\xF0",
  "\xA9\x8B" => "\x2F\xF1",
  "\xA9\x8C" => "\x2F\xF2",
  "\xA9\x8D" => "\x2F\xF3",
  "\xA9\x8E" => "\x2F\xF4",
  "\xA9\x8F" => "\x2F\xF5",
  "\xA9\x90" => "\x2F\xF6",
  "\xA9\x91" => "\x2F\xF7",
  "\xA9\x92" => "\x2F\xF8",
  "\xA9\x93" => "\x2F\xF9",
  "\xA9\x94" => "\x2F\xFA",
  "\xA9\x95" => "\x2F\xFB",

  "\xFE\x50" => "\x2E\x81",
  "\xFE\x51" => "\xE8\x16",
  "\xFE\x52" => "\xE8\x17",
  "\xFE\x53" => "\xE8\x18",
  "\xFE\x54" => "\x2E\x84",
  "\xFE\x55" => "\x34\x73",
  "\xFE\x56" => "\x34\x47",
  "\xFE\x57" => "\x2E\x88",
  "\xFE\x58" => "\x2E\x8B",
  "\xFE\x59" => "\x9F\xB4",
  "\xFE\x5A" => "\x35\x9E",
  "\xFE\x5B" => "\x36\x1A",
  "\xFE\x5C" => "\x36\x0E",
  "\xFE\x5D" => "\x2E\x8C",
  "\xFE\x5E" => "\x2E\x97",
  "\xFE\x5F" => "\x39\x6E",

  "\xFE\x60" => "\x39\x18",
  "\xFE\x61" => "\x9F\xB5",
  "\xFE\x62" => "\x39\xCF",
  "\xFE\x63" => "\x39\xDF",
  "\xFE\x64" => "\x3A\x73",
  "\xFE\x65" => "\x39\xD0",
  "\xFE\x66" => "\x9F\xB6",
  "\xFE\x67" => "\x9F\xB7",
  "\xFE\x68" => "\x3B\x4E",
  "\xFE\x69" => "\x3C\x6E",
  "\xFE\x6A" => "\x3C\xE0",
  "\xFE\x6B" => "\x2E\xA7",
  "\xFE\x6C" => "\xE8\x31",
  "\xFE\x6D" => "\x9F\xB8",
  "\xFE\x6E" => "\x2E\xAA",
  "\xFE\x6F" => "\x40\x56",

  "\xFE\x76" => "\xE8\x3B",
  "\xFE\x7E" => "\x9F\xB9",
  "\xFE\x90" => "\x9F\xBA",
  "\xFE\x91" => "\xE8\x55",
  "\xFE\xA0" => "\x9F\xBB"];
testAllValidChars($updatedMappings, 'GB18030-2022', 'UTF-16BE', false);
testAllValidChars(array_flip($updatedMappings), 'UTF-16BE', 'GB18030-2022', false);

$sampleSMP = [
  "\x00\x10\x03\x08" => "\xDE\x30\xE6\x36",
  "\x00\x10\x14\xEB" => "\xDE\x34\xB8\x35",
  "\x00\x10\x29\x76" => "\xDE\x38\xCE\x34",
  "\x00\x10\x40\x6E" => "\xDF\x33\xA4\x34",
  "\x00\x10\x78\x7B" => "\xE0\x34\xD5\x33",
  "\x00\x01\x25\x2A" => "\x90\x37\xC6\x34",
  "\x00\x01\x5B\xA4" => "\x91\x38\xCF\x30",
  "\x00\x01\x6D\x81" => "\x92\x32\xA0\x33",
  "\x00\x01\x7F\xB2" => "\x92\x35\xF8\x30",
  "\x00\x01\x89\x9B" => "\x92\x37\xF9\x37",
  "\x00\x01\x9E\x77" => "\x93\x32\x99\x37",
  "\x00\x02\x08\x9A" => "\x95\x33\xE0\x38",
  "\x00\x02\x1B\x00" => "\x95\x37\xBF\x38",
  "\x00\x02\x31\xBE" => "\x96\x32\x90\x30",
  "\x00\x02\x64\xD4" => "\x97\x32\xBF\x38",
  "\x00\x02\xA9\xA0" => "\x98\x36\xBD\x30",
  "\x00\x02\xBA\x38" => "\x98\x39\xEB\x38",
  "\x00\x03\x1C\x13" => "\x9A\x39\xDC\x39",
  "\x00\x03\x20\x6D" => "\x9B\x30\xCE\x33",
  "\x00\x03\x22\xA9" => "\x9B\x31\x89\x35",
  "\x00\x03\x39\xB3" => "\x9B\x35\xDF\x33",
  "\x00\x03\xA7\xF2" => "\x9D\x38\x93\x36",
  "\x00\x03\xDF\xFB" => "\x9E\x39\xC4\x31",
  "\x00\x04\x01\x69" => "\x9F\x36\xA9\x39",
  "\x00\x04\x23\x79" => "\xA0\x33\x9F\x39",
  "\x00\x04\x26\x52" => "\xA0\x33\xE8\x38",
  "\x00\x04\x38\xDB" => "\xA0\x37\xCB\x33",
  "\x00\x04\x46\x84" => "\xA1\x30\xAF\x30",
  "\x00\x04\x6C\x7C" => "\xA1\x38\x8B\x30",
  "\x00\x04\x78\x41" => "\xA2\x30\xBC\x33",
  "\x00\x04\x97\x32" => "\xA2\x36\xE0\x34",
  "\x00\x04\x9E\xCC" => "\xA2\x38\xA7\x30",
  "\x00\x04\xC5\xDB" => "\xA3\x36\x9E\x39",
  "\x00\x04\xF4\xE2" => "\xA4\x35\xE4\x38",
  "\x00\x05\x3B\xA6" => "\xA6\x30\x96\x34",
  "\x00\x05\x76\x53" => "\xA7\x32\x8C\x35",
  "\x00\x05\xEA\x9F" => "\xA9\x35\xDB\x37",
  "\x00\x06\x12\x29" => "\xAA\x33\xDF\x39",
  "\x00\x06\x1B\x9E" => "\xAA\x35\xD6\x30",
  "\x00\x06\x3B\x26" => "\xAB\x32\x8B\x32",
  "\x00\x06\x4C\xA8" => "\xAB\x35\xD1\x34",
  "\x00\x06\x63\x3E" => "\xAC\x30\x9D\x36",
  "\x00\x06\xB3\xA1" => "\xAD\x36\xC7\x35",
  "\x00\x07\x0A\x31" => "\xAF\x34\x93\x35",
  "\x00\x07\x22\xA7" => "\xAF\x39\x8F\x37",
  "\x00\x07\x79\xA3" => "\xB1\x36\xE4\x35",
  "\x00\x07\x88\xFA" => "\xB1\x39\xF3\x32",
  "\x00\x07\xCE\xCA" => "\xB3\x34\x8C\x34",
  "\x00\x07\xF8\xD2" => "\xB4\x32\xD0\x34",
  "\x00\x08\x20\xF6" => "\xB5\x30\xE4\x30",
  "\x00\x08\xAD\x05" => "\xB7\x39\x9F\x35",
  "\x00\x08\xEA\x7E" => "\xB9\x31\xDD\x32",
  "\x00\x08\xF0\xB8" => "\xB9\x32\xFE\x36",
  "\x00\x09\x14\x07" => "\xBA\x30\x96\x35",
  "\x00\x09\x41\xDD" => "\xBA\x39\xBD\x39",
  "\x00\x09\x42\xEF" => "\xBA\x39\xD9\x33",
  "\x00\x07\x22\xA7" => "\xAF\x39\x8F\x37",
  "\x00\x07\x79\xA3" => "\xB1\x36\xE4\x35",
  "\x00\x07\x88\xFA" => "\xB1\x39\xF3\x32",
  "\x00\x07\xCE\xCA" => "\xB3\x34\x8C\x34",
  "\x00\x07\xF8\xD2" => "\xB4\x32\xD0\x34",
  "\x00\x08\x20\xF6" => "\xB5\x30\xE4\x30",
  "\x00\x08\xAD\x05" => "\xB7\x39\x9F\x35",
  "\x00\x08\xEA\x7E" => "\xB9\x31\xDD\x32",
  "\x00\x08\xF0\xB8" => "\xB9\x32\xFE\x36",
  "\x00\x09\x14\x07" => "\xBA\x30\x96\x35",
  "\x00\x09\x41\xDD" => "\xBA\x39\xBD\x39",
  "\x00\x09\x42\xEF" => "\xBA\x39\xD9\x33",
  "\x00\x09\xBA\x2B" => "\xBD\x33\xF5\x37",
  "\x00\x0A\x26\x00" => "\xBF\x35\xEA\x32",
  "\x00\x0A\x36\xE9" => "\xBF\x39\xA3\x31",
  "\x00\x0A\x7A\x20" => "\xC1\x32\xF5\x38",
  "\x00\x0A\x9C\x93" => "\xC1\x39\xF5\x37",
  "\x00\x0A\xC0\xD7" => "\xC2\x37\xA6\x31",
  "\x00\x0A\xD8\x77" => "\xC3\x32\x8C\x39",
  "\x00\x0B\x1A\x9B" => "\xC4\x35\xC4\x31",
  "\x00\x0B\x4F\x27" => "\xC5\x36\x9B\x33",
  "\x00\x0B\x72\x6D" => "\xC6\x33\xB0\x33",
  "\x00\x0B\xEE\x23" => "\xC8\x38\xC1\x33",
  "\x00\x0B\xF0\xDF" => "\xC8\x39\x89\x33",
  "\x00\x0C\x0B\xE1" => "\xC9\x34\xC6\x37",
  "\x00\x0C\x4C\x98" => "\xCA\x37\xD9\x34",
  "\x00\x0C\x5F\x41" => "\xCB\x31\xBF\x31",
  "\x00\x0C\x63\xE4" => "\xCB\x32\xB7\x38",
  "\x00\x0C\x70\x0A" => "\xCB\x34\xF2\x38",
  "\x00\x0C\xAD\x6A" => "\xCC\x37\xB0\x30",
  "\x00\x0C\xCC\x03" => "\xCD\x33\xCB\x33",
  "\x00\x0C\xD5\x4C" => "\xCD\x35\xBD\x30",
  "\x00\x0C\xE6\x70" => "\xCD\x38\xF9\x38",
  "\x00\x0D\x1B\x6A" => "\xCE\x39\xDC\x30",
  "\x00\x0D\x55\xEE" => "\xD0\x31\xCE\x30",
  "\x00\x0D\xBB\xB1" => "\xD2\x32\xA5\x31",
  "\x00\x0D\xC0\x4F" => "\xD2\x33\x9D\x33",
  "\x00\x0D\xFA\x84" => "\xD3\x35\x87\x34",
  "\x00\x0E\x16\x71" => "\xD4\x30\xDC\x33",
  "\x00\x0E\x1E\x03" => "\xD4\x32\xA2\x31",
  "\x00\x0E\x20\xE8" => "\xD4\x32\xEC\x32",
  "\x00\x0E\x39\x6A" => "\xD4\x37\xE9\x36",
  "\x00\x0E\x6A\x95" => "\xD5\x37\xE8\x33",
  "\x00\x0E\x7E\xCD" => "\xD6\x31\xF5\x39",
  "\x00\x0E\x80\x69" => "\xD6\x32\xA1\x31",
  "\x00\x0E\x9A\x7F" => "\xD6\x37\xC6\x39",
  "\x00\x0E\xEE\x12" => "\xD8\x34\xC4\x34",
  "\x00\x0E\xFC\xA1" => "\xD8\x37\xBF\x31",
  "\x00\x0F\x29\xB0" => "\xD9\x36\xD2\x36",
  "\x00\x0F\x2A\x12" => "\xD9\x36\xDC\x34",
  "\x00\x0F\x6C\x8C" => "\xDB\x30\x9E\x32",
  "\x00\x0F\xAF\x04" => "\xDC\x33\xDD\x38",
  "\x00\x0F\xBE\x65" => "\xDC\x36\xED\x35",
  "\x00\x0F\xE5\x88" => "\xDD\x34\xE7\x34",
  "\x00\x0F\xE7\xB1" => "\xDD\x35\xA0\x37",
  "\x00\x0F\xF4\x27" => "\xDD\x37\xE3\x37"];
testAllValidChars($sampleSMP, 'UTF-32BE', 'GB18030-2022', false);

function readGB18030_2022_ConversionTable($path, &$from, &$to, $utf32 = false) {
    $from = [];
    $to   = [];

    $fp = fopen($path, 'r+');
    while ($line = fgets($fp, 256)) {
        if ($line[0] == '#')
            continue;
        if (sscanf($line, "%x\t%x", $codepoint, $char) == 2) {
            $codepoint = $utf32 ? pack('N', $codepoint) : pack('n', $codepoint);
            if ($char == PHP_INT_MAX) {
                // We may be on a 32-bit machine and testing a text encoding with 4-byte codes
                // (which can't be represented in a PHP integer)
                $char = "";
                for ($i = 2; $i < strlen($line); $i += 2) {
                    $substr = substr($line, $i, 2);
                    if (ctype_xdigit($substr))
                        $char .= chr(hexdec($substr));
                    else
                        break;
                }
            } else {
                if ($char <= 0xFF)
                    $char = chr($char); // hex codes must not have leading zero bytes
                else if ($char <= 0xFFFF)
                    $char = pack('n', $char);
                else if ($char <= 0xFFFFFF)
                    $char = chr($char >> 16) . pack('n', $char & 0xFFFF);
                else
                    $char = pack('N', $char);
            }
            $from[$char] = $codepoint;
            $to[$codepoint] = $char;
        }
    }
}

readGB18030_2022_ConversionTable(__DIR__ . '/data/GB18030-2022MappingTableBMP.txt', $toUnicode, $fromUnicode);

// We will test 4-byte codes separately
findInvalidChars($toUnicode, $invalid, $truncated);

function notFourByteCode($gb) {
  return ((ord($gb) < 0x81 || ord($gb) > 0x84) && (ord($gb) < 0x90 || ord($gb) > 0xE3)) ||
    (strlen($gb) > 1 && (ord($gb[1]) < 0x30 || ord($gb[1]) > 0x39));
}

$invalid = array_filter($invalid, 'notFourByteCode', ARRAY_FILTER_USE_KEY);
$truncated = array_filter($truncated, 'notFourByteCode', ARRAY_FILTER_USE_KEY);

testAllValidChars($toUnicode, 'GB18030-2022', 'UTF-16BE', false);
testAllInvalidChars($invalid, $toUnicode, 'GB18030-2022', 'UTF-16BE', "\x00%");
testTruncatedChars($truncated, 'GB18030-2022', 'UTF-16BE', "\x00%");

echo "Tested GB18030-2022 (BMP) -> UTF-16BE\n";

// Test one random 4-byte code for each range used for Unicode codepoints in BMP
function fourByteCodeIndex($byte4, $byte3, $byte2, $byte1) {
  return (($byte4 - 0x81) * 10 * 126 * 10) + (($byte3 - 0x30) * 10 * 126) + (($byte2 - 0x81) * 10) + ($byte1 - 0x30);
}

function fourByteCodeFromIndex($index) {
  $quotient = intdiv($index, 10 * 126 * 10);
  $byte4 = $quotient + 0x81;
  $index -= ($quotient * 10 * 126 * 10);
  $quotient = intdiv($index, 10 * 126);
  $byte3 = $quotient + 0x30;
  $index -= ($quotient * 10 * 126);
  $quotient = intdiv($index, 10);
  $byte2 = $quotient + 0x81;
  $byte1 = $index - ($quotient * 10) + 0x30;
  return chr($byte4) . chr($byte3) . chr($byte2) . chr($byte1);
}

// Invalid 4-byte codes in range for BMP
testInvalidString("\x81\x30\x81\xFF", "\x00\x00\x00%", "GB18030-2022", "UTF-32BE");
testInvalidString("\x84\x31\xA4\x40", "\x00\x00\x00%", "GB18030-2022", "UTF-32BE");
testInvalidString("\x84\x31\xA5\x30", "\x00\x00\x00%", "GB18030-2022", "UTF-32BE");
testInvalidString("\x84\x32\x81\x30", "\x00\x00\x00%", "GB18030-2022", "UTF-32BE");
testInvalidString("\x85\x31\x81\x30", "\x00\x00\x00%\x00\x00\x00%", "GB18030-2022", "UTF-32BE");

// Valid 4-byte codes for other Unicode planes
testValidString("\x90\x30\x81\x30", "\x00\x01\x00\x00", "GB18030-2022", "UTF-32BE");
testValidString("\xE3\x32\x9A\x35", "\x00\x10\xFF\xFF", "GB18030-2022", "UTF-32BE");

// Invalid 4-byte codes for other Unicode planes
testInvalidString("\x90\x30\x81\xFF", "\x00\x00\x00%", "GB18030-2022", "UTF-32BE");
testInvalidString("\xE3\x32\x9A\x36", "\x00\x00\x00%", "GB18030-2022", "UTF-32BE");
testInvalidString("\xE4\x30\x81\x35", "\x00\x00\x00%\x00\x00\x00%", "GB18030-2022", "UTF-32BE");

testInvalidString("\x90\x30\x80\x30", "\x00\x00\x00%\x00\x00\x00\x30", "GB18030-2022", "UTF-32BE");

echo "Tested GB18030-2022 (SMP) <-> UTF-32BE\n";

testAllValidChars($fromUnicode, 'UTF-16BE', 'GB18030-2022', false);
echo "Tested UTF-16BE -> GB18030-2022 (BMP)\n";

convertInvalidString("\xAA\xB8\x2D\x38\x00\x00\x00#", "%#", "UTF-32BE", "GB18030-2022");

// Test "long" illegal character markers
mb_substitute_character("long");
convertInvalidString("\x81\x30\x81\xFF", "%", "GB18030-2022", "UTF-8");
convertInvalidString("\xE3\x32\x9A\x36", "%", "GB18030-2022", "UTF-8");

echo "Done!\n";
?>
--EXPECT--
Tested GB18030-2022 (BMP) -> UTF-16BE
Tested GB18030-2022 (SMP) <-> UTF-32BE
Tested UTF-16BE -> GB18030-2022 (BMP)
Done!
