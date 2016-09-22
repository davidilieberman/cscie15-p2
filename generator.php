<?php

// Load our source words into an array
$lines = file('./words.txt');

// Set up our array of special characters
$charsArray = array('@', '#', '$', '%', '^', '*', '?', '!');

// Debugging function: write the current state of the word array to output
function echoLines($lines)
{
    echo "<p>\n";
    foreach ($lines as $line_num => $line) {
        $l = trim($line);
        echo "Line #<b>{$line_num}</b>: \"${l}\" <br/>\n";
    }
    echo "</p>\n";
}

/**
Convenience function for pulling a random special character from
our array of them.
*/
function getChar($charsArray)
{
    return $charsArray[mt_rand(0, count($charsArray) - 1)];
}

// Construct the password
function concatPwd($lines, $numComponents, $charsArray, $params)
{
    // Initialize the passphrase to an empty string
    $pwd = '';
    for ($i = 0; $i < $numComponents; ++$i) {

        // Pick a random index into the array
        $r = mt_rand(0, count($lines) - 1);

        // Splice the word at index $r out of the array so that it is only
        // used once.
        $w = trim(array_splice($lines, $r, 1)[0]);

        // If the user has selected the "special characters" option,
        // we prepend a randomly-selected character to each word
        if (radioState('specialChars', $params)) {
            debug('generator.php.concatPwd(): handling special characters');
            $w = getChar($charsArray).$w;
        }

        // Append the word to our passphrase
        $pwd .= $w;
        if ($i < $numComponents - 1) {
            $pwd .= '-';
        }

        // If the user has selected the "include numbers" option,
        // we inject a random five-digit number in the middle of the
        // passphrase
        if (radioState('includeNums', $params) && $i == floor($numComponents / 2) - 1) {
            $r = mt_rand(10000, 99999);
            $pwd .= $r . '-';
        }
    }

    return $pwd;
}

// If the user has submitted a generation request, either show the
// validation error message if validation has failed or run the request.
if (isset($params['submitted'])) {
    if ($validation['valid']) {
        debug("generator.php: specialChars is $specialChars");
        $pwd = concatPwd($lines, $validation['num'], $charsArray, $params);
        echo "Your password is $pwd";
    } else {
        echo "<span class='error'>".$validation['msg'].'</span>';
    }
}
